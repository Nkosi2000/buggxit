@extends('layouts.app')

@section('title', 'Your Collection Cart – BUGGXIT Couture')

@section('content')
<div class="container-wide px-4 sm:px-6 lg:px-8 mx-auto py-12">
    {{-- Header --}}
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-white">
            Your <span class="text-yellow-500">Collection</span>
        </h1>
        <p class="text-gray-400 mt-2">Review and adjust your selections before checkout.</p>
    </div>

    @if(empty($items))
        {{-- Empty cart --}}
        <div class="text-center py-16 bg-black/90 backdrop-blur-sm border border-gray-800 rounded-2xl">
            <svg class="w-20 h-20 mx-auto text-gray-700 mb-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <h2 class="text-2xl font-bold text-white mb-2">Your cart is empty</h2>
            <p class="text-gray-400 mb-6">Looks like you haven't added any dresses yet.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-semibold rounded-lg hover:from-yellow-400 hover:to-yellow-500 transition-all duration-300">
                <i class="fas fa-tshirt mr-2"></i>
                Explore Collections
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Cart Items (2/3 width) --}}
            <div class="lg:col-span-2 space-y-4">
                @foreach($items as $item)
                    @php $dress = $item['dress']; @endphp
                    <div class="cart-item bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-4 flex flex-col sm:flex-row gap-4 hover:border-yellow-500/30 transition-colors"
                         data-product-id="{{ $dress->id }}">
                        {{-- Image --}}
                        <div class="sm:w-24 sm:h-24 rounded-lg overflow-hidden border border-gray-800 flex-shrink-0">
                            @if($dress->main_image_url)
                                <img src="{{ $dress->main_image_url }}" alt="{{ $dress->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Details --}}
                        <div class="flex-1 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <div class="text-xs text-yellow-500 uppercase tracking-wider">
                                    {{ $categories[$dress->sku_prefix]['name'] ?? $dress->sku_prefix }}
                                </div>
                                <a href="{{ route('products.show', $dress) }}" class="text-white font-semibold hover:text-yellow-500 transition-colors">
                                    {{ $dress->name }}
                                </a>
                                <div class="text-sm text-gray-400 mt-1">
                                    R{{ number_format($dress->price, 0) }} each
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                {{-- Quantity control --}}
                                <div class="flex items-center border border-gray-700 rounded-lg bg-gray-800/30">
                                    <button class="quantity-decrease px-3 py-2 text-gray-400 hover:text-yellow-500 transition-colors disabled:opacity-50"
                                            {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <span class="quantity-value w-8 text-center text-white font-medium">{{ $item['quantity'] }}</span>
                                    <button class="quantity-increase px-3 py-2 text-gray-400 hover:text-yellow-500 transition-colors"
                                            {{ $item['quantity'] >= 10 ? 'disabled' : '' }}>
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>

                                {{-- Subtotal & remove --}}
                                <div class="text-right min-w-[80px]">
                                    <div class="text-yellow-500 font-bold subtotal">
                                        R{{ number_format($item['subtotal'], 0) }}
                                    </div>
                                    <button class="remove-item text-xs text-gray-500 hover:text-red-400 transition-colors mt-1">
                                        <i class="fas fa-trash-alt mr-1"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-1">
                <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 sticky top-24">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-receipt text-yellow-500 mr-2"></i>
                        Order Summary
                    </h3>

                    <div class="space-y-3 text-sm border-b border-gray-800/50 pb-4 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Subtotal</span>
                            <span class="text-white font-medium" id="cart-subtotal">R{{ number_format($subtotal, 0) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Shipping</span>
                            <span class="text-gray-300">Calculated at checkout</span>
                        </div>
                    </div>

                    <div class="flex justify-between text-base font-semibold mb-6">
                        <span class="text-white">Estimated Total</span>
                        <span class="text-yellow-500" id="cart-total">R{{ number_format($subtotal, 0) }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" 
                       class="block w-full py-3.5 text-center bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-bold rounded-lg hover:from-yellow-400 hover:to-yellow-500 transition-all duration-300 shadow-lg shadow-yellow-500/20">
                        Proceed to Checkout
                    </a>

                    <p class="text-xs text-gray-500 text-center mt-4">
                        <i class="fas fa-lock mr-1"></i> Secure checkout
                    </p>
                </div>
            </div>
        </div>

        {{-- Continue shopping link --}}
        <div class="mt-8 text-center lg:text-left">
            <a href="{{ route('products.index') }}" class="inline-flex items-center text-gray-400 hover:text-yellow-500 transition-colors group">
                <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Continue Shopping
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // Quantity increase
    document.querySelectorAll('.quantity-increase').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const container = this.closest('.cart-item');
            const productId = container.dataset.productId;
            const qtySpan = container.querySelector('.quantity-value');
            let qty = parseInt(qtySpan.textContent);
            if (qty < 10) {
                qty++;
                updateCart(productId, qty, container);
            }
        });
    });

    // Quantity decrease
    document.querySelectorAll('.quantity-decrease').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const container = this.closest('.cart-item');
            const productId = container.dataset.productId;
            const qtySpan = container.querySelector('.quantity-value');
            let qty = parseInt(qtySpan.textContent);
            if (qty > 1) {
                qty--;
                updateCart(productId, qty, container);
            }
        });
    });

    // Remove item
    document.querySelectorAll('.remove-item').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const container = this.closest('.cart-item');
            const productId = container.dataset.productId;

            fetch('{{ route("cart.remove") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    container.remove();
                    updateGlobalCartCount(data.cart_count);
                    updateSummary(data.subtotal);
                    if (data.cart_count == 0) {
                        location.reload(); // refresh to show empty state
                    }
                }
            })
            .catch(err => console.error(err));
        });
    });

    function updateCart(productId, newQty, container) {
        fetch('{{ route("cart.update") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ product_id: productId, quantity: newQty })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Update quantity display
                container.querySelector('.quantity-value').textContent = newQty;
                // Update subtotal for this item
                const price = parseFloat(container.querySelector('.subtotal').textContent.replace('R', '').replace(',', '')) / (newQty - (newQty > 1 ? -1 : 1));
                const newSubtotal = price * newQty;
                container.querySelector('.subtotal').textContent = 'R' + newSubtotal.toLocaleString('en-ZA', {maximumFractionDigits:0});
                // Update global summary
                updateGlobalCartCount(data.cart_count);
                updateSummary(data.subtotal);
                // Enable/disable decrease button
                const decBtn = container.querySelector('.quantity-decrease');
                if (newQty <= 1) decBtn.disabled = true; else decBtn.disabled = false;
            }
        });
    }

    function updateGlobalCartCount(count) {
        document.querySelectorAll('.cart-count').forEach(el => {
            el.textContent = count;
            el.classList.add('scale-150');
            setTimeout(() => el.classList.remove('scale-150'), 300);
        });
    }

    function updateSummary(subtotal) {
        document.getElementById('cart-subtotal').textContent = subtotal;
        document.getElementById('cart-total').textContent = subtotal;
    }
</script>
@endpush