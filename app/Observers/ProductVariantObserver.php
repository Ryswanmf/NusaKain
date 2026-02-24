<?php

namespace App\Observers;

use App\Models\ProductVariant;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Log;

class ProductVariantObserver
{
    /**
     * Handle the ProductVariant "updated" event.
     */
    public function updated(ProductVariant $variant): void
    {
        if ($variant->wasChanged('stock') && $variant->getOriginal('stock') <= 0 && $variant->stock > 0) {
            $this->notifyUsers($variant);
        }
    }

    protected function notifyUsers(ProductVariant $variant)
    {
        $product = $variant->product;
        
        $wishlists = Wishlist::where('product_id', $product->id)
            ->where('notify_stock', true)
            ->with('user')
            ->get();

        foreach ($wishlists as $wishlist) {
            Log::info("STOK VARIAN TERSEDIA: Mengirim notifikasi ke {$wishlist->user->name} untuk produk {$product->name} (Varian: {$variant->name})");
            $wishlist->update(['notify_stock' => false]);
        }
    }
}
