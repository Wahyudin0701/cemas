<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Homepage' }}</title>
    {{ $styles ?? '' }}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <x-navbar></x-navbar>

    <main>
        {{ $slot }}
    </main>


    <footer class="bg-gray-900 text-white py-6 text-center">
        <p>© {{ date('Y') }} CeMas — Dibuat oleh Warga, untuk Warga.</p>
    </footer>

    @vite('resources/js/app.js')

    {{ $scripts ?? '' }}    
</body>

</html>