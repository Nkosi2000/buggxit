<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\Discount;

class StatsHelper
{
    /**
     * Safely get product count
     */
    public static function productCount(): int
    {
        try {
            return Product::count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Safely get active discount count
     */
    public static function activeDiscountCount(): int
    {
        try {
            return Discount::where('active', true)->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Get all stats safely
     */
    public static function allStats(): array
    {
        return [
            'product_count' => self::productCount(),
            'active_discount_count' => self::activeDiscountCount(),
        ];
    }
}