@extends('layouts.admin')

@section('title', 'Manage Orders')
@section('page-title', 'Orders')
@section('page-description', 'Manage customer orders')

@section('content')
<div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-800/50">
            <thead class="bg-gray-900/50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Order #</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Customer</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Date</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Total</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Payment</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800/50">
                @foreach($orders as $order)
                    <tr class="hover:bg-gray-800/30">
                        <td class="px-6 py-4 text-sm font-mono text-white">{{ $order->order_number }}</td>
                        <td class="px-6 py-4 text-sm text-gray-300">
                            {{ $order->user->name ?? 'Guest' }}<br>
                            <span class="text-xs text-gray-500">{{ $order->user->email ?? 'No email' }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-300">{{ $order->created_at->format('d M Y') }}</td>
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
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-yellow-500 hover:text-yellow-400 transition-colors">
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
@endsection