<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        // Check if stock changed from 0 to something positive
        if ($product->wasChanged('stock') && $product->getOriginal('stock') <= 0 && $product->stock > 0) {
            $this->notifyUsers($product);
        }
    }

    protected function notifyUsers(Product $product)
    {
        $wishlists = Wishlist::where('product_id', $product->id)
            ->where('notify_stock', true)
            ->with('user')
            ->get();

        foreach ($wishlists as $wishlist) {
            // Log for debugging
            Log::info("STOK TERSEDIA: Mengirim notifikasi ke {$wishlist->user->name} untuk produk {$product->name}");
            
            // Here you can trigger real notifications like:
            // $wishlist->user->notify(new \App\Notifications\ProductBackInStock($product));
            
            // Optionally clear the notification request after sending
            $wishlist->update(['notify_stock' => false]);
        }
    }
}
