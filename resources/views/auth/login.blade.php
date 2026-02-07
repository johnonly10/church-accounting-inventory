@extends('layouts.auth')

@section('title', 'Login')

@section('hero-text')
    <p class="text-white text-lg italic leading-relaxed">
        "The Lord is my shepherd; I shall not want."
    </p>
    <p class="text-white/80 text-sm">— Psalm 23:1</p>
@endsection

@section('content')
    <div class="text-center mb-8">
        <h1 class="title font-bold text-gray-900">Sign in</h1>
        <p class="sub text-gray-600 mt-2">Welcome back — we're glad you're here.</p>
    </div>

    @if (session('status'))
        <div class="mb-5 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-800 ring-1 ring-emerald-100">
            {{ session('status') }}
        </div>
    @endif

    <!-- Google Sign-In Button -->
    <div class="mb-6">
        <a href="{{ route('login.google') }}"
            class="flex items-center justify-center w-full rounded-xl border-2 border-gray-300 bg-white px-4 py-3 text-sm font-semibold text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
            <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                <path fill="#4285F4"
                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                <path fill="#34A853"
                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                <path fill="#FBBC05"
                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                <path fill="#EA4335"
                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
            </svg>
            Sign in with Google
        </a>
        @error('google')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <!-- Divider -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-white text-gray-500">Or continue with email</span>
        </div>
    </div>

    <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
        @csrf

        <!-- Email input -->
        <div>
            <label class="block text-sm font-semibold text-gray-800 mb-2">Email</label>
            <input name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                class="focus-ring input w-full rounded-xl border-2 border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 placeholder:text-gray-400"
                placeholder="you@example.com">
            @error('email')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password input -->
        <div>
            <label class="block text-sm font-semibold text-gray-800 mb-2">Password</label>
            <input name="password" type="password" required autocomplete="current-password"
                class="focus-ring input w-full rounded-xl border-2 border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 placeholder:text-gray-400"
                placeholder="••••••••">
            @error('password')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember me checkbox -->
        <div class="flex items-center justify-between gap-3">
            <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" type="checkbox"
                    name="remember" {{ old('remember') ? 'checked' : '' }}>
                Remember me
            </label>

            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-indigo-700 hover:text-indigo-800">
                Forgot password?
            </a>
        </div>

        <!-- Submit button -->
        <button type="submit"
            class="btn w-full rounded-xl bg-gradient-to-r from-blue-600 to-violet-600 px-4 py-3 text-sm font-bold text-white">
            Sign in
        </button>

        <!-- Register link -->
        <div class="pt-2 text-center text-sm text-gray-600">
            New here?
            <a href="{{ route('register') }}" class="font-semibold text-indigo-700 hover:text-indigo-800">
                Create an account
            </a>
        </div>
    </form>

    <div class="mt-8 text-center text-xs text-gray-500 leading-relaxed">
        Need help? Please contact your church admin for access support.
    </div>
@endsection
