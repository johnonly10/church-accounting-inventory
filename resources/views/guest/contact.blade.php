@extends('layouts.guest')

@section('content')
    <x-hero-section title="Contact <em>Us</em>" :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'Contact Us']]" />

    <section class="section section--white">
        <div class="container">
            <div class="contact-wrapper">
                <div class="card">
                    <h2 class="section-title">Send us a message</h2>

                    <x-sweet-alert entity="Contact Us" />

                    @if (!Auth::check())
                        <div class="login-prompt">
                            <p>Please <a href="{{ route('login') }}">login</a> to send a message.</p>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="form">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="label">Your Name</label>
                            <input type="text" id="name" name="name"
                                class="input @error('name') is-invalid @enderror" placeholder="John Doe"
                                value="{{ old('name', Auth::user()->name ?? '') }}" {{ Auth::check() ? 'readonly' : '' }}>
                            @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="label">Email Address</label>
                            <input type="email" id="email" name="email"
                                class="input @error('email') is-invalid @enderror" placeholder="john@example.com"
                                value="{{ old('email', Auth::user()->email ?? '') }}" {{ Auth::check() ? 'readonly' : '' }}>
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="message" class="label">Message</label>
                            <textarea id="message" name="message" rows="5" required class="textarea @error('message') is-invalid @enderror"
                                placeholder="Tell us more about your inquiry...">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn--primary" {{ !Auth::check() ? 'disabled' : '' }}>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f52e0;
            --primary-light: #8183f4;
            --gray-900: #111827;
            --gray-700: #374151;
            --gray-600: #4b5563;
            --gray-300: #d1d5db;
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -4px rgba(0, 0, 0, .1);
            --success-color: #10b981;
            --error-color: #ef4444;
        }

        body {
            margin: 0;
            color: var(--gray-900);
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 16px;
        }

        @media (min-width: 640px) {
            .container {
                padding: 0 24px;
            }
        }

        @media (min-width: 1024px) {
            .container {
                padding: 0 32px;
                max-width: 1100px;
            }
        }

        .section {
            padding: 80px 0;
        }

        .section--white {
            background: #fff;
        }

        .section-title {
            margin: 0 0 24px;
            font-weight: 800;
            font-size: 30px;
            color: var(--gray-900);
            text-align: center;
        }

        .contact-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: #fff;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            padding: 32px;
            width: 100%;
            max-width: 900px;
        }

        @media (min-width: 768px) {
            .card {
                padding: 48px;
            }
        }

        .form {
            display: grid;
            gap: 24px;
        }

        .form-group {
            display: grid;
            gap: 8px;
        }

        .label {
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-700);
        }

        .input,
        .textarea {
            width: 100%;
            border: 1px solid var(--gray-300);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 16px;
            transition: border-color .2s ease, box-shadow .2s ease;
            outline: none;
            /* Force text color to be dark gray/black */
            color: var(--gray-900) !important;
            -webkit-text-fill-color: var(--gray-900);
            /* For Safari */
        }

        /* Ensure placeholder text has the correct color */
        .input::placeholder,
        .textarea::placeholder {
            color: var(--gray-600);
            opacity: 0.7;
            -webkit-text-fill-color: var(--gray-600);
        }

        /* Override any autofill styles that might be causing blue text */
        .input:-webkit-autofill,
        .input:-webkit-autofill:hover,
        .input:-webkit-autofill:focus,
        .input:-webkit-autofill:active,
        .textarea:-webkit-autofill,
        .textarea:-webkit-autofill:hover,
        .textarea:-webkit-autofill:focus,
        .textarea:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px white inset !important;
            -webkit-text-fill-color: var(--gray-900) !important;
            color: var(--gray-900) !important;
            caret-color: var(--gray-900);
            /* Cursor color */
        }

        .input:focus,
        .textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
            /* Ensure text stays dark even on focus */
            color: var(--gray-900) !important;
        }

        .input.is-invalid,
        .textarea.is-invalid {
            border-color: var(--error-color);
        }

        .input:read-only,
        .textarea:read-only {
            background-color: #f3f4f6;
            cursor: not-allowed;
            /* Keep text color dark for readonly fields */
            color: var(--gray-900) !important;
        }

        .textarea {
            resize: none;
            min-height: 140px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            border: none;
            cursor: pointer;
            border-radius: 10px;
            font-weight: 700;
            padding: 16px 20px;
            transition: transform .2s ease, background-color .2s ease, box-shadow .2s ease;
        }

        .btn--primary {
            background-color: var(--primary-color);
            color: #ffffff;
        }

        .btn--primary:hover:not(:disabled) {
            background-color: var(--primary-dark);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .alert {
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 24px;
        }

        .alert-success {
            background-color: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .alert-error {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .error-message {
            color: var(--error-color);
            font-size: 14px;
            margin-top: 4px;
        }

        .login-prompt {
            background-color: #eef2ff;
            border: 1px solid #c7d2fe;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 24px;
            text-align: center;
        }

        .login-prompt a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .login-prompt a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
    </style>
@endpush
