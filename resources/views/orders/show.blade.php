@extends('layouts.app')

@section('title', 'Order ' . $order->order_number)

@section('content')
<div class="container-wide px-4 py-12 mx-auto">
    <div class="mb-6">
        <a href="{{ route('orders.index') }}" class="inline-flex items-center text-gray-400 hover:text-yellow-500 transition-colors group">
            <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Orders
        </a>
    </div>

    <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 md:p-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white">Order {{ $order->order_number }}</h1>
                <p class="text-gray-400 mt-1">Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <span class="px-4 py-2 rounded-full text-sm font-medium
                    @if($order->status == 'pending') bg-yellow-500/10 text-yellow-400 border border-yellow-500/30
                    @elseif($order->status == 'processing') bg-blue-500/10 text-blue-400 border border-blue-500/30
                    @elseif($order->status == 'completed') bg-green-500/10 text-green-400 border border-green-500/30
                    @else bg-gray-500/10 text-gray-400 border border-gray-500/30
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
                <span class="px-4 py-2 rounded-full text-sm font-medium
                    @if($order->payment_status == 'paid') bg-green-500/10 text-green-400 border border-green-500/30
                    @else bg-yellow-500/10 text-yellow-400 border border-yellow-500/30
                    @endif">
                    Payment: {{ ucfirst($order->payment_status) }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <h3 class="text-white font-semibold mb-3 flex items-center">
                    <i class="fas fa-truck text-yellow-500 mr-2"></i> Shipping Address
                </h3>
                <address class="not-italic text-gray-300 text-sm border border-gray-800 rounded-lg p-4 bg-gray-900/30">
                    {{ $order->shippingAddress->address_line1 }}<br>
                    @if($order->shippingAddress->address_line2){{ $order->shippingAddress->address_line2 }}<br>@endif
                    {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} {{ $order->shippingAddress->postal_code }}<br>
                    {{ $order->shippingAddress->country }}<br>
                    <span class="text-gray-400">Phone: {{ $order->shippingAddress->phone }}</span>
                </address>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-3 flex items-center">
                    <i class="fas fa-credit-card text-yellow-500 mr-2"></i> Payment Method
                </h3>
                <div class="text-gray-300 text-sm border border-gray-800 rounded-lg p-4 bg-gray-900/30">
                    {{ $order->payment_method == 'eft' ? 'Bank Transfer (EFT)' : 'Cash on Delivery' }}
                </div>
            </div>
        </div>

        <h3 class="text-white font-semibold mb-4 flex items-center">
            <i class="fas fa-shopping-bag text-yellow-500 mr-2"></i> Order Items
        </h3>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-800/50">
                <thead class="bg-gray-900/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Product</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Price</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Quantity</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/50">
                    @foreach($order->items as $item)
                        <tr>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    @if($item->dress && $item->dress->main_image_url)
                                        <img src="{{ $item->dress->main_image_url }}" alt="{{ $item->dress->name }}" class="w-12 h-12 rounded-lg object-cover mr-3">
                                    @endif
                                    <span class="text-white">{{ $item->dress->name ?? 'Product unavailable' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-gray-300">R{{ number_format($item->price, 0) }}</td>
                            <td class="px-4 py-4 text-gray-300">{{ $item->quantity }}</td>
                            <td class="px-4 py-4 text-yellow-500 font-semibold">R{{ number_format($item->price * $item->quantity, 0) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-t border-gray-800/50">
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-right text-gray-400">Subtotal</td>
                        <td class="px-4 py-4 text-white">R{{ number_format($order->subtotal, 0) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-right text-gray-400">Shipping</td>
                        <td class="px-4 py-4 text-white">R{{ number_format($order->shipping_cost, 0) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-right text-gray-400 font-bold">Total</td>
                        <td class="px-4 py-4 text-yellow-500 font-bold text-lg">R{{ number_format($order->total, 0) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if($order->notes)
            <div class="mt-6 pt-6 border-t border-gray-800/50">
                <h4 class="text-white font-medium mb-2">Order Notes</h4>
                <p class="text-gray-400 text-sm">{{ $order->notes }}</p>
            </div>
        @endif
    </div>
</div>
@endsection