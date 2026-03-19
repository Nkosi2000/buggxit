@extends('layouts.app')

@section('title', 'BUGGXIT Couture – Bespoke Traditional Ceremony Attire')

@section('content')
{{-- ========== HERO SECTION – FULL WIDTH, BOLD, MODERN ========== --}}
<section class="relative mb-20 overflow-hidden">
    <!-- Background orbs -->
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-yellow-500/5 rounded-full blur-3xl"></div>
    
    <div class="relative z-10 bg-gradient-to-br from-black via-gray-900 to-black border-y border-gray-800/50 py-16 md:py-24">
        <div class="container-wide px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Animated badge -->
                <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-500 border border-yellow-500/30 mb-6 backdrop-blur-sm">
                    <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2 animate-pulse"></span>
                    Since 2018 • Handcrafted in South Africa
                </span>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                    Where Tradition Wears
                    <span class="text-yellow-500 block mt-2">Geometric Royalty</span>
                </h1>
                
                <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
                    Every stitch tells your story. Custom‑made traditional ceremony attire, 
                    sized perfectly from 32 to 42, delivered to your nearest courier.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('products.index') }}" 
                       class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-bold rounded-full hover:from-yellow-400 hover:to-yellow-500 transition-all duration-300 shadow-2xl shadow-yellow-500/25">
                        <span>Explore Collections</span>
                        <svg class="w-5 h-5 ml-3 group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('about') }}" 
                       class="group inline-flex items-center px-8 py-4 bg-gray-800/50 backdrop-blur-sm border border-gray-700 text-gray-300 font-bold rounded-full hover:bg-gray-800 hover:text-white hover:border-yellow-500/50 transition-all duration-300">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Our Story
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- subtle wave separator -->
    <div class="absolute bottom-0 left-0 right-0 h-12 bg-gradient-to-t from-black to-transparent pointer-events-none"></div>
</section>

{{-- ========== CATEGORIES – DYNAMIC FROM DATABASE ========== --}}
<section class="container-wide px-4 sm:px-6 lg:px-8 mx-auto mb-20">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-10">
        <div>
            <h2 class="text-3xl md:text-4xl font-bold text-white">
                <span class="text-yellow-500">//</span> Collections
            </h2>
            <p class="text-gray-400 text-lg mt-2">Choose your silhouette, we'll craft it.</p>
        </div>
        <a href="{{ route('products.index') }}" class="hidden md:flex items-center text-yellow-500 hover:text-yellow-400 font-medium mt-4 md:mt-0 group">
            View all categories
            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </a>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 md:gap-6">
        @forelse($activeCategories as $key => $category)
            <a href="{{ route('products.index', ['category' => $key]) }}" 
               class="group relative bg-black/90 backdrop-blur-sm border border-gray-800 rounded-2xl p-6 hover:border-yellow-500/50 transition-all duration-500 hover:shadow-2xl hover:shadow-yellow-500/10 overflow-hidden">
                <!-- Glow effect on hover -->
                <div class="absolute inset-0 bg-gradient-to-br from-yellow-500/0 to-yellow-500/0 group-hover:from-yellow-500/5 group-hover:to-transparent transition-all duration-700"></div>
                
                <div class="relative z-10">
                    <div class="w-14 h-14 mb-4 bg-yellow-500/10 rounded-2xl flex items-center justify-center group-hover:bg-yellow-500/20 transition-colors">
                        <i class="{{ $category['icon'] }} text-2xl text-yellow-500"></i>
                    </div>
                    <h3 class="text-white font-semibold text-lg mb-1 group-hover:text-yellow-500 transition-colors">
                        {{ $category['name'] }}
                    </h3>
                    <p class="text-gray-500 text-sm">
                        {{ $category['count'] }} {{ Str::plural('dress', $category['count']) }}
                    </p>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                <i class="fas fa-tshirt text-4xl mb-4 text-gray-700"></i>
                <p>Collections coming soon.</p>
            </div>
        @endforelse
    </div>
</section>

{{-- ========== FEATURED DRESSES – REAL DATA ========== --}}
@if($featuredDresses->isNotEmpty())
<section class="container-wide px-4 sm:px-6 lg:px-8 mx-auto mb-20">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-10">
        <div>
            <h2 class="text-3xl md:text-4xl font-bold text-white">
                <span class="text-yellow-500">✦</span> Editor's Pick
            </h2>
            <p class="text-gray-400 text-lg mt-2">The finest of our current collection.</p>
        </div>
        <a href="{{ route('products.index') }}" class="hidden md:flex items-center text-yellow-500 hover:text-yellow-400 font-medium group">
            Discover all
            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($featuredDresses as $dress)
            <div class="group bg-black/90 backdrop-blur-sm border border-gray-800 rounded-2xl overflow-hidden hover:border-yellow-500/50 transition-all duration-500 hover:shadow-2xl hover:shadow-yellow-500/10">
                <div class="relative h-72 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent z-10"></div>
                    
                    @if($dress->main_image_url)
                        <img src="{{ $dress->main_image_url }}" 
                             alt="{{ $dress->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
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
                
                <div class="p-5">
                    <div class="text-xs text-yellow-500 uppercase tracking-wider mb-1">
                        {{ $categories[$dress->sku_prefix]['name'] ?? $dress->sku_prefix }}
                    </div>
                    <h3 class="font-semibold text-white text-lg mb-2 line-clamp-1">
                        {{ $dress->name }}
                    </h3>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-yellow-500">
                            R{{ number_format($dress->price, 0) }}
                        </span>
                        <button class="add-to-cart p-3 bg-yellow-500/10 rounded-xl text-yellow-500 hover:bg-yellow-500 hover:text-gray-900 transition-all duration-300"
                                data-product-id="{{ $dress->id }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

