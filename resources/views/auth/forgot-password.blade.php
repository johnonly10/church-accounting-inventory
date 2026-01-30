@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('hero-text')
    <p class="text-white text-lg italic leading-relaxed">
        "Cast your burden on the Lord, and he will sustain you."
    </p>
    <p class="text-white/80 text-sm">— Psalm 55:22</p>
@endsection

@section('content')
    <div class="text-center mb-8">
        <h1 class="title font-bold text-gray-900">Reset your password</h1>
        <p class="sub text-gray-600 mt-2">Enter your email and we'll send you instructions to reset your password.</p>
    </div>

    @if (session('status'))
        <div class="mb-5 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-800 ring-1 ring-emerald-100">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <!-- Email input -->
        <div>
            <label class="block text-sm font-semibold text-gray-800 mb-2">Email address</label>
            <input name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                class="focus-ring input w-full rounded-xl border-2 border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 placeholder:text-gray-400"
                placeholder="you@example.com">
            @error('email')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit button -->
        <button type="submit"
            class="btn w-full rounded-xl bg-gradient-to-r from-blue-600 to-violet-600 px-4 py-3 text-sm font-bold text-white">
            Send reset link
        </button>

        <!-- Back to login link -->
        <div class="pt-2 text-center text-sm text-gray-600">
            Remember your password?
            <a href="{{ route('login') }}" class="font-semibold text-indigo-700 hover:text-indigo-800">
                Back to login
            </a>
        </div>
    </form>

    <div class="mt-8 text-center text-xs text-gray-500 leading-relaxed">
        <p class="mb-1">You should receive an email within a few minutes.</p>
        <p>Check your spam folder if you don't see it in your inbox.</p>
    </div>
@endsection
