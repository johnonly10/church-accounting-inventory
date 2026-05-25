@extends('layouts.guest')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Nunito:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --violet: #6366f1;
            --violet-d: #4f46e5;
            --violet-l: #818cf8;
            --purple: #8b5cf6;
            --ink: #16132b;
            --card-bg: rgba(255, 255, 255, 0.10);
            --card-border: rgba(255, 255, 255, 0.18);
            --input-bg: rgba(255, 255, 255, 0.12);
            --input-focus: rgba(255, 255, 255, 0.20);
            --white: #ffffff;
            --white-90: rgba(255, 255, 255, 0.92);
            --white-60: rgba(255, 255, 255, 0.60);
            --white-35: rgba(255, 255, 255, 0.35);
            --red: #f87171;
            --radius-sm: 10px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --sp-1: 8px;
            --sp-2: 16px;
            --sp-3: 24px;
            --sp-4: 32px;
            --sp-5: 48px;
        }

        body.lp-body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--ink);
            color: var(--white-90);
            min-height: 100vh;
            min-width: 1200px;
            overflow-x: auto;
        }

        .lp-bg {
            position: fixed;
            inset: 0;
            z-index: -3;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .lp-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(160deg,
                    rgba(22, 19, 43, 0.80) 0%,
                    rgba(22, 19, 43, 0.68) 50%,
                    rgba(22, 19, 43, 0.82) 100%);
        }

        .lp-mesh {
            position: fixed;
            inset: 0;
            z-index: -2;
            pointer-events: none;
            background:
                radial-gradient(ellipse 70% 55% at 15% 15%, rgba(99, 102, 241, .28) 0%, transparent 60%),
                radial-gradient(ellipse 55% 50% at 85% 85%, rgba(139, 92, 246, .20) 0%, transparent 60%);
        }

        .lp-grain {
            position: fixed;
            inset: 0;
            z-index: -1;
            pointer-events: none;
            opacity: 0.04;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='g'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23g)'/%3E%3C/svg%3E");
        }

        #lp-page {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 150px);
            padding: 48px 48px;
            gap: 24px;
            width: 100%;
            max-width: 1600px;
            margin: 0 auto;
        }

        .lp-identity {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 16px;
            animation: lp-fade-up 0.45s ease both;
        }

        .lp-cross {
            position: relative;
            width: 34px;
            height: 42px;
            animation: lp-glow 4s ease-in-out infinite alternate;
        }

        .lp-cross::before,
        .lp-cross::after {
            content: '';
            position: absolute;
            background: white;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(255, 255, 255, .35);
        }

        .lp-cross::before {
            width: 7px;
            height: 100%;
            left: 50%;
            transform: translateX(-50%);
        }

        .lp-cross::after {
            width: 100%;
            height: 7px;
            top: 28%;
            transform: translateY(-50%);
        }

        @keyframes lp-glow {
            from {
                filter: drop-shadow(0 0 5px rgba(255, 255, 255, .20));
            }

            to {
                filter: drop-shadow(0 0 18px rgba(255, 255, 255, .55));
            }
        }

        .lp-church-name {
            font-family: 'Lora', serif;
            font-size: 24px;
            font-weight: 600;
            color: white;
            line-height: 1.25;
        }

        .lp-card {
            width: 600px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-lg);
            padding: 48px;
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            box-shadow:
                0 8px 40px rgba(0, 0, 0, .32),
                inset 0 1px 0 rgba(255, 255, 255, .10);
            animation: lp-fade-up 0.55s cubic-bezier(.22, 1, .36, 1) .06s both;
        }

        @keyframes lp-fade-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .lp-card-title {
            font-family: 'Lora', serif;
            font-size: 36px;
            font-weight: 500;
            color: white;
            text-align: center;
            margin-bottom: 6px;
            line-height: 1.2;
        }

        .lp-card-sub {
            font-size: 15px;
            color: var(--white-60);
            text-align: center;
            margin-bottom: 32px;
            line-height: 1.5;
            font-weight: 400;
        }

        .lp-btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding: 16px 20px;
            border-radius: var(--radius-md);
            background: rgba(255, 255, 255, .13);
            border: 1.5px solid rgba(255, 255, 255, .26);
            color: white;
            font-family: 'Nunito', sans-serif;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background .2s, transform .15s, box-shadow .2s;
        }

        .lp-btn-google:hover,
        .lp-btn-google:focus-visible {
            background: rgba(255, 255, 255, .20);
            transform: translateY(-2px);
            box-shadow: 0 6px 22px rgba(0, 0, 0, .22);
            outline: 3px solid rgba(255, 255, 255, .40);
            outline-offset: 2px;
        }

        .lp-btn-google:active {
            transform: translateY(0);
        }

        .lp-btn-google svg {
            width: 22px;
            height: 22px;
            flex-shrink: 0;
        }

        .lp-google-error {
            margin-top: 10px;
            font-size: 13.5px;
            color: var(--red);
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
        }

        .lp-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
        }

        .lp-divider-line {
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, .18);
        }

        .lp-divider-text {
            font-size: 12px;
            color: var(--white-60);
            letter-spacing: 1.2px;
            text-transform: uppercase;
            white-space: nowrap;
            font-weight: 700;
        }

        .lp-field {
            margin-bottom: 24px;
        }

        .lp-field label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14.5px;
            font-weight: 700;
            color: var(--white-90);
            margin-bottom: 9px;
            letter-spacing: .2px;
        }

        .lp-field label i {
            font-size: 13px;
            color: var(--violet-l);
            width: 16px;
            text-align: center;
        }

        .lp-field-wrap {
            position: relative;
        }

        .lp-field input {
            width: 100%;
            padding: 15px 18px;
            background: var(--input-bg);
            border: 1.5px solid rgba(255, 255, 255, .22);
            border-radius: var(--radius-sm);
            color: white;
            font-family: 'Nunito', sans-serif;
            font-size: 16px;
            font-weight: 500;
            outline: none;
            transition: border-color .2s, background .2s, box-shadow .2s;
        }

        .lp-field input::placeholder {
            color: var(--white-35);
            font-weight: 400;
        }

        .lp-field input:focus {
            border-color: var(--violet-l);
            background: var(--input-focus);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, .22);
        }

        .lp-field input.is-invalid {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(248, 113, 113, .18);
        }

        .lp-pwd-toggle {
            position: absolute;
            right: 4px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--white-60);
            padding: 12px 14px;
            font-size: 16px;
            border-radius: 8px;
            transition: color .2s, background .2s;
        }

        .lp-pwd-toggle:hover,
        .lp-pwd-toggle:focus-visible {
            color: white;
            background: rgba(255, 255, 255, .09);
            outline: none;
        }

        .lp-field-error {
            margin-top: 8px;
            font-size: 13px;
            color: var(--red);
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
        }

        .lp-forgot-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: -10px;
            margin-bottom: 24px;
        }

        .lp-left-links {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .lp-new-here {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.60);
        }

        .lp-forgot-link:hover,
        .lp-forgot-link:focus-visible {
            color: white;
            text-decoration: underline;
            outline: none;
        }

        .lp-btn-submit {
            width: 100%;
            padding: 17px;
            background: linear-gradient(135deg, var(--violet) 0%, var(--purple) 100%);
            border: none;
            border-radius: var(--radius-md);
            color: white;
            font-family: 'Nunito', sans-serif;
            font-size: 17px;
            font-weight: 700;
            letter-spacing: .3px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform .15s, box-shadow .2s;
            box-shadow: 0 6px 24px rgba(99, 102, 241, .40);
        }

        .lp-btn-submit::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .14) 0%, transparent 55%);
            opacity: 0;
            transition: opacity .2s;
        }

        .lp-btn-submit:hover::before,
        .lp-btn-submit:focus-visible::before {
            opacity: 1;
        }

        .lp-btn-submit:hover,
        .lp-btn-submit:focus-visible {
            transform: translateY(-2px);
            box-shadow: 0 10px 32px rgba(99, 102, 241, .50);
            outline: 3px solid rgba(139, 92, 246, .55);
            outline-offset: 2px;
        }

        .lp-btn-submit:active {
            transform: translateY(0);
        }

        .lp-btn-submit:disabled {
            opacity: .65;
            cursor: not-allowed;
            transform: none;
        }

        .lp-btn-text {
            position: relative;
            z-index: 1;
        }

        .lp-spinner {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 22px;
            height: 22px;
            border: 2.5px solid rgba(255, 255, 255, .30);
            border-top-color: white;
            border-radius: 50%;
            animation: lp-spin .7s linear infinite;
        }

        @keyframes lp-spin {
            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .lp-btn-submit.loading .lp-btn-text {
            opacity: 0;
        }

        .lp-btn-submit.loading .lp-spinner {
            display: block;
        }

        .lp-verse-banner {
            width: 680px;
            border-radius: var(--radius-md);
            overflow: hidden;
            position: relative;
            animation: lp-fade-up 0.6s ease .18s both;
        }

        .lp-verse-img {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: brightness(0.30) saturate(0.70);
            transition: filter .5s ease;
        }

        .lp-verse-banner:hover .lp-verse-img {
            filter: brightness(0.38) saturate(0.85);
        }

        .lp-verse-content {
            position: relative;
            z-index: 1;
            padding: 24px 32px;
            text-align: center;
            background: linear-gradient(180deg,
                    rgba(22, 19, 43, .55) 0%,
                    rgba(22, 19, 43, .20) 100%);
        }

        .lp-verse-quote {
            font-family: 'Lora', serif;
            font-size: 16px;
            font-style: italic;
            font-weight: 400;
            color: rgba(255, 255, 255, .88);
            line-height: 1.75;
            margin-bottom: 10px;
        }

        .lp-verse-ref {
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--white-60);
        }
    </style>
