@extends('layouts.admin')
@section('content')

<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold uppercase text-[rgb(193,146,43)] mb-6">👕 Product Inventory</h1>

    {{-- Success message --}}
    @if (session('status'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
            {{ session('status') }}
        </div>
    @endif

    {{-- Search and Filter Section --}}
    <div class="mb-6 bg-white p-4 rounded shadow">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            {{-- Add Product button --}}
            <div>
                <a href="{{ route('admin.products.create') }}"
                   class="bg-[rgb(193,146,43)] text-black px-4 py-2 rounded hover:bg-black hover:text-white transition">
                    ➕ Add Product
                </a>
            </div>

            {{-- Search and Filter --}}
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                <div class="relative">
                    <input type="text" 
                           placeholder="Search by SKU or name..." 
                           class="border rounded p-2 pl-10 w-full md:w-64 focus:ring focus:ring-[rgb(193,146,43)]"
                           id="searchInput">
                    <svg class="absolute left-3 top-3 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                
                <select class="border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]" id="categoryFilter">
                    <option value="">All Categories</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Accessories">Accessories</option>
                    <option value="Footwear">Footwear</option>
                    <option value="Homeware">Homeware</option>
                    <option value="Other">Other</option>
                </select>

                <select class="border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]" id="stockFilter">
                    <option value="">All Stock Status</option>
                    <option value="in_stock">In Stock</option>
                    <option value="low_stock">Low Stock</option>
                    <option value="out_of_stock">Out of Stock</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Products table --}}
    <div class="bg-white p-6 rounded shadow">
        <table class="w-full table-auto text-left" id="productsTable">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">SKU</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Turnaround</th>
                    <th class="px-4 py-2">Stock</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                    @php
                        // Determine stock status
                        $stockStatus = 'out_of_stock';
                        $stockClass = 'bg-red-100 text-red-800';
                        $stockLabel = 'Out of Stock';
                        
                        if (isset($p['stock']) && $p['stock'] > 0) {
                            if ($p['stock'] > 20) {
                                $stockStatus = 'in_stock';
                                $stockClass = 'bg-green-100 text-green-800';
                                $stockLabel = 'In Stock';
                            } else {
                                $stockStatus = 'low_stock';
                                $stockClass = 'bg-yellow-100 text-yellow-800';
                                $stockLabel = 'Low Stock';
                            }
                        }
                    @endphp
                    
                    {{-- Product row --}}
                    <tr class="border-t product-row" 
                        data-category="{{ $p['category'] ?? '' }}"
                        data-stock-status="{{ $stockStatus }}"
                        data-sku="{{ $p['sku'] ?? '' }}"
                        data-name="{{ $p['name'] ?? '' }}">
                        <td class="px-4 py-2 font-semibold">{{ $p['id'] ?? '—' }}</td>
                        <td class="px-4 py-2 font-mono text-sm bg-gray-50 rounded">
                            {{ $p['sku'] ?? '—' }}
                        </td>
                        <td class="px-4 py-2">{{ $p['name'] ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $p['category'] ?? '—' }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                                {{ $p['turnaround_time'] ?? 5 }} days
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex flex-col gap-1">
                                <span class="px-2 py-1 rounded text-xs {{ $stockClass }} inline-block w-fit">
                                    {{ $stockLabel }}
                                </span>
                                @if(isset($p['stock']) && $p['stock'] >= 0)
                                    <span class="font-bold">{{ $p['stock'] }} units</span>
                                    @if(isset($p['variants_count']) || isset($p['variants']))
                                        <span class="text-sm text-gray-500">
                                            ({{ $p['variants_count'] ?? count($p['variants'] ?? []) }} variants)
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-2">{{ $p['price_display'] ?? '—' }}</td>
                        <td class="px-4 py-2 flex gap-3">
                            <a href="{{ route('admin.products.edit', $p['id']) }}"
                            class="text-[rgb(193,146,43)] hover:underline">Edit</a>
                            <button type="button"
                                    onclick="openDeleteModal('{{ $p['id'] }}', '{{ $p['name'] }}')"
                                    class="text-red-600 hover:underline">
                                Delete
                            </button>
                            
                            {{-- Add Variant button --}}
                            <a href="{{ route('admin.products.variants.create', $p['id']) }}"
                               class="text-blue-600 hover:underline">
                                Add Variant
                            </a>
                        </td>
                    </tr>

                    {{-- Variants rows (if any) --}}
                    @if(isset($p['variants']) && count($p['variants']) > 0)
                        @foreach ($p['variants'] as $variant)
                            @php
                                // Calculate final price for variant: base_price + price_adjustment
                                $basePrice = $p['base_price'] ?? 0;
                                $adjustment = $variant['price_adjustment'] ?? 0;
                                $finalPrice = $basePrice + $adjustment;
                                
                                // Variant stock status
                                $variantStockClass = 'bg-red-100 text-red-800';
                                if ($variant['stock'] > 10) {
                                    $variantStockClass = 'bg-green-100 text-green-800';
                                } elseif ($variant['stock'] > 0) {
                                    $variantStockClass = 'bg-yellow-100 text-yellow-800';
                                }
                            @endphp
                            <tr class="bg-gray-50 text-sm variant-row">
                                <td class="px-4 py-2 pl-8">↳</td>
                                <td class="px-4 py-2 pl-8">—</td>
                                <td class="px-4 py-2">
                                    {{ $variant['color'] ?? '—' }} / {{ $variant['size'] ?? '—' }}
                                </td>
                                <td class="px-4 py-2">—</td>
                                <td class="px-4 py-2">—</td>
                                <td class="px-4 py-2">
                                    <span class="px-2 py-1 rounded text-xs {{ $variantStockClass }}">
                                        {{ $variant['stock'] ?? 0 }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    @if($adjustment != 0)
                                        <span class="text-gray-500 text-xs">
                                            {{ $adjustment > 0 ? '+' : '' }}R{{ number_format($adjustment, 2) }}
                                        </span><br>
                                    @endif
                                    R{{ number_format($finalPrice, 2) }}
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('admin.products.edit', $p['id']) }}#variants"
                                       class="text-gray-500 hover:text-gray-700 text-xs">
                                        Edit in Product
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                            No products found. 
                            <a href="{{ route('admin.products.create') }}" class="text-[rgb(193,146,43)] hover:underline ml-1">
                                Create your first product
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow max-w-sm w-full">
        <h2 class="text-xl font-semibold mb-4 text-red-600">Confirm Delete</h2>
        <p id="deleteMessage" class="mb-4 text-gray-700">Are you sure you want to delete this product?</p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Script --}}
