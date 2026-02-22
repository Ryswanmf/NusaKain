<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with(['product', 'variant'])
            ->where('user_id', Auth::id())
            ->get();
            
        return view('landing_page.cart', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_variant_id' => 'nullable|exists:product_variants,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->where('product_variant_id', $request->product_variant_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity ?? 1);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'product_variant_id' => $request->product_variant_id,
                'quantity' => $request->quantity ?? 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function destroy(CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function checkout()
    {
        $cartItems = CartItem::with(['product', 'variant'])->where('user_id', Auth::id())->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $totalWeight = $cartItems->sum(function($item) {
            return ($item->variant->weight ?? $item->product->weight) * $item->quantity;
        });

        $totalAmount = $cartItems->sum(function($item) {
            $price = $item->variant ? ($item->variant->price ?? $item->product->price) : $item->product->price;
            return $price * $item->quantity;
        });

        return view('landing_page.checkout', compact('cartItems', 'totalWeight', 'totalAmount'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'address_detail' => 'required|string',
            'postal_code' => 'required|string|max:10',
        ]);

        $cartItems = CartItem::with(['product', 'variant'])->where('user_id', Auth::id())->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        return \Illuminate\Support\Facades\DB::transaction(function () use ($cartItems, $request) {
            $productTotal = $cartItems->sum(function($item) {
                $price = $item->variant ? ($item->variant->price ?? $item->product->price) : $item->product->price;
                return $price * $item->quantity;
            });

            $totalWeight = $cartItems->sum(function($item) {
                return ($item->variant->weight ?? $item->product->weight) * $item->quantity;
            });

            // For now, simple flat shipping or 0 until RajaOngkir is integrated
            $shippingCost = 0; 
            $totalAmount = $productTotal + $shippingCost;
            
            $orderNumber = 'NK-' . strtoupper(\Illuminate\Support\Str::random(8));

            // Create Order
            $order = \App\Models\Order::create([
                'user_id' => Auth::id(),
                'order_number' => $orderNumber,
                'total_amount' => $totalAmount,
                'shipping_cost' => $shippingCost,
                'total_weight' => $totalWeight,
                'receiver_name' => $request->receiver_name,
                'receiver_phone' => $request->receiver_phone,
                'address_detail' => $request->address_detail,
                'postal_code' => $request->postal_code,
                'status' => 'pending',
                'payment_status' => 'unpaid',
            ]);

            // Create Order Items
            foreach ($cartItems as $item) {
                $unitPrice = $item->variant ? ($item->variant->price ?? $item->product->price) : $item->product->price;
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->product_variant_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $unitPrice,
                ]);
            }

            // Get Midtrans Snap Token
            $midtrans = new MidtransService();
            $snapToken = $midtrans->getSnapToken($order);
            
            $order->update(['snap_token' => $snapToken]);

            // Clear Cart
            CartItem::where('user_id', Auth::id())->delete();

            return redirect()->route('customer.orders.show', $order->order_number);
        });
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        if ($hashed == $request->signature_key) {
            $order = \App\Models\Order::where('order_number', $request->order_id)->first();
            if ($order) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $order->update(['payment_status' => 'paid', 'status' => 'processing']);
                } elseif ($request->transaction_status == 'pending') {
                    $order->update(['payment_status' => 'pending']);
                } elseif ($request->transaction_status == 'deny' || $request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
                    $order->update(['payment_status' => 'failed']);
                }
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function orders()
    {
        $orders = \App\Models\Order::where('user_id', Auth::id())->latest()->paginate(10);
        return view('landing_page.orders.index', compact('orders'));
    }

    public function showOrder($order_number)
    {
        $order = \App\Models\Order::where('user_id', Auth::id())
            ->where('order_number', $order_number)
            ->with('items.product')
            ->firstOrFail();
            
        return view('landing_page.orders.show', compact('order'));
    }
}
