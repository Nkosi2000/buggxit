<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Manual authentication check
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        // Cache statistics for better performance (5 minutes)
        $stats = Cache::remember('admin_dashboard_stats', 300, function () {
            return [
                'total_dresses' => Dress::count(),
                'active_dresses' => Dress::where('status', 'active')->count(),
                'featured_dresses' => Dress::where('is_featured', true)->count(),
                'draft_dresses' => Dress::where('status', 'draft')->count(),
                'out_of_stock_dresses' => Dress::where('status', 'out_of_stock')->count(),
            ];
        });

        // Get recent dresses (not cached for real-time data)
        $recentDresses = Dress::with([])
            ->latest()
            ->take(5)
            ->get();

        // Get dress categories statistics
        $categories = [
            'SLMK' => Dress::where('sku_prefix', 'SLMK')->count(),
            'ZMBN' => Dress::where('sku_prefix', 'ZMBN')->count(),
            'CLPS' => Dress::where('sku_prefix', 'CLPS')->count(),
            'NKWA' => Dress::where('sku_prefix', 'NKWA')->count(),
            'PNDK' => Dress::where('sku_prefix', 'PNDK')->count(),
            'SLBL' => Dress::where('sku_prefix', 'SLBL')->count(),
            'CUSTOM' => Dress::where('sku_prefix', 'CUSTOM')->count(),
        ];

        // Calculate revenue (placeholder - you'll need order tracking)
        $estimatedRevenue = Dress::where('status', 'active')->sum('price') * 0.3; // Placeholder calculation

        // Recent activity (hardcoded for now)
        $recentActivity = [
            ['type' => 'new_dress', 'message' => 'Added "Traditional Zulu Wedding Dress"', 'time' => '2 hours ago'],
            ['type' => 'update', 'message' => 'Updated stock for "Slay Makoti Dress"', 'time' => '1 day ago'],
            ['type' => 'order', 'message' => 'New order received #ORD-001', 'time' => '2 days ago'],
            ['type' => 'featured', 'message' => 'Marked "Zimbini Dress Set" as featured', 'time' => '3 days ago'],
        ];

        return view('admin.dashboard', compact(
            'stats',
            'recentDresses',
            'categories',
            'estimatedRevenue',
            'recentActivity'
        ));
    }

    /**
     * Get quick stats for AJAX requests
     */
    public function getQuickStats()
    {
        // Manual authentication check
        if (!Auth::guard('admin')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $stats = [
            'total_dresses' => Dress::count(),
            'active_dresses' => Dress::where('status', 'active')->count(),
            'featured_dresses' => Dress::where('is_featured', true)->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Clear dashboard cache
     */
    public function clearCache()
    {
        // Manual authentication check
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        Cache::forget('admin_dashboard_stats');
        
        return back()->with('success', 'Dashboard cache cleared successfully!');
    }
}