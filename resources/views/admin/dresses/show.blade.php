@extends('layouts.admin')

@section('title', $dress->name)
@section('page-title', 'Dress Details')
@section('page-description', 'View dress information')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.dresses.index') }}" class="text-yellow-500 hover:text-yellow-400 transition-colors flex items-center text-sm group">
            <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Dresses
        </a>
    </div>
    
    <!-- Dress Header -->
    <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white">{{ $dress->name }}</h1>
                <div class="flex flex-wrap items-center mt-3 gap-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                        @if($dress->status == 'active') bg-green-500/10 text-green-400 border border-green-500/30
                        @elseif($dress->status == 'draft') bg-yellow-500/10 text-yellow-400 border border-yellow-500/30
                        @else bg-red-500/10 text-red-400 border border-red-500/30
                        @endif">
                        {{ ucfirst(str_replace('_', ' ', $dress->status)) }}
                    </span>
                    @if($dress->is_featured)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-400 border border-yellow-500/30">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        Featured
                    </span>
                    @endif
                    <span class="text-lg font-bold text-yellow-500">R{{ number_format($dress->price, 2) }}</span>
                </div>
            </div>
            <div class="flex mt-4 md:mt-0 space-x-3">
                <a href="{{ route('admin.dresses.edit', $dress) }}" 
                   class="inline-flex items-center px-4 py-2.5 bg-gray-800/50 border border-gray-700 rounded-lg text-gray-300 hover:text-white hover:bg-gray-800 hover:border-yellow-500/50 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.dresses.destroy', $dress) }}" method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this dress?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2.5 bg-gray-800/50 border border-gray-700 rounded-lg text-red-400 hover:text-red-300 hover:bg-red-900/20 hover:border-red-500/50 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        
        <!-- SKU and Category -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-gray-800/30 border border-gray-800 rounded-lg">
                <p class="text-xs text-gray-500 uppercase tracking-wider">Category</p>
                <p class="mt-1 text-sm font-medium text-white">{{ $categories[$dress->sku_prefix] ?? $dress->sku_prefix }}</p>
            </div>
            <div class="p-4 bg-gray-800/30 border border-gray-800 rounded-lg">
                <p class="text-xs text-gray-500 uppercase tracking-wider">SKU</p>
                <p class="mt-1 text-sm font-medium text-white">{{ $dress->display_sku }}</p>
            </div>
            <div class="p-4 bg-gray-800/30 border border-gray-800 rounded-lg">
                <p class="text-xs text-gray-500 uppercase tracking-wider">Date Created</p>
                <p class="mt-1 text-sm font-medium text-white">{{ $dress->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Images -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Main Image -->
            <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl overflow-hidden">
                @if($dress->main_image_url)
                <img src="{{ $dress->main_image_url }}" 
                     alt="{{ $dress->name }}" 
                     class="w-full h-96 object-cover">
                @else
                <div class="w-full h-96 bg-gray-900 flex items-center justify-center">
                    <svg class="w-24 h-24 text-gray-700" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2z"/>
                    </svg>
                </div>
                @endif
            </div>
            
            <!-- Gallery Images -->
            @if($dress->gallery_images && count($dress->gallery_images) > 0)
            <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 5h16v14H4V5zm2 2v10h12V7H6z"/>
                    </svg>
                    Gallery Images
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($dress->gallery_images as $image)
                    <div class="rounded-lg overflow-hidden border border-gray-800">
                        <img src="{{ $image }}" alt="{{ $dress->name }}" class="w-full h-40 object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        
        <!-- Right Column - Details -->
        <div class="space-y-6">
            <!-- Description -->
            <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16v12H4V6zm2 2v8h12V8H6z"/>
                    </svg>
                    Description
                </h3>
                <p class="text-gray-300 whitespace-pre-line text-sm leading-relaxed">{{ $dress->description }}</p>
            </div>
            
            <!-- Sizes & Colors -->
            <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 11h10v2H7zM4 7h16v2H4zM6 15h12v2H6z"/>
                    </svg>
                    Available Options
                </h3>
                
                <!-- Sizes -->
                <div class="mb-5">
                    <p class="text-sm font-medium text-gray-400 mb-2">Sizes</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($dress->sizes ?? [] as $size)
                        <span class="px-3 py-1.5 bg-gray-800 text-gray-300 rounded-lg border border-gray-700 text-sm">
                            {{ $size }}
                        </span>
                        @endforeach
                    </div>
                </div>
                
                <!-- Colors -->
                <div>
                    <p class="text-sm font-medium text-gray-400 mb-2">Colors</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($dress->display_colors as $color)
                        <span class="px-3 py-1.5 bg-gray-800 text-gray-300 rounded-lg border border-gray-700 text-sm flex items-center">
                            <span class="w-3 h-3 rounded-full mr-2" style="background-color: {{ $color == 'Multi-color' ? 'linear-gradient(to right, red, blue, yellow)' : '' }}"></span>
                            {{ $color }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Production & Delivery -->
            <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 8h-2v2h2v6h-2v2h2a2 2 0 002-2v-6a2 2 0 00-2-2zM4 8h2v2H4v6h2v2H4a2 2 0 01-2-2v-6a2 2 0 012-2z"/>
                    </svg>
                    Production & Delivery
                </h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-800/50">
                        <span class="text-sm text-gray-400">Turnaround Time</span>
                        <span class="text-sm font-medium text-white">{{ $dress->turnaround_time }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-800/50">
                        <span class="text-sm text-gray-400">Expected Delivery</span>
                        <span class="text-sm font-medium text-white">{{ $dress->expected_delivery }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-400">Last Updated</span>
                        <span class="text-xs text-gray-500">{{ $dress->updated_at->format('M d, Y h:i A') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection