<?php

use App\Livewire\Forms\LoginForm;
use App\Models\Image;
use Illuminate\Support\Facades\Session;
use Livewire\Volt\Component;

new class extends Component {
    public LoginForm $form;

    public ?string $logoPath = null;
    public ?string $bgPath = null;
    public ?string $bg2Path = null;

    public function mount(): void
    {
        $images = Image::query()
            ->where('is_active', true)
            ->whereIn('type', ['logo', 'background', 'background_2'])
            ->get()
            ->keyBy('type');

        $this->logoPath = $images['logo']->path ?? null;
        $this->bgPath = $images['background']->path ?? null;
        $this->bg2Path = $images['background_2']->path ?? null;
    }
    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();

        $user = auth()->user();

        if ($user->roletype === 'STAFF') {
            $this->redirectIntended(default: route('staff.index', absolute: false));
            return;
        }

        if ($user->roletype === 'PASTOR') {
            $this->redirectIntended(default: route('pastor.index', absolute: false));
            return;
        }
    }
};
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.98);
        }

        .input-focus {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-focus:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        }

        .button-hover {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .button-hover:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.25);
        }

        .button-hover:active {
            transform: translateY(0);
        }

        .divider-gradient {
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
        }

        .logo-glow {
            filter: drop-shadow(0 4px 12px rgba(79, 70, 229, 0.2));
        }

        .card-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }

        .cross-pattern {
            background-image:
                repeating-linear-gradient(0deg, transparent, transparent 35px, rgba(139, 92, 246, 0.03) 35px, rgba(139, 92, 246, 0.03) 36px),
                repeating-linear-gradient(90deg, transparent, transparent 35px, rgba(139, 92, 246, 0.03) 35px, rgba(139, 92, 246, 0.03) 36px);
        }

        /* Responsive container that fits all screen sizes */
        .login-container {
            height: 100vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(1rem, 2vw, 2rem);
        }

        .login-card {
            width: 100%;
            max-width: min(1400px, calc(100vw - 2rem));
            height: 100%;
            max-height: min(900px, calc(100vh - 2rem));
        }

        /* Ensure form content is scrollable on very small screens */
        .form-scroll {
            overflow-y: auto;
            max-height: 100%;
        }

        .form-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .form-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .form-scroll::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 3px;
        }

        .form-scroll::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }

        /* Responsive text sizing */
        .hero-title {
            font-size: clamp(2rem, 4vw, 3.5rem);
            line-height: 1.1;
        }

        .hero-subtitle {
            font-size: clamp(0.875rem, 1.2vw, 1.125rem);
        }

        .page-title {
            font-size: clamp(1.5rem, 2.5vw, 2rem);
        }

        .page-subtitle {
            font-size: clamp(0.875rem, 1.2vw, 1rem);
        }
    </style>
</head>

