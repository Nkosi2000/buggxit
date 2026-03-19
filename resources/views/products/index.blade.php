@extends('layouts.app')

@section('title', 'All Dresses – BUGGXIT Couture')

@section('content')
{{-- ========== PAGE HEADER ========== --}}
<section class="relative mb-12 overflow-hidden">
    <div class="absolute -top-20 -right-20 w-64 h-64 bg-yellow-500/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-yellow-500/5 rounded-full blur-3xl"></div>
    
    <div class="relative z-10 py-12 md:py-16">
        <div class="container-wide px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="max-w-3xl">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-500 border border-yellow-500/30 mb-4 backdrop-blur-sm">
                    <i class="fas fa-tshirt mr-2"></i>
                    {{ $dresses->total() }} {{ Str::plural('design', $dresses->total()) }} available
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                    Our <span class="text-yellow-500">Collections</span>
                </h1>
                <p class="text-lg text-gray-300 max-w-2xl">
                    Handcrafted traditional ceremony attire, made to measure. 
                    Each piece is a unique expression of heritage and elegance.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ========== CATEGORY FILTER ========== --}}
<section class="container-wide px-4 sm:px-6 lg:px-8 mx-auto mb-12">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h2 class="text-white font-semibold text-lg flex items-center">
            <i class="fas fa-filter mr-2 text-yellow-500"></i>
            Filter by collection
        </h2>
        
        {{-- Reset filter link --}}
        <a href="{{ route('products.index') }}" 
           class="text-sm text-gray-400 hover:text-yellow-500 transition-colors {{ request()->has('category') ? '' : 'hidden' }}">
            <i class="fas fa-times mr-1"></i> Clear filter
        </a>
    </div>
    
    <div class="flex flex-wrap gap-3">
        {{-- All categories pill --}}
        <a href="{{ route('products.index') }}" 
           class="inline-flex items-center px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300
                  {{ !request()->has('category') 
                     ? 'bg-yellow-500 text-gray-900 shadow-lg shadow-yellow-500/30' 
                     : 'bg-gray-800/50 border border-gray-700 text-gray-300 hover:bg-gray-800 hover:text-white hover:border-yellow-500/50' }}">
            <i class="fas fa-tags mr-2"></i>
            All
        </a>
        
        {{-- Dynamic category pills from database --}}
        @foreach($categories as $key => $category)
            @php
                $count = \App\Models\Dress::where('sku_prefix', $key)->where('status', 'active')->count();
            @endphp
            @if($count > 0)
                <a href="{{ route('products.index', ['category' => $key]) }}" 
                   class="inline-flex items-center px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300
                          {{ request('category') == $key 
                             ? 'bg-yellow-500 text-gray-900 shadow-lg shadow-yellow-500/30' 
                             : 'bg-gray-800/50 border border-gray-700 text-gray-300 hover:bg-gray-800 hover:text-white hover:border-yellow-500/50' }}">
                    <i class="{{ $category['icon'] }} mr-2"></i>
                    {{ $category['name'] }}
                    <span class="ml-2 text-xs opacity-75">({{ $count }})</span>
                </a>
            @endif
        @endforeach
    </div>
</section>

{{-- ========== PRODUCT GRID ========== --}}
<section class="container-wide px-4 sm:px-6 lg:px-8 mx-auto mb-16">
    {{-- Sort / Result bar (optional) --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <p class="text-gray-400 text-sm">
            Showing <span class="text-white font-medium">{{ $dresses->firstItem() ?? 0 }}</span> 
            – <span class="text-white font-medium">{{ $dresses->lastItem() ?? 0 }}</span> 
            of <span class="text-yellow-500 font-medium">{{ $dresses->total() }}</span> dresses
        </p>
        
        {{-- Sorting dropdown (placeholder – you can implement later) --}}
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" 
                    class="flex items-center space-x-2 px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-lg text-gray-300 hover:text-white hover:border-yellow-500/50 transition-colors text-sm">
                <i class="fas fa-sort-amount-down text-yellow-500"></i>
                <span>Sort by: Latest</span>
                <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute right-0 mt-2 w-48 bg-black/90 backdrop-blur-sm border border-gray-800 rounded-lg shadow-xl z-50 overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-yellow-500/30 to-transparent"></div>
                <a href="#" class="block px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-800/50 hover:text-yellow-500 transition-colors">Latest</a>
                <a href="#" class="block px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-800/50 hover:text-yellow-500 transition-colors">Price: Low to High</a>
                <a href="#" class="block px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-800/50 hover:text-yellow-500 transition-colors">Price: High to Low</a>
            </div>
        </div>
    </div>
    
    {{-- Product grid --}}
    @if($dresses->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($dresses as $dress)
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
                        <a href="{{ route('products.show', $dress) }}" class="block">
                            <h3 class="font-semibold text-white text-lg mb-2 line-clamp-1 hover:text-yellow-500 transition-colors">
                                {{ $dress->name }}
                            </h3>
                        </a>
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
    @else
        {{-- Empty state --}}
        <div class="text-center py-16 bg-black/90 backdrop-blur-sm border border-gray-800 rounded-2xl">
            <svg class="w-20 h-20 mx-auto text-gray-700 mb-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2z"/>
            </svg>
            <h3 class="text-2xl font-bold text-white mb-2">No dresses found</h3>
            <p class="text-gray-400 mb-6">Try adjusting your filter or check back later.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-semibold rounded-lg hover:from-yellow-400 hover:to-yellow-500 transition-all duration-300">
                <i class="fas fa-times-circle mr-2"></i>
                Clear filter
            </a>
        </div>
    @endif
    
    {{-- ========== PAGINATION ========== --}}
    @if($dresses->hasPages())
        <div class="mt-12">
            {{ $dresses->onEachSide(2)->links('vendor.pagination.tailwind-dark') }}
        </div>
    @endif
</section>
@endsection

@push('scripts')
{{-- Same cart script as landing page --}}
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
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
                body: JSON.stringify({ product_id: productId, quantity: 1 })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.querySelectorAll('.cart-count').forEach(el => {
                        el.textContent = data.cart_count;
                        el.classList.add('scale-150');
                        setTimeout(() => el.classList.remove('scale-150'), 300);
                    });
                    
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
@endpush