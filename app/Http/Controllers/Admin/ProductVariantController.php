<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SupabaseService;
use Illuminate\Support\Facades\Log;

class ProductVariantController extends Controller
{
    /**
     * Show the form for creating a new variant for a product.
     */
    public function create($product, SupabaseService $supabase)
    {
        try {
            // Fetch the product data
            $productData = $supabase->from('products')
                ->select('*')
                ->eq('id', $product)
                ->execute()
                ->getData();
            $productData = $productData[0] ?? null;
            
            if (!$productData) {
                return redirect()->route('admin.products.index')
                    ->withErrors(['error' => 'Product not found.']);
            }
            
            return view('admin.products.variants.create', compact('productData'));
        } catch (\Throwable $e) {
            Log::error('Supabase fetch product failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Could not load product.']);
        }
    }

    /**
     * Store a new variant for a product
     */
    public function store(Request $request, SupabaseService $supabase, $product)
    {
        $validated = $request->validate([
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:50',
            'price_adjustment' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            // Removed 'sku' and 'price' fields as per new schema
        ]);
        
        try {
            $payload = [
                'product_id' => (int) $product,
                'color' => $validated['color'] ?? null,
                'size' => $validated['size'] ?? null,
                'price_adjustment' => $validated['price_adjustment'] ?? 0,
                'stock' => $validated['stock'],
            ];
            
            $supabase->from('product_variants')->insert($payload);
            
            return redirect()->route('admin.products.edit', $product)
                ->with('status', 'Variant added successfully!');
        } catch (\Throwable $e) {
            Log::error('Supabase variant insert failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Could not add variant.']);
        }
    }

    /**
     * Update an existing variant
     */
    public function update(Request $request, SupabaseService $supabase, $product, $variant)
    {
        $validated = $request->validate([
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:50',
            'price_adjustment' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            // Removed 'sku' and 'price' fields as per new schema
        ]);
        
        try {
            $payload = [
                'color' => $validated['color'] ?? null,
                'size' => $validated['size'] ?? null,
                'price_adjustment' => $validated['price_adjustment'] ?? 0,
                'stock' => $validated['stock'],
            ];
            
            $result = $supabase->from('product_variants')
                ->update($payload)
                ->eq('id', $variant)
                ->execute();
            
            // Get the data from result to check if updated
            $data = $result->getData();
            if (empty($data)) {
                return back()->withErrors(['error' => 'No variant was updated.']);
            }
            
            return redirect()->route('admin.products.edit', $product)
                ->with('status', 'Variant updated successfully!');
        } catch (\Throwable $e) {
            Log::error('Supabase variant update failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Could not update variant.']);
        }
    }

    /**
     * Delete a variant
     */
    public function destroy(SupabaseService $supabase, $product, $variant)
    {
        try {
            $supabase->from('product_variants')
                ->delete()
                ->eq('id', $variant)
                ->execute();
            
            return redirect()->route('admin.products.edit', $product)
                ->with('status', 'Variant deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Supabase variant delete failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Could not delete variant.']);
        }
    }
}