<body class="antialiased"
    style="{{ $bgPath ? "background-image:url('" . asset($bgPath) . "'); background-size:cover; background-position:center;" : 'background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 50%, #ddd6fe 100%);' }}">

    <main class="login-container cross-pattern">
        <div class="login-card">
            <div class="grid h-full overflow-hidden rounded-3xl glass-effect card-shadow md:grid-cols-[1fr_1fr]">

                <!-- Left Panel - Church Welcome Section -->
                <section class="relative hidden md:flex flex-col justify-end overflow-hidden p-8 lg:p-12 xl:p-16"
                    style="{{ $bg2Path ? "background-image:url('" . asset($bg2Path) . "'); background-size:cover; background-position:center;" : 'background: linear-gradient(135deg, #4f46e5 0%, #6366f1 50%, #818cf8 100%);' }}">

                    <!-- Semi-transparent overlay for better text readability -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent"></div>

                    <!-- Bible Quote -->
                    <div class="relative z-10 space-y-3">
                        <p class="text-white text-lg lg:text-xl italic font-light leading-relaxed">
                            "For where two or three gather in my name,<br>there am I with them."
                        </p>
                        <p class="text-white/80 text-sm lg:text-base font-medium">
                            — Matthew 18:20
                        </p>
                    </div>
                </section>

                <!-- Right Panel - Login Form -->
                <section class="h-full bg-white overflow-hidden">
                    <div class="form-scroll h-full p-6 sm:p-8 lg:p-10 xl:p-12">
                        <div class="mx-auto w-full max-w-md min-h-full flex flex-col justify-center py-4">

                            {{-- Logo Section --}}
                            {{-- <div class="flex justify-center mb-6 lg:mb-8">
                                @if ($logoPath)
                                    <img src="{{ asset($logoPath) }}" alt="Church Logo"
                                        class="h-16 w-16 sm:h-20 sm:w-20 lg:h-24 lg:w-24 object-contain logo-glow" />
                                @else
                                    <div class="h-16 w-16 sm:h-20 sm:w-20 lg:h-24 lg:w-24 rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 flex items-center justify-center logo-glow shadow-xl">
                                        <svg class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </div>
                                @endif
                            </div> --}}

                            <!-- Header -->
                            <div class="text-center mb-8 lg:mb-10">
                                <h1 class="page-title font-bold text-gray-900 mb-3">
                                    Welcome Back! 👋
                                </h1>
                                <p class="page-subtitle text-gray-600 leading-relaxed">
                                    We're glad to see you again.<br>Login in to continue to your dashboard.
                                </p>
                            </div>

                            <!-- Status Message -->
                            {{-- @if (session('status'))
                                <div
                                    class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 flex items-start gap-3">
                                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ session('status') }}</span>
                                </div>
                            @endif --}}

                            <!-- Google Sign In -->
                            {{-- <a href="{{ route('auth.google.redirect') }}"
                                class="w-full rounded-xl border-2 border-gray-200 bg-white px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 inline-flex items-center justify-center gap-3 button-hover shadow-sm">
                                <svg width="20" height="20" viewBox="0 0 48 48"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path fill="#FFC107"
                                        d="M43.6 20.5H42V20H24v8h11.3C33.7 32.4 29.3 35 24 35c-6.1 0-11-4.9-11-11s4.9-11 11-11c2.8 0 5.4 1.1 7.3 2.8l5.7-5.7C33.6 6.6 29 5 24 5 13.5 5 5 13.5 5 24s8.5 19 19 19 19-8.5 19-19c0-1.2-.1-2.3-.4-3.5z" />
                                    <path fill="#FF3D00"
                                        d="M6.3 14.7l6.6 4.8C14.7 15.3 19 12 24 12c2.8 0 5.4 1.1 7.3 2.8l5.7-5.7C33.6 6.6 29 5 24 5 16.7 5 10.3 9.1 6.3 14.7z" />
                                    <path fill="#4CAF50"
                                        d="M24 43c4.9 0 9.4-1.9 12.8-5l-5.9-5c-1.6 1.2-3.8 2-6.9 2-5.3 0-9.7-3.6-11.3-8.5l-6.6 5.1C10.1 38.6 16.6 43 24 43z" />
                                    <path fill="#1976D2"
                                        d="M43.6 20.5H42V20H24v8h11.3c-.8 2.3-2.4 4.2-4.4 5.5l5.9 5C39.7 36.1 43 30.6 43 24c0-1.2-.1-2.3-.4-3.5z" />
                                </svg>
                                Continue with Google
                            </a> --}}


                            <!-- Divider -->
                            {{-- <div class="my-5 lg:my-6 flex items-center gap-4">
                                <div class="h-px flex-1 divider-gradient"></div>
                                <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Or</span>
                                <div class="h-px flex-1 divider-gradient"></div>
                            </div> --}}

                            <!-- Login Form -->
                            <form wire:submit="login" class="space-y-4 lg:space-y-5">
                                <!-- Email Field -->
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Email address
                                    </label>
                                    <input wire:model="form.email" id="email" type="email" name="email"
                                        autocomplete="username" required autofocus placeholder="you@example.com"
                                        class="input-focus block w-full rounded-xl border-2 border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 outline-none" />
                                    @error('form.email')
                                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Password Field -->
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Password
                                    </label>
                                    <div class="relative">
                                        <input wire:model="form.password" id="password" type="password" name="password"
                                            autocomplete="current-password" required placeholder="Enter your password"
                                            class="input-focus block w-full rounded-xl border-2 border-gray-200 bg-gray-50 px-4 py-3 pr-12 text-sm text-gray-900 placeholder:text-gray-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 outline-none" />
                                        <button type="button" id="togglePassword"
                                            class="absolute inset-y-0 right-0 flex items-center justify-center w-12 text-gray-400 hover:text-gray-600 focus:outline-none focus:text-indigo-600 transition-colors"
                                            aria-label="Show password" aria-pressed="false">
                                            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg"
                                                class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M10.5 10.677A2 2 0 0 0 13.323 13.5" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7.362 7.561C5.68 8.739 4.278 10.318 3.458 12c1.274 4.057 5.064 7 9.542 7 1.36 0 2.66-.271 3.85-.76" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9.88 5.095A10.61 10.61 0 0 1 12 5c4.478 0 8.268 2.943 9.542 7a11.08 11.08 0 0 1-2.12 3.592" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('form.password')
                                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Remember Me & Forgot Password -->
                                <div class="flex items-center justify-between pt-1">
                                    <label
                                        class="inline-flex items-center gap-2 text-sm font-medium text-gray-700 cursor-pointer group">
                                        <input wire:model="form.remember" id="remember" type="checkbox" name="remember"
                                            class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 focus:ring-2 focus:ring-offset-0 cursor-pointer" />
                                        <span class="group-hover:text-gray-900 transition-colors">Remember me</span>
                                    </label>

                                    @if (Route::has('password.request'))
                                        <a class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors"
                                            href="{{ route('password.request') }}" wire:navigate>
                                            Forgot password?
                                        </a>
                                    @endif
                                </div>

                                <!-- Submit Button -->
                                <button type="submit"
                                    class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-3.5 text-sm font-bold text-white hover:from-indigo-700 hover:to-violet-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/50 transition-all duration-200 button-hover mt-6 shadow-lg">
                                    Login In
                                </button>
                            </form>


                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('password');
            const btn = document.getElementById('togglePassword');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');

            if (!input || !btn) return;

            btn.addEventListener('click', () => {
                const isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';

                eyeOpen.classList.toggle('hidden', !isHidden);
                eyeClosed.classList.toggle('hidden', isHidden);

                btn.setAttribute('aria-pressed', String(isHidden));
                btn.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
            });
        });
    </script>

    @livewireScripts
</body>

</html>
