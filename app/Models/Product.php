<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'cost_price',
        'original_price',
        'stock',
        'weight',
        'image',
        'gallery',
        'category',
        'rating',
        'is_active',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'rating' => 'float',
        'gallery' => 'array',
    ];

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedOriginalPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->original_price, 0, ',', '.');
    }

    public function variants(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductReview::class)->where('is_visible', true);
    }

    public function getRatingStats()
    {
        $total = $this->reviews()->count();
        $stats = [
            5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0
        ];

        if ($total > 0) {
            $counts = $this->reviews()
                ->selectRaw('rating, count(*) as count')
                ->groupBy('rating')
                ->pluck('count', 'rating');

            foreach ($counts as $rating => $count) {
                $stats[$rating] = round(($count / $total) * 100);
            }
        }

        return [
            'total' => $total,
            'average' => round($this->reviews()->avg('rating') ?? 0, 1),
            'percentages' => $stats
        ];
    }
}
