<nav x-data="{ mobileMenuOpen: false, accountOpen: false }" 
     class="fixed z-50 w-full select-none top-0 bg-black/90 backdrop-blur-sm border-b border-gray-800">
    
    <!-- Decorative gradient line -->
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-yellow-500/30 to-transparent pointer-events-none"></div>
    
    <!-- Glowing orb - fixed with pointer-events-none -->
    <div class="absolute -top-10 left-1/4 w-40 h-40 bg-yellow-500/5 rounded-full blur-3xl pointer-events-none"></div>
    
    <div class="container-wide px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex items-center justify-between h-16">
            <!-- Left: Logo -->
            <div class="flex items-center flex-1">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('logo.webp') }}" alt="Buggxit logo" class="h-9 w-auto drop-shadow-glow">
                </a>
            </div>

            <!-- Center: Desktop Navigation Links -->
            <div class="hidden md:flex items-center justify-center flex-1 space-x-1 xl:space-x-2 relative z-20">
                @foreach([
                    ['route' => 'home', 'label' => 'Home'],
                    ['route' => 'products.index', 'label' => 'Products'],
                    ['route' => 'about', 'label' => 'About'],
                    ['route' => 'contact', 'label' => 'Contact'],
                ] as $item)
                    <a href="{{ route($item['route']) }}" 
                       class="px-3 py-2.5 text-sm font-medium whitespace-nowrap transition-all duration-300 relative z-30
                              {{ request()->routeIs($item['route']) 
                                ? 'text-yellow-500 hover:text-yellow-300 hover:bg-gray-800/50' 
                                : 'text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50' }}
                              rounded-lg">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            <!-- Right: Icons -->
            <div class="flex items-center justify-end flex-1 space-x-3 relative z-20">
                <!-- Search Icon -->
                <button class="p-2.5 text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 rounded-full transition-all duration-300 group">
                    <i class="fas fa-search text-lg group-hover:scale-110"></i>
                </button>
                
                <!-- Cart Icon -->
                <div class="relative">
                    <x-cart-icon :count="$cartCount ?? 0" 
                                size="md" 
                                class="p-2.5 text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 rounded-full transition-all duration-300 group" />
                </div>

                <!-- Desktop Account Dropdown -->
                <div class="hidden md:block relative" x-data="{ open: false }">
                    <button @click="open = !open" 
                            class="p-2.5 text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 transition-all duration-300 rounded-full group relative z-30">
                        <x-account-icon class="group-hover:scale-110 transition-transform duration-300" />
                    </button>

                    <!-- Dropdown Content -->
                    <div x-show="open" x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         @click.away="open = false"
                         class="absolute right-0 mt-2 w-56 rounded-lg shadow-xl bg-black/90 backdrop-blur-sm border border-gray-800 z-50 overflow-hidden">
                        <!-- Decorative gradient line -->
                        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-yellow-500/30 to-transparent pointer-events-none"></div>
                        
                        @auth
                            <div class="px-4 py-3 border-b border-gray-800/50 bg-gradient-to-r from-gray-900/50 to-black/50">
                                <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 transition-all duration-200 group">
                                <i class="fas fa-tachometer-alt mr-3 text-yellow-500 group-hover:scale-110 transition-transform duration-300"></i> Dashboard
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-sm text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 transition-all duration-200 group">
                                <i class="fas fa-user-edit mr-3 text-yellow-500 group-hover:scale-110 transition-transform duration-300"></i> Profile
                            </a>
                            <div class="border-t border-gray-800/50">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left">
                                        <div class="flex items-center px-4 py-3 text-sm text-gray-400 hover:bg-red-900/20 hover:text-red-400 transition-all duration-200 group">
                                            <i class="fas fa-sign-out-alt mr-3 group-hover:scale-110 transition-transform duration-300"></i> Log Out
                                        </div>
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="flex items-center px-4 py-3 text-sm text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 border-b border-gray-800/50 transition-all duration-200 group">
                                <i class="fas fa-sign-in-alt mr-3 text-yellow-500 group-hover:scale-110 transition-transform duration-300"></i> Sign In
                            </a>
                            <a href="{{ route('register') }}" class="flex items-center px-4 py-3 text-sm text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 transition-all duration-200 group">
                                <i class="fas fa-user-plus mr-3 text-yellow-500 group-hover:scale-110 transition-transform duration-300"></i> Register
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="md:hidden p-2.5 text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 rounded-full transition-all duration-300 relative z-30">
                    <!-- Hamburger Icon -->
                    <svg x-show="!mobileMenuOpen" x-cloak
                         class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 9h16.5M3.75 15h16.5" />
                    </svg>
                    <!-- Close Icon -->
                    <svg x-show="mobileMenuOpen" x-cloak
                         class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-cloak 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-black/90 backdrop-blur-sm border-t border-gray-800 relative z-40">
        <!-- Decorative gradient line -->
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-yellow-500/30 to-transparent pointer-events-none"></div>
        
        <!-- Mobile Menu Content with vertical scroll -->
        <div class="max-h-[70vh] overflow-y-auto overscroll-contain">
            <div class="px-4 py-3 space-y-1">
                <!-- Mobile Navigation Links -->
                @foreach([
                    ['route' => 'home', 'label' => 'Home', 'icon' => 'home'],
                    ['route' => 'products.index', 'label' => 'Products', 'icon' => 'shopping-bag'],
                    ['route' => 'about', 'label' => 'About Us', 'icon' => 'info-circle'],
                    ['route' => 'contact', 'label' => 'Contact Us', 'icon' => 'envelope'],
                ] as $item)
                    <a href="{{ route($item['route']) }}" 
                       @click="mobileMenuOpen = false"
                       class="flex items-center px-4 py-3 text-base font-medium rounded-lg transition-all duration-300 relative z-10
                              {{ request()->routeIs($item['route']) 
                                ? 'bg-gray-800/30 text-yellow-500 hover:text-yellow-300 hover:bg-gray-800/50' 
                                : 'text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50' }}">
                        <i class="fas fa-{{ $item['icon'] }} mr-3 w-5 text-center 
                           {{ request()->routeIs($item['route']) ? 'text-yellow-500' : '' }}"></i> 
                        {{ $item['label'] }}
                    </a>
                @endforeach

                <!-- Divider -->
                <div class="border-t border-gray-800/50 pt-3"></div>

                <!-- Mobile Cart -->
                <div class="px-4 py-3">
                    <x-cart-icon :count="$cartCount ?? 0" size="lg" showText="true" 
                                class="w-full justify-between text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 rounded-lg px-4 py-3 transition-all duration-300" />
                </div>

                <!-- Mobile Search -->
                <div class="px-4 py-3">
                    <div class="relative">
                        <input 
                            type="search" 
                            placeholder="Search products..." 
                            class="w-full px-4 py-3 bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-full text-white text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-all duration-300 pl-12"
                        >
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </div>

                <!-- Mobile Account Section -->
                <div class="border-t border-gray-800/50 pt-3">
                    <div x-data="{ accountOpen: false }">
                        <button @click="accountOpen = !accountOpen" 
                                class="w-full flex items-center justify-between py-3 px-4 text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 transition-all duration-300 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-user-circle mr-3 text-lg text-yellow-500"></i>
                                <span class="font-medium">Account</span>
                            </div>
                            <svg :class="accountOpen ? 'rotate-180' : ''" 
                                 class="w-5 h-5 text-gray-400 transition-transform duration-300" 
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="accountOpen" x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             class="mt-2 ml-11 mr-4 space-y-2 rounded-lg bg-black/90 backdrop-blur-sm border border-gray-800 p-3">
                            @auth
                                <div class="px-4 py-3 border-b border-gray-800/50 bg-gradient-to-r from-gray-900/50 to-black/50">
                                    <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('dashboard') }}" 
                                   @click="mobileMenuOpen = false; accountOpen = false"
                                   class="flex items-center py-3 text-sm text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 transition-all duration-200 group px-3 rounded-lg">
                                    <i class="fas fa-tachometer-alt mr-3 w-5 text-center group-hover:scale-110 transition-transform duration-300"></i> Dashboard
                                </a>
                                <a href="{{ route('profile.edit') }}" 
                                   @click="mobileMenuOpen = false; accountOpen = false"
                                   class="flex items-center py-3 text-sm text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 transition-all duration-200 group px-3 rounded-lg">
                                    <i class="fas fa-user-edit mr-3 w-5 text-center group-hover:scale-110 transition-transform duration-300"></i> Profile
                                </a>
                                <div class="border-t border-gray-800/50 pt-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left">
                                            <div class="flex items-center py-3 text-sm text-gray-400 hover:bg-red-900/20 hover:text-red-400 transition-all duration-200 group px-3 rounded-lg">
                                                <i class="fas fa-sign-out-alt mr-3 w-5 text-center group-hover:scale-110 transition-transform duration-300"></i> Log Out
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <a href="{{ route('login') }}" 
                                   @click="mobileMenuOpen = false; accountOpen = false"
                                   class="flex items-center py-3 text-sm text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 transition-all duration-200 group px-3 rounded-lg">
                                    <i class="fas fa-sign-in-alt mr-3 w-5 text-center text-yellow-500 group-hover:scale-110 transition-transform duration-300"></i> Sign In
                                </a>
                                <a href="{{ route('register') }}" 
                                   @click="mobileMenuOpen = false; accountOpen = false"
                                   class="flex items-center py-3 text-sm text-gray-400 hover:text-yellow-500 hover:bg-gray-800/50 transition-all duration-200 group px-3 rounded-lg">
                                    <i class="fas fa-user-plus mr-3 w-5 text-center text-yellow-500 group-hover:scale-110 transition-transform duration-300"></i> Register
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="sticky bottom-0 left-0 right-0 h-6 bg-gradient-to-t from-black/90 to-transparent pointer-events-none"></div>
    </div>
