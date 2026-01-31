<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ config('app.name', 'Laravel') }} - Under Maintenance</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
            color: #333;
        }

        .maintenance-container {
            text-align: center;
            max-width: 600px;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-out;
        }

        .maintenance-icon {
            font-size: 80px;
            margin-bottom: 30px;
            color: #4f46e5;
        }

        h1 {
            font-size: 2.5rem;
            color: #1f2937;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .highlight {
            color: #4f46e5;
        }

        p {
            font-size: 1.2rem;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .status {
            display: inline-block;
            background: #f0f9ff;
            color: #0369a1;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            margin-bottom: 30px;
            border: 2px solid #bae6fd;
        }

        .contact-info {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e5e7eb;
        }

        .contact-info p {
            font-size: 1rem;
            margin-bottom: 10px;
            color: #4b5563;
        }

        .email {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
        }

        .email:hover {
            text-decoration: underline;
        }

        .progress-bar {
            height: 6px;
            background: #e5e7eb;
            border-radius: 3px;
            overflow: hidden;
            margin: 25px 0;
        }

        .progress {
            height: 100%;
            background: linear-gradient(90deg, #4f46e5, #8b5cf6);
            width: 75%;
            animation: progressAnimation 2s ease-in-out infinite alternate;
        }

        /* Logout button styles */
        .logout-form {
            margin: 20px 0;
        }

        .logout-button {
            background: #ef4444;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .logout-button:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.2);
        }

        .logout-button:active {
            transform: translateY(0);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes progressAnimation {
            0% {
                width: 70%;
            }

            100% {
                width: 80%;
            }
        }

        @media (max-width: 640px) {
            .maintenance-container {
                padding: 30px 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .logout-button {
                padding: 10px 25px;
                font-size: 0.95rem;
            }
        }
    </style>
</head>

<body>
    <div class="maintenance-container">
        <div class="maintenance-icon">
            🔧
        </div>

        <h1>We're <span class="highlight">Under Maintenance</span></h1>

        <div class="status">
            🔄 UPDATE IN PROGRESS
        </div>

        <p>
            We're currently performing scheduled maintenance to improve your experience.
            The website will be back online as soon as possible. Thank you for your patience!
        </p>

        <!-- Logout Form -->
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                Logout
            </button>
        </form>

        <div class="progress-bar">
            <div class="progress"></div>
        </div>

        <div class="contact-info">
            <p>Need immediate assistance?</p>
            <p>Contact us at: <a href="mailto:buenaventurajenson8@gmail.com"
                    class="email">buenaventurajenson8@gmail.com</a></p>
            <p style="font-size: 0.9rem; color: #9ca3af; margin-top: 20px;">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        setTimeout(() => {
            window.location.reload();
        }, 5 * 60 * 1000);
    </script>
</body>

</html>
