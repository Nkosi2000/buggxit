<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <title>Buggxit Couture Est.2018</title>
    @vite('resources/css/app.css')
    <!-- Onest Font -->
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-[WalkwayRounded] flex flex-col min-h-screen">

    <!-- Enhanced Header / Navigation - Optimized for Conversions -->
    <header x-data="{ open: false, scrolled: false }" 
            @scroll.window="scrolled = window.scrollY > 50"
            class="bg-black shadow-lg sticky top-0 z-50 transition-all duration-300"
            :class="scrolled ? 'py-2 bg-black/95 backdrop-blur-sm' : 'py-4'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">

                <!-- Logo -->
                <div class="flex-shrink-0 transform transition-transform duration-300 hover:scale-105">
                    <a href="/">
                        <img src="{{ asset('logo.png') }}" alt="Buggxit Couture Logo" class="h-12 w-auto object-contain">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex space-x-1 items-center">
                    <!-- Home -->
                    <a href="/"
                    class="uppercase relative px-4 py-2 text-[rgb(193,146,43)] hover:text-white font-medium 
                    transition-all duration-300 group
                    {{ request()->is('/') ? 'text-white font-semibold' : '' }}">
                        Home
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[rgb(193,146,43)] transition-all duration-300 group-hover:w-full"></span>
                        @if(request()->is('/'))
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[rgb(193,146,43)]"></span>
                        @endif
                    </a>

                    <!-- Shop Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="uppercase relative px-4 py-2 text-[rgb(193,146,43)] hover:text-white font-medium 
                                    transition-all duration-300 group flex items-center gap-1">
                            Shop
                            <svg class="w-4 h-4 transform transition-transform duration-300" 
                                :class="{ 'rotate-180': open }" 
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[rgb(193,146,43)] transition-all duration-300 group-hover:w-full"></span>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                            class="absolute left-0 mt-2 w-56 bg-black/95 backdrop-blur-sm border border-[rgb(193,146,43)]/30 rounded-lg shadow-2xl py-2 z-50">
                            <a href="/products" class="block px-4 py-3 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white transition-all duration-300">
                                All Products
                            </a>
                            <a href="/products?category=men" class="block px-4 py-3 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white transition-all duration-300">
                                Men's Collection
                            </a>
                            <a href="/products?category=women" class="block px-4 py-3 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white transition-all duration-300">
                                Women's Collection
                            </a>
                            <a href="/products?category=accessories" class="block px-4 py-3 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white transition-all duration-300">
                                Accessories
                            </a>
                            <a href="/products?category=new-arrivals" class="block px-4 py-3 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white transition-all duration-300">
                                New Arrivals
                            </a>
                            <a href="/products?category=sale" class="block px-4 py-3 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white transition-all duration-300">
                                Sale
                            </a>
                        </div>
                    </div>

                    <!-- Other Navigation Links -->
                    <a href="/about"
                    class="uppercase relative px-4 py-2 text-[rgb(193,146,43)] hover:text-white font-medium 
                    transition-all duration-300 group
                    {{ request()->is('about') ? 'text-white font-semibold' : '' }}">
                        About
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[rgb(193,146,43)] transition-all duration-300 group-hover:w-full"></span>
                        @if(request()->is('about'))
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[rgb(193,146,43)]"></span>
                        @endif
                    </a>

                    <a href="/collections"
                    class="uppercase relative px-4 py-2 text-[rgb(193,146,43)] hover:text-white font-medium 
                    transition-all duration-300 group
                    {{ request()->is('collections') ? 'text-white font-semibold' : '' }}">
                        Collections
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[rgb(193,146,43)] transition-all duration-300 group-hover:w-full"></span>
                        @if(request()->is('collections'))
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[rgb(193,146,43)]"></span>
                        @endif
                    </a>

                    <a href="/contact"
                    class="uppercase relative px-4 py-2 text-[rgb(193,146,43)] hover:text-white font-medium 
                    transition-all duration-300 group
                    {{ request()->is('contact') ? 'text-white font-semibold' : '' }}">
                        Contact
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[rgb(193,146,43)] transition-all duration-300 group-hover:w-full"></span>
                        @if(request()->is('contact'))
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[rgb(193,146,43)]"></span>
                        @endif
                    </a>
                </nav>

                <!-- User Actions & Cart - OPTIMIZED VERSION -->
                <div class="hidden lg:flex items-center space-x-3">
                    <!-- Search -->
                    <button class="text-[rgb(193,146,43)] hover:text-white transition-colors duration-300 p-2 rounded-full hover:bg-[rgb(193,146,43)]/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>

                    <!-- Wishlist -->
                    <button class="text-[rgb(193,146,43)] hover:text-white transition-colors duration-300 p-2 rounded-full hover:bg-[rgb(193,146,43)]/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>

                    <!-- Shopping Cart -->
                    <a href="/cart" class="relative text-[rgb(193,146,43)] hover:text-white transition-colors duration-300 p-2 rounded-full hover:bg-[rgb(193,146,43)]/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <!-- Cart Counter -->
                        <span class="absolute -top-1 -right-1 bg-[rgb(193,146,43)] text-black text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                            0
                        </span>
                    </a>

                    <!-- Account Dropdown (Replaces Login/Signup buttons) -->
                    <div class="relative" x-data="{ accountOpen: false }" @mouseenter="accountOpen = true" @mouseleave="accountOpen = false">
                        <button class="text-[rgb(193,146,43)] hover:text-white transition-colors duration-300 p-2 rounded-full hover:bg-[rgb(193,146,43)]/10">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </button>
                        
                        <!-- Account Dropdown Menu -->
                        <div x-show="accountOpen" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                            class="absolute right-0 mt-2 w-48 bg-black/95 backdrop-blur-sm border border-[rgb(193,146,43)]/30 rounded-lg shadow-2xl py-2 z-50">
                            <!-- For logged out users -->
                            <a href="/login" class="block px-4 py-3 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white transition-all duration-300 text-sm font-medium">
                                Sign In
                            </a>
                            <a href="/register" class="block px-4 py-3 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white transition-all duration-300 text-sm font-medium">
                                Create Account
                            </a>
                            <div class="border-t border-[rgb(193,146,43)]/20 my-1"></div>
                            <a href="/orders" class="block px-4 py-2 text-gray-400 hover:bg-[rgb(193,146,43)]/10 hover:text-white transition-all duration-300 text-sm">
                                Order History
                            </a>
                            <a href="/wishlist" class="block px-4 py-2 text-gray-400 hover:bg-[rgb(193,146,43)]/10 hover:text-white transition-all duration-300 text-sm">
                                Wishlist
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden flex items-center space-x-3">
                    <!-- Mobile Cart -->
                    <a href="/cart" class="relative text-[rgb(193,146,43)] p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="absolute -top-1 -right-1 bg-[rgb(193,146,43)] text-black text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                            0
                        </span>
                    </a>

                    <button @click="open = !open" class="text-[rgb(193,146,43)] focus:outline-none transition-transform duration-300 hover:scale-110 p-2">
                        <!-- Hamburger Icon -->
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <!-- X Icon -->
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-4"
            class="lg:hidden bg-black/95 backdrop-blur-sm shadow-lg rounded-b-2xl">

            <!-- Mobile Navigation Links -->
            <div class="px-4 pt-4 pb-2 space-y-1">
                <a href="/" class="block px-4 py-3 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white font-medium rounded-lg transition-all duration-300 {{ request()->is('/') ? 'bg-[rgb(193,146,43)]/20 text-white border-l-4 border-[rgb(193,146,43)]' : '' }}">
                    Home
                </a>

                <!-- Mobile Shop Accordion -->
                <div x-data="{ shopOpen: false }" class="border-b border-[rgb(193,146,43)]/20 pb-2">
                    <button @click="shopOpen = !shopOpen" class="w-full flex justify-between items-center px-4 py-3 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white font-medium rounded-lg transition-all duration-300">
                        <span>Shop</span>
                        <svg class="w-4 h-4 transform transition-transform duration-300" 
                            :class="{ 'rotate-180': shopOpen }" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div x-show="shopOpen" x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="mt-2 space-y-1 bg-black/50 rounded-lg p-2">
                        <a href="/products" class="block px-4 py-2 text-[rgb(193,146,43)]/80 hover:bg-[rgb(193,146,43)]/10 hover:text-white rounded transition-all duration-300">
                            All Products
                        </a>
                        <a href="/products?category=men" class="block px-4 py-2 text-[rgb(193,146,43)]/80 hover:bg-[rgb(193,146,43)]/10 hover:text-white rounded transition-all duration-300">
                            Men's Collection
                        </a>
                        <a href="/products?category=women" class="block px-4 py-2 text-[rgb(193,146,43)]/80 hover:bg-[rgb(193,146,43)]/10 hover:text-white rounded transition-all duration-300">
                            Women's Collection
                        </a>
                        <a href="/products?category=accessories" class="block px-4 py-2 text-[rgb(193,146,43)]/80 hover:bg-[rgb(193,146,43)]/10 hover:text-white rounded transition-all duration-300">
                            Accessories
                        </a>
                        <a href="/products?category=new-arrivals" class="block px-4 py-2 text-[rgb(193,146,43)]/80 hover:bg-[rgb(193,146,43)]/10 hover:text-white rounded transition-all duration-300">
                            New Arrivals
                        </a>
                        <a href="/products?category=sale" class="block px-4 py-2 text-[rgb(193,146,43)]/80 hover:bg-[rgb(193,146,43)]/10 hover:text-white rounded transition-all duration-300">
                            Sale Items
                        </a>
                    </div>
                </div>

                <a href="/about" class="block px-4 py-3 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white font-medium rounded-lg transition-all duration-300 {{ request()->is('about') ? 'bg-[rgb(193,146,43)]/20 text-white border-l-4 border-[rgb(193,146,43)]' : '' }}">
                    About
                </a>

                <a href="/collections" class="block px-4 py-3 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white font-medium rounded-lg transition-all duration-300 {{ request()->is('collections') ? 'bg-[rgb(193,146,43)]/20 text-white border-l-4 border-[rgb(193,146,43)]' : '' }}">
                    Collections
                </a>

                <a href="/contact" class="block px-4 py-3 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white font-medium rounded-lg transition-all duration-300 {{ request()->is('contact') ? 'bg-[rgb(193,146,43)]/20 text-white border-l-4 border-[rgb(193,146,43)]' : '' }}">
                    Contact
                </a>
            </div>

            <!-- Mobile Auth Buttons - Moved to bottom and less prominent -->
            <div class="px-4 pt-2 pb-6 border-t border-[rgb(193,146,43)]/30 space-y-2">
                <p class="text-gray-400 text-xs px-4 py-1">Account</p>
                <a href="/login" class="block px-4 py-2 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white font-medium rounded transition-all duration-300 text-sm">
                    Sign In
                </a>
                <a href="/register" class="block px-4 py-2 text-[rgb(193,146,43)] hover:bg-[rgb(193,146,43)]/10 hover:text-white font-medium rounded transition-all duration-300 text-sm">
                    Create Account
                </a>
            </div>
        </div>
    </header>

    <!-- Enhanced Hero Section -->
    <main class="flex-grow">
        <!-- Enhanced Hero Section with Smooth Counting -->
        <section class="relative bg-gradient-to-br from-black via-gray-900 to-[#1a1a1a] text-white py-20 lg:py-32 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23c1922b\" fill-opacity=\"0.4\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"1\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center"
                x-data="enhancedHeroAnimations()">
                
                <!-- Brand Badge - Slide from top -->
                <div class="inline-flex items-center gap-2 bg-[rgb(193,146,43)]/10 border border-[rgb(193,146,43)]/30 rounded-full px-4 py-2 mb-6 transform transition-all duration-1000 ease-out"
                    :class="animated ? 'translate-y-0 opacity-100' : '-translate-y-10 opacity-0'">
                    <span class="w-2 h-2 bg-[rgb(193,146,43)] rounded-full animate-pulse"></span>
                    <span class="text-[rgb(193,146,43)] text-sm font-medium uppercase tracking-wider">Est. 2018</span>
                </div>

                <!-- Main Heading - Staggered slide from left -->
                <h1 class="text-5xl lg:text-7xl font-bold mb-6 leading-tight overflow-hidden">
                    <span class="block transform transition-all duration-800 delay-300 ease-out"
                        :class="animated ? 'translate-x-0 opacity-100' : '-translate-x-full opacity-0'">
                        <span class="bg-gradient-to-r from-[rgb(193,146,43)] to-yellow-200 bg-clip-text text-transparent">
                            Buggxit
                        </span>
                    </span>
                    <span class="block transform transition-all duration-800 delay-500 ease-out"
                        :class="animated ? 'translate-x-0 opacity-100' : '-translate-x-full opacity-0'">
                        Couture
                    </span>
                </h1>
                
                <!-- Subtitle - Slide from right -->
                <p class="text-xl lg:text-2xl text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed transform transition-all duration-800 delay-700 ease-out"
                :class="animated ? 'translate-x-0 opacity-100' : 'translate-x-full opacity-0'">
                    Where luxury meets contemporary fashion. Discover exclusive collections crafted for the modern individual.
                </p>

                <!-- CTA Buttons - Staggered slide up -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-10">
                    <a href="/products" 
                    class="group relative bg-[rgb(193,146,43)] text-black px-8 py-4 rounded-lg font-bold uppercase tracking-wider transition-all duration-300 hover:scale-105 hover:bg-white shadow-2xl hover:shadow-2xl hover:shadow-[rgb(193,146,43)]/30 transform transition-all duration-800 delay-900 ease-out"
                    :class="animated ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                        <span class="relative z-10">Shop Collection</span>
                        <div class="absolute inset-0 bg-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                    
                    <a href="/about" 
                    class="group border-2 border-[rgb(193,146,43)] text-[rgb(193,146,43)] px-8 py-4 rounded-lg font-bold uppercase tracking-wider transition-all duration-300 hover:scale-105 hover:bg-[rgb(193,146,43)] hover:text-black transform transition-all duration-800 delay-1000 ease-out"
                    :class="animated ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                        Our Story
                    </a>
                </div>

                <!-- Enhanced Stats with Smooth Counting -->
                <div class="grid grid-cols-3 gap-8 mt-16 pt-8 border-t border-[rgb(193,146,43)]/20 max-w-2xl mx-auto transform transition-all duration-800 delay-1100 ease-out"
                    :class="animated ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                    
                    <!-- Years -->
                    <div class="text-center" x-data="counter(6, 1500, $root.animated)">
                        <div class="text-3xl lg:text-4xl font-bold text-[rgb(193,146,43)] mb-2" x-text="number + '+'"></div>
                        <div class="text-gray-400 uppercase text-sm tracking-wider">Years</div>
                    </div>

                    <!-- Designs -->
                    <div class="text-center" x-data="counter(500, 1800, $root.animated)">
                        <div class="text-3xl lg:text-4xl font-bold text-[rgb(193,146,43)] mb-2" x-text="number + '+'"></div>
                        <div class="text-gray-400 uppercase text-sm tracking-wider">Designs</div>
                    </div>

                    <!-- Customers -->
                    <div class="text-center" x-data="counter(10000, 2000, $root.animated)">
                        <div class="text-3xl lg:text-4xl font-bold text-[rgb(193,146,43)] mb-2" x-text="number.toLocaleString() + '+'"></div>
                        <div class="text-gray-400 uppercase text-sm tracking-wider">Customers</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Categories Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Collections</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Discover our carefully curated collections that redefine modern luxury fashion</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Category 1 -->
                    <div class="group relative bg-black rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-105">
                        <div class="aspect-square bg-gradient-to-br from-[rgb(193,146,43)]/20 to-black"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">Luxury Wear</h3>
                            <p class="text-gray-300 mb-4">Premium collections for the discerning</p>
                            <a href="/products?category=luxury" 
                               class="inline-flex items-center text-[rgb(193,146,43)] font-semibold group-hover:underline">
                                Explore
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Category 2 -->
                    <div class="group relative bg-black rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-105">
                        <div class="aspect-square bg-gradient-to-br from-gray-800 to-[rgb(193,146,43)]/10"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">Street Style</h3>
                            <p class="text-gray-300 mb-4">Urban fashion with luxury touch</p>
                            <a href="/products?category=street" 
                               class="inline-flex items-center text-[rgb(193,146,43)] font-semibold group-hover:underline">
                                Explore
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Category 3 -->
                    <div class="group relative bg-black rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-105">
                        <div class="aspect-square bg-gradient-to-br from-[rgb(193,146,43)] to-yellow-200 opacity-20"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">Accessories</h3>
                            <p class="text-gray-300 mb-4">Complete your look with style</p>
                            <a href="/products?category=accessories" 
                               class="inline-flex items-center text-[rgb(193,146,43)] font-semibold group-hover:underline">
                                Explore
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

   <!-- Enhanced Footer -->
    <footer class="bg-black text-[rgb(193,146,43)] mt-auto">
        <div class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand Column -->
            <div class="md:col-span-1">
                <div class="flex items-center gap-3 mb-6">
                    <img src="{{ asset('logo.png') }}" alt="Buggxit Couture Logo" class="h-12 w-auto">
                    <div>
                        <div class="uppercase font-bold text-lg">Buggxit Couture</div>
                        <div class="text-sm text-gray-400">Est. 2018</div>
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">
                    Redefining luxury fashion with contemporary designs that celebrate individuality and style.
                </p>
                <!-- Social Links -->
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-[rgb(193,146,43)] transition-colors duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[rgb(193,146,43)] transition-colors duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="uppercase font-bold text-lg mb-6 text-white">Quick Links</h3>
                <ul class="space-y-3">
                    <li><a href="/about" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center gap-2 group">
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        About Us
                    </a></li>
                    <li><a href="/products" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center gap-2 group">
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        Shop
                    </a></li>
                    <li><a href="/contact" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center gap-2 group">
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        Contact
                    </a></li>
                    <li><a href="/faq" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center gap-2 group">
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        FAQ
                    </a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h3 class="uppercase font-bold text-lg mb-6 text-white">Customer Service</h3>
                <ul class="space-y-3 text-gray-400">
                    <li>Shipping & Returns</li>
                    <li>Size Guide</li>
                    <li>Care Instructions</li>
                    <li>Privacy Policy</li>
                    <li>Terms of Service</li>
                </ul>
            </div>

            <!-- Admin Access -->
            <div>
                <h3 class="uppercase font-bold text-lg mb-6 text-white">Admin Access</h3>
                <p class="text-gray-400 text-sm mb-4">Restricted area for authorized personnel only</p>
                <a href="/admin/login" 
                class="inline-flex items-center justify-center gap-2 bg-[rgb(193,146,43)] text-black px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 hover:bg-white shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.104-.896-2-2-2s-2 .896-2 2 .896 2 2 2 2-.896 2-2zm0 0c0 1.104.896 2 2 2s2-.896 2-2-.896-2-2-2-2 .896-2 2zm0 0v1m0 4h.01M6.938 4.938a9 9 0 1110.124 0A9 9 0 016.938 4.938z" />
                    </svg>
                    Admin Login
                </a>
            </div>
        </div>

        <!-- Development Credit - Added as a subtle, professional section -->
        <div class="border-t border-[rgb(193,146,43)]/20 py-6">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
                    <!-- Copyright -->
                    <div class="text-gray-400 text-sm">
                        &copy; 2018 - {{ date('Y') }} Buggxit Couture. All Rights Reserved.
                    </div>
                    
                    <!-- Development Credit with Enhanced Hover Effects -->
                    <a href="https://www.linkedin.com/in/nkosi2k/" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    class="flex items-center justify-center gap-3 text-gray-500 text-sm group transition-all duration-300 hover:-translate-y-0.5 cursor-pointer px-4 py-2 rounded-lg hover:bg-[rgb(193,146,43)]/5">
                        <span class="text-gray-400 transition-colors duration-300 group-hover:text-gray-300">
                            Crafted with excellence by
                        </span>
                        <div class="flex items-center gap-2 transition-all duration-300 group-hover:-translate-y-0.5">
                            <img src="{{ asset('watermarks/watermark.png') }}" 
                                alt="Nkosi Development Signature" 
                                class="h-5 w-auto opacity-70 group-hover:opacity-100 transition-all duration-300 group-hover:scale-110 group-hover:drop-shadow-lg">
                            <span class="text-[rgb(193,146,43)] font-medium group-hover:text-white transition-colors duration-300 group-hover:font-semibold">
                                Nkosi
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
    // Enhanced counter with easing function
    function counter(target, duration, shouldAnimate) {
        return {
            number: 0,
            init() {
                if (shouldAnimate) {
                    this.animateNumber(0, target, duration);
                }
            },
            animateNumber(start, end, duration) {
                const startTime = performance.now();
                const easeOutQuart = (t) => 1 - --t * t * t * t;
                
                const updateNumber = (currentTime) => {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const easedProgress = easeOutQuart(progress);
                    
                    this.number = Math.floor(start + (end - start) * easedProgress);
                    
                    if (progress < 1) {
                        requestAnimationFrame(updateNumber);
                    } else {
                        this.number = end; // Ensure we end exactly at the target
                    }
                };
                
                requestAnimationFrame(updateNumber);
            }
        }
    }

    function enhancedHeroAnimations() {
        return {
            animated: false,
            init() {
                // Use Intersection Observer to trigger animations
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            setTimeout(() => {
                                this.animated = true;
                            }, 200); // Small delay for better effect
                            observer.unobserve(entry.target);
                        }
                    });
                }, { 
                    threshold: 0.2,
                    rootMargin: '0px 0px -50px 0px'
                });
                
                observer.observe(this.$el);
            }
        }
    }
    </script>

</body>
</html>