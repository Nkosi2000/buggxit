<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gray-100 font-sans">

    <!-- Header -->
    <header class="bg-black text-[rgb(193,146,43)] px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <span class="uppercase font-bold">Admin Panel</span>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button class="bg-[rgb(193,146,43)] text-black px-4 py-2 rounded hover:bg-black hover:text-white transition">
                Logout
            </button>
        </form>
    </header>

    <!-- Sidebar + Main Content -->
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white min-h-screen p-6">
            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-3 py-2 rounded hover:bg-[rgb(193,146,43)] hover:text-black transition">
                    🏠 Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="block px-3 py-2 rounded hover:bg-[rgb(193,146,43)] hover:text-black transition">
                    👕 Products
                </a>
                <a href="{{ route('admin.discounts.index') }}"
                   class="block px-3 py-2 rounded hover:bg-[rgb(193,146,43)] hover:text-black transition">
                    🎟️ Discounts
                </a>
                <a href="{{ route('admin.reports.index') }}"
                   class="block px-3 py-2 rounded hover:bg-[rgb(193,146,43)] hover:text-black transition">
                    📊 Reports
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>