<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pembeli')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('Image/logo.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Tailwind CDN for development consistency without npm run dev -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                    },
                }
            }
        }
    </script>
    <style>
        .fade-in {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.5s ease;
        }

        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-50 font-sans text-gray-900 antialiased">

    @if (request()->routeIs('pembeli.dashboard'))
        <x-navbar />
    @else
        @php
            $backUrl = route('pembeli.dashboard');
            if (Auth::check() && Auth::user()->isAdmin()) {
                $backUrl = route('admin.semua-toko'); // atau route lain di admin
            }
        @endphp
        <x-navbar :back-url="$backUrl" />
    @endif

    <!-- Page Content -->
    <main class="fade-in">
        @yield('content')
    </main>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Load cart badge on page load
        document.addEventListener('DOMContentLoaded', () => {
            @if(Auth::check() && Auth::user()->isPembeli())
            loadCart();
            @endif
        });

        async function loadCart() {
            try {
                const res = await fetch('{{ route('keranjang.items') }}');
                const items = await res.json();
                updateCartBadge(items);
            } catch (e) {
                console.error('Error loading cart:', e);
            }
        }

        function updateCartBadge(items) {
            const badge = document.getElementById('cartCountBadge');
            const mobileBadge = document.getElementById('mobileCartCountBadge');

            if (items.length > 0) {
                if (badge) {
                    badge.innerText = items.length;
                    badge.classList.remove('hidden');
                }
                if (mobileBadge) {
                    mobileBadge.innerText = items.length;
                    mobileBadge.classList.remove('hidden');
                }
            } else {
                if (badge) badge.classList.add('hidden');
                if (mobileBadge) mobileBadge.classList.add('hidden');
            }
        }

        setTimeout(() => {
            document.querySelectorAll('.fade-in').forEach(el => el.classList.add('show'));
        }, 100);

    </script>

    @stack('scripts')

</body>

</html>
