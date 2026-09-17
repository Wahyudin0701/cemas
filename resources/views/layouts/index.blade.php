<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CeMas')</title>
    
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


    @stack('styles')
</head>

<body>
    @if(session('success'))
        <div id="global-toast-success" class="fixed top-20 right-6 z-50 bg-green-500 text-white px-5 py-3 rounded-xl shadow-2xl flex items-center gap-3 transition-all duration-500 transform translate-y-0 opacity-100">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('global-toast-success');
                if(toast) {
                    toast.classList.remove('translate-y-0', 'opacity-100');
                    toast.classList.add('-translate-y-full', 'opacity-0');
                    setTimeout(() => toast.remove(), 500);
                }
            }, 3000);
        </script>
    @endif
    @if(session('error'))
        <div id="global-toast-error" class="fixed top-20 right-6 z-50 bg-red-500 text-white px-5 py-3 rounded-xl shadow-2xl flex items-center gap-3 transition-all duration-500 transform translate-y-0 opacity-100">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            <span class="font-medium text-sm">{{ session('error') }}</span>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('global-toast-error');
                if(toast) {
                    toast.classList.remove('translate-y-0', 'opacity-100');
                    toast.classList.add('-translate-y-full', 'opacity-0');
                    setTimeout(() => toast.remove(), 500);
                }
            }, 3000);
        </script>
    @endif

    @yield('konten')

    @vite('resources/js/app.js')

    @stack('scripts')
    <!-- GLOBAL AJAX TOAST -->
    <div id="ajax-toast" class="fixed bottom-6 right-6 z-[100] transform translate-y-[150%] opacity-0 transition-all duration-300">
        <div class="bg-gray-800 text-white px-5 py-3 rounded-xl shadow-2xl flex items-center gap-3">
            <svg id="ajax-toast-icon" class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span id="ajax-toast-msg" class="font-medium text-sm">Berhasil</span>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if(Auth::check() && Auth::user()->isPembeli())
            loadCart();
            @endif
        });

        async function loadCart() {
            try {
                const res = await fetch('/keranjang/items');
                if(!res.ok) return;
                const items = await res.json();
                
                // Update badge in navbar
                const desktopBadge = document.getElementById('cartCountBadge');
                const mobileBadge = document.getElementById('mobileCartCountBadge');
                
                if (items.length > 0) {
                    if (desktopBadge) {
                        desktopBadge.innerText = items.length;
                        desktopBadge.classList.remove('hidden');
                    }
                    if (mobileBadge) {
                        mobileBadge.innerText = items.length;
                        mobileBadge.classList.remove('hidden');
                    }
                } else {
                    if (desktopBadge) desktopBadge.classList.add('hidden');
                    if (mobileBadge) mobileBadge.classList.add('hidden');
                }
            } catch (e) {
                console.error(e);
            }
        }

        async function addToCart(produkId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            try {
                const res = await fetch('/keranjang/tambah', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        produk_id: produkId
                    })
                });

                const data = await res.json();

                if (res.ok) {
                    showAjaxToast('Produk ditambahkan ke keranjang!');
                    loadCart();
                } else {
                    showAjaxToast(data.message || 'Gagal menambahkan', true);
                }
            } catch (e) {
                showAjaxToast('Terjadi kesalahan jaringan', true);
            }
        }

        function showAjaxToast(msg, isError = false) {
            const toast = document.getElementById('ajax-toast');
            const txt = document.getElementById('ajax-toast-msg');
            const icon = document.getElementById('ajax-toast-icon');
            txt.innerText = msg;

            if (isError) {
                toast.firstElementChild.classList.add('bg-red-600');
                toast.firstElementChild.classList.remove('bg-gray-800');
                icon.classList.remove('text-green-400');
                icon.classList.add('text-white');
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
            } else {
                toast.firstElementChild.classList.remove('bg-red-600');
                toast.firstElementChild.classList.add('bg-gray-800');
                icon.classList.remove('text-white');
                icon.classList.add('text-green-400');
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
            }

            toast.classList.remove('translate-y-[150%]', 'opacity-0');
            
            // clear previous timeout if multiple rapid clicks
            if(window.ajaxToastTimeout) clearTimeout(window.ajaxToastTimeout);
            
            window.ajaxToastTimeout = setTimeout(() => {
                toast.classList.add('translate-y-[150%]', 'opacity-0');
            }, 3000);
        }
    </script>
</body>

</html>