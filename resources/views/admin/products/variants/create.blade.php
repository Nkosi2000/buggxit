@extends('layouts.admin')

@section('title', 'Add Variant')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4 text-[rgb(193,146,43)]">
        Add Variant to: {{ $product['name'] }}
    </h2>
    
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.products.variants.store', $product['id']) }}" method="POST" class="space-y-4">
        @csrf
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-medium">Color</label>
                <input type="text" name="color" value="{{ old('color') }}"
                       class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                       placeholder="e.g., Red, Black">
            </div>
            
            <div>
                <label class="block text-gray-700 font-medium">Size</label>
                <input type="text" name="size" value="{{ old('size') }}"
                       class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                       placeholder="e.g., S, M, L, 10">
            </div>
        </div>
        
        <div>
            <label class="block text-gray-700 font-medium">Price Adjustment (R)</label>
            <input type="number" step="0.01" name="price_adjustment" value="{{ old('price_adjustment', 0) }}"
                   class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]">
            <p class="text-sm text-gray-500 mt-1">
                Positive adds to base price (R{{ number_format($product['base_price'] ?? 0, 2) }}), negative subtracts.
            </p>
        </div>
        
        <div>
            <label class="block text-gray-700 font-medium">Stock *</label>
            <input type="number" name="stock" value="{{ old('stock', 0) }}"
                   class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                   min="0" required>
        </div>
        
        <div class="pt-4">
            <button type="submit"
                    class="bg-[rgb(193,146,43)] text-black px-6 py-2 rounded hover:bg-black hover:text-white transition">
                Add Variant
            </button>
            <a href="{{ route('admin.products.edit', $product['id']) }}" 
               class="ml-3 text-gray-600 hover:underline">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection@extends('layouts.admin')

@section('title', 'Add Variant')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4 text-[rgb(193,146,43)]">
        Add Variant to: {{ $product['name'] }}
    </h2>
    
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.products.variants.store', $product['id']) }}" method="POST" class="space-y-4">
        @csrf
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-medium">Color</label>
                <input type="text" name="color" value="{{ old('color') }}"
                       class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                       placeholder="e.g., Red, Black">
            </div>
            
            <div>
                <label class="block text-gray-700 font-medium">Size</label>
                <input type="text" name="size" value="{{ old('size') }}"
                       class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                       placeholder="e.g., S, M, L, 10">
            </div>
        </div>
        
        <div>
            <label class="block text-gray-700 font-medium">Price Adjustment (R)</label>
            <input type="number" step="0.01" name="price_adjustment" value="{{ old('price_adjustment', 0) }}"
                   class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]">
            <p class="text-sm text-gray-500 mt-1">
                Positive adds to base price (R{{ number_format($product['base_price'] ?? 0, 2) }}), negative subtracts.
            </p>
        </div>
        
        <div>
            <label class="block text-gray-700 font-medium">Stock *</label>
            <input type="number" name="stock" value="{{ old('stock', 0) }}"
                   class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                   min="0" required>
        </div>
        
        <div class="pt-4">
            <button type="submit"
                    class="bg-[rgb(193,146,43)] text-black px-6 py-2 rounded hover:bg-black hover:text-white transition">
                Add Variant
            </button>
            <a href="{{ route('admin.products.edit', $product['id']) }}" 
               class="ml-3 text-gray-600 hover:underline">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection