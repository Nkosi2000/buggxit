<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <title>Admin Password Reset — Buggxit Couture</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-black flex items-center justify-center font-[WalkwayRounded]">
    <div class="bg-white w-full max-w-md p-8 rounded-xl shadow-xl">
        <!-- Logo + Heading -->
        <div class="text-center mb-6">
            <img src="{{ asset('logo.png') }}" alt="Buggxit Couture" class="h-12 mx-auto mb-2">
            <h1 class="text-2xl font-bold uppercase text-[rgb(193,146,43)]">Password Reset</h1>
        </div>

        <!-- Status Message -->
        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm text-center font-medium">
                {{ session('status') }}
            </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Reset Form -->
        <form method="POST" action="{{ route('admin.password.email') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-[rgb(193,146,43)]">
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-[rgb(193,146,43)] text-black py-2 rounded-lg font-semibold hover:bg-black hover:text-white transition">
                Send Reset Link
            </button>
        </form>

        <!-- Back to Login -->
        <div class="mt-6 text-center">
            <a href="{{ route('admin.login') }}" class="text-sm text-[rgb(193,146,43)] hover:text-black transition">
                Back to Admin Login
            </a>
        </div>
    </div>
</body>
</html>