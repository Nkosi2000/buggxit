<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="BUGGXIT Couture - Admin Login">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon/Logo for browser tab -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('logo.png') }}">

    <title>Admin Login - BUGGXIT Couture</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js from Breeze -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Custom Styles for Admin Login -->
    <style>
        :root {
            --primary-bg: #0a0a0a;
            --secondary-bg: #111111;
            --accent-gold: #D4AF37;
            --accent-gold-light: #F4E4A6;
            --text-primary: #ffffff;
            --text-secondary: #d1d5db;
            --text-muted: #9ca3af;
            --border-dark: #1f2937;
        }
        
        html, body {
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
            position: relative;
        }
        
        body {
            font-family: 'Manrope', sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #111111 100%);
            color: var(--text-primary);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        /* Main content wrapper that pushes footer down */
        .page-wrapper {
            flex: 1 0 auto;
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 100%;
            position: relative;
            overflow-x: hidden;
        }
        
        .main-content {
            flex: 1 0 auto;
            width: 100%;
            max-width: 100%;
        }
        
        /* Footer stays at bottom */
        .footer-wrapper {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
        }
        
        /* Admin Login Header Banner (THE ONE YOU LIKED) */
        .admin-login-header {
            background: linear-gradient(to right, rgba(26, 26, 26, 0.95), rgba(17, 17, 17, 0.95));
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
            position: relative;
            padding: 2rem 0;
        }
        
        .admin-login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.3), transparent);
        }
        
        .admin-login-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.1), transparent);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--primary-bg);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--accent-gold);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-gold-light);
        }
        
        /* Prevent horizontal overflow */
        * {
            box-sizing: border-box;
        }
        
        /* Container */
        .container-wide {
            max-width: 90rem;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        /* Add a little glow to the header text */
        .header-glow {
            text-shadow: 0 0 10px rgba(212, 175, 55, 0.3);
        }
    </style>
</head>
<body class="antialiased">
    <!-- Page wrapper for sticky footer -->
    <div class="page-wrapper">
        <!-- NO NAVBAR - JUST THE ADMIN LOGIN HEADER BANNER -->
        <header class="admin-login-header">
            <div class="container-wide">
                <!-- THE BANNER DESIGN YOU LIKED -->
                <div class="flex flex-col items-center justify-center text-center">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 header-glow">
                        <span class="text-yellow-500">Admin</span> Portal Access
                    </h1>
                    <p class="text-gray-400 text-sm md:text-base">
                        Secure access to BUGGXIT admin dashboard
                    </p>
                    
                    <!-- Optional: Add a subtle decorative line -->
                    <div class="mt-4 w-24 h-px bg-gradient-to-r from-transparent via-yellow-500/50 to-transparent"></div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="main-content">
            @yield('content')
        </main>
        
        <!-- Footer - This will stick to bottom -->
        <div class="footer-wrapper">
            @include('layouts.footer')
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>