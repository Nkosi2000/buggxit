<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupabaseService;

class ReportController extends Controller
{
    public function index(SupabaseService $supabase)
    {
        // Example: fetch all orders for reporting
        $orders = $supabase->from('orders')->select('*');
        return view('admin.reports.index', compact('orders'));
    }
}