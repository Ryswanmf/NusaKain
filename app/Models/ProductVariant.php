<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'sku',
        'price',
        'stock',
        'weight',
        'image',
    ];

    public function getFormattedPriceAttribute(): string
    {
        $price = $this->price ?? $this->product->price;
        return 'Rp ' . number_format($price, 0, ',', '.');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
