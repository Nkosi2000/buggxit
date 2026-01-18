<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <title>Reset Admin Password — Buggxit Couture</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-black flex items-center justify-center font-[WalkwayRounded]">
    <div class="bg-white w-full max-w-md p-8 rounded-xl shadow-xl">
        <!-- Logo + Heading -->
        <div class="text-center mb-6">
            <img src="{{ asset('logo.png') }}" alt="Buggxit Couture" class="h-12 mx-auto mb-2">
            <h1 class="text-2xl font-bold uppercase text-[rgb(193,146,43)]">Reset Password</h1>
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
        <form method="POST" action="{{ route('admin.password.update') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-[rgb(193,146,43)]">
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- New Password -->
            <div>
                <label for="password" class="block text-gray-700 mb-1">New Password</label>
                <input id="password" type="password" name="password" required
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-[rgb(193,146,43)]">
                @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-gray-700 mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-[rgb(193,146,43)]">
            </div>

            <!-- Submit -->
            <button type="submit"
                    class="w-full bg-[rgb(193,146,43)] text-black py-2 rounded-lg font-semibold hover:bg-black hover:text-white transition">
                Reset Password
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