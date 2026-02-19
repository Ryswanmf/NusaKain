<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'client_name',
        'description',
        'image',
        'category',
        'project_date',
        'is_published',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($portfolio) {
            if (empty($portfolio->slug)) {
                $portfolio->slug = Str::slug($portfolio->title);
            }
        });
    }

    protected $casts = [
        'is_published' => 'boolean',
        'project_date' => 'date',
    ];
}
