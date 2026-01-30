@extends('layouts.auth')

@section('title', 'Reset Password')

@section('hero-text')
    <p class="text-white text-lg italic leading-relaxed">
        "I can do all things through Christ who strengthens me."
    </p>
    <p class="text-white/80 text-sm">— Philippians 4:13</p>
@endsection

@section('content')
    <div class="text-center mb-8">
        <h1 class="title font-bold text-gray-900">Set new password</h1>
        <p class="sub text-gray-600 mt-2">Create a new password for your account.</p>
    </div>

    @if ($errors->any())
        <div class="mb-5 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-800 ring-1 ring-red-100">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="mb-5 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-800 ring-1 ring-emerald-100">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">


        @if ($email ?? old('email'))
            <div>
                <label class="block text-sm font-semibold text-gray-800 mb-2">Email</label>
                <div class="rounded-xl border-2 border-gray-200 bg-gray-50 px-4 py-3 text-gray-700">
                    {{ $email ?? old('email') }}
                </div>
                @error('email')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>
        @endif

        <!-- Password input -->
        <div>
            <label class="block text-sm font-semibold text-gray-800 mb-2">New Password</label>
            <input name="password" type="password" required autofocus autocomplete="new-password"
                class="focus-ring input w-full rounded-xl border-2 border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 placeholder:text-gray-400"
                placeholder="••••••••">
            @error('password')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password input -->
        <div>
            <label class="block text-sm font-semibold text-gray-800 mb-2">Confirm New Password</label>
            <input name="password_confirmation" type="password" required autocomplete="new-password"
                class="focus-ring input w-full rounded-xl border-2 border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 placeholder:text-gray-400"
                placeholder="••••••••">
            @error('password_confirmation')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password requirements hint -->
        <div class="rounded-lg bg-blue-50 p-3 text-sm text-blue-800">
            <p class="font-semibold mb-1">Password requirements:</p>
            <ul class="list-disc list-inside space-y-1">
                <li>At least 8 characters</li>
                <li>Use a mix of letters, numbers, and symbols</li>
            </ul>
        </div>

        <!-- Submit button -->
        <button type="submit"
            class="btn w-full rounded-xl bg-gradient-to-r from-blue-600 to-violet-600 px-4 py-3 text-sm font-bold text-white">
            Reset password
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
        <p>Make sure your new password is strong and unique.</p>
        <p>Consider using a password manager for better security.</p>
    </div>
@endsection
