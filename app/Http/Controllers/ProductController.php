<?php

namespace App\Http\Controllers;

use App\Models\Dress;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of all active dresses.
     */
    public function index(Request $request)
    {
        $query = Dress::where('status', 'active');

        // Filter by category (sku_prefix)
        if ($request->has('category') && array_key_exists($request->category, $this->categories())) {
            $query->where('sku_prefix', $request->category);
        }

        $dresses = $query->latest()->paginate(12);

        return view('products.index', [
            'dresses' => $dresses,
            'categories' => $this->categories(),
            'currentCategory' => $request->category,
        ]);
    }

    /**
     * Display the specified dress.
     */
    public function show(Dress $dress)
    {
        // Ensure only active dresses are viewable
        if ($dress->status !== 'active') {
            abort(404);
        }

        return view('products.show', [
            'dress' => $dress,
            'categories' => $this->categories(),
        ]);
    }

    /**
     * Helper: category definitions with icons and names.
     */
    private function categories()
    {
        return [
            'SLMK' => ['name' => 'Slay Makoti', 'icon' => 'fas fa-crown'],
            'ZMBN' => ['name' => 'Zimbini', 'icon' => 'fas fa-fan'],
            'CLPS' => ['name' => 'Classic Panel', 'icon' => 'fas fa-vest'],
            'NKWA' => ['name' => 'Nokwanda', 'icon' => 'fas fa-gem'],
            'PNDK' => ['name' => 'Phenduka', 'icon' => 'fas fa-ribbon'],
            'SLBL' => ['name' => 'Slay Bubble', 'icon' => 'fas fa-bubble'],
            'CUSTOM' => ['name' => 'Bespoke', 'icon' => 'fas fa-pen-fancy'],
        ];
    }
}