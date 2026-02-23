<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
            'image' => 'nullable|image|max:2048',
        ]);

        $order = Order::where('id', $request->order_id)
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->firstOrFail();

        // Cek apakah sudah pernah direview
        $exists = ProductReview::where('order_id', $order->id)
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Anda sudah memberikan review untuk produk ini.');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reviews', 'public');
        }

        ProductReview::create([
            'user_id' => Auth::id(),
            'order_id' => $order->id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'image' => $imagePath,
        ]);

        // Update Rating Produk (Rata-rata)
        $product = \App\Models\Product::find($request->product_id);
        $avgRating = ProductReview::where('product_id', $product->id)->avg('rating');
        $product->update(['rating' => $avgRating]);

        return redirect()->back()->with('success', 'Terima kasih atas review Anda!');
    }
}
