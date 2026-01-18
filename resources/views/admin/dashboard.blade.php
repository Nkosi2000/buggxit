<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <title>Admin Dashboard — Buggxit Couture</title>
    @vite('resources/css/app.css')
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .variant-row {
            transition: all 0.3s ease;
        }
        .variant-row:hover {
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50 font-[WalkwayRounded]">

    <!-- Header -->
    <header class="bg-black text-[rgb(193,146,43)] px-6 py-4 shadow-lg">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('logo.png') }}" class="h-8" alt="Buggxit Logo">
                <span class="uppercase font-semibold tracking-wide">Admin Dashboard</span>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button class="bg-[rgb(193,146,43)] text-black px-4 py-2 rounded hover:bg-black hover:text-white transition font-semibold">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto p-6 space-y-8">

        <!-- Welcome Section -->
        <section class="fade-in">
            <h1 class="text-3xl font-bold uppercase text-[rgb(193,146,43)]">Welcome, Admin</h1>
            <p class="mt-2 text-gray-600">Manage your store efficiently with real-time insights and tools.</p>
        </section>

        <!-- Enhanced Stats Section -->
        <section class="grid grid-cols-1 md:grid-cols-4 gap-6 fade-in">
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</h3>
                        <p class="text-gray-600 text-sm">Total Products</p>
                    </div>
                    <img src="{{ asset('icons/stock.png') }}" class="h-8 opacity-80" alt="Products">
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalStock }}</h3>
                        <p class="text-gray-600 text-sm">Total Stock</p>
                    </div>
                    <img src="{{ asset('icons/total.png') }}" class="h-8 opacity-80" alt="Stock">
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-purple-500 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">R{{ number_format($totalValue, 2) }}</h3>
                        <p class="text-gray-600 text-sm">Inventory Value</p>
                    </div>
                    <img src="{{ asset('icons/value.png') }}" class="h-8 opacity-80" alt="Value">
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-orange-500 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $productsWithVariants }}</h3>
                        <p class="text-gray-600 text-sm">With Variants</p>
                    </div>
                    <img src="{{ asset('icons/variants.png') }}" class="h-8 opacity-80" alt="Variants">
                </div>
            </div>
        </section>

        <!-- Quick Actions -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 fade-in">
            <a href="{{ route('admin.products.create') }}" class="group bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg hover:border-[rgb(193,146,43)] transition-all flex items-center justify-center gap-3 font-semibold text-gray-700 hover:text-[rgb(193,146,43)]">
                <img src="{{ asset('icons/add.png') }}" class="h-6 w-6 group-hover:scale-110 transition-transform" alt="Add Product">
                <span>Add New Product</span>
            </a>
            <a href="{{ route('admin.discounts.index') }}" class="group bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg hover:border-[rgb(193,146,43)] transition-all flex items-center justify-center gap-3 font-semibold text-gray-700 hover:text-[rgb(193,146,43)]">
                <img src="{{ asset('icons/discounts.png') }}" class="h-6 w-6 group-hover:scale-110 transition-transform" alt="Discounts">
                <span>Manage Discounts</span>
            </a>
            <a href="{{ route('admin.reports.index') }}" class="group bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg hover:border-[rgb(193,146,43)] transition-all flex items-center justify-center gap-3 font-semibold text-gray-700 hover:text-[rgb(193,146,43)]">
                <img src="{{ asset('icons/reports.png') }}" class="h-6 w-6 group-hover:scale-110 transition-transform" alt="Reports">
                <span>View Reports</span>
            </a>
        </section>

        <!-- Product Inventory Section -->
        <section class="bg-white rounded-lg shadow-md overflow-hidden fade-in">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-3">
                    <img src="{{ asset('icons/products.png') }}" class="h-6" alt="Inventory">
                    Product Inventory
                    <span class="text-sm text-gray-500 font-normal">({{ $totalProducts }} products)</span>
                </h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($products as $product)
                            <tr class="variant-row hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $product['name'] }}</div>
                                            <div class="text-sm text-gray-500">ID: {{ $product['id'] }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $product['category'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $product['calculated_stock'] }}</div>
                                    @if($product['has_variants'])
                                        <div class="text-xs text-gray-500">{{ count($product['variants']) }} variants</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $product['price_display'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($product['calculated_stock'] > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            In Stock
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Out of Stock
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.products.edit', $product['id']) }}" 
                                           class="text-[rgb(193,146,43)] hover:text-black transition-colors">
                                            Edit
                                        </a>
                                        @if($product['has_variants'])
                                            <button type="button"
                                                    onclick="toggleVariants({{ $product['id'] }})"
                                                    id="toggle-btn-{{ $product['id'] }}"
                                                    class="text-blue-600 hover:text-blue-800 transition-colors">
                                                Show Variants
                                            </button>
                                        @else
                                            <span class="text-gray-400 text-xs">No variants</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- Variants Row -->
                            @if($product['has_variants'])
                                <tr id="variants-{{ $product['id'] }}" class="hidden bg-blue-50">
                                    <td colspan="6" class="px-6 py-4">
                                        <div class="ml-8">
                                            <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                                <span>📦 Product Variants ({{ count($product['variants']) }})</span>
                                            </h4>
                                            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                                                <table class="w-full text-sm">
                                                    <thead class="bg-gray-100">
                                                        <tr>
                                                            <th class="px-4 py-2 text-left font-medium text-gray-700">Variant ID</th>
                                                            <th class="px-4 py-2 text-left font-medium text-gray-700">SKU</th>
                                                            <th class="px-4 py-2 text-left font-medium text-gray-700">Color/Size</th>
                                                            <th class="px-4 py-2 text-left font-medium text-gray-700">Stock</th>
                                                            <th class="px-4 py-2 text-left font-medium text-gray-700">Price</th>
                                                            <th class="px-4 py-2 text-left font-medium text-gray-700">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-200">
                                                        @foreach ($product['variants'] as $variant)
                                                            <tr class="hover:bg-gray-50">
                                                                <td class="px-4 py-2 font-mono text-xs text-gray-600">#{{ $variant['id'] }}</td>
                                                                <td class="px-4 py-2 font-medium">{{ $variant['sku'] ?? '—' }}</td>
                                                                <td class="px-4 py-2">
                                                                    <span class="inline-flex items-center gap-1">
                                                                        @if($variant['color'] ?? false)
                                                                            <span class="w-3 h-3 rounded-full border border-gray-300" style="background-color: {{ $variant['color'] }}"></span>
                                                                        @endif
                                                                        {{ $variant['color'] ?? '—' }} / {{ $variant['size'] ?? '—' }}
                                                                    </span>
                                                                </td>
                                                                <td class="px-4 py-2">
                                                                    <span class="font-medium {{ $variant['stock'] > 0 ? 'text-green-600' : 'text-red-600' }}">
                                                                        {{ $variant['stock'] ?? 0 }}
                                                                    </span>
                                                                </td>
                                                                <td class="px-4 py-2 font-medium">
                                                                    R{{ number_format($variant['price'] ?? 0, 2) }}
                                                                </td>
                                                                <td class="px-4 py-2">
                                                                    @if(($variant['stock'] ?? 0) > 0)
                                                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-green-100 text-green-800">
                                                                            Available
                                                                        </span>
                                                                    @else
                                                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-red-100 text-red-800">
                                                                            Out of Stock
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <img src="{{ asset('icons/empty.png') }}" class="h-12 w-12 opacity-50 mb-2" alt="Empty">
                                        <p>No products found. Start by adding your first product!</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Recent Activity Section -->
        <section class="bg-white rounded-lg shadow-md overflow-hidden fade-in">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-3">
                    <img src="{{ asset('icons/activity.png') }}" class="h-6" alt="Activity">
                    Recent Activity
                </h2>
            </div>
            <div class="p-6">
                <div class="text-center text-gray-500 py-8">
                    <img src="{{ asset('icons/orders.png') }}" class="h-12 w-12 opacity-50 mx-auto mb-2" alt="Orders">
                    <p>No recent activity to display</p>
                    <p class="text-sm">Orders and updates will appear here</p>
                </div>
            </div>
        </section>

    </main>

    <!-- JavaScript -->
    <script>
        function toggleVariants(productId) {
            const section = document.getElementById(`variants-${productId}`);
            const button = document.getElementById(`toggle-btn-${productId}`);

            if (!section || !button) return;

            if (section.classList.contains('hidden')) {
                section.classList.remove('hidden');
                button.textContent = 'Hide Variants';
                button.classList.remove('text-blue-600');
                button.classList.add('text-blue-800', 'font-semibold');
            } else {
                section.classList.add('hidden');
                button.textContent = 'Show Variants';
                button.classList.remove('text-blue-800', 'font-semibold');
                button.classList.add('text-blue-600');
            }
        }

        // Add smooth scrolling to variants
        function scrollToVariants(productId) {
            const section = document.getElementById(`variants-${productId}`);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }
    </script>
</body>
</html>