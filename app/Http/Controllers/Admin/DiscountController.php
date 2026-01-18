<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupabaseService;

class DiscountController extends Controller
{
    public function index(SupabaseService $supabase)
    {
        $discounts = $supabase->from('discounts')->select('*');
        return view('admin.discounts.index', compact('discounts'));
    }

    public function create()
    {
        return view('admin.discounts.create');
    }

    public function store(Request $request, SupabaseService $supabase)
    {
        $validated = $request->validate([
            'code'       => 'required|string|max:50',
            'percentage' => 'required|numeric|min:1|max:100',
        ]);

        $supabase->from('discounts')->insert($validated);

        return redirect()->route('admin.discounts.index')->with('status', 'Discount created.');
    }
}