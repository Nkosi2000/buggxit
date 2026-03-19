<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="BUGGXIT Couture - Est 2018">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon/Logo for browser tab -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.webp') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('logo.webp') }}">

    <title>{{ config('app.name', 'Buggxit Couture Est 2018') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    
    <!-- Alpine.js from Breeze -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Custom Styles for Consistent Theme -->
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
            padding-top: 64px; /* Navigation height */
            width: 100%;
            max-width: 100%;
        }
        
        /* Footer stays at bottom */
        .footer-wrapper {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
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
        
        /* Wider container */
        .container-wide {
            max-width: 90rem; /* 1440px */
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        /* Prevent horizontal overflow */
        * {
            box-sizing: border-box;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Page wrapper for sticky footer -->
    <div class="page-wrapper">
        <!-- Breeze-structured navigation with BUGGXIT design -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @hasSection('header')
            <header class="bg-gradient-to-r from-gray-900 to-black border-b border-yellow-900/30 w-full">
                <div class="container-wide py-8">
                    @yield('header')
                </div>
            </header>
        @endif

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