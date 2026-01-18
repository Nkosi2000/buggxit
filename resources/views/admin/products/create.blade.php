@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4 text-[rgb(193,146,43)]">➕ Add Product</h2>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success message --}}
    @if (session('status'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium">Product Name *</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                   placeholder="e.g., Premium T-Shirt"
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Category *</label>
            <input type="text" name="category" value="{{ old('category') }}"
                   class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                   placeholder="e.g., Clothing, Accessories"
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">SKU (Stock Keeping Unit)</label>
            <input type="text" name="sku" value="{{ old('sku') }}"
                   class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                   placeholder="Leave empty to auto-generate">
            <p class="text-sm text-gray-500 mt-1">
                Unique product identifier. Auto-generated if left empty.
            </p>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Base Price (R) *</label>
            <input type="number" step="0.01" name="base_price" value="{{ old('base_price') }}"
                   class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                   min="0" placeholder="0.00" required>
            <p class="text-sm text-gray-500 mt-1">
                Base price for this product. Variants can adjust this price.
            </p>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Turnaround Time (Days) *</label>
            <input type="number" name="turnaround_time" value="{{ old('turnaround_time', 5) }}"
                   class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                   min="1" max="30" required>
            <p class="text-sm text-gray-500 mt-1">
                Estimated shipping/production time in business days.
            </p>
        </div>

        {{-- Stock Information Note --}}
        <div class="p-3 bg-blue-50 border border-blue-200 rounded">
            <p class="text-sm text-blue-700">
                💡 <strong>Note:</strong> Stock is managed through product variants.
                After creating this product, you'll be able to add variants (colors, sizes) with their own stock levels.
            </p>
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="bg-[rgb(193,146,43)] text-black px-6 py-2 rounded hover:bg-black hover:text-white transition">
                Save Product
            </button>
            <a href="{{ route('admin.products.index') }}" 
               class="ml-3 text-gray-600 hover:underline">
                Cancel
            </a>
        </div>
    </form>
</div>

{{-- Optional: Auto-generate SKU preview script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.querySelector('input[name="name"]');
    const categoryInput = document.querySelector('input[name="category"]');
    const skuInput = document.querySelector('input[name="sku"]');
    const skuPreview = document.createElement('div');
    
    // Add preview element below SKU input
    if (skuInput) {
        skuPreview.className = 'text-xs text-gray-500 mt-1 hidden';
        skuInput.parentNode.appendChild(skuPreview);
        
        // Generate preview when name or category changes
        function updateSkuPreview() {
            const name = nameInput.value.trim();
            const category = categoryInput.value.trim();
            
            if (name && category && !skuInput.value) {
                const prefix = name.substring(0, 3).toUpperCase().replace(/[^A-Z]/g, '');
                const catCode = category.substring(0, 2).toUpperCase();
                const timestamp = new Date().getFullYear().toString().substr(-2) + 
                                  ('0' + (new Date().getMonth() + 1)).slice(-2) + 
                                  ('0' + new Date().getDate()).slice(-2);
                const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
                
                const generatedSku = (prefix + '-' + catCode + '-' + timestamp + '-' + random).replace(/--/g, '-');
                skuPreview.textContent = 'Auto-generated SKU will be: ' + generatedSku;
                skuPreview.classList.remove('hidden');
            } else {
                skuPreview.classList.add('hidden');
            }
        }
        
        nameInput.addEventListener('input', updateSkuPreview);
        categoryInput.addEventListener('input', updateSkuPreview);
        skuInput.addEventListener('input', function() {
            skuPreview.classList.add('hidden');
        });
    }
});
</script>
@endsection