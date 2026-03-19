<?php

namespace App\Http\Controllers;

use App\Models\Dress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Category definitions (same as in ProductController)
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

    /**
     * Display the cart page.
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $items = [];
        $subtotal = 0;

        foreach ($cart as $id => $quantity) {
            $dress = Dress::find($id);
            if ($dress && $dress->status == 'active') {
                $items[] = [
                    'dress' => $dress,
                    'quantity' => $quantity,
                    'subtotal' => $dress->price * $quantity
                ];
                $subtotal += $dress->price * $quantity;
            }
        }
        
        return view('cart.index', [
            'items'      => $items,
            'subtotal'   => $subtotal,
            'categories' => $this->categories(),
        ]);
    }

    /**
     * Add an item to the cart (AJAX).
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:dresses,id',
            'quantity'   => 'integer|min:1|max:10'
        ]);

        $cart = Session::get('cart', []);
        $id = $request->product_id;
        $quantity = $request->quantity ?? 1;

        if (isset($cart[$id])) {
            $cart[$id] += $quantity;
        } else {
            $cart[$id] = $quantity;
        }

        Session::put('cart', $cart);

        return response()->json([
            'success'    => true,
            'cart_count' => array_sum($cart),
            'message'    => 'Added to your collection'
        ]);
    }

    /**
     * Update item quantity (AJAX).
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:dresses,id',
            'quantity'   => 'required|integer|min:0|max:10'
        ]);

        $cart = Session::get('cart', []);
        $id = $request->product_id;
        $quantity = $request->quantity;

        if ($quantity <= 0) {
            unset($cart[$id]);
        } else {
            $cart[$id] = $quantity;
        }

        Session::put('cart', $cart);

        // Recalculate subtotal
        $subtotal = 0;
        foreach ($cart as $pid => $qty) {
            $dress = Dress::find($pid);
            if ($dress) {
                $subtotal += $dress->price * $qty;
            }
        }

        return response()->json([
            'success'    => true,
            'cart_count' => array_sum($cart),
            'subtotal'   => 'R' . number_format($subtotal, 0),
            'message'    => 'Cart updated'
        ]);
    }

    /**
     * Remove an item from the cart (AJAX).
     */
    public function remove(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:dresses,id']);

        $cart = Session::get('cart', []);
        unset($cart[$request->product_id]);
        Session::put('cart', $cart);

        // Recalculate subtotal
        $subtotal = 0;
        foreach ($cart as $pid => $qty) {
            $dress = Dress::find($pid);
            if ($dress) {
                $subtotal += $dress->price * $qty;
            }
        }

        return response()->json([
            'success'    => true,
            'cart_count' => array_sum($cart),
            'subtotal'   => 'R' . number_format($subtotal, 0),
            'message'    => 'Item removed'
        ]);
    }
}