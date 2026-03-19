@extends('layouts.app')

@section('title', 'Checkout – BUGGXIT Couture')

@section('content')
<div class="container-wide px-4 py-12 mx-auto">
    <h1 class="text-3xl md:text-4xl font-bold text-white mb-8">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Checkout Form (left column) --}}
        <div class="lg:col-span-2">
            <form method="POST" action="{{ route('checkout.store') }}" id="checkout-form">
                @csrf

                {{-- Shipping Address --}}
                <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 mb-6">
                    <h2 class="text-xl font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-truck text-yellow-500 mr-2"></i>
                        Shipping Address
                    </h2>

                    @if(auth()->check() && $addresses->count() > 0)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-400 mb-2">Select saved address</label>
                            <select name="shipping_address_id" class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white">
                                <option value="">Use a new address</option>
                                @foreach($addresses as $address)
                                    <option value="{{ $address->id }}" @selected(old('shipping_address_id') == $address->id)>
                                        {{ $address->address_line1 }}, {{ $address->city }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="border-t border-gray-800/50 my-4"></div>
                    @endif

                    <div id="new-address-fields">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-400 mb-1">Address Line 1 *</label>
                                <input type="text" name="address_line1" value="{{ old('address_line1') }}" class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:border-yellow-500">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-400 mb-1">Address Line 2 (optional)</label>
                                <input type="text" name="address_line2" value="{{ old('address_line2') }}" class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">City *</label>
                                <input type="text" name="city" value="{{ old('city') }}" class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">State/Province</label>
                                <input type="text" name="state" value="{{ old('state') }}" class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Postal Code *</label>
                                <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Country *</label>
                                <input type="text" name="country" value="{{ old('country', 'South Africa') }}" class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-400 mb-1">Phone *</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 mb-6">
                    <h2 class="text-xl font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-credit-card text-yellow-500 mr-2"></i>
                        Payment Method
                    </h2>
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border border-gray-700 rounded-lg cursor-pointer hover:border-yellow-500/50 transition-colors">
                            <input type="radio" name="payment_method" value="eft" class="h-4 w-4 text-yellow-500 focus:ring-yellow-500" checked>
                            <span class="ml-3 text-white">Bank Transfer (EFT)</span>
                        </label>
                        <label class="flex items-center p-3 border border-gray-700 rounded-lg cursor-pointer hover:border-yellow-500/50 transition-colors">
                            <input type="radio" name="payment_method" value="cash_on_delivery" class="h-4 w-4 text-yellow-500 focus:ring-yellow-500">
                            <span class="ml-3 text-white">Cash on Delivery</span>
                        </label>
                    </div>
                </div>

                {{-- Billing Address --}}
                <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 mb-6">
                    <h2 class="text-xl font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-file-invoice text-yellow-500 mr-2"></i>
                        Billing Address
                    </h2>
                    <label class="flex items-center p-3 border border-gray-700 rounded-lg cursor-pointer hover:border-yellow-500/50 transition-colors">
                        <input type="checkbox" name="same_as_shipping" value="1" class="h-4 w-4 text-yellow-500 rounded" checked>
                        <span class="ml-3 text-white">Same as shipping address</span>
                    </label>
                    {{-- You could add separate billing address fields here if needed --}}
                </div>

                {{-- Order Notes --}}
                <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
                    <h2 class="text-xl font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-pen text-yellow-500 mr-2"></i>
                        Additional Notes (Optional)
                    </h2>
                    <textarea name="notes" rows="3" class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white">{{ old('notes') }}</textarea>
                </div>
            </form>
        </div>

        {{-- Order Summary (right column) --}}
        <div class="lg:col-span-1">
            <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 sticky top-24">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-shopping-bag text-yellow-500 mr-2"></i>
                    Your Order
                </h3>

                <div class="space-y-3 max-h-80 overflow-y-auto mb-4 pr-2">
                    @foreach($items as $item)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-300">{{ $item['dress']->name }} <span class="text-gray-500">x{{ $item['quantity'] }}</span></span>
                            <span class="text-white font-medium">R{{ number_format($item['subtotal'], 0) }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-800/50 pt-4 space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Subtotal</span>
                        <span class="text-white">R{{ number_format($subtotal, 0) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Shipping</span>
                        <span class="text-white">Calculated at delivery</span>
                    </div>
                </div>

                <div class="border-t border-gray-800/50 mt-4 pt-4 flex justify-between text-lg font-bold">
                    <span class="text-white">Total</span>
                    <span class="text-yellow-500">R{{ number_format($subtotal, 0) }}</span>
                </div>

                <button type="submit" form="checkout-form" class="w-full mt-6 py-3.5 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-bold rounded-lg hover:from-yellow-400 hover:to-yellow-500 transition-all duration-300">
                    Place Order
                </button>

                <p class="text-xs text-gray-500 text-center mt-4">
                    <i class="fas fa-lock mr-1"></i> Your information is secure
                </p>
            </div>
        </div>
    </div>
</div>
@endsection