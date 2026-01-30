@extends('layouts.auth')

@section('title', 'Login')

@section('hero-text')
    <p class="text-white text-lg italic leading-relaxed">
        “The Lord is my shepherd; I shall not want.”
    </p>
    <p class="text-white/80 text-sm">— Psalm 23:1</p>
@endsection

@section('content')
    <div class="text-center mb-8">
        <h1 class="title font-bold text-gray-900">Sign in</h1>
        <p class="sub text-gray-600 mt-2">Welcome back — we’re glad you’re here.</p>
    </div>

    @if (session('status'))
        <div class="mb-5 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-800 ring-1 ring-emerald-100">
            {{ session('status') }}
        </div>
    @endif

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
