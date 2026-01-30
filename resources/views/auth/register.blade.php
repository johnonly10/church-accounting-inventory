@extends('layouts.auth')

@section('title', 'Register')

@section('hero-text')
    <p class="text-white text-lg italic leading-relaxed">
        "For I know the plans I have for you, declares the Lord, plans to prosper you and not to harm you, plans to give you
        hope and a future."
    </p>
    <p class="text-white/80 text-sm">— Jeremiah 29:11</p>
@endsection

@section('content')
    <div class="text-center mb-8">
        <h1 class="title font-bold text-gray-900">Join Our Community</h1>
        <p class="sub text-gray-600 mt-2">Create your account to connect with our church family.</p>
    </div>

    @if (session('status'))
        <div class="mb-5 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-800 ring-1 ring-emerald-100">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}" class="space-y-5">
        @csrf

        <!-- Name input -->
        <div>
            <label class="block text-sm font-semibold text-gray-800 mb-2">Full Name</label>
            <input name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="focus-ring input w-full rounded-xl border-2 border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 placeholder:text-gray-400"
                placeholder="Your full name">
            @error('name')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email input -->
        <div>
            <label class="block text-sm font-semibold text-gray-800 mb-2">Email Address</label>
            <input name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                class="focus-ring input w-full rounded-xl border-2 border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 placeholder:text-gray-400"
                placeholder="you@example.com">
            @error('email')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password input -->
        <div>
            <label class="block text-sm font-semibold text-gray-800 mb-2">Password</label>
            <input name="password" type="password" required autocomplete="new-password"
                class="focus-ring input w-full rounded-xl border-2 border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 placeholder:text-gray-400"
                placeholder="••••••••">
            @error('password')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password input -->
        <div>
            <label class="block text-sm font-semibold text-gray-800 mb-2">Confirm Password</label>
            <input name="password_confirmation" type="password" required autocomplete="new-password"
                class="focus-ring input w-full rounded-xl border-2 border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 placeholder:text-gray-400"
                placeholder="••••••••">
        </div>

        <!-- Submit button -->
        <button type="submit"
            class="btn w-full rounded-xl bg-gradient-to-r from-blue-600 to-violet-600 px-4 py-3 text-sm font-bold text-white">
            Create Account
        </button>

        <!-- Login link -->
        <div class="pt-2 text-center text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="font-semibold text-indigo-700 hover:text-indigo-800">
                Sign in
            </a>
        </div>
    </form>

    <div class="mt-8 text-center text-xs text-gray-500 leading-relaxed">
        By creating an account, you agree to our church's community guidelines and privacy policy.
    </div>
@endsection
