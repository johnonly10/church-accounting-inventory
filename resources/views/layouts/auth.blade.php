<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Church') }} - @yield('title', 'Authentication')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            min-height: 100vh;
        }

        .glass {
            backdrop-filter: blur(18px);
            background: rgba(255, 255, 255, .96);
        }

        .card-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, .12);
        }

        .input {
            transition: all .2s cubic-bezier(.4, 0, .2, 1);
        }

        .input:focus {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, .14);
        }

        .btn {
            transition: all .2s cubic-bezier(.4, 0, .2, 1);
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 24px rgba(37, 99, 235, .22);
        }

        .btn:active {
            transform: translateY(0);
        }

        .pattern {
            background-image:
                radial-gradient(circle at 20% 10%, rgba(59, 130, 246, .08), transparent 35%),
                radial-gradient(circle at 90% 30%, rgba(147, 51, 234, .08), transparent 35%),
                radial-gradient(circle at 60% 95%, rgba(16, 185, 129, .08), transparent 35%);
        }

        .page-wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(0.75rem, 2vw, 2rem);
        }

        .shell {
            width: 100%;
            max-width: min(1200px, 95vw);
            overflow: hidden;
            border-radius: clamp(1rem, 2vw, 1.75rem);
            margin: 0 auto;
        }

        .hero-title {
            font-size: clamp(1.4rem, 3vw, 2.6rem);
            line-height: 1.1;
        }

        .title {
            font-size: clamp(1.25rem, 2.5vw, 1.85rem);
        }

        .sub {
            font-size: clamp(0.85rem, 1.5vw, 1rem);
        }

        /* Accessibility helpers */
        .focus-ring:focus {
            outline: 3px solid rgba(59, 130, 246, .35);
            outline-offset: 2px;
        }

        /* Responsive grid adjustments */
        .responsive-grid {
            display: grid;
            grid-template-columns: 1fr;
        }

        @media (min-width: 768px) {
            .responsive-grid {
                grid-template-columns: 1.05fr 0.95fr;
            }
        }

        @media (min-width: 1024px) {
            .shell {
                max-width: 1100px;
            }

            .responsive-grid {
                grid-template-columns: 1.1fr 0.9fr;
            }
        }

        @media (min-width: 1440px) {
            .shell {
                max-width: 1300px;
            }

            .responsive-grid {
                grid-template-columns: 1.15fr 0.85fr;
            }
        }

        /* Section padding responsive */
        .hero-section {
            padding: clamp(1.5rem, 3vw, 3rem);
        }

        .form-section {
            padding: clamp(1rem, 2vw, 2.5rem);
        }

        @media (min-width: 768px) {
            .hero-section {
                padding: clamp(2rem, 4vw, 4rem);
            }

            .form-section {
                padding: clamp(1.5rem, 3vw, 3rem);
            }
        }

        /* Form container responsive */
        .form-container {
            max-width: min(400px, 90vw);
            margin: 0 auto;
        }

        @media (min-width: 640px) {
            .form-container {
                max-width: 400px;
            }
        }

        @media (min-width: 768px) {
            .form-container {
                max-width: 100%;
            }
        }

        @media (min-width: 1024px) {
            .form-container {
                max-width: 400px;
            }
        }

        /* Image handling */
        .bg-cover-center {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Safe area for notches */
        @supports (padding: max(0px)) {
            .page-wrap {
                padding-left: max(0.75rem, env(safe-area-inset-left));
                padding-right: max(0.75rem, env(safe-area-inset-right));
                padding-top: max(0.75rem, env(safe-area-inset-top));
                padding-bottom: max(0.75rem, env(safe-area-inset-bottom));
            }
        }

        /* Print styles */
        @media print {
            .glass {
                background: white;
                backdrop-filter: none;
            }

            .card-shadow {
                box-shadow: none;
            }

            .btn:hover {
                transform: none;
                box-shadow: none;
            }
        }
    </style>
</head>

<body class="antialiased pattern"
    style="{{ isset($bgPath) && $bgPath ? "background-image:url('" . asset($bgPath) . "');background-size:cover;background-position:center;" : 'background:linear-gradient(135deg,#eff6ff 0%,#eef2ff 45%,#f5f3ff 100%);' }}">

    <main class="page-wrap">
        <div class="shell glass card-shadow">
            <div class="responsive-grid">

                {{-- LEFT: Church Hero Section --}}
                <section class="relative hidden md:flex flex-col justify-between hero-section bg-cover-center"
                    style="{{ isset($bg2Path) && $bg2Path ? "background-image:url('" . asset($bg2Path) . "');" : 'background:linear-gradient(135deg,#1d4ed8 0%,#4f46e5 55%,#7c3aed 100%);' }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/35 to-transparent"></div>

                    <div class="relative z-10">
                        <div class="flex items-center gap-3">
                            {{-- Logo or branding can go here --}}
                        </div>
                    </div>

                    <div class="relative z-10 mt-6 lg:mt-10 space-y-2 lg:space-y-3">
                        @yield('hero-text')
                    </div>
                </section>

                {{-- RIGHT: Form Section --}}
                <section class="bg-white form-section">
                    <div class="form-container">
                        @yield('content')
                    </div>
                </section>

            </div>
        </div>
    </main>
</body>

</html>
