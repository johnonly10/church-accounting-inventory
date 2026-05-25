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
            padding: 15px 54px 15px 18px;
            background: var(--input-bg);
            border: 1.5px solid rgba(255, 255, 255, .22);
            border-radius: var(--radius-sm);
            color: white;
            font-family: 'Nunito', sans-serif;
            font-size: 16px;
            font-weight: 500;
            outline: none;
            transition: border-color .2s, background .2s, box-shadow .2s;
            box-sizing: border-box;
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
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            height: 40px;
            width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--white-60);
            padding: 0;
            border-radius: 10px;
            transition: color .2s, background .2s;
        }

        .lp-pwd-toggle:hover,
        .lp-pwd-toggle:focus-visible {
            color: white;
            background: rgba(255, 255, 255, .09);
            outline: none;
        }

        .lp-pwd-toggle i {
            line-height: 1;
            font-size: 16px;
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

        .lp-footer-row {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 18px;
            gap: 8px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.60);
            font-weight: 600;
        }

        .lp-link {
            font-size: 14px;
            font-weight: 700;
            color: var(--violet-l);
            text-decoration: none;
            padding: 6px 2px;
            transition: color .2s;
        }

        .lp-link:hover,
        .lp-link:focus-visible {
            color: white;
            text-decoration: underline;
            outline: none;
        }

        .lp-status {
            margin-bottom: 18px;
            border-radius: 14px;
            padding: 12px 14px;
            font-size: 13.5px;
            font-weight: 700;
            color: rgba(22, 19, 43, 0.92);
            background: rgba(52, 211, 153, 0.92);
        }
    </style>
@endpush

@section('content')
    @if ($bgPath ?? null)
        <div class="lp-bg" aria-hidden="true" style="background-image: url('{{ asset($bgPath) }}')"></div>
    @else
        <div class="lp-bg" aria-hidden="true" style="background: linear-gradient(135deg, #1a1625 0%, #2e2840 100%)"></div>
    @endif
    <div class="lp-mesh" aria-hidden="true"></div>
    <div class="lp-grain" aria-hidden="true"></div>

    <div id="lp-page">
        <div class="lp-card">
            <h1 class="lp-card-title">Create Account</h1>
            <p class="lp-card-sub">Join our community and connect with our church family.</p>

            @if (session('status'))
                <div class="lp-status">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}" id="registerForm" novalidate
                aria-label="Create an account">
                @csrf

                <div class="lp-field">
                    <label for="name">
                        <i class="fas fa-user" aria-hidden="true"></i>
                        Full Name
                    </label>
                    <div class="lp-field-wrap">
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                            autocomplete="name" placeholder="Your full name"
                            @if ($errors->has('name')) aria-describedby="name-error" @endif
                            class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
                    </div>
                    @error('name')
                        <div class="lp-field-error" id="name-error" role="alert">
                            <i class="fas fa-circle-exclamation" aria-hidden="true"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="lp-field">
                    <label for="email">
                        <i class="fas fa-envelope" aria-hidden="true"></i>
                        Email Address
                    </label>
                    <div class="lp-field-wrap">
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
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
                        <input id="password" name="password" type="password" required autocomplete="new-password"
                            placeholder="Enter your password"
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

                <div class="lp-field">
                    <label for="password_confirmation">
                        <i class="fas fa-lock" aria-hidden="true"></i>
                        Confirm Password
                    </label>
                    <div class="lp-field-wrap">
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            autocomplete="new-password" placeholder="Confirm your password">
                        <button type="button" id="togglePasswordConfirm" class="lp-pwd-toggle"
                            aria-label="Show confirm password" aria-pressed="false">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="lp-btn-submit" id="submitBtn">
                    <span class="lp-btn-text">Create Account</span>
                    <div class="lp-spinner" aria-hidden="true"></div>
                </button>

                <div class="lp-footer-row">
                    <span>Already have an account?</span>
                    <a href="{{ route('login') }}" class="lp-link">Sign in</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('lp-body');

            const submit = document.getElementById('submitBtn');
            const form = document.getElementById('registerForm');
            if (form && submit) {
                form.addEventListener('submit', function() {
                    submit.classList.add('loading');
                    submit.disabled = true;
                });
            }

            const pwd = document.getElementById('password');
            const toggle = document.getElementById('togglePassword');
            if (toggle && pwd) {
                toggle.addEventListener('click', function() {
                    const showing = pwd.type === 'text';
                    pwd.type = showing ? 'password' : 'text';
                    this.querySelector('i').className = showing ? 'fas fa-eye' : 'fas fa-eye-slash';
                    this.setAttribute('aria-label', showing ? 'Show password' : 'Hide password');
                    this.setAttribute('aria-pressed', String(!showing));
                });
            }

            const pwd2 = document.getElementById('password_confirmation');
            const toggle2 = document.getElementById('togglePasswordConfirm');
            if (toggle2 && pwd2) {
                toggle2.addEventListener('click', function() {
                    const showing = pwd2.type === 'text';
                    pwd2.type = showing ? 'password' : 'text';
                    this.querySelector('i').className = showing ? 'fas fa-eye' : 'fas fa-eye-slash';
                    this.setAttribute('aria-label', showing ? 'Show confirm password' :
                        'Hide confirm password');
                    this.setAttribute('aria-pressed', String(!showing));
                });
            }
        });
    </script>
@endpush
