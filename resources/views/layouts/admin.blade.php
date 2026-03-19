<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'BUGGXIT Admin') – Buggxit Couture</title>
    
    <!-- Preload critical assets -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style" crossorigin="anonymous">
    
    <!-- Tailwind via CDN (or use your local build) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Deferred Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" media="print" onload="this.media='all'" crossorigin="anonymous">
    
    @stack('styles')
</head>
<body class="bg-black text-white font-sans antialiased overflow-x-hidden">
    
    <!-- Fixed top gradient line (signature detail) -->
    <div class="fixed top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-yellow-500/30 to-transparent pointer-events-none z-50"></div>
    
    <!-- Glowing orbs (fixed background) -->
    <div class="fixed -top-40 -left-40 w-80 h-80 bg-yellow-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="fixed -bottom-40 -right-40 w-80 h-80 bg-yellow-500/3 rounded-full blur-3xl pointer-events-none"></div>
    
    <!-- ========== ADMIN NAVBAR ========== -->
    <nav x-data="{ mobileMenuOpen: false, userDropdownOpen: false }" 
         class="relative z-40 bg-black/90 backdrop-blur-sm border-b border-gray-800/50 w-full">
        
        <div class="container-wide px-4 sm:px-6 lg:px-8 mx-auto relative">
            <div class="flex items-center justify-between h-16">
                
                <!-- Logo + Brand -->
                <div class="flex items-center flex-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 group">
                        <div class="relative">
                            <div class="absolute inset-0 bg-yellow-500/20 rounded-full blur-md group-hover:bg-yellow-500/30 transition-all duration-300"></div>
                            <div class="relative p-2 bg-gradient-to-br from-gray-900 to-black border border-gray-800 rounded-full">
                                <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-white font-bold text-lg tracking-tight group-hover:text-yellow-500 transition-colors">
                            BUGGXIT<span class="text-yellow-500">.</span>admin
                        </span>
                    </a>
                </div>
                
                <!-- Desktop Navigation Links (admin sections) -->
                <div class="hidden md:flex items-center justify-center flex-1 space-x-1">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300
                              {{ request()->routeIs('admin.dashboard') 
                                 ? 'bg-yellow-500/10 text-yellow-500 border border-yellow-500/30' 
                                 : 'text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50' }}">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.dresses.index') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300
                              {{ request()->routeIs('admin.dresses.*') 
                                 ? 'bg-yellow-500/10 text-yellow-500 border border-yellow-500/30' 
                                 : 'text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50' }}">
                        <i class="fas fa-tshirt mr-2"></i>Dresses
                    </a>
                </div>
                
                <!-- Right: Admin User Dropdown -->
                <div class="flex items-center justify-end flex-1 space-x-2">
                    <!-- Admin User Dropdown (desktop) -->
                    <div class="hidden md:relative md:block" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 transition-all duration-300 group">
                            <div class="w-6 h-6 rounded-full bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center">
                                <span class="text-xs font-bold text-black">{{ substr(Auth::guard('admin')->user()->name ?? 'A', 0, 1) }}</span>
                            </div>
                            <span class="text-sm font-medium">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                            <svg class="w-4 h-4 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-48 bg-black/90 backdrop-blur-sm border border-gray-800 rounded-lg shadow-xl overflow-hidden z-50">
                            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-yellow-500/30 to-transparent"></div>
                            
                            <div class="px-4 py-3 border-b border-gray-800/50">
                                <p class="text-sm font-semibold text-white">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</p>
                                <p class="text-xs text-gray-400">{{ Auth::guard('admin')->user()->email ?? '' }}</p>
                            </div>
                            
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-sm text-gray-400 hover:text-red-400 hover:bg-red-900/20 transition-all duration-200 flex items-center">
                                    <i class="fas fa-sign-out-alt mr-3 w-4"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            class="md:hidden p-2 text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 rounded-lg transition-all duration-300">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 9h16.5M3.75 15h16.5" />
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-cloak 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="md:hidden border-t border-gray-800/50 bg-black/90 backdrop-blur-sm">
            <div class="container-wide px-4 py-3 space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   @click="mobileMenuOpen = false"
                   class="block px-4 py-3 rounded-lg text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 transition-all duration-200">
                    <i class="fas fa-tachometer-alt mr-3 w-5"></i> Dashboard
                </a>
                <a href="{{ route('admin.dresses.index') }}" 
                   @click="mobileMenuOpen = false"
                   class="block px-4 py-3 rounded-lg text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 transition-all duration-200">
                    <i class="fas fa-tshirt mr-3 w-5"></i> Dresses
                </a>
                <div class="border-t border-gray-800/50 my-2"></div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 rounded-lg text-gray-400 hover:text-red-400 hover:bg-red-900/20 transition-all duration-200">
                        <i class="fas fa-sign-out-alt mr-3 w-5"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
    
    <!-- ========== MAIN CONTENT ========== -->
    <main class="relative z-10 container-wide px-4 sm:px-6 lg:px-8 py-8 mx-auto min-h-[calc(100vh-64px)]">
        
        <!-- Page Header (can be overridden) -->
        @hasSection('page-header')
            <div class="mb-8">
                @yield('page-header')
            </div>
        @else
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">
                        @yield('page-title', 'Admin Dashboard')
                    </h1>
                    <p class="text-gray-400 text-sm mt-1">
                        @yield('page-description', 'Manage your BUGGXIT Couture collection')
                    </p>
                </div>
                @yield('header-actions')
            </div>
        @endif
        
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 rounded-lg flex items-center">
                <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                <span class="text-green-400 text-sm">{{ session('success') }}</span>
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-lg flex items-center">
                <svg class="w-5 h-5 text-red-400 mr-3" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                </svg>
                <span class="text-red-400 text-sm">{{ session('error') }}</span>
            </div>
        @endif
        
        <!-- Yield Content -->
        @yield('content')
    </main>
    
    <!-- ========== ADMIN FOOTER (simplified, consistent with login page footer style) ========== -->
    <footer class="relative bg-black/90 backdrop-blur-sm border-t border-gray-800/50 w-full mt-auto">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-yellow-500/30 to-transparent pointer-events-none"></div>
        
        <div class="container-wide px-4 sm:px-6 lg:px-8 py-6 mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-gray-400 text-xs">
                    &copy; {{ date('Y') }} <span class="text-yellow-500 font-semibold">Buggxit Couture</span>. All rights reserved.
                </p>
                <div class="flex items-center space-x-4 text-xs text-gray-500">
                    <span>Admin Portal v1.0</span>
                    <span class="text-gray-700">•</span>
                    <span>Session timeout: 30 min</span>
                </div>
                <div class="text-gray-400 text-xs">
                    Crafted by 
                    <img src="{{ asset('watermarks/watermark22.webp') }}" alt="Watermark" class="inline-block h-3 w-auto mx-1 align-middle">
                    <a href="https://linkedin.com/in/nkosi2k" class="text-yellow-500 hover:text-yellow-400 transition-colors" target="_blank">
                        Nkosi
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Return to top button -->
    <button 
        onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed bottom-6 right-6 p-3 bg-black/80 backdrop-blur-sm border border-gray-800 rounded-full text-gray-400 hover:text-yellow-500 hover:border-yellow-500 transition-all duration-300 z-50 shadow-lg group">
        <i class="fas fa-arrow-up text-lg group-hover:-translate-y-1 transition-transform duration-300"></i>
    </button>
    
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Inline styles for consistency -->
    <style>
        [x-cloak] { display: none !important; }
        .container-wide {
            max-width: 90rem; /* 1440px */
            width: 100%;
        }
        /* Smooth backdrop blur fallback */
        @supports not (backdrop-filter: blur(10px)) {
            .backdrop-blur-sm {
                background-color: rgba(10, 10, 10, 0.95);
            }
        }
    </style>
    
    @stack('scripts')
</body>
</html>