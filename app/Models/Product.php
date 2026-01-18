<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['name', 'category', 'base_price'];
    
    // Remove 'stock' from fillable since it will be calculated
    
    /**
     * Relationship to variants
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
    
    /**
     * Calculate total stock from all variants
     */
    public function getStockAttribute(): int
    {
        return $this->variants->sum('stock');
    }
    
    /**
     * Get base price for display
     */
    public function getPriceDisplayAttribute(): string
    {
        return 'R' . number_format($this->base_price, 2);
    }
}