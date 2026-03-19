@extends('layouts.app')

@section('title', 'My Orders – BUGGXIT Couture')

@section('content')
<div class="container-wide px-4 py-12 mx-auto">
    <h1 class="text-3xl md:text-4xl font-bold text-white mb-8">My Orders</h1>

    @if($orders->count() > 0)
        <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-800/50">
                    <thead class="bg-gray-900/50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Order #</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Items</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Total</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Payment</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800/50">
                        @foreach($orders as $order)
                            <tr class="hover:bg-gray-800/30 transition-colors">
                                <td class="px-6 py-4 text-sm font-mono text-white">{{ $order->order_number }}</td>
                                <td class="px-6 py-4 text-sm text-gray-300">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-300">{{ $order->items->count() }} item(s)</td>
                                <td class="px-6 py-4 text-sm font-semibold text-yellow-500">R{{ number_format($order->total, 0) }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        @if($order->status == 'pending') bg-yellow-500/10 text-yellow-400 border border-yellow-500/30
                                        @elseif($order->status == 'processing') bg-blue-500/10 text-blue-400 border border-blue-500/30
                                        @elseif($order->status == 'completed') bg-green-500/10 text-green-400 border border-green-500/30
                                        @else bg-gray-500/10 text-gray-400 border border-gray-500/30
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        @if($order->payment_status == 'paid') bg-green-500/10 text-green-400 border border-green-500/30
                                        @else bg-yellow-500/10 text-yellow-400 border border-yellow-500/30
                                        @endif">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('orders.show', $order) }}" class="text-yellow-500 hover:text-yellow-400 transition-colors">
                                        <i class="fas fa-eye mr-1"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-800/50">
                {{ $orders->links('vendor.pagination.tailwind-dark') }}
            </div>
        </div>
    @else
        <div class="text-center py-16 bg-black/90 backdrop-blur-sm border border-gray-800 rounded-2xl">
            <svg class="w-20 h-20 mx-auto text-gray-700 mb-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <h2 class="text-2xl font-bold text-white mb-2">No orders yet</h2>
            <p class="text-gray-400 mb-6">Looks like you haven't placed any orders.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-semibold rounded-lg hover:from-yellow-400 hover:to-yellow-500 transition-all duration-300">
                <i class="fas fa-tshirt mr-2"></i> Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection