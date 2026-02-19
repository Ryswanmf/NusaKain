<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();
            
        return view('landing_page.cart', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity ?? 1);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
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

    public function checkout(Request $request)
    {
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong.');
        }

        return \Illuminate\Support\Facades\DB::transaction(function () use ($cartItems) {
            $totalAmount = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
            $orderNumber = 'NK-' . strtoupper(\Illuminate\Support\Str::random(8));

            // Create Order
            $order = \App\Models\Order::create([
                'user_id' => Auth::id(),
                'order_number' => $orderNumber,
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            // Create Order Items
            foreach ($cartItems as $item) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->product->price,
                ]);
            }

            // Clear Cart
            CartItem::where('user_id', Auth::id())->delete();

            // Prepare WA Message
            $waNumber = '6289515915699';
            $message = "Halo Nusakain, saya ingin konfirmasi pesanan baru!\n\n";
            $message .= "*Nomor Pesanan:* #{$orderNumber}\n";
            $message .= "*Nama:* " . Auth::user()->name . "\n\n";
            $message .= "*Daftar Produk:*\n";
            foreach ($order->items as $item) {
                $message .= "- {$item->product->name} ({$item->quantity}m)\n";
            }
            $message .= "\n*Total:* Rp" . number_format($totalAmount, 0, ',', '.') . "\n\n";
            $message .= "Mohon informasikan langkah pembayaran selanjutnya. Terima kasih.";

            $waUrl = "https://wa.me/{$waNumber}?text=" . urlencode($message);

            return redirect()->away($waUrl);
        });
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
