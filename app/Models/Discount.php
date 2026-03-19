<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'type',
        'value',
        'min_order_amount',
        'usage_limit',
        'used_count',
        'active',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
        'active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    /**
     * Check if the discount is currently active
     */
    public function getIsActiveAttribute(): bool
    {
        if (!$this->active) {
            return false;
        }

        $now = now();
        
        if ($this->starts_at && $this->starts_at > $now) {
            return false;
        }

        if ($this->ends_at && $this->ends_at < $now) {
            return false;
        }

        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            return false;
        }

        return true;
    }

    /**
     * Apply discount to a price
     */
    public function applyTo(float $price): float
    {
        if (!$this->getIsActiveAttribute()) {
            return $price;
        }

        if ($this->type === 'percentage') {
            $discount = $price * ($this->value / 100);
            return max(0, $price - $discount);
        }

        // Fixed discount
        return max(0, $price - $this->value);
    }
}