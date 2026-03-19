@extends('layouts.admin')

@section('title', 'Edit Dress: ' . $dress->name)
@section('page-title', 'Edit Dress')
@section('page-description', 'Update dress information')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.dresses.update', $dress) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Basic Information Card -->
        <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 6h16v12H4V6zm2 2v8h12V8H6z"/>
                </svg>
                Basic Information
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Dress Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-400 mb-2">Dress Name <span class="text-yellow-500">*</span></label>
                    <input type="text" name="name" id="name" 
                           value="{{ old('name', $dress->name) }}"
                           required
                           class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-all duration-200">
                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Category -->
                <div>
                    <label for="sku_prefix" class="block text-sm font-medium text-gray-400 mb-2">Category <span class="text-yellow-500">*</span></label>
                    <select name="sku_prefix" id="sku_prefix" 
                            required
                            onchange="toggleCustomSku()"
                            class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-all duration-200">
                        <option value="" class="bg-gray-900">Select a category</option>
                        @foreach($categories as $sku => $category)
                            <option value="{{ $sku }}" {{ old('sku_prefix', $dress->sku_prefix) == $sku ? 'selected' : '' }} class="bg-gray-900">
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                    @error('sku_prefix')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Custom SKU (only for CUSTOM category) -->
                <div id="custom-sku-container" class="{{ $dress->sku_prefix === 'CUSTOM' ? '' : 'hidden' }}">
                    <label for="custom_sku" class="block text-sm font-medium text-gray-400 mb-2">Custom SKU <span class="text-yellow-500">*</span></label>
                    <input type="text" name="custom_sku" id="custom_sku" 
                           value="{{ old('custom_sku', $dress->custom_sku) }}"
                           class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-all duration-200">
                    @error('custom_sku')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-400 mb-2">Price (R) <span class="text-yellow-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-gray-500 text-sm">R</span>
                        </div>
                        <input type="number" name="price" id="price" 
                               value="{{ old('price', $dress->price) }}"
                               step="0.01" min="0" required
                               class="pl-8 w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-all duration-200">
                    </div>
                    @error('price')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-400 mb-2">Status <span class="text-yellow-500">*</span></label>
                    <select name="status" id="status" 
                            required
                            class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-all duration-200">
                        <option value="draft" {{ old('status', $dress->status) == 'draft' ? 'selected' : '' }} class="bg-gray-900">Draft</option>
                        <option value="active" {{ old('status', $dress->status) == 'active' ? 'selected' : '' }} class="bg-gray-900">Active</option>
                        <option value="out_of_stock" {{ old('status', $dress->status) == 'out_of_stock' ? 'selected' : '' }} class="bg-gray-900">Out of Stock</option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Description -->
            <div class="mt-6">
                <label for="description" class="block text-sm font-medium text-gray-400 mb-2">Description <span class="text-yellow-500">*</span></label>
                <textarea name="description" id="description" rows="4"
                          required
                          class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-all duration-200">{{ old('description', $dress->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Sizes & Colors Card -->
        <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 11h10v2H7zM4 7h16v2H4zM6 15h12v2H6z"/>
                </svg>
                Sizes & Colors
            </h3>
            
            <!-- Sizes -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-400 mb-3">Available Sizes <span class="text-yellow-500">*</span></label>
                <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
                    @foreach($availableSizes as $size)
                    <label class="flex items-center p-3 bg-gray-800/30 border border-gray-700 rounded-lg hover:border-yellow-500/50 cursor-pointer transition-colors">
                        <input type="checkbox" name="sizes[]" value="{{ $size }}"
                               {{ in_array($size, old('sizes', $dress->sizes ?? [])) ? 'checked' : '' }}
                               class="h-4 w-4 text-yellow-500 bg-gray-800 border-gray-600 rounded focus:ring-yellow-500/30 focus:ring-offset-0">
                        <span class="ml-2 text-sm text-gray-300">Size {{ $size }}</span>
                    </label>
                    @endforeach
                </div>
                @error('sizes')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Colors -->
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-3">Available Colors <span class="text-yellow-500">*</span></label>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3">
                    @foreach($availableColors as $value => $label)
                    <label class="flex items-center p-3 bg-gray-800/30 border border-gray-700 rounded-lg hover:border-yellow-500/50 cursor-pointer transition-colors">
                        <input type="checkbox" name="colors[]" value="{{ $value }}"
                               {{ in_array($value, old('colors', $dress->colors ?? [])) ? 'checked' : '' }}
                               class="h-4 w-4 text-yellow-500 bg-gray-800 border-gray-600 rounded focus:ring-yellow-500/30 focus:ring-offset-0">
                        <span class="ml-2 text-sm text-gray-300">{{ $label }}</span>
                        @if($value != 'multi')
                        <div class="ml-auto w-4 h-4 rounded-full" style="background-color: {{ $value }}; border: 1px solid rgba(255,255,255,0.2);"></div>
                        @else
                        <div class="ml-auto w-4 h-4 rounded-full bg-gradient-to-r from-red-400 via-blue-400 to-yellow-400 border border-white/20"></div>
                        @endif
                    </label>
                    @endforeach
                </div>
                @error('colors')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Production & Delivery Card -->
        <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 8h-2v2h2v6h-2v2h2a2 2 0 002-2v-6a2 2 0 00-2-2zM4 8h2v2H4v6h2v2H4a2 2 0 01-2-2v-6a2 2 0 012-2z"/>
                </svg>
                Production & Delivery
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Turnaround Time -->
                <div>
                    <label for="turnaround_time" class="block text-sm font-medium text-gray-400 mb-2">Turnaround Time <span class="text-yellow-500">*</span></label>
                    <input type="text" name="turnaround_time" id="turnaround_time" 
                           value="{{ old('turnaround_time', $dress->turnaround_time) }}"
                           required
                           class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-all duration-200">
                    @error('turnaround_time')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Expected Delivery -->
                <div>
                    <label for="expected_delivery" class="block text-sm font-medium text-gray-400 mb-2">Expected Delivery <span class="text-yellow-500">*</span></label>
                    <input type="text" name="expected_delivery" id="expected_delivery" 
                           value="{{ old('expected_delivery', $dress->expected_delivery) }}"
                           required
                           class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-all duration-200">
                    @error('expected_delivery')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Featured -->
            <div class="mt-6">
                <label class="flex items-center cursor-pointer group">
                    <input type="checkbox" name="is_featured" value="1"
                           {{ old('is_featured', $dress->is_featured) ? 'checked' : '' }}
                           class="h-4 w-4 text-yellow-500 bg-gray-800 border-gray-600 rounded focus:ring-yellow-500/30 focus:ring-offset-0">
                    <span class="ml-2 text-sm text-gray-300 group-hover:text-yellow-500 transition-colors">Mark as featured dress</span>
                </label>
            </div>
        </div>
        
        <!-- Images Card -->
        <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 5h16v14H4V5zm2 2v10h12V7H6z"/>
                </svg>
                Images
            </h3>
            
            <!-- Current Main Image -->
            @if($dress->main_image_url)
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-400 mb-2">Current Main Image</p>
                <img src="{{ $dress->main_image_url }}" 
                     alt="{{ $dress->name }}" 
                     class="w-48 h-48 object-cover rounded-lg border border-gray-700">
            </div>
            @endif
            
            <!-- Main Image Upload -->
            <div class="mb-6">
                <label for="main_image" class="block text-sm font-medium text-gray-400 mb-2">
                    {{ $dress->main_image_url ? 'Replace Main Image' : 'Upload Main Image' }} <span class="text-yellow-500">{{ $dress->main_image_url ? '' : '*' }}</span>
                </label>
                <input type="file" name="main_image" id="main_image"
                       accept="image/*"
                       class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-yellow-500/10 file:text-yellow-500 hover:file:bg-yellow-500/20">
                <p class="mt-2 text-xs text-gray-500">Leave empty to keep current image</p>
                @error('main_image')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Gallery Images -->
            <div>
                <label for="gallery_images" class="block text-sm font-medium text-gray-400 mb-2">Gallery Images</label>
                <input type="file" name="gallery_images[]" id="gallery_images" multiple
                       accept="image/*"
                       class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-yellow-500/10 file:text-yellow-500 hover:file:bg-yellow-500/20">
                <p class="mt-2 text-xs text-gray-500">Upload new images to replace current gallery</p>
                @error('gallery_images.*')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.dresses.show', $dress) }}" 
               class="px-6 py-3 border border-gray-700 rounded-lg text-gray-400 hover:text-white hover:bg-gray-800/50 transition-all duration-200">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-semibold rounded-lg hover:from-yellow-400 hover:to-yellow-500 transition-all duration-300 shadow-lg shadow-yellow-500/20">
                Update Dress
            </button>
        </div>
    </form>
</div>

<script>
function toggleCustomSku() {
    const categorySelect = document.getElementById('sku_prefix');
    const customSkuContainer = document.getElementById('custom-sku-container');
    const customSkuInput = document.getElementById('custom_sku');
    
    if (categorySelect.value === 'CUSTOM') {
        customSkuContainer.classList.remove('hidden');
        customSkuInput.required = true;
    } else {
        customSkuContainer.classList.add('hidden');
        customSkuInput.required = false;
        customSkuInput.value = '';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    toggleCustomSku();
});
</script>
@endsection