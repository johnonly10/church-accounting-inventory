<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    @include('includes.staff-head')

    <link rel="stylesheet" href="{{ asset('css/navbar/index.css') }}">

    @stack('styles')
</head>

<body>
    @include('includes.guest.navbar')

    <main id="main-content">
        @yield('content')
    </main>
    @include('includes.guest.footer')
    @include('includes.staff-scripts')
    @vite(['resources/js/app.js'])

    @stack('scripts')
</body>

</html>
