@extends('layouts.guest')

@section('content')
    <x-hero-section title="Contact <em>Us</em>" :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'Contact Us']]" />

    <section class="section section--white">
        <div class="container">
            <div class="contact-wrapper">
                <div class="card">
                    <h2 class="section-title">Send us a message</h2>

                    <form action="{{ route('contact.store') }}" method="POST" class="form">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="label">Your Name</label>
                            <input type="text" id="name" name="name" required class="input"
                                placeholder="John Doe">
                        </div>

                        <div class="form-group">
                            <label for="email" class="label">Email Address</label>
                            <input type="email" id="email" name="email" required class="input"
                                placeholder="john@example.com">
                        </div>

                        <div class="form-group">
                            <label for="message" class="label">Message</label>
                            <textarea id="message" name="message" rows="5" required class="textarea"
                                placeholder="Tell us more about your inquiry..."></textarea>
                        </div>

                        <button type="submit" class="btn btn--primary">
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
            --blue-600: #2563eb;
            --blue-700: #1d4ed8;
            --gray-900: #111827;
            --gray-700: #374151;
            --gray-600: #4b5563;
            --gray-300: #d1d5db;
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -4px rgba(0, 0, 0, .1);
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
        }

        .textarea {
            resize: none;
            min-height: 140px;
        }

        .input:focus,
        .textarea:focus {
            border-color: var(--blue-600);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.25);
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
            background-color: #6366f1;
            color: #f0f0f0;
        }

        .btn--primary:hover {
            background-color: #f0f0f0;
            color: #6366f1;
        }
    </style>
@endpush
