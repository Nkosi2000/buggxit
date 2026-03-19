<!-- resources/views/admin/login.blade.php -->
@extends('layouts.admin-auth')

@section('header')
    <div class="flex flex-col items-center justify-center text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2" style="will-change: transform; contain: layout;">
            <span class="text-yellow-500">Admin</span> Portal Access
        </h1>
        <p class="text-gray-400 text-sm md:text-base">
            Secure access to BUGGXIT admin dashboard
        </p>
    </div>
@endsection

@section('content')
<!-- Preload critical fonts -->
<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style" crossorigin="anonymous">
<link rel="preconnect" href="https://cdnjs.cloudflare.com/ajax/libs">

<div class="min-h-[calc(100vh-200px)] flex items-center justify-center px-4 py-8 relative overflow-hidden" style="contain: layout paint;">
    <!-- Simplified decorative elements - CSS only when needed -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true" style="contain: strict;">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-yellow-500/5 rounded-full blur-3xl" style="transform: translateZ(0);"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-yellow-500/3 rounded-full blur-3xl" style="transform: translateZ(0);"></div>
    </div>

    <!-- Decorative gradient line (simplified) -->
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-yellow-500/30 to-transparent pointer-events-none" style="transform: translateZ(0); contain: strict;" aria-hidden="true"></div>

    <div class="w-full max-w-md relative z-10" style="contain: layout style;">
        <!-- Card Container - Simplified shadow -->
        <div class="bg-black/90 backdrop-blur-sm border border-gray-800 rounded-xl shadow-lg overflow-hidden" style="transform: translateZ(0); will-change: transform;">
            <!-- Card Header -->
            <div class="px-8 pt-8 pb-6 text-center border-b border-gray-800/50 bg-gradient-to-b from-gray-900/20 to-transparent">
                <!-- Admin Icon with simplified glow -->
                <div class="relative inline-block mb-4" style="contain: layout paint;">
                    <div class="absolute inset-0 bg-yellow-500/20 rounded-full blur-md" style="transform: translateZ(0);"></div>
                    <div class="relative p-4 bg-gradient-to-br from-gray-900 to-black border border-gray-800 rounded-full">
                        <!-- Inline SVG icon for faster loading -->
                        <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                        </svg>
                    </div>
                </div>
                
                <h2 class="text-2xl font-bold text-white mb-2" style="will-change: transform;">Admin Dashboard</h2>
                <p class="text-sm text-gray-400">Enter your credentials to continue</p>
                
                <!-- Session status messages -->
                @if (session('status'))
                    <div class="mt-4 p-3 bg-green-500/10 border border-green-500/30 rounded-lg">
                        <p class="text-sm text-green-400">{{ session('status') }}</p>
                    </div>
                @endif
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('admin.login.post') }}" class="px-8 pt-8 pb-8">
                @csrf

                <!-- Email Input -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2 flex items-center">
                        <!-- SVG icon instead of Font Awesome -->
                        <svg class="w-4 h-4 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                        <span>Admin Email</span>
                    </label>
                    <div class="relative">
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="email"
                            class="w-full px-4 py-3 pl-12 bg-gray-800/50 border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-all duration-200"
                            placeholder="admin@buggxit.com"
                            style="transform: translateZ(0);"
                        >
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                            </svg>
                        </div>
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-400 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2 flex items-center">
                        <!-- SVG icon instead of Font Awesome -->
                        <svg class="w-4 h-4 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
                        </svg>
                        <span>Password</span>
                    </label>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            class="w-full px-4 py-3 pl-12 bg-gray-800/50 border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-all duration-200 pr-12"
                            placeholder="••••••••"
                            style="transform: translateZ(0);"
                        >
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2z"/>
                            </svg>
                        </div>
                        <!-- Password toggle button -->
                        <button type="button" 
                                onclick="togglePassword()" 
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-yellow-500 transition-colors duration-200"
                                aria-label="Toggle password visibility"
                                style="transform: translateZ(0);">
                            <svg id="toggleIcon" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-400 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-8">
                    <label class="flex items-center cursor-pointer group" for="remember">
                        <input type="checkbox" 
                            name="remember" 
                            id="remember"
                            class="sr-only"
                            {{ old('remember') || isset($remember_token) ? 'checked' : '' }}
                            autocomplete="off">
                        <div id="checkbox-visual" class="w-5 h-5 border border-gray-700 rounded-md bg-gray-800/50 group-hover:border-yellow-500 transition-colors duration-200 flex items-center justify-center mr-3">
                            <svg class="w-3 h-3 text-yellow-500 opacity-0 transition-opacity duration-200" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                        </div>
                        <span class="text-sm text-gray-400 group-hover:text-gray-300 transition-colors duration-200">
                            Remember me for 30 days
                        </span>
                    </label>
                    
                    <a href="{{ route('admin.password.request') }}" 
                    class="text-sm text-gray-400 hover:text-yellow-500 transition-colors duration-200 flex items-center group">
                        <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2z"/>
                        </svg>
                        Forgot password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full px-6 py-3.5 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-semibold rounded-lg hover:from-yellow-400 hover:to-yellow-500 transition-all duration-300 flex items-center justify-center group"
                        style="transform: translateZ(0); will-change: transform;">
                    <span class="mr-3">Sign In to Dashboard</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 17l5-5-5-5v10z"/>
                    </svg>
                </button>

                <!-- Error Alert -->
                @if($errors->any())
                    <div class="mt-6 p-4 bg-red-500/10 border border-red-500/30 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-400 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                            </svg>
                            <div>
                                <p class="text-sm text-red-400 font-medium">Authentication failed</p>
                                <p class="text-xs text-red-300 mt-1">Please check your credentials and try again.</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Back to store link -->
                <div class="mt-8 pt-6 border-t border-gray-800/50 text-center">
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center text-sm text-gray-400 hover:text-yellow-500 transition-colors duration-200 group">
                        <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                        </svg>
                        Return to BUGGXIT Store
                    </a>
                </div>
            </form>

            <!-- Security Note -->
            <div class="px-8 pb-6">
                <div class="bg-gray-900/30 border border-gray-800/50 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-yellow-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-300 font-medium mb-1">Restricted Access</p>
                            <p class="text-xs text-gray-400">This portal is for authorized BUGGXIT administrators only. Unauthorized access is prohibited.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Session Information -->
        <div class="mt-6 text-center">
            <div class="inline-flex items-center text-xs text-gray-500 bg-gray-900/50 border border-gray-800/50 rounded-full px-4 py-2">
                <svg class="w-4 h-4 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>
                    <path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                </svg>
                <span>Session timeout: 30 minutes</span>
                <span class="mx-2 text-gray-600">•</span>
                <svg class="w-4 h-4 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                </svg>
                <span>Admin Portal v1.0</span>
            </div>
        </div>
    </div>