</nav>

<!-- Add padding to main content -->
<div class="h-16"></div>

<!-- Glow effect for logo -->
<style>
    @keyframes glow {
        0%, 100% { filter: drop-shadow(0 0 5px rgba(212, 175, 55, 0.5)); }
        50% { filter: drop-shadow(0 0 15px rgba(212, 175, 55, 0.8)); }
    }
    
    .drop-shadow-glow {
        animation: glow 2s ease-in-out infinite;
    }
    
    [x-cloak] { display: none !important; }
    
    /* Smooth backdrop blur fallback */
    @supports not (backdrop-filter: blur(10px)) {
        .backdrop-blur-sm {
            background-color: rgba(10, 10, 10, 0.95);
        }
    }
    
    /* Wider container for navigation */
    .container-wide {
        max-width: 90rem; /* 1440px */
        width: 100%;
        margin-left: auto;
        margin-right: auto;
    }
    
    /* Custom scrollbar for mobile menu */
    .overscroll-contain {
        overscroll-behavior: contain;
    }
    
    .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }
    
    .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 3px;
    }
    
    .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: rgba(212, 175, 55, 0.3);
        border-radius: 3px;
    }
    
    .max-h-\[70vh\]::-webkit-scrollbar-thumb:hover {
        background: rgba(212, 175, 55, 0.5);
    }
</style>