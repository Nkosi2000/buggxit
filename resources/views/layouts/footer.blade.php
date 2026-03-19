<footer class="relative bg-black/90 backdrop-blur-sm border-t border-gray-800 w-full overflow-hidden">
    <!-- Decorative element -->
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-yellow-500/30 to-transparent"></div>
    
    <!-- Glowing orbs - fixed to prevent horizontal scroll -->
    <div class="absolute top-0 left-0 w-40 h-40 bg-yellow-500/5 rounded-full blur-3xl md:w-60 md:h-60 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-60 h-60 bg-yellow-500/3 rounded-full blur-3xl md:w-80 md:h-80 translate-x-1/2 translate-y-1/2"></div>
    
    <div class="container-wide py-12 relative z-10 w-full">
        <!-- Top section: 4 columns on desktop, 2 columns on tablet, 1 column on mobile -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10 w-full">
            <!-- Logo & Social -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('logo.webp') }}" alt="BUGGXIT Logo" class="h-12 w-auto drop-shadow-glow md:h-14">
                </div>                
                <div class="space-y-6">
                    <div class="flex flex-wrap gap-3">
                        <a href="#" class="p-2.5 bg-gray-800/50 rounded-full text-gray-400 hover:text-yellow-500 hover:bg-gray-800/80 transition-all duration-300 group">
                            <i class="fab fa-instagram text-lg group-hover:scale-110"></i>
                        </a>
                        <a href="#" class="p-2.5 bg-gray-800/50 rounded-full text-gray-400 hover:text-yellow-500 hover:bg-gray-800/80 transition-all duration-300 group">
                            <i class="fab fa-facebook text-lg group-hover:scale-110"></i>
                        </a>
                        <a href="#" class="p-2.5 bg-gray-800/50 rounded-full text-gray-400 hover:text-yellow-500 hover:bg-gray-800/80 transition-all duration-300 group">
                            <i class="fab fa-twitter text-lg group-hover:scale-110"></i>
                        </a>
                        <a href="#" class="p-2.5 bg-gray-800/50 rounded-full text-gray-400 hover:text-yellow-500 hover:bg-gray-800/80 transition-all duration-300 group">
                            <i class="fab fa-tiktok text-lg group-hover:scale-110"></i>
                        </a>
                    
                    </div>
                    
                    <!-- Admin Access Button -->
                    <a href="{{ route('admin.login') }}" class="inline-flex items-center px-4 py-2.5 text-sm border border-gray-700 rounded-full text-gray-400 hover:border-yellow-500 hover:text-yellow-500 hover:bg-yellow-500/10 transition-all duration-300 group">
                        <i class="fas fa-lock mr-2 group-hover:scale-110"></i> Admin Access
                    </a>
                </div>
            </div>
            
            <!-- Collections -->
            <div class="lg:col-span-1">
                <h3 class="text-white font-semibold mb-4 pb-2 border-b border-gray-800/50">Collections</h3>
                <ul class="space-y-3">
                   
                    <li>
                        <a href="{{ route('products.index') }}" class="flex items-center text-gray-400 hover:text-yellow-500 text-sm transition-all duration-300 group">
                            <i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 group-hover:text-yellow-500 transition-all duration-300"></i>
                            Products
                        </a>
                    </li>
                    
                   
                </ul>
            </div>
            
            <!-- Customer Service -->
            <div class="lg:col-span-1">
                <h3 class="text-white font-semibold mb-4 pb-2 border-b border-gray-800/50">Customer Service</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('contact') }}" class="flex items-center text-gray-400 hover:text-yellow-500 text-sm transition-all duration-300 group">
                            <i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 group-hover:text-yellow-500 transition-all duration-300"></i>
                            Contact
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('about') }}" class="flex items-center text-gray-400 hover:text-yellow-500 text-sm transition-all duration-300 group">
                            <i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 group-hover:text-yellow-500 transition-all duration-300"></i>
                            About
                        </a>
                    </li>
                    
                </ul>
            </div>
            
            <!-- Newsletter -->
            <div class="space-y-6 sm:col-span-2 lg:col-span-1">
                <div>
                    <h3 class="text-white font-semibold mb-4 pb-2 border-b border-gray-800/50">Stay Updated</h3>
                    <p class="text-gray-400 text-sm mb-4">Subscribe for exclusive offers and new collections.</p>
                </div>
                
                <form class="space-y-4">
                    <div class="relative">
                        <input 
                            type="email" 
                            placeholder="Your email address" 
                            class="w-full px-4 py-3 bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-full text-white text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-all duration-300 pl-12"
                        >
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <button 
                        type="submit" 
                        class="w-full px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-semibold rounded-full hover:from-yellow-400 hover:to-yellow-500 hover:shadow-lg hover:shadow-yellow-500/25 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0"
                    >
                        Subscribe
                    </button>
                </form>
                
                <!-- Payment Methods -->
                <div class="pt-6 mt-6 border-t border-gray-800/50">
                    <p class="text-gray-400 text-sm mb-3">Secure Payment Methods</p>
                    <div class="flex flex-wrap items-center gap-3 opacity-70">
                        <i class="fab fa-cc-visa text-2xl text-white"></i>
                        <i class="fab fa-cc-mastercard text-2xl text-white"></i>
                        <i class="fab fa-cc-amex text-2xl text-white"></i>
                        <i class="fab fa-cc-paypal text-2xl text-white"></i>
                        <i class="fab fa-cc-apple-pay text-2xl text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom section -->
        <div class="mt-12 pt-8 border-t border-gray-800/50">
            <!-- On mobile: Stack everything -->
            <!-- On desktop: Copyright left, Legal Links center, Creator Credit right (but moved left) -->
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <!-- Copyright - left on desktop -->
                <p class="text-gray-400 text-sm text-center md:text-left">
                    &copy; {{ date('Y') }} <span class="text-yellow-500 font-semibold">Buggxit Couture</span>. All rights reserved.
                </p>
                
                <!-- Legal Links - center on desktop -->
                <div class="flex items-center justify-center space-x-6">
                    <a href="#" class="text-gray-400 hover:text-yellow-500 text-sm transition-colors duration-300">
                        Privacy Policy
                    </a>
                    <a href="#" class="text-gray-400 hover:text-yellow-500 text-sm transition-colors duration-300">
                        Terms of Service
                    </a>
                    <a href="#" class="text-gray-400 hover:text-yellow-500 text-sm transition-colors duration-300">
                        Shipping Policy
                    </a>
                </div>
                
                <!-- Creator Credit with watermark - right on desktop but moved left -->
                <div class="text-gray-400 text-sm text-center md:text-right md:pr-12">
                    Crafted by
                    <img src="{{ asset('watermarks/watermark22.webp') }}" alt="Watermark" class="inline-block h-4 w-auto mx-1 align-middle">
                    <a href="https://linkedin.com/in/nkosi2k" class="text-yellow-500 hover:text-yellow-400 transition-colors duration-300 font-semibold" target="_blank">
                        Nkosi
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Return to top button - positioned to avoid overlap -->
    <button 
        onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed bottom-6 right-6 md:bottom-8 md:right-8 p-3 bg-black/80 backdrop-blur-sm border border-gray-800 rounded-full text-gray-400 hover:text-yellow-500 hover:border-yellow-500 transition-all duration-300 z-40 shadow-lg group"
    >
        <i class="fas fa-arrow-up text-lg group-hover:-translate-y-1 transition-transform duration-300"></i>
    </button>
</footer>

<style>
    @keyframes glow {
        0%, 100% { filter: drop-shadow(0 0 5px rgba(212, 175, 55, 0.5)); }
        50% { filter: drop-shadow(0 0 15px rgba(212, 175, 55, 0.8)); }
    }
    
    .drop-shadow-glow {
        animation: glow 2s ease-in-out infinite;
    }
    
    /* Smooth backdrop blur fallback */
    @supports not (backdrop-filter: blur(10px)) {
        .backdrop-blur-sm {
            background-color: rgba(10, 10, 10, 0.95);
        }
    }
    
    /* Wider container */
    .container-wide {
        max-width: 90rem; /* 1440px */
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .sm\:grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    
    @media (max-width: 480px) {
        .sm\:grid-cols-2 {
            grid-template-columns: 1fr;
        }
        
        .flex-wrap {
            justify-content: center;
        }
        
        .text-center {
            text-align: center !important;
        }
    }
</style>