</div>

<!-- Defer Font Awesome loading -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" media="print" onload="this.media='all'" crossorigin="anonymous">

<!-- Inline critical JavaScript -->
<script>
    // Password toggle functionality
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.innerHTML = '<path d="M12 6.5c2.76 0 5 2.24 5 5 0 .51-.1 1-.24 1.46l3.06 3.06c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l2.17 2.17c.47-.14.96-.24 1.47-.24zM2.71 3.16c-.39.39-.39 1.02 0 1.41l1.97 1.97C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.97-.3 4.31-.82l2.72 2.72c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L4.13 3.16c-.39-.39-1.03-.39-1.42 0zM12 16.5c-2.76 0-5-2.24-5-5 0-.77.18-1.5.49-2.14l1.57 1.57c-.03.18-.06.37-.06.57 0 1.66 1.34 3 3 3 .2 0 .38-.03.57-.07L14.14 16c-.64.32-1.37.5-2.14.5zm2.97-5.33c-.15-1.4-1.25-2.49-2.64-2.64l2.64 2.64z"/>';
        } else {
            passwordInput.type = 'password';
            toggleIcon.innerHTML = '<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>';
        }
    }

    // Handle checkbox styling
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('remember');
        const checkboxVisual = document.getElementById('checkbox-visual');
        const checkIcon = checkboxVisual.querySelector('svg');
        
        // Set initial state
        if (checkbox.checked) {
            checkIcon.style.opacity = '1';
            checkboxVisual.classList.add('border-yellow-500');
            checkboxVisual.style.backgroundColor = 'rgba(212, 175, 55, 0.1)';
        }
        
        // Update visual when checkbox changes
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                checkIcon.style.opacity = '1';
                checkboxVisual.classList.add('border-yellow-500');
                checkboxVisual.style.backgroundColor = 'rgba(212, 175, 55, 0.1)';
            } else {
                checkIcon.style.opacity = '0';
                checkboxVisual.classList.remove('border-yellow-500');
                checkboxVisual.style.backgroundColor = '';
            }
        });
        
        // Also update when clicking the visual checkbox
        checkboxVisual.addEventListener('click', function(e) {
            e.preventDefault();
            checkbox.checked = !checkbox.checked;
            checkbox.dispatchEvent(new Event('change'));
        });
        
        // Auto-focus email field
        const emailField = document.getElementById('email');
        if (emailField && !emailField.value) {
            setTimeout(() => emailField.focus(), 100);
        }
    });

    // Optimized form submission
    document.querySelector('form')?.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            const originalHTML = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<svg class="w-4 h-4 mr-2 animate-spin" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1a11 11 0 1 0 11 11A11 11 0 0 0 12 1zm0 19a8 8 0 1 1 8-8 8 8 0 0 1-8 8z" opacity=".25"/><path d="M10.14 1.16a11 11 0 0 0-9 8.94A1.59 1.59 0 0 0 2.46 12a1.59 1.59 0 0 0 1.65-1.3 8 8 0 0 1 6.66-6.61A1.42 1.42 0 0 0 12 2.69a1.57 1.57 0 0 0-1.86-1.53z"/></svg> Authenticating...';
            
            // Re-enable after timeout
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalHTML;
            }, 10000);
        }
    });
</script>

<style>
    /* Critical CSS only */
    #checkbox-visual {
        transition: border-color 200ms ease, background-color 200ms ease;
    }
    
    #checkbox-visual svg {
        transition: opacity 200ms ease;
    }
    
    /* Optimize animations */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 200ms;
    }
    
    /* Simplify shadow */
    .shadow-lg {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5), 
                    0 0 5px rgba(212, 175, 55, 0.1);
    }
    
    /* Optimize blur effects */
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
    }
    
    /* Optimize animations with will-change */
    * {
        backface-visibility: hidden;
    }
    
    /* Spinner animation */
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
@endsection