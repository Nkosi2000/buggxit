@extends('layouts.admin')

@section('title', 'Order ' . $order->order_number)
@section('page-title', 'Order Details')
@section('page-description', 'Order #' . $order->order_number)

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.orders.index') }}" class="text-yellow-500 hover:text-yellow-400 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to Orders
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Left: Order Info --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Status Update Card --}}
        <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Update Status</h3>
            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="flex flex-wrap gap-4">
                @csrf
                @method('PATCH')
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Order Status</label>
                    <select name="status" class="px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-lg text-white">
                        <option value="pending" @selected($order->status == 'pending')>Pending</option>
                        <option value="processing" @selected($order->status == 'processing')>Processing</option>
                        <option value="completed" @selected($order->status == 'completed')>Completed</option>
                        <option value="cancelled" @selected($order->status == 'cancelled')>Cancelled</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Payment Status</label>
                    <select name="payment_status" class="px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-lg text-white">
                        <option value="pending" @selected($order->payment_status == 'pending')>Pending</option>
                        <option value="paid" @selected($order->payment_status == 'paid')>Paid</option>
                        <option value="failed" @selected($order->payment_status == 'failed')>Failed</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="px-6 py-2 bg-yellow-500 text-gray-900 rounded-lg hover:bg-yellow-400 transition-colors">
                        Update
                    </button>
                </div>
            </form>
        </div>

        {{-- Items --}}
        <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Order Items</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-800/50">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left text-xs text-gray-400">Product</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-400">Price</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-400">Qty</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-400">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800/50">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        @if($item->dress && $item->dress->main_image_url)
                                            <img src="{{ $item->dress->main_image_url }}" class="w-10 h-10 rounded object-cover mr-3">
                                        @endif
                                        <span class="text-white">{{ $item->dress->name ?? 'Deleted' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-gray-300">R{{ number_format($item->price, 0) }}</td>
                                <td class="px-4 py-4 text-gray-300">{{ $item->quantity }}</td>
                                <td class="px-4 py-4 text-yellow-500 font-semibold">R{{ number_format($item->price * $item->quantity, 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 pt-4 border-t border-gray-800/50 space-y-2 text-right">
                <div class="flex justify-end">
                    <span class="text-gray-400 w-32 text-left">Subtotal:</span>
                    <span class="text-white w-24">R{{ number_format($order->subtotal, 0) }}</span>
                </div>
                <div class="flex justify-end">
                    <span class="text-gray-400 w-32 text-left">Shipping:</span>
                    <span class="text-white w-24">R{{ number_format($order->shipping_cost, 0) }}</span>
                </div>
                <div class="flex justify-end text-lg font-bold">
                    <span class="text-gray-400 w-32 text-left">Total:</span>
                    <span class="text-yellow-500 w-24">R{{ number_format($order->total, 0) }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Right: Customer & Address --}}
    <div class="space-y-6">
        <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
            <h3 class="text-white font-semibold mb-3">Customer</h3>
            @if($order->user)
                <p class="text-gray-300">{{ $order->user->name }}</p>
                <p class="text-gray-400 text-sm">{{ $order->user->email }}</p>
            @else
                <p class="text-gray-400">Guest checkout</p>
            @endif
        </div>

        <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
            <h3 class="text-white font-semibold mb-3">Shipping Address</h3>
            @if($order->shippingAddress)
                <address class="not-italic text-gray-300 text-sm">
                    {{ $order->shippingAddress->address_line1 }}<br>
                    @if($order->shippingAddress->address_line2){{ $order->shippingAddress->address_line2 }}<br>@endif
                    {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} {{ $order->shippingAddress->postal_code }}<br>
                    {{ $order->shippingAddress->country }}<br>
                    Phone: {{ $order->shippingAddress->phone }}
                </address>
            @endif
        </div>

        <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
            <h3 class="text-white font-semibold mb-3">Payment Method</h3>
            <p class="text-gray-300">{{ $order->payment_method == 'eft' ? 'Bank Transfer (EFT)' : 'Cash on Delivery' }}</p>
        </div>

        @if($order->notes)
            <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
                <h3 class="text-white font-semibold mb-3">Order Notes</h3>
                <p class="text-gray-300 text-sm">{{ $order->notes }}</p>
            </div>
        @endif
    </div>
</div>
@endsection