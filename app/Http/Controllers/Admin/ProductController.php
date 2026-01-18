<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SupabaseService;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(SupabaseService $supabase)
    {
        try {
            // Fetch all products with new columns
            $products = $supabase->from('products')
                ->select('id, name, category, sku, base_price, turnaround_time')
                ->execute()
                ->getData();
            
            \Log::info('Fetched products count: ' . count($products));
            
            if (empty($products)) {
                return view('admin.products.index', ['products' => []]);
            }
            
            // Process each product
            foreach ($products as &$product) {
                // Fetch variants for this product
                $variants = $supabase->from('product_variants')
                    ->select('*')
                    ->eq('product_id', $product['id'])
                    ->execute()
                    ->getData();
                
                $product['variants'] = $variants;
                
                // Calculate total stock from variants
                $totalStock = 0;
                $prices = [];
                
                foreach ($variants as $variant) {
                    $totalStock += (int)($variant['stock'] ?? 0);
                    
                    // Calculate variant prices
                    if (isset($variant['price_adjustment'])) {
                        $variantPrice = $product['base_price'] + $variant['price_adjustment'];
                        $prices[] = $variantPrice;
                    }
                }
                
                $product['stock'] = $totalStock;
                
                // Create price display
                if (!empty($prices)) {
                    $minPrice = min($prices);
                    $maxPrice = max($prices);
                    
                    $product['price_display'] = $minPrice == $maxPrice
                        ? "R" . number_format($minPrice, 2)
                        : "R" . number_format($minPrice, 2) . " – R" . number_format($maxPrice, 2);
                } else {
                    $product['price_display'] = "R" . number_format($product['base_price'] ?? 0, 2);
                }
                
                $product['variants_count'] = count($variants);
            }
            
            \Log::info('Processed products for display');
            
            return view('admin.products.index', compact('products'));
            
        } catch (\Throwable $e) {
            \Log::error('Error in ProductController@index: ' . $e->getMessage());
            return view('admin.products.index', ['products' => []]);
        }
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request, SupabaseService $supabase)
    {
        \Log::info('Product creation attempt', $request->all());
        
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'category'         => 'required|string|max:255',
            'sku'              => 'nullable|string|max:50',
            'base_price'       => 'required|numeric|min:0',
            'turnaround_time'  => 'required|integer|min:1|max:30',
        ]);
        
        // Generate SKU if not provided
        if (empty($validated['sku'])) {
            $prefix = strtoupper(substr(preg_replace('/[^A-Z]/', '', $validated['name']), 0, 3));
            $categoryCode = strtoupper(substr($validated['category'], 0, 2));
            $timestamp = date('ymd');
            $random = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $validated['sku'] = $prefix . '-' . $categoryCode . '-' . $timestamp . '-' . $random;
        }
        
        try {
            \Log::info('Inserting product', $validated);
            
            $result = $supabase->from('products')->insert([
                'name' => $validated['name'],
                'category' => $validated['category'],
                'sku' => $validated['sku'],
                'base_price' => (float)$validated['base_price'],
                'turnaround_time' => (int)$validated['turnaround_time'],
                // Note: NOT including 'stock' column anymore
            ]);
            
            \Log::info('Insert successful');
            
            return redirect()->route('admin.products.index')
                ->with('status', 'Product created successfully! SKU: ' . $validated['sku']);
                
        } catch (\Throwable $e) {
            \Log::error('Product creation failed', [
                'error' => $e->getMessage(),
                'data' => $validated
            ]);
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Could not save product: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Generate a unique SKU based on product name and category
     */
    private function generateSku($name, $category)
    {
        $prefix = strtoupper(substr(preg_replace('/[^A-Z]/', '', $name), 0, 3));
        $categoryCode = strtoupper(substr($category, 0, 2));
        $timestamp = date('ymd');
        $random = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        
        $sku = $prefix . '-' . $categoryCode . '-' . $timestamp . '-' . $random;
        
        // Check if SKU exists in database (you might want to implement this check)
        // For now, we'll assume it's unique enough
        return $sku;
    }

    public function edit($id, SupabaseService $supabase)
    {
        try {
            // Fetch the product with new fields
            $productRows = $supabase->from('products')
                ->select('*')
                ->eq('id', $id)
                ->execute()
                ->getData();
            $product = $productRows[0] ?? null;
            
            // Fetch variants for this product
            $variants = $supabase->from('product_variants')
                ->select('*')
                ->eq('product_id', $id)
                ->execute()
                ->getData();
                
        } catch (\Throwable $e) {
            Log::error('Supabase fetch product/variants failed', ['error' => $e->getMessage()]);
            return redirect()->route('admin.products.index')
                ->withErrors(['supabase' => 'Could not load product.']);
        }
        
        if (!$product) {
            return redirect()->route('admin.products.index')
                ->withErrors(['supabase' => 'Product not found.']);
        }
        
        return view('admin.products.edit', compact('product', 'variants'));
    }

    public function update(Request $request, $id, SupabaseService $supabase)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'category'         => 'required|string|max:255',
            'sku'              => 'nullable|string|max:50',
            'base_price'       => 'required|numeric|min:0',
            'turnaround_time'  => 'required|integer|min:1|max:30',
            // REMOVED: 'stock' validation
        ]);
        
        try {
            // Check if SKU is being changed and if it's unique (excluding current product)
            if (isset($validated['sku']) && !empty($validated['sku'])) {
                $existing = $supabase->from('products')
                    ->select('id')
                    ->eq('sku', $validated['sku'])
                    ->neq('id', $id)
                    ->execute()
                    ->getData();
                    
                if (!empty($existing)) {
                    return back()->withErrors(['sku' => 'This SKU is already in use by another product.']);
                }
            }
            
            // Update product
            $result = $supabase->from('products')
                ->update([
                    'name' => $validated['name'],
                    'category' => $validated['category'],
                    'sku' => $validated['sku'],
                    'base_price' => $validated['base_price'],
                    'turnaround_time' => $validated['turnaround_time'],
                ])
                ->eq('id', $id)
                ->execute();
            
            return redirect()->route('admin.products.index')
                ->with('status', 'Product updated successfully.');
        } catch (\Throwable $e) {
            Log::error('Supabase update failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['supabase' => 'We could not update the product. Please try again later.']);
        }
    }

    public function destroy($id, SupabaseService $supabase)
    {
        try {
            // First, delete all variants (cascade delete)
            $supabase->from('product_variants')
                ->delete()
                ->eq('product_id', $id)
                ->execute();
            
            // Then delete the product
            $supabase->from('products')
                ->delete()
                ->eq('id', $id)
                ->execute();
                
            return redirect()->route('admin.products.index')
                ->with('status', 'Product and all its variants deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Supabase delete failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['supabase' => 'We could not delete the product. Please try again later.']);
        }
    }
}