<script>
    function openDeleteModal(id, name) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteMessage').textContent =
            `Are you sure you want to delete "${name}"?`;
        document.getElementById('deleteForm').action =
            `/admin/products/${id}`;
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Search and Filter Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const stockFilter = document.getElementById('stockFilter');
        const productRows = document.querySelectorAll('.product-row');
        const variantRows = document.querySelectorAll('.variant-row');
        
        function filterProducts() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedCategory = categoryFilter.value;
            const selectedStock = stockFilter.value;
            
            productRows.forEach(row => {
                const category = row.getAttribute('data-category');
                const stockStatus = row.getAttribute('data-stock-status');
                const sku = row.getAttribute('data-sku').toLowerCase();
                const name = row.getAttribute('data-name').toLowerCase();
                
                let showRow = true;
                
                // Search filter
                if (searchTerm) {
                    if (!sku.includes(searchTerm) && !name.includes(searchTerm)) {
                        showRow = false;
                    }
                }
                
                // Category filter
                if (selectedCategory && category !== selectedCategory) {
                    showRow = false;
                }
                
                // Stock filter
                if (selectedStock && stockStatus !== selectedStock) {
                    showRow = false;
                }
                
                // Show/hide row
                if (showRow) {
                    row.style.display = '';
                    // Also show its variant rows
                    let nextRow = row.nextElementSibling;
                    while (nextRow && nextRow.classList.contains('variant-row')) {
                        nextRow.style.display = '';
                        nextRow = nextRow.nextElementSibling;
                    }
                } else {
                    row.style.display = 'none';
                    // Also hide its variant rows
                    let nextRow = row.nextElementSibling;
                    while (nextRow && nextRow.classList.contains('variant-row')) {
                        nextRow.style.display = 'none';
                        nextRow = nextRow.nextElementSibling;
                    }
                }
            });
        }
        
        // Add event listeners
        searchInput.addEventListener('input', filterProducts);
        categoryFilter.addEventListener('change', filterProducts);
        stockFilter.addEventListener('change', filterProducts);
        
        // Initialize filters from URL params (optional)
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('category')) {
            categoryFilter.value = urlParams.get('category');
            filterProducts();
        }
        if (urlParams.has('stock')) {
            stockFilter.value = urlParams.get('stock');
            filterProducts();
        }
        if (urlParams.has('search')) {
            searchInput.value = urlParams.get('search');
            filterProducts();
        }
    });
</script>

<style>
    .product-row, .variant-row {
        transition: all 0.3s ease;
    }
    
    .product-row:hover {
        background-color: #f9fafb;
    }
    
    .variant-row:hover {
        background-color: #f3f4f6;
    }
</style>
@endsection