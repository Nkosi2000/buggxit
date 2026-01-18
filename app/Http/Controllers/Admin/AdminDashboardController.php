<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupabaseService;
use Illuminate\Support\Facades\Log;

class AdminDashboardController extends Controller
{
    public function index(SupabaseService $supabase)
    {
        try {
            // Fetch all products with their variants in a single structured approach
            $products = $this->getProductsWithVariants($supabase);
            
            // Calculate dashboard statistics
            $stats = $this->calculateDashboardStats($products);

        } catch (\Throwable $e) {
            Log::error('Dashboard data fetch failed', ['error' => $e->getMessage()]);
            $products = [];
            $stats = $this->getEmptyStats();
        }

        return view('admin.dashboard', array_merge($stats, ['products' => $products]));
    }

    /**
     * Fetch all products with their variants
     */
    private function getProductsWithVariants(SupabaseService $supabase): array
    {
        $products = $supabase->from('products')->select('*');
        
        foreach ($products as &$product) {
            $variants = $supabase->from('product_variants')
                                ->select('*', "product_id=eq.{$product['id']}");
            
            $product = $this->processProductWithVariants($product, $variants);
        }

        return $products;
    }

    /**
     * Process product data with variants
     */
    private function processProductWithVariants(array $product, array $variants): array
    {
        $product['variants'] = $variants;
        $product['has_variants'] = !empty($variants);
        
        // Calculate stock
        $product['calculated_stock'] = $this->calculateProductStock($product, $variants);
        
        // Calculate price display
        $product['price_display'] = $this->calculatePriceDisplay($product, $variants);
        
        // Calculate product value for inventory
        $product['inventory_value'] = $this->calculateProductValue($product, $variants);

        return $product;
    }

    /**
     * Calculate product stock (sum of variants or product stock)
     */
    private function calculateProductStock(array $product, array $variants): int
    {
        if (!empty($variants)) {
            return array_sum(array_column($variants, 'stock'));
        }
        
        return $product['stock'] ?? 0;
    }

    /**
     * Calculate price display (range for variants, single price for products)
     */
    private function calculatePriceDisplay(array $product, array $variants): string
    {
        if (!empty($variants)) {
            $prices = array_column($variants, 'price');
            $prices = array_filter($prices, fn($p) => $p !== null && $p > 0);
            
            if (!empty($prices)) {
                $min = min($prices);
                $max = max($prices);
                
                if ($min == $max) {
                    return "R" . number_format($min, 2);
                }
                
                return "R" . number_format($min, 2) . " – R" . number_format($max, 2);
            }
        }
        
        return "R" . number_format($product['price'] ?? 0, 2);
    }

    /**
     * Calculate total value of product inventory
     */
    private function calculateProductValue(array $product, array $variants): float
    {
        if (!empty($variants)) {
            $value = 0;
            foreach ($variants as $variant) {
                $value += ($variant['price'] ?? 0) * ($variant['stock'] ?? 0);
            }
            return $value;
        }
        
        return ($product['price'] ?? 0) * ($product['stock'] ?? 0);
    }

    /**
     * Calculate all dashboard statistics
     */
    private function calculateDashboardStats(array $products): array
    {
        $totalProducts = count($products);
        $totalStock = 0;
        $totalValue = 0;
        $productsWithVariants = 0;

        foreach ($products as $product) {
            $totalStock += $product['calculated_stock'];
            $totalValue += $product['inventory_value'];
            
            if ($product['has_variants']) {
                $productsWithVariants++;
            }
        }

        return [
            'totalProducts' => $totalProducts,
            'totalStock' => $totalStock,
            'totalValue' => $totalValue,
            'productsWithVariants' => $productsWithVariants,
            'productsWithoutVariants' => $totalProducts - $productsWithVariants,
        ];
    }

    /**
     * Return empty stats for error handling
     */
    private function getEmptyStats(): array
    {
        return [
            'totalProducts' => 0,
            'totalStock' => 0,
            'totalValue' => 0,
            'productsWithVariants' => 0,
            'productsWithoutVariants' => 0,
        ];
    }
}