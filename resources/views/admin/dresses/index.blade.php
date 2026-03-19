@extends('layouts.admin')

@section('title', 'Manage Dresses')
@section('page-title', 'Dress Management')
@section('page-description', 'Manage your traditional ceremony dress collection')

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
<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Total Dresses -->
    <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 hover:border-yellow-500/30 transition-all duration-300 group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">Total Dresses</p>
                <p class="text-3xl font-bold text-white">{{ $dresses->total() }}</p>
            </div>
            <div class="p-3 bg-yellow-500/10 rounded-lg group-hover:bg-yellow-500/20 transition-colors">
                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Active Dresses -->
    <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 hover:border-green-500/30 transition-all duration-300 group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">Active</p>
                <p class="text-3xl font-bold text-white">{{ \App\Models\Dress::where('status', 'active')->count() }}</p>
            </div>
            <div class="p-3 bg-green-500/10 rounded-lg group-hover:bg-green-500/20 transition-colors">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Featured Dresses -->
    <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 hover:border-yellow-500/30 transition-all duration-300 group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">Featured</p>
                <p class="text-3xl font-bold text-white">{{ \App\Models\Dress::where('is_featured', true)->count() }}</p>
            </div>
            <div class="p-3 bg-yellow-500/10 rounded-lg group-hover:bg-yellow-500/20 transition-colors">
                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Draft Dresses -->
    <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6 hover:border-gray-500/30 transition-all duration-300 group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">Drafts</p>
                <p class="text-3xl font-bold text-white">{{ \App\Models\Dress::where('status', 'draft')->count() }}</p>
            </div>
            <div class="p-3 bg-gray-500/10 rounded-lg group-hover:bg-gray-500/20 transition-colors">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Dresses Table -->
<div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-800/50">
            <thead class="bg-gray-900/50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Dress</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Category/SKU</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Sizes</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800/50">
                @forelse($dresses as $dress)
                <tr class="hover:bg-gray-800/30 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($dress->main_image_url)
                            <div class="flex-shrink-0 h-10 w-10 rounded-lg border border-gray-700 overflow-hidden">
                                <img class="h-10 w-10 object-cover" src="{{ $dress->main_image_url }}" alt="{{ $dress->name }}">
                            </div>
                            @else
                            <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-gray-800/50 border border-gray-700 flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2z"/>
                                </svg>
                            </div>
                            @endif
                            <div class="ml-4">
                                <a href="{{ route('admin.dresses.show', $dress) }}" class="text-sm font-medium text-white hover:text-yellow-500 transition-colors">
                                    {{ $dress->name }}
                                </a>
                                <div class="text-xs text-gray-500 mt-0.5">{{ Str::limit($dress->description, 40) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-300">{{ $categories[$dress->sku_prefix] ?? $dress->sku_prefix }}</div>
                        <div class="text-xs text-gray-500">{{ $dress->display_sku }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-yellow-500">R{{ number_format($dress->price, 2) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-wrap gap-1">
                            @foreach($dress->sizes ?? [] as $size)
                            <span class="px-2 py-1 text-xs bg-gray-800 text-gray-300 rounded border border-gray-700">{{ $size }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('admin.dresses.update-status', $dress) }}" method="POST" class="inline" id="status-form-{{ $dress->id }}">
                            @csrf
                            @method('PATCH')
                            <select name="status" 
                                    onchange="document.getElementById('status-form-{{ $dress->id }}').submit()"
                                    class="text-xs rounded-lg border-0 bg-gray-800/50 text-gray-300 px-3 py-1.5 focus:ring-2 focus:ring-yellow-500/30 focus:outline-none
                                    @if($dress->status == 'active') text-green-400
                                    @elseif($dress->status == 'draft') text-yellow-400
                                    @else text-red-400
                                    @endif">
                                <option value="draft" {{ $dress->status == 'draft' ? 'selected' : '' }} class="text-gray-900">Draft</option>
                                <option value="active" {{ $dress->status == 'active' ? 'selected' : '' }} class="text-gray-900">Active</option>
                                <option value="out_of_stock" {{ $dress->status == 'out_of_stock' ? 'selected' : '' }} class="text-gray-900">Out of Stock</option>
                            </select>
                        </form>
                        
                        <form action="{{ route('admin.dresses.toggle-featured', $dress) }}" method="POST" class="inline ml-2">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="p-1.5 rounded-lg hover:bg-gray-800/50 transition-colors">
                                <svg class="w-4 h-4 {{ $dress->is_featured ? 'text-yellow-500' : 'text-gray-500' }}" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('admin.dresses.show', $dress) }}" class="text-gray-400 hover:text-yellow-500 transition-colors" title="View">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <a href="{{ route('admin.dresses.edit', $dress) }}" class="text-gray-400 hover:text-yellow-500 transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.dresses.destroy', $dress) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this dress?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-700" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2z"/>
                        </svg>
                        <p class="mt-4 text-gray-400 text-lg">No dresses found</p>
                        <p class="text-gray-500 text-sm mt-1">Create your first dress to get started</p>
                        <a href="{{ route('admin.dresses.create') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-semibold rounded-lg hover:from-yellow-400 hover:to-yellow-500 transition-all duration-300">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4v16m8-8H4"/>
                            </svg>
                            Create First Dress
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($dresses->hasPages())
    <div class="px-6 py-4 border-t border-gray-800/50">
        {{ $dresses->links() }}
    </div>
    @endif
</div>
@endsection