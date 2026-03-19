<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Dress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

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

        // For logged in users, fetch their saved addresses
        $addresses = auth()->check() ? auth()->user()->addresses : collect();

        return view('checkout.index', compact('items', 'subtotal', 'addresses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address_id' => 'nullable|exists:addresses,id',
            'address_line1' => 'required_without:shipping_address_id',
            'address_line2' => 'nullable',
            'city' => 'required_without:shipping_address_id',
            'state' => 'nullable',
            'postal_code' => 'required_without:shipping_address_id',
            'country' => 'required_without:shipping_address_id',
            'phone' => 'required_without:shipping_address_id',
            'payment_method' => 'required|in:eft,cash_on_delivery',
            'same_as_shipping' => 'boolean',
            'email' => 'required_if:guest,true|email',
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            // 1. Handle address
            if ($request->shipping_address_id) {
                $address = Address::findOrFail($request->shipping_address_id);
                if ($address->user_id != auth()->id()) {
                    abort(403);
                }
                $shippingAddress = $address;
            } else {
                // Create new address
                $shippingAddress = Address::create([
                    'user_id' => auth()->id(),
                    'address_line1' => $request->address_line1,
                    'address_line2' => $request->address_line2,
                    'city' => $request->city,
                    'state' => $request->state,
                    'postal_code' => $request->postal_code,
                    'country' => $request->country,
                    'phone' => $request->phone,
                    'is_default' => false,
                ]);
            }

            // Billing address (same or separate)
            $billingAddress = $shippingAddress;
            if (!$request->same_as_shipping) {
                // For simplicity, we'll use same for now; you can extend with separate form later
                $billingAddress = $shippingAddress;
            }

            // 2. Calculate totals
            $subtotal = 0;
            $items = [];
            foreach ($cart as $id => $quantity) {
                $dress = Dress::find($id);
                if (!$dress || $dress->status != 'active') {
                    throw new \Exception("Product not available");
                }
                $subtotal += $dress->price * $quantity;
                $items[] = [
                    'dress' => $dress,
                    'quantity' => $quantity,
                ];
            }
            $shippingCost = 0; // You can calculate based on location if needed
            $total = $subtotal + $shippingCost;

            // 3. Create order
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'user_id' => auth()->id(),
                'shipping_address_id' => $shippingAddress->id,
                'billing_address_id' => $billingAddress->id,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
            ]);

            // 4. Create order items
            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'dress_id' => $item['dress']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['dress']->price,
                ]);
            }

            // 5. Clear cart
            Session::forget('cart');

            DB::commit();

            return redirect()->route('checkout.success', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Checkout failed. Please try again.');
        }
    }

    public function success(Order $order)
    {
        // Ensure the user can only see their own order
        if (auth()->check() && $order->user_id != auth()->id()) {
            abort(403);
        }

        return view('checkout.success', compact('order'));
    }
}