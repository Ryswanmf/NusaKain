<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order_amount',
        'limit_per_user',
        'max_uses',
        'used_count',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
    ];

    public function isValid($totalAmount)
    {
        if (!$this->is_active) return false;
        
        if ($this->start_date && now()->lt($this->start_date)) return false;
        
        if ($this->end_date && now()->gt($this->end_date)) return false;
        
        if ($this->max_uses && $this->used_count >= $this->max_uses) return false;
        
        if ($totalAmount < $this->min_order_amount) return false;

        return true;
    }

    public function calculateDiscount($totalAmount)
    {
        if ($this->type === 'fixed') {
            return min($this->value, $totalAmount);
        }

        return ($this->value / 100) * $totalAmount;
    }
}
