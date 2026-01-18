@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto p-6">

    {{-- Success/Error Messages --}}
    @if (session('status'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Product Edit Form --}}
    <h1 class="text-2xl font-bold mb-6 text-[rgb(193,146,43)]">Edit Product</h1>
    
    <div class="bg-white p-6 rounded shadow mb-8">
        <form action="{{ route('admin.products.update', $product['id']) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold mb-1">Product Name *</label>
                    <input type="text" name="name" value="{{ old('name', $product['name'] ?? '') }}" 
                           class="w-full border px-3 py-2 rounded focus:ring focus:ring-[rgb(193,146,43)]" required>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Category *</label>
                    <input type="text" name="category" value="{{ old('category', $product['category'] ?? '') }}" 
                           class="w-full border px-3 py-2 rounded focus:ring focus:ring-[rgb(193,146,43)]" required>
                </div>

                <div>
                    <label class="block font-semibold mb-1">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku', $product['sku'] ?? '') }}" 
                           class="w-full border px-3 py-2 rounded focus:ring focus:ring-[rgb(193,146,43)]">
                    <p class="text-sm text-gray-500 mt-1">Leave empty to auto-generate</p>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Base Price (R) *</label>
                    <input type="number" step="0.01" name="base_price" 
                           value="{{ old('base_price', $product['base_price'] ?? 0) }}" 
                           class="w-full border px-3 py-2 rounded focus:ring focus:ring-[rgb(193,146,43)]" min="0" required>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Turnaround Time (Days) *</label>
                    <input type="number" name="turnaround_time" 
                           value="{{ old('turnaround_time', $product['turnaround_time'] ?? 5) }}" 
                           class="w-full border px-3 py-2 rounded focus:ring focus:ring-[rgb(193,146,43)]" min="1" max="30" required>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Current Stock</label>
                    <div class="p-3 bg-gray-50 rounded border">
                        @if(isset($product['stock']))
                            <span class="text-xl font-bold">{{ $product['stock'] }}</span>
                            <span class="text-sm text-gray-500 ml-2">
                                (from {{ count($variants) }} variants)
                            </span>
                        @else
                            <span class="text-gray-500">No variants yet</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Stock is calculated from variants below</p>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-[rgb(193,146,43)] text-black px-6 py-2 rounded hover:bg-black hover:text-white transition">
                    Save Product Changes
                </button>
                <a href="{{ route('admin.products.index') }}" class="ml-3 text-gray-600 hover:underline">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    {{-- Variants Section --}}
    <div class="bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-[rgb(193,146,43)]">Product Variants</h2>
            <a href="{{ route('admin.products.variants.create', $product['id']) }}" 
               class="bg-[rgb(193,146,43)] text-black px-4 py-2 rounded hover:bg-black hover:text-white transition">
                + Add New Variant
            </a>
        </div>

        @if(count($variants) > 0)
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-3 text-left">Color</th>
                        <th class="px-4 py-3 text-left">Size</th>
                        <th class="px-4 py-3 text-left">Price Adjustment</th>
                        <th class="px-4 py-3 text-left">Final Price</th>
                        <th class="px-4 py-3 text-left">Stock</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($variants as $variant)
                        @php
                            // Calculate final price
                            $basePrice = $product['base_price'] ?? 0;
                            $adjustment = $variant['price_adjustment'] ?? 0;
                            $finalPrice = $basePrice + $adjustment;
                        @endphp
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $variant['color'] ?? '—' }}</td>
                            <td class="px-4 py-3">{{ $variant['size'] ?? '—' }}</td>
                            <td class="px-4 py-3">
                                @if($adjustment == 0)
                                    <span class="text-gray-500">None</span>
                                @else
                                    {{ $adjustment > 0 ? '+' : '' }}R{{ number_format($adjustment, 2) }}
                                @endif
                            </td>
                            <td class="px-4 py-3 font-semibold">R{{ number_format($finalPrice, 2) }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-sm 
                                    {{ $variant['stock'] > 10 ? 'bg-green-100 text-green-800' : 
                                       ($variant['stock'] > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $variant['stock'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-3">
                                    {{-- Edit Variant Form (Inline) --}}
                                    <form action="{{ route('admin.products.variants.update', ['product' => $product['id'], 'variant' => $variant['id']]) }}" 
                                          method="POST" class="hidden" id="edit-form-{{ $variant['id'] }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="color" value="{{ $variant['color'] ?? '' }}" 
                                               class="border px-2 py-1 w-20" placeholder="Color">
                                        <input type="text" name="size" value="{{ $variant['size'] ?? '' }}" 
                                               class="border px-2 py-1 w-20" placeholder="Size">
                                        <input type="number" step="0.01" name="price_adjustment" 
                                               value="{{ $variant['price_adjustment'] ?? 0 }}" 
                                               class="border px-2 py-1 w-24" placeholder="Adjustment">
                                        <input type="number" name="stock" value="{{ $variant['stock'] }}" 
                                               class="border px-2 py-1 w-20" min="0" required>
                                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                            Save
                                        </button>
                                        <button type="button" onclick="cancelEdit({{ $variant['id'] }})" 
                                                class="text-gray-600 text-sm ml-2">
                                            Cancel
                                        </button>
                                    </form>
                                    
                                    {{-- View Mode --}}
                                    <div id="view-mode-{{ $variant['id'] }}" class="flex gap-3">
                                        <button type="button" onclick="enableEdit({{ $variant['id'] }})" 
                                                class="text-[rgb(193,146,43)] hover:underline text-sm">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.products.variants.destroy', ['product' => $product['id'], 'variant' => $variant['id']]) }}" 
                                              method="POST" onsubmit="return confirm('Are you sure you want to delete this variant?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{-- Stock Summary --}}
        <div class="mt-6 p-4 bg-gray-50 rounded border">
            <h3 class="font-semibold mb-2">Stock Summary</h3>
            <div class="grid grid-cols-3 gap-4 text-center">
                <div>
                    <div class="text-2xl font-bold">{{ $product['stock'] ?? 0 }}</div>
                    <div class="text-sm text-gray-600">Total Stock</div>
                </div>
                <div>
                    <div class="text-2xl font-bold">{{ count($variants) }}</div>
                    <div class="text-sm text-gray-600">Total Variants</div>
                </div>
                <div>
                    <div class="text-2xl font-bold">R{{ number_format($product['base_price'] ?? 0, 2) }}</div>
                    <div class="text-sm text-gray-600">Base Price</div>
                </div>
            </div>
        </div>
        
        @else
            <div class="text-center py-8 text-gray-500">
                <p class="mb-3">No variants added yet.</p>
                <p>Add variants to manage stock, colors, and sizes.</p>
            </div>
        @endif
    </div>

</div>

{{-- JavaScript for inline editing --}}
<script>
function enableEdit(variantId) {
    document.getElementById(`edit-form-${variantId}`).classList.remove('hidden');
    document.getElementById(`view-mode-${variantId}`).classList.add('hidden');
}

function cancelEdit(variantId) {
    document.getElementById(`edit-form-${variantId}`).classList.add('hidden');
    document.getElementById(`view-mode-${variantId}`).classList.remove('hidden');
}

// Auto-focus first input when editing
function focusEditInput(variantId) {
    const form = document.getElementById(`edit-form-${variantId}`);
    if (form) {
        const firstInput = form.querySelector('input');
        if (firstInput) firstInput.focus();
    }
}
</script>
@endsection