<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CeMas') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('Image/logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .login-bg {
            background-image: url('{{ asset('Image/lorong_asvil.jpg') }}');
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased 
             bg-cover bg-center bg-no-repeat bg-fixed login-bg">
    <!-- FULL CENTER -->
    <div class="min-h-screen flex items-center justify-center px-4">

        <!-- BLUR FOLLOW CONTENT -->
        <div class="w-full max-w-xl bg-white/40 backdrop-blur-3xl rounded-3xl shadow-2xl p-6 md:p-8 border border-white/50">

            <!-- Header -->
            <div class="flex flex-col items-center mb-8">
                <a href="/">
                    <img src="{{ asset('Image/logo.png') }}" alt="CeMas Logo" class="h-16 object-contain drop-shadow-md hover:scale-105 transition-transform">
                </a>
                <p class="text-sm font-medium text-slate-700 mt-3 tracking-wide">Community E-Marketplace Aston Villa</p>
            </div>

            <!-- FORM -->
            <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl shadow-slate-200/50 p-6 md:p-8 border border-white">
                {{ $slot }}
            </div>

        </div>

    </div>
</body>



</html>