{{-- ========== NEW ARRIVALS – LATEST DRESSES ========== --}}
@if($newArrivals->isNotEmpty())
<section class="container-wide px-4 sm:px-6 lg:px-8 mx-auto mb-20">
    <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-3xl p-8 md:p-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10">
            <div>
                <span class="text-yellow-500 text-sm font-semibold uppercase tracking-wider">Fresh off the needle</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mt-2">
                    New Arrivals
                </h2>
            </div>
            <a href="{{ route('products.index') }}" class="inline-flex items-center text-yellow-500 hover:text-yellow-400 font-medium mt-4 md:mt-0 group">
                View all new dresses
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($newArrivals as $dress)
                <a href="{{ route('products.show', $dress) }}" class="group">
                    <div class="relative h-56 rounded-xl overflow-hidden border border-gray-800 group-hover:border-yellow-500/50 transition-colors mb-3">
                        @if($dress->main_image_url)
                            <img src="{{ $dress->main_image_url }}" 
                                 alt="{{ $dress->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gray-800/50 flex items-center justify-center">
                                <svg class="w-10 h-10 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <h4 class="text-white font-medium group-hover:text-yellow-500 transition-colors">
                        {{ $dress->name }}
                    </h4>
                    <p class="text-yellow-500 font-bold mt-1">
                        R{{ number_format($dress->price, 0) }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ========== BESPOKE PROCESS – NO DATABASE, PURE BRANDING ========== --}}
<section class="container-wide px-4 sm:px-6 lg:px-8 mx-auto mb-20">
    <div class="relative bg-gradient-to-br from-gray-900 to-black border border-gray-800 rounded-3xl p-8 md:p-12 overflow-hidden">
        <!-- Decorative -->
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-yellow-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-yellow-500/5 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto text-center">
            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-500 border border-yellow-500/30 mb-6">
                <i class="fas fa-ruler-combined mr-2"></i> Made to measure
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6">
                Your vision, <span class="text-yellow-500">perfectly fitted</span>
            </h2>
            <p class="text-gray-300 text-lg mb-10 max-w-2xl mx-auto">
                From consultation to delivery – every dress is hand‑cut, hand‑sewn, and fitted to your unique measurements. 
                No mass production, only singular pieces.
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-3xl mx-auto">
                <div class="flex flex-col items-center p-5">
                    <div class="w-16 h-16 mb-4 bg-yellow-500/10 rounded-full flex items-center justify-center border border-yellow-500/30">
                        <i class="fas fa-comments text-2xl text-yellow-500"></i>
                    </div>
                    <h4 class="text-white font-semibold text-lg">1. Consult</h4>
                    <p class="text-gray-400 text-sm text-center">Share your style, fabric, and event.</p>
                </div>
                <div class="flex flex-col items-center p-5">
                    <div class="w-16 h-16 mb-4 bg-yellow-500/10 rounded-full flex items-center justify-center border border-yellow-500/30">
                        <i class="fas fa-cut text-2xl text-yellow-500"></i>
                    </div>
                    <h4 class="text-white font-semibold text-lg">2. Craft</h4>
                    <p class="text-gray-400 text-sm text-center">Hand‑cut patterns, hand‑stitched detail.</p>
                </div>
                <div class="flex flex-col items-center p-5">
                    <div class="w-16 h-16 mb-4 bg-yellow-500/10 rounded-full flex items-center justify-center border border-yellow-500/30">
                        <i class="fas fa-truck text-2xl text-yellow-500"></i>
                    </div>
                    <h4 class="text-white font-semibold text-lg">3. Deliver</h4>
                    <p class="text-gray-400 text-sm text-center">Quality checked, sent to your courier.</p>
                </div>
            </div>
            
            <div class="mt-12">
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-bold rounded-full hover:from-yellow-400 hover:to-yellow-500 transition-all duration-300 shadow-lg">
                    Start your bespoke order
                    <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>



@endsection

@push('scripts')
<script>
    // CSRF token for cart AJAX
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    // Add to cart handler
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const productId = this.dataset.productId;
            
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Animate cart count
                    document.querySelectorAll('.cart-count').forEach(el => {
                        el.textContent = data.cart_count;
                        el.classList.add('scale-150');
                        setTimeout(() => el.classList.remove('scale-150'), 300);
                    });
                    
                    // Subtle notification (replace with toast later)
                    const notification = document.createElement('div');
                    notification.className = 'fixed top-20 right-6 bg-green-500/90 text-white px-5 py-3 rounded-lg shadow-2xl z-50 animate-fade-in-up';
                    notification.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Added to your collection';
                    document.body.appendChild(notification);
                    setTimeout(() => notification.remove(), 3000);
                }
            })
            .catch(err => console.error(err));
        });
    });
</script>

<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.3s ease-out;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush