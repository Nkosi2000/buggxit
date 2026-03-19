@extends('layouts.app')

@section('title', $dress->name . ' – BUGGXIT Couture')

@section('content')
{{-- ========== BACK LINK ========== --}}
<div class="container-wide px-4 sm:px-6 lg:px-8 mx-auto pt-6">
    <a href="{{ route('products.index', request()->has('category') ? ['category' => request()->category] : []) }}" 
       class="inline-flex items-center text-gray-400 hover:text-yellow-500 transition-colors group">
        <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back to all dresses
    </a>
</div>

{{-- ========== MAIN PRODUCT SECTION ========== --}}
<section class="container-wide px-4 sm:px-6 lg:px-8 mx-auto py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16">
        {{-- Left: Images --}}
        <div class="space-y-4">
            {{-- Main Image --}}
            <div class="relative aspect-square rounded-2xl overflow-hidden border border-gray-800 bg-black/90 backdrop-blur-sm group">
                @if($dress->main_image_url)
                    <img src="{{ $dress->main_image_url }}" 
                         alt="{{ $dress->name }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-700" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2z"/>
                        </svg>
                    </div>
                @endif
                
                @if($dress->is_featured)
                    <span class="absolute top-4 left-4 z-20 px-3 py-1.5 text-xs font-medium bg-yellow-500/90 text-gray-900 rounded-full backdrop-blur-sm">
                        <i class="fas fa-star mr-1"></i> Featured
                    </span>
                @endif
            </div>
            
            {{-- Gallery Thumbnails --}}
            @if($dress->gallery_images && count($dress->gallery_images) > 0)
                <div class="grid grid-cols-4 gap-2">
                    {{-- Main image as first thumbnail --}}
                    @if($dress->main_image_url)
                        <div class="aspect-square rounded-lg overflow-hidden border border-gray-800 cursor-pointer hover:border-yellow-500/50 transition-colors"
                             onclick="document.querySelector('.aspect-square img').src='{{ $dress->main_image_url }}'">
                            <img src="{{ $dress->main_image_url }}" alt="Main" class="w-full h-full object-cover">
                        </div>
                    @endif
                    
                    {{-- Gallery images --}}
                    @foreach($dress->gallery_images as $image)
                        <div class="aspect-square rounded-lg overflow-hidden border border-gray-800 cursor-pointer hover:border-yellow-500/50 transition-colors"
                             onclick="document.querySelector('.aspect-square img').src='{{ $image }}'">
                            <img src="{{ $image }}" alt="Gallery" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        
        {{-- Right: Details --}}
        <div class="space-y-6">
            {{-- Category & Name --}}
            <div>
                <div class="text-sm text-yellow-500 uppercase tracking-wider mb-2">
                    {{ $categories[$dress->sku_prefix]['name'] ?? $dress->sku_prefix }}
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-white">{{ $dress->name }}</h1>
            </div>
            
            {{-- Price --}}
            <div class="flex items-baseline gap-3">
                <span class="text-3xl font-bold text-yellow-500">R{{ number_format($dress->price, 0) }}</span>
                @if($dress->is_featured)
                    <span class="px-3 py-1 text-xs font-medium bg-yellow-500/10 text-yellow-500 border border-yellow-500/30 rounded-full">
                        <i class="fas fa-star mr-1"></i> Editor's pick
                    </span>
                @endif
            </div>
            
            {{-- Description --}}
            <div class="prose prose-invert max-w-none">
                <p class="text-gray-300 leading-relaxed">{{ $dress->description }}</p>
            </div>
            
            {{-- Available Sizes --}}
            <div>
                <h3 class="text-white font-semibold mb-3 flex items-center">
                    <i class="fas fa-ruler-combined text-yellow-500 mr-2"></i>
                    Available Sizes
                </h3>
                <div class="flex flex-wrap gap-2">
                    @forelse($dress->sizes ?? [] as $size)
                        <span class="px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-lg text-gray-300 text-sm hover:border-yellow-500/30 transition-colors">
                            Size {{ $size }}
                        </span>
                    @empty
                        <span class="text-gray-500 text-sm">Contact us for sizing</span>
                    @endforelse
                </div>
            </div>
            
            {{-- Available Colors --}}
            <div>
                <h3 class="text-white font-semibold mb-3 flex items-center">
                    <i class="fas fa-palette text-yellow-500 mr-2"></i>
                    Available Colors
                </h3>
                <div class="flex flex-wrap gap-3">
                    @forelse($dress->colors ?? [] as $color)
                        <span class="flex items-center px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-lg text-gray-300 text-sm">
                            @if($color != 'multi')
                                <span class="w-3 h-3 rounded-full mr-2" style="background-color: {{ $color }};"></span>
                            @else
                                <span class="w-3 h-3 rounded-full mr-2 bg-gradient-to-r from-red-400 via-blue-400 to-yellow-400"></span>
                            @endif
                            {{ ucfirst($color) }}
                        </span>
                    @empty
                        <span class="text-gray-500 text-sm">Contact us for color options</span>
                    @endforelse
                </div>
            </div>
            
            {{-- Production & Delivery --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-gray-800/50">
                <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 rounded-lg bg-yellow-500/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-clock text-yellow-500"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Turnaround time</p>
                        <p class="text-white font-medium">{{ $dress->turnaround_time }}</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 rounded-lg bg-yellow-500/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-truck text-yellow-500"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Expected delivery</p>
                        <p class="text-white font-medium">{{ $dress->expected_delivery }}</p>
                    </div>
                </div>
            </div>
            
            {{-- Add to Cart Button --}}
            <div class="pt-6">
                <button class="add-to-cart w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-bold rounded-xl hover:from-yellow-400 hover:to-yellow-500 transition-all duration-300 shadow-2xl shadow-yellow-500/25 flex items-center justify-center space-x-3 text-lg"
                        data-product-id="{{ $dress->id }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Add to Collection</span>
                </button>
            </div>
            
            {{-- Additional info --}}
            <div class="text-xs text-gray-500 pt-4 border-t border-gray-800/50">
                <i class="fas fa-shield-alt mr-1"></i> Handcrafted with care in South Africa. 
                Each piece is made to order.
            </div>
        </div>
    </div>
</section>

{{-- ========== RELATED PRODUCTS (OPTIONAL - YOU CAN EXPAND LATER) ========== --}}
{{-- @if($relatedDresses->isNotEmpty())
<section class="container-wide px-4 sm:px-6 lg:px-8 mx-auto py-16">
    <h2 class="text-2xl md:text-3xl font-bold text-white mb-8">
        <span class="text-yellow-500">//</span> You May Also Like
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($relatedDresses as $related)
            <div class="group bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl overflow-hidden hover:border-yellow-500/50 transition-all duration-500">
                <a href="{{ route('products.show', $related) }}" class="block">
                    <div class="h-56 overflow-hidden">
                        @if($related->main_image_url)
                            <img src="{{ $related->main_image_url }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                <svg class="w-10 h-10 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="text-xs text-yellow-500">{{ $categories[$related->sku_prefix]['name'] ?? $related->sku_prefix }}</div>
                        <h3 class="font-medium text-white mt-1 group-hover:text-yellow-500 transition-colors">{{ $related->name }}</h3>
                        <p class="text-yellow-500 font-bold mt-2">R{{ number_format($related->price, 0) }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>
@endif --}}
@endsection

@push('scripts')
<script>
    // CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    // Add to cart
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.dataset.productId;
            
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ product_id: productId, quantity: 1 })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Update all cart counts in navbar
                    document.querySelectorAll('.cart-count').forEach(el => {
                        el.textContent = data.cart_count;
                        el.classList.add('scale-150');
                        setTimeout(() => el.classList.remove('scale-150'), 300);
                    });
                    
                    // Show success toast
                    const toast = document.createElement('div');
                    toast.className = 'fixed top-20 right-6 bg-green-500/90 text-white px-5 py-3 rounded-lg shadow-2xl z-50 animate-fade-in-up flex items-center';
                    toast.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Added to your collection';
                    document.body.appendChild(toast);
                    setTimeout(() => toast.remove(), 3000);
                }
            })
            .catch(err => console.error(err));
        });
    });
    
    // Thumbnail switcher (simple)
    document.querySelectorAll('[onclick^="document.querySelector"]').forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Already handled by inline onclick, but we can keep for clarity
        });
    });
</script>
@endpush

@push('styles')
<style>
    /* Simple fade animation for toast */
    .animate-fade-in-up {
        animation: fadeInUp 0.3s ease-out;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush