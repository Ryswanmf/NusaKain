<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CartController extends Controller
{
    public function downloadInvoice($order_number)
    {
        $order = \App\Models\Order::where('user_id', Auth::id())
            ->where('order_number', $order_number)
            ->with(['items.product', 'items.variant'])
            ->firstOrFail();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('landing_page.orders.invoice', compact('order'));
        
        return $pdf->download('Invoice-' . $order->order_number . '.pdf');
    }

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
            'quantity' => 'nullable|numeric|min:0.1',
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
            'quantity' => 'required|numeric|min:0.1',
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

        $discount = 0;
        $appliedVoucher = null;
        
        if (session()->has('applied_voucher')) {
            $voucher = \App\Models\Voucher::where('code', session('applied_voucher'))->first();
            if ($voucher && $voucher->isValid($totalAmount)) {
                $discount = $voucher->calculateDiscount($totalAmount);
                $appliedVoucher = $voucher;
            } else {
                session()->forget('applied_voucher');
            }
        }

        return view('landing_page.checkout', compact('cartItems', 'totalWeight', 'totalAmount', 'discount', 'appliedVoucher'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'city' => 'required|string',
            'address_detail' => 'required|string',
            'postal_code' => 'required|string|max:10',
            'courier' => 'required',
            'shipping_service' => 'required',
            'shipping_cost' => 'required|numeric',
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

            // Per 4kg (4000 gram) ongkos kirim nya 20 ribu
            $shippingCost = ceil(max($totalWeight, 1) / 4000) * 20000; 
            
            // Apply Voucher Discount
            $discount = 0;
            $voucherCode = null;
            if (session()->has('applied_voucher')) {
                $voucher = \App\Models\Voucher::where('code', session('applied_voucher'))->first();
                if ($voucher && $voucher->isValid($productTotal)) {
                    $discount = $voucher->calculateDiscount($productTotal);
                    $voucherCode = $voucher->code;
                    $voucher->increment('used_count');
                }
            }

            $totalAmount = ($productTotal - $discount) + $shippingCost;
            
            $orderNumber = 'NK-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(6));

            // Create Order
            $order = \App\Models\Order::create([
                'user_id' => Auth::id(),
                'order_number' => $orderNumber,
                'total_amount' => $totalAmount,
                'shipping_cost' => $shippingCost,
                'total_weight' => $totalWeight,
                'voucher_code' => $voucherCode,
                'discount_amount' => $discount,
                'city_id' => $request->city, // Store city name
                'courier' => strtoupper($request->courier),
                'shipping_service' => $request->shipping_service,
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
                $costPrice = $item->variant ? ($item->variant->cost_price ?? $item->product->cost_price) : $item->product->cost_price;
                
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->product_variant_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $unitPrice,
                    'cost_price' => $costPrice,
                ]);
            }

            // Get Midtrans Snap Token
            $midtrans = new MidtransService();
            $snapToken = $midtrans->getSnapToken($order);
            
            $order->update(['snap_token' => $snapToken]);

            // Clear Cart and Voucher Session
            CartItem::where('user_id', Auth::id())->delete();
            session()->forget('applied_voucher');

            return redirect()->route('customer.orders.show', $order->order_number);
        });
    }

    public function callback(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Midtrans Callback Received', $request->all());

        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        if ($hashed == $request->signature_key) {
            \Illuminate\Support\Facades\Log::info('Midtrans Signature Validated');
            $order = \App\Models\Order::where('order_number', $request->order_id)->first();
            if ($order) {
                $transaction = $request->transaction_status;
                $type = $request->payment_type;
                $order_id = $request->order_id;
                $fraud = $request->fraud_status;

                if ($transaction == 'capture' || $transaction == 'settlement') {
                    if ($type == 'credit_card' && $fraud == 'challenge') {
                        $order->update(['payment_status' => 'pending']);
                    } else {
                        // Jika status sebelumnya belum paid, maka kurangi stok
                        if ($order->payment_status !== 'paid') {
                            $this->reduceStock($order);
                            $order->update(['payment_status' => 'paid', 'status' => 'processing']);
                        }
                    }
                } elseif ($transaction == 'pending') {
                    $order->update(['payment_status' => 'pending']);
                } elseif ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
                    $order->update(['payment_status' => 'failed']);
                }
            }
        } else {
            \Illuminate\Support\Facades\Log::error('Midtrans Invalid Signature', [
                'expected' => $hashed,
                'received' => $request->signature_key
            ]);
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

        $midtrans = new MidtransService();

        // Sync status from Midtrans if still pending/unpaid locally
        if (in_array($order->payment_status, ['unpaid', 'pending'])) {
            $status = $midtrans->status($order->order_number);
            
            if ($status) {
                $transaction = $status->transaction_status;
                if ($transaction == 'capture' || $transaction == 'settlement') {
                    // Update Stok if first time paid
                    if ($order->payment_status !== 'paid') {
                        $this->reduceStock($order);
                        $order->update(['payment_status' => 'paid', 'status' => 'processing']);
                    }
                } elseif ($transaction == 'pending') {
                    $order->update(['payment_status' => 'pending']);
                } elseif (in_array($transaction, ['deny', 'expire', 'cancel'])) {
                    $order->update(['payment_status' => 'failed']);
                }
            }
        }

        // Regenerate snap token if missing and unpaid
        if ($order->payment_status === 'unpaid' && !$order->snap_token) {
            try {
                $snapToken = $midtrans->getSnapToken($order);
                $order->update(['snap_token' => $snapToken]);
            } catch (\Exception $e) {
                logger()->error('Midtrans Snap Token Error: ' . $e->getMessage());
            }
        }
            
        return view('landing_page.orders.show', compact('order'));
    }

    public function confirmReceipt(\App\Models\Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'shipped') {
            return redirect()->back()->with('error', 'Hanya pesanan yang sudah dikirim yang dapat dikonfirmasi.');
        }

        $order->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Terima kasih! Pesanan Anda telah selesai. Silakan berikan review.');
    }

    private function reduceStock($order)
    {
        \Illuminate\Support\Facades\DB::transaction(function () use ($order) {
            foreach ($order->items as $item) {
                if ($item->product_variant_id) {
                    $variant = \App\Models\ProductVariant::lockForUpdate()->find($item->product_variant_id);
                    if ($variant) {
                        $variant->decrement('stock', $item->quantity);
                    }
                } else {
                    $product = \App\Models\Product::lockForUpdate()->find($item->product_id);
                    if ($product) {
                        $product->decrement('stock', $item->quantity);
                    }
                }
            }
        });
    }
}
