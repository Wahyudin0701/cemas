<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pembeli - CeMas')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>

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
    <!-- PEMBELI NAVBAR (Dashboard) -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('pembeli.dashboard') }}" class="flex items-center gap-2">
                    <span class="text-2xl font-bold text-blue-600">CeMas</span>
                </a>
            </div>

            <div class="flex items-center">
                <!-- User Dropdown -->
                <div class="relative hidden md:flex">
                    <button type="button" class="flex items-center gap-3 text-sm text-gray-500 pr-4 mr-1 cursor-pointer focus:outline-none" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span>{{ Auth::user()->name }}</span>
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" class="w-8 h-8 rounded-full border">
                    </button>

                    <div class="origin-top-right absolute right-0 mt-9 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none transition-all duration-200 ease-out transform opacity-0 scale-95 invisible" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" id="user-dropdown-menu">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Edit Profile</a>
                        <a href="{{ route('keranjang.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Keranjang</a>
                        <a href="{{ route('riwayat-pesanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Riwayat Pesanan</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Logout</button>
                        </form>
                    </div>
                </div>
                <!-- Keranjang Icon -->
                <a href="{{ route('keranjang.index') }}" class="relative p-2 text-gray-600 hover:text-blue-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span id="cartCountBadge" class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center hidden">0</span>
                </a>
            </div>
        </div>
    </nav>
    @else
    <!-- PEMBELI NAVBAR (Simple for other pages) -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="{{ route('pembeli.dashboard') }}" class="flex items-center text-gray-600 hover:text-blue-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="hidden md:inline">Kembali</span>
            </a>
            <div class="flex items-center">
                <!-- User Dropdown -->
                <div class="relative hidden md:flex">
                    <button type="button" class="flex items-center gap-3 text-sm text-gray-500 pr-4 mr-1 cursor-pointer focus:outline-none" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span>{{ Auth::user()->name }}</span>
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" class="w-8 h-8 rounded-full border">
                    </button>
                    <div class="origin-top-right absolute right-0 mt-9 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none transition-all duration-200 ease-out transform opacity-0 scale-95 invisible" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" id="user-dropdown-menu">
                        <a href="{{ route('pembeli.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Dashboard</a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Edit Profile</a>
                        <a href="{{ route('keranjang.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Keranjang</a>
                        <a href="{{ route('riwayat-pesanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Riwayat Pesanan</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Logout</button>
                        </form>
                    </div>
                </div>
                <!-- Keranjang Icon -->
                <a href="{{ route('keranjang.index') }}" class="relative p-2 text-gray-600 hover:text-blue-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span id="cartCountBadge" class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center hidden">0</span>
                </a>
            </div>
        </div>
    </nav>
    @endif

    <!-- Page Content -->
    <main class="fade-in">
        @yield('content')
    </main>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Load cart badge on page load
        document.addEventListener('DOMContentLoaded', () => {
            loadCart();
        });

        async function loadCart() {
            try {
                const res = await fetch('{{ route("keranjang.items") }}');
                const items = await res.json();
                updateCartBadge(items);
            } catch (e) {
                console.error('Error loading cart:', e);
            }
        }

        function updateCartBadge(items) {
            const badge = document.getElementById('cartCountBadge');
            if (!badge) return;

            if (items.length > 0) {
                badge.innerText = items.length;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }

        setTimeout(() => {
            document.querySelectorAll('.fade-in').forEach(el => el.classList.add('show'));
        }, 100);

        const userMenuButton = document.getElementById('user-menu-button');
        const userDropdownMenu = document.getElementById('user-dropdown-menu');

        if (userMenuButton && userDropdownMenu) {
            userMenuButton.addEventListener('click', (event) => {
                event.stopPropagation();
                const isExpanded = userMenuButton.getAttribute('aria-expanded') === 'true';
                userMenuButton.setAttribute('aria-expanded', !isExpanded);

                if (userDropdownMenu.classList.contains('opacity-0')) {
                    userDropdownMenu.classList.remove('opacity-0', 'scale-95', 'invisible');
                    userDropdownMenu.classList.add('opacity-100', 'scale-100', 'visible');
                } else {
                    userDropdownMenu.classList.remove('opacity-100', 'scale-100', 'visible');
                    userDropdownMenu.classList.add('opacity-0', 'scale-95', 'invisible');
                }
            });

            document.addEventListener('click', (event) => {
                if (!userMenuButton.contains(event.target) && !userDropdownMenu.contains(event.target)) {
                    userDropdownMenu.classList.remove('opacity-100', 'scale-100', 'visible');
                    userDropdownMenu.classList.add('opacity-0', 'scale-95', 'invisible');
                    userMenuButton.setAttribute('aria-expanded', 'false');
                }
            });
        }
    </script>

    @stack('scripts')

</body>

</html>