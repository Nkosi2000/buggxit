@extends('layouts.admin')

@section('title', 'Dashboard - BUGGXIT Admin')
@section('page-title', 'Dress Management Dashboard')
@section('page-description')
    Welcome back, {{ Auth::guard('admin')->user()->name ?? 'Admin' }}. Here's what's happening with your collection.
@endsection

@section('header-actions')
    <div class="mt-4 md:mt-0">
        <a href="{{ route('admin.dresses.create') }}" 
           class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-semibold rounded-lg hover:from-yellow-400 hover:to-yellow-500 transition-all duration-300 text-sm shadow-lg shadow-yellow-500/20">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 4v16m8-8H4"/>
            </svg>
            Add New Dress
        </a>
    </div>
@endsection

@section('content')
<!-- Stats Cards Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Total Dresses -->
    <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 hover:border-yellow-500/30 transition-all duration-300 group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">Total Dresses</p>
                <p class="text-3xl font-bold text-white">{{ $stats['total_dresses'] }}</p>
            </div>
            <div class="p-3 bg-yellow-500/10 rounded-lg group-hover:bg-yellow-500/20 transition-colors">
                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-xs">
            <span class="text-gray-500">All time</span>
        </div>
    </div>
    
    <!-- Active Dresses -->
    <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 hover:border-green-500/30 transition-all duration-300 group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">Active Dresses</p>
                <p class="text-3xl font-bold text-white">{{ $stats['active_dresses'] }}</p>
            </div>
            <div class="p-3 bg-green-500/10 rounded-lg group-hover:bg-green-500/20 transition-colors">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-xs">
            <span class="text-green-400">✓ Available for sale</span>
        </div>
    </div>
    
    <!-- Featured Dresses -->
    <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 hover:border-yellow-500/30 transition-all duration-300 group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">Featured Dresses</p>
                <p class="text-3xl font-bold text-white">{{ $stats['featured_dresses'] }}</p>
            </div>
            <div class="p-3 bg-yellow-500/10 rounded-lg group-hover:bg-yellow-500/20 transition-colors">
                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-xs">
            <span class="text-yellow-500">★ Marked as featured</span>
        </div>
    </div>
    
    <!-- Draft Dresses -->
    <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 hover:border-gray-500/30 transition-all duration-300 group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">Drafts</p>
                <p class="text-3xl font-bold text-white">{{ $stats['draft_dresses'] }}</p>
            </div>
            <div class="p-3 bg-gray-500/10 rounded-lg group-hover:bg-gray-500/20 transition-colors">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-xs">
            <span class="text-gray-500">Awaiting publication</span>
        </div>
    </div>
</div>

<!-- Quick Actions Row (cards) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <a href="{{ route('admin.dresses.create') }}" 
       class="group bg-gradient-to-br from-black to-gray-900 border border-gray-800 rounded-xl p-6 hover:border-yellow-500/50 transition-all duration-300 flex items-center justify-between">
        <div>
            <p class="text-white font-semibold text-lg mb-1">Create New Dress</p>
            <p class="text-gray-400 text-sm">Add a unique traditional attire</p>
        </div>
        <div class="p-3 bg-yellow-500/10 rounded-full group-hover:bg-yellow-500/20 transition-colors">
            <svg class="w-6 h-6 text-yellow-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 4v16m8-8H4"/>
            </svg>
        </div>
    </a>
    
    <a href="{{ route('admin.dresses.index') }}" 
       class="group bg-gradient-to-br from-black to-gray-900 border border-gray-800 rounded-xl p-6 hover:border-yellow-500/50 transition-all duration-300 flex items-center justify-between">
        <div>
            <p class="text-white font-semibold text-lg mb-1">Manage Dresses</p>
            <p class="text-gray-400 text-sm">View, edit or delete items</p>
        </div>
        <div class="p-3 bg-yellow-500/10 rounded-full group-hover:bg-yellow-500/20 transition-colors">
            <svg class="w-6 h-6 text-yellow-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
        </div>
    </a>
    
    <form action="{{ route('admin.dashboard.clear-cache') }}" method="POST" class="group">
        @csrf
        <button type="submit"
                class="w-full bg-gradient-to-br from-black to-gray-900 border border-gray-800 rounded-xl p-6 hover:border-yellow-500/50 transition-all duration-300 flex items-center justify-between">
            <div class="text-left">
                <p class="text-white font-semibold text-lg mb-1">Refresh Data</p>
                <p class="text-gray-400 text-sm">Clear cache & update stats</p>
            </div>
            <div class="p-3 bg-yellow-500/10 rounded-full group-hover:bg-yellow-500/20 transition-colors">
                <svg class="w-6 h-6 text-yellow-500 group-hover:rotate-180 transition-transform duration-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </div>
        </button>
    </form>
</div>

