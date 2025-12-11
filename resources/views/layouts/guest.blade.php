<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
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
        <div class="w-full max-w-xl bg-white/30 backdrop-blur-2xl 
                    rounded-3xl shadow-2xl p-8">

            <!-- Header -->
            <div class="flex flex-col items-center mb-6">
                <div
                    class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center font-bold text-xl">
                    C
                </div>
                <h1 class="mt-2 text-xl font-bold">CeMas</h1>
                <p class="text-xs text-gray-600 -mt-1">Community E-Marketplace Aston Villa</p>
            </div>

            <!-- FORM -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow p-6">
                {{ $slot }}
            </div>

        </div>

    </div>
</body>



</html>