@endpush

@section('content')
    @if ($bgPath)
        <div class="lp-bg" aria-hidden="true" style="background-image: url('{{ asset($bgPath) }}')"></div>
    @else
        <div class="lp-bg" aria-hidden="true" style="background: linear-gradient(135deg, #1a1625 0%, #2e2840 100%)"></div>
    @endif
    <div class="lp-mesh" aria-hidden="true"></div>
    <div class="lp-grain" aria-hidden="true"></div>

    <div id="lp-page">

        <div class="lp-card">
            @if (session('status'))
                <div class="mb-5 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-800 ring-1 ring-emerald-100">
                    {{ session('status') }}
                </div>
            @endif
            <h1 class="lp-card-title">Sign In</h1>
            <p class="lp-card-sub">Welcome back — good to see you again.</p>

            <a href="{{ route('login.google') }}" class="lp-btn-google" aria-label="Continue with your Google account">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="#4285F4"
                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                    <path fill="#34A853"
                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                    <path fill="#FBBC05"
                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                    <path fill="#EA4335"
                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                </svg>
                Continue with Google
            </a>

            @error('google')
                <div class="lp-google-error" role="alert">
                    <i class="fas fa-circle-exclamation" aria-hidden="true"></i>
                    {{ $message }}
                </div>
            @enderror

            <div class="lp-divider" role="separator">
                <div class="lp-divider-line"></div>
                <span class="lp-divider-text">or use email</span>
                <div class="lp-divider-line"></div>
            </div>

            <form method="POST" action="{{ route('login.submit') }}" id="loginForm" novalidate
                aria-label="Sign in with email and password">
                @csrf

                <div class="lp-field">
                    <label for="email">
                        <i class="fas fa-envelope" aria-hidden="true"></i>
                        Email Address
                    </label>
                    <div class="lp-field-wrap">
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                            autocomplete="email" placeholder="you@example.com"
                            @if ($errors->has('email')) aria-describedby="email-error" @endif
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                    </div>
                    @error('email')
                        <div class="lp-field-error" id="email-error" role="alert">
                            <i class="fas fa-circle-exclamation" aria-hidden="true"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="lp-field">
                    <label for="password">
                        <i class="fas fa-lock" aria-hidden="true"></i>
                        Password
                    </label>
                    <div class="lp-field-wrap">
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            placeholder="Enter your password" style="padding-right: 54px;"
                            @if ($errors->has('password')) aria-describedby="pwd-error" @endif
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                        <button type="button" id="togglePassword" class="lp-pwd-toggle" aria-label="Show password"
                            aria-pressed="false">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="lp-field-error" id="pwd-error" role="alert">
                            <i class="fas fa-circle-exclamation" aria-hidden="true"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>



                <div class="lp-forgot-row">
                    <div class="lp-left-links">

                        <a href="{{ route('register') }}" class="lp-forgot-link">New Here? Register Now</a>
                    </div>

                    <a href="{{ route('password.request') }}" class="lp-forgot-link">Forgot your password?</a>
                </div>
                <button type="submit" class="lp-btn-submit" id="submitBtn">
                    <span class="lp-btn-text">Sign In</span>
                    <div class="lp-spinner" aria-hidden="true"></div>
                </button>
            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('lp-body');

            const toggle = document.getElementById('togglePassword');
            const pwd = document.getElementById('password');
            if (toggle && pwd) {
                toggle.addEventListener('click', function() {
                    const showing = pwd.type === 'text';
                    pwd.type = showing ? 'password' : 'text';
                    this.querySelector('i').className = showing ? 'fas fa-eye' : 'fas fa-eye-slash';
                    this.setAttribute('aria-label', showing ? 'Show password' : 'Hide password');
                    this.setAttribute('aria-pressed', String(!showing));
                });
            }

            const form = document.getElementById('loginForm');
            const submit = document.getElementById('submitBtn');
            if (form && submit) {
                form.addEventListener('submit', function() {
                    submit.classList.add('loading');
                    submit.disabled = true;
                });
            }
        });
    </script>
@endpush
