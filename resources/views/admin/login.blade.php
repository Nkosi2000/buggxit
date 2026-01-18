<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <title>Admin Login — Buggxit Couture</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-[#1a1a1a] font-[WalkwayRounded] flex items-center justify-center p-4">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23c1922b\" fill-opacity=\"0.4\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"1\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <!-- Security Badge -->
    <div class="absolute top-6 right-6 flex items-center gap-2 text-[rgb(193,146,43)]/70 text-sm">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
        </svg>
        <span>Secure Access</span>
    </div>

    <div class="w-full max-w-md">
        <!-- Login Card -->
        <div class="bg-black/80 backdrop-blur-lg border border-[rgb(193,146,43)]/30 rounded-2xl shadow-2xl overflow-hidden">
            
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-[rgb(193,146,43)]/10 to-transparent p-6 border-b border-[rgb(193,146,43)]/20">
                <div class="text-center">
                    <div class="flex justify-center items-center gap-3 mb-4">
                        <img src="{{ asset('logo.png') }}" alt="Buggxit Couture" class="h-10 w-auto">
                        <div class="h-8 w-px bg-[rgb(193,146,43)]/40"></div>
                        <div class="text-left">
                            <h1 class="text-xl font-bold text-white uppercase tracking-wider">Admin Portal</h1>
                            <p class="text-[rgb(193,146,43)] text-sm">Restricted Access</p>
                        </div>
                    </div>
                    <div class="inline-flex items-center gap-2 bg-[rgb(193,146,43)]/10 border border-[rgb(193,146,43)]/30 rounded-full px-4 py-1">
                        <span class="w-2 h-2 bg-[rgb(193,146,43)] rounded-full animate-pulse"></span>
                        <span class="text-[rgb(193,146,43)] text-xs font-medium uppercase tracking-wider">Authentication Required</span>
                    </div>
                </div>
            </div>

            <!-- Success Messages -->
            @if (session('success'))
                <div class="mx-6 mt-6 p-4 bg-green-500/10 border border-green-500/30 rounded-lg">
                    <div class="flex items-center gap-2 text-green-400 text-sm">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mx-6 mt-6 p-4 bg-red-500/10 border border-red-500/30 rounded-lg">
                    <div class="flex items-center gap-2 text-red-400 text-sm">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('admin.login.post') }}" class="p-6 space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div class="space-y-2">
                    <label class="block text-[rgb(193,146,43)] text-sm font-medium uppercase tracking-wider">Email Address</label>
                    <div class="relative">
                        <input type="email" 
                               name="email" 
                               required
                               value="{{ old('email') }}"
                               placeholder="admin@buggxit.com"
                               class="w-full bg-black/50 border border-[rgb(193,146,43)]/30 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[rgb(193,146,43)] focus:border-transparent transition-all duration-300">
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <svg class="w-5 h-5 text-[rgb(193,146,43)]/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <label class="block text-[rgb(193,146,43)] text-sm font-medium uppercase tracking-wider">Password</label>
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               required
                               placeholder="••••••••"
                               class="w-full bg-black/50 border border-[rgb(193,146,43)]/30 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[rgb(193,146,43)] focus:border-transparent transition-all duration-300">
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <svg class="w-5 h-5 text-[rgb(193,146,43)]/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center text-gray-400 text-sm hover:text-white transition-colors duration-300 cursor-pointer">
                        <input type="checkbox" name="remember" class="mr-2 rounded border-[rgb(193,146,43)]/30 bg-black/50 text-[rgb(193,146,43)] focus:ring-[rgb(193,146,43)]"> 
                        Remember me
                    </label>
                    <a href="{{ route('admin.password.request') }}" 
                       class="text-sm text-[rgb(193,146,43)] hover:text-white transition-colors duration-300 flex items-center gap-1 group">
                        <span>Forgot password?</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-gradient-to-r from-[rgb(193,146,43)] to-yellow-600 text-black py-3 rounded-lg font-bold uppercase tracking-wider hover:from-white hover:to-gray-300 transform transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                    Access Dashboard
                </button>
            </form>

            <!-- Footer Note -->
            <div class="px-6 pb-6 pt-4 border-t border-[rgb(193,146,43)]/20">
                <div class="text-center">
                    <p class="text-gray-500 text-xs flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Authorized personnel only. All activities are monitored.
                    </p>
                </div>
            </div>
        </div>

        <!-- Back to Main Site - BUTTON STYLE -->
        {{-- <div class="text-center mt-6">
            <a href="{{ route('/') }}" 
            class="inline-flex items-center gap-2 bg-[rgb(193,146,43)] text-black hover:bg-white border border-[rgb(193,146,43)] px-6 py-3 rounded-lg font-semibold transition-all duration-300 text-sm group cursor-pointer hover:scale-105 hover:shadow-lg transform">
                <svg class="w-4 h-4 transform group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Return to Main Site
            </a>
        </div> --}}
    </div>
</body>
</html>