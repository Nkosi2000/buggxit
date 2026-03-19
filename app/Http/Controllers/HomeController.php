<?php

namespace App\Http\Controllers;

use App\Models\Dress;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Featured dresses (max 4)
        $featuredDresses = Dress::where('is_featured', true)
            ->where('status', 'active')
            ->latest()
            ->take(4)
            ->get();

        // 2. New arrivals (latest 4 active dresses)
        $newArrivals = Dress::where('status', 'active')
            ->latest()
            ->take(4)
            ->get();

        // 3. Full category definitions (icons + names)
        $categories = [
            'SLMK' => ['name' => 'Slay Makoti', 'icon' => 'fas fa-crown'],
            'ZMBN' => ['name' => 'Zimbini', 'icon' => 'fas fa-fan'],
            'CLPS' => ['name' => 'Classic Panel', 'icon' => 'fas fa-vest'],
            'NKWA' => ['name' => 'Nokwanda', 'icon' => 'fas fa-gem'],
            'PNDK' => ['name' => 'Phenduka', 'icon' => 'fas fa-ribbon'],
            'SLBL' => ['name' => 'Slay Bubble', 'icon' => 'fas fa-bubble'],
            'CUSTOM' => ['name' => 'Bespoke', 'icon' => 'fas fa-pen-fancy'],
        ];

        // 4. Add live counts to each category
        foreach ($categories as $sku => &$data) {
            $data['count'] = Dress::where('sku_prefix', $sku)->count();
        }

        // 5. Filter out categories with zero dresses
        $activeCategories = array_filter($categories, fn($cat) => $cat['count'] > 0);

        // 6. Return the view – change 'home' to 'pages.landing' if that's your file path
        return view('pages.landing', compact(
            'featuredDresses',
            'newArrivals',
            'categories',        // full array (used in featured loop)
            'activeCategories'   // only non‑empty categories
        ));
    }
}