<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id', 'color', 'size', 
        'price_adjustment', 'stock'
    ];
    
    /**
     * Relationship to parent product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    
    /**
     * Calculate final price (base + adjustment)
     */
    public function getFinalPriceAttribute(): float
    {
        return $this->product->base_price + $this->price_adjustment;
    }
    
    /**
     * Get display price
     */
    public function getPriceDisplayAttribute(): string
    {
        return 'R' . number_format($this->final_price, 2);
    }
}