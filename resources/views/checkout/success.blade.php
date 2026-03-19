@extends('layouts.app')

@section('title', 'Order Confirmed – BUGGXIT Couture')

@section('content')
<div class="container-wide px-4 py-16 mx-auto text-center">
    <div class="max-w-2xl mx-auto bg-black/90 backdrop-blur-sm border border-gray-800 rounded-2xl p-8 md:p-12">
        <div class="w-20 h-20 mx-auto mb-6 bg-green-500/20 rounded-full flex items-center justify-center border border-green-500/30">
            <i class="fas fa-check text-4xl text-green-500"></i>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Thank You for Your Order!</h1>
        <p class="text-gray-300 mb-6">Your order has been placed successfully.</p>

        <div class="bg-gray-800/30 border border-gray-700 rounded-lg p-6 mb-8 text-left">
            <div class="flex justify-between mb-2">
                <span class="text-gray-400">Order Number</span>
                <span class="text-white font-mono">{{ $order->order_number }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="text-gray-400">Date</span>
                <span class="text-white">{{ $order->created_at->format('d M Y, H:i') }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="text-gray-400">Total</span>
                <span class="text-yellow-500 font-bold">R{{ number_format($order->total, 0) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-400">Payment Method</span>
                <span class="text-white">{{ $order->payment_method == 'eft' ? 'Bank Transfer (EFT)' : 'Cash on Delivery' }}</span>
            </div>
        </div>

        <p class="text-gray-400 mb-8">We'll send you a confirmation email with order details and tracking information once your dress is ready.</p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-800/50 border border-gray-700 text-white rounded-lg hover:bg-gray-800 transition-colors">
                <i class="fas fa-tshirt mr-2"></i> Continue Shopping
            </a>
            @auth
                <a href="{{ route('orders.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-semibold rounded-lg hover:from-yellow-400 hover:to-yellow-500 transition-all duration-300">
                    <i class="fas fa-history mr-2"></i> View My Orders
                </a>
            @endauth
        </div>
    </div>
</div>
@endsection