<!-- Main Content Grid: Recent Dresses + Categories -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Recent Dresses (2/3 width on large) -->
    <div class="lg:col-span-2">
        <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-800/50 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white flex items-center">
                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    Recently Added
                </h3>
                <a href="{{ route('admin.dresses.index') }}" class="text-sm text-yellow-500 hover:text-yellow-400 transition-colors">
                    View all <span aria-hidden="true">→</span>
                </a>
            </div>
            
            <div class="p-6">
                @if($recentDresses->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentDresses as $dress)
                        <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-800/30 transition-colors group">
                            <div class="flex items-center space-x-4">
                                <!-- Dress image -->
                                <div class="w-12 h-12 rounded-lg bg-gray-800/50 border border-gray-700 overflow-hidden flex-shrink-0">
                                    @if($dress->main_image_url)
                                        <img src="{{ $dress->main_image_url }}" alt="{{ $dress->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ route('admin.dresses.show', $dress) }}" class="font-medium text-white group-hover:text-yellow-500 transition-colors">
                                        {{ $dress->name }}
                                    </a>
                                    <div class="flex items-center text-xs text-gray-500 mt-1">
                                        <span>R{{ number_format($dress->price, 2) }}</span>
                                        <span class="mx-2">•</span>
                                        @php
                                            $catNames = ['SLMK'=>'Slay Makoti','ZMBN'=>'Zimbini','CLPS'=>'Classic Panel','NKWA'=>'Nokwanda','PNDK'=>'Phenduka','SLBL'=>'Slay Bubble','CUSTOM'=>'Custom'];
                                        @endphp
                                        <span>{{ $catNames[$dress->sku_prefix] ?? $dress->sku_prefix }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                    {{ $dress->status == 'active' ? 'bg-green-500/10 text-green-400 border border-green-500/30' : 
                                       ($dress->status == 'draft' ? 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/30' : 
                                       'bg-gray-500/10 text-gray-400 border border-gray-500/30') }}">
                                    {{ ucfirst($dress->status) }}
                                </span>
                                <a href="{{ route('admin.dresses.edit', $dress) }}" 
                                   class="p-2 text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 rounded-lg transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-700" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2z"/>
                        </svg>
                        <p class="mt-4 text-gray-400">No dresses yet. Create your first dress!</p>
                        <a href="{{ route('admin.dresses.create') }}" class="mt-4 inline-flex items-center text-yellow-500 hover:text-yellow-400">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4v16m8-8H4"/>
                            </svg>
                            Add New Dress
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Right Column: Categories & Stats -->
    <div class="space-y-6">
        <!-- Categories Breakdown -->
        <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                Categories
            </h3>
            
            <div class="space-y-4">
                @php
                    $categoryNames = [
                        'SLMK' => 'Slay Makoti',
                        'ZMBN' => 'Zimbini',
                        'CLPS' => 'Classic Panel',
                        'NKWA' => 'Nokwanda',
                        'PNDK' => 'Phenduka',
                        'SLBL' => 'Slay Bubble',
                        'CUSTOM' => 'Custom',
                    ];
                    $totalDresses = $stats['total_dresses'] ?: 1; // avoid division by zero
                @endphp
                @foreach($categories as $code => $count)
                    @if($count > 0)
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-300">{{ $categoryNames[$code] ?? $code }}</span>
                                <span class="text-white font-medium">{{ $count }}</span>
                            </div>
                            <div class="w-full bg-gray-800 rounded-full h-2 overflow-hidden">
                                <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ ($count / $totalDresses) * 100 }}%"></div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            
            <div class="mt-6 pt-4 border-t border-gray-800/50">
                <div class="flex justify-between items-center">
                    <span class="text-gray-400 text-sm">Total distinct categories</span>
                    <span class="text-white font-bold">{{ count(array_filter($categories)) }}</span>
                </div>
            </div>
        </div>
        
        <!-- Quick Status Summary -->
        <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                </svg>
                Inventory Health
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-400 text-sm">Active</span>
                    <span class="text-green-400 font-medium">{{ $stats['active_dresses'] }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400 text-sm">Draft</span>
                    <span class="text-yellow-400 font-medium">{{ $stats['draft_dresses'] }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400 text-sm">Out of Stock</span>
                    <span class="text-gray-400 font-medium">{{ $stats['out_of_stock_dresses'] }}</span>
                </div>
                <div class="flex justify-between pt-2 border-t border-gray-800/50">
                    <span class="text-gray-300 text-sm font-medium">Featured</span>
                    <span class="text-yellow-500 font-bold">{{ $stats['featured_dresses'] }}</span>
                </div>
            </div>
            
            <!-- Estimated revenue placeholder -->
            <div class="mt-6 p-4 bg-gradient-to-br from-yellow-500/5 to-yellow-500/10 border border-yellow-500/20 rounded-lg">
                <p class="text-xs text-gray-400 uppercase tracking-wider">Est. Monthly Revenue</p>
                <p class="text-xl font-bold text-white">R{{ number_format($estimatedRevenue, 2) }}</p>
                <p class="text-xs text-gray-500 mt-1">Based on active dresses</p>
            </div>
        </div>
    </div>
</div>
@endsection