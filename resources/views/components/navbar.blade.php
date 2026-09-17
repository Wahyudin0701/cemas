@props(['backUrl' => null])

<nav x-data="{ mobileMenuOpen: false }" @click.away="mobileMenuOpen = false" class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm backdrop-blur-md bg-white/90">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        
        @if ($backUrl)
            <!-- Back Button for Inner Pages -->
            <a href="{{ $backUrl }}" class="flex items-center text-gray-500 hover:text-primary-600 transition-colors duration-200 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="hidden md:inline">Kembali</span>
            </a>
        @else
            <!-- Brand Logo & Mobile Menu Toggle -->
            <div class="flex items-center gap-3 md:gap-8">
                <!-- Hamburger Menu Button (Mobile Only) -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 -ml-2 text-gray-600 hover:text-primary-600 focus:outline-none transition-colors rounded-lg hover:bg-slate-50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileMenuOpen" style="display: none;" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Logo -->
                <a href="/" class="flex items-center gap-3 group py-2">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center p-1.5 shadow-sm border border-slate-200 group-hover:shadow-md transition-all shrink-0">
                        <img src="{{ asset('Image/logo.png') }}" alt="CeMas Logo" class="w-full h-full object-contain">
                    </div>
                    <span class="text-xl md:text-2xl font-extrabold text-primary-600 tracking-tight group-hover:text-primary-700 transition-colors">CeMas.</span>
                </a>
            </div>

@php
    $activeClass = 'text-primary-600 font-bold border-b-2 border-primary-600 pb-5 mb-[-1.25rem]'; 
    $inactiveClass = 'text-gray-500 hover:text-primary-600 border-b-2 border-transparent pb-5 mb-[-1.25rem]';

    $mobileActiveClass = 'bg-primary-50 text-primary-700 font-bold';
    $mobileInactiveClass = 'text-gray-700 hover:bg-primary-50 hover:text-primary-600';
@endphp

            <!-- Middle Menu (Desktop) -->
            @if(!Auth::check() || (Auth::check() && Auth::user()->isPembeli()))
                <div class="hidden md:flex space-x-8">
                    <a href="/" class="text-sm font-medium transition {{ request()->is('/') ? $activeClass : $inactiveClass }}">Beranda</a>
                    <a href="{{ route('semua-produk') }}" class="text-sm font-medium transition {{ request()->routeIs('semua-produk') ? $activeClass : $inactiveClass }}">Produk</a>
                    <a href="{{ route('daftar-toko') }}" class="text-sm font-medium transition {{ request()->routeIs('daftar-toko') ? $activeClass : $inactiveClass }}">Daftar Toko</a>
                    <a href="{{ route('tentang-cemas') }}" class="text-sm font-medium transition {{ request()->routeIs('tentang-cemas') ? $activeClass : $inactiveClass }}">Tentang Cemas</a>
                </div>
            @elseif(Auth::check() && Auth::user()->isAdmin())
                <div class="hidden md:flex space-x-8">
                    <a href="/" class="text-sm font-medium transition {{ request()->is('/') ? $activeClass : $inactiveClass }}">Beranda</a>
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? $activeClass : $inactiveClass }}">Dashboard Admin</a>
                    <a href="{{ route('admin.semua-toko') }}" class="text-sm font-medium transition {{ request()->routeIs('admin.semua-toko') ? $activeClass : $inactiveClass }}">Semua Toko</a>
                </div>
            @elseif(Auth::check() && Auth::user()->isPenjual())
                <div class="hidden md:flex space-x-8">
                    <a href="/" class="text-sm font-medium transition {{ request()->is('/') ? $activeClass : $inactiveClass }}">Beranda</a>
                    <a href="{{ route('penjual.dashboard') }}" class="text-sm font-medium transition {{ request()->routeIs('penjual.dashboard') ? $activeClass : $inactiveClass }}">Dashboard Penjual</a>
                </div>
            @endif
        @endif

        <!-- Right Side: Profile & Cart -->
        <div class="flex items-center gap-2 sm:gap-4">
            
            <!-- Keranjang & Riwayat Icon (Pembeli Only) -->
            @if(Auth::check() && Auth::user()->isPembeli())
                <div class="hidden md:flex items-center gap-2">
                    <!-- Riwayat Pesanan -->
                    <a href="{{ route('riwayat-pesanan') }}" class="relative p-2 text-gray-500 hover:text-primary-600 transition-colors rounded-full hover:bg-primary-50" title="Riwayat Pesanan">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </a>

                    <!-- Keranjang -->
                    <a href="{{ route('keranjang.index') }}" class="relative p-2 text-gray-500 hover:text-primary-600 transition-colors rounded-full hover:bg-primary-50" title="Keranjang Belanja">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span id="cartCountBadge" class="absolute top-0 right-0 bg-red-500 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center hidden transform translate-x-1 -translate-y-1 ring-2 ring-white">0</span>
                    </a>
                </div>

                <!-- Divider -->
                <div class="h-6 border-l border-gray-200 mx-1 hidden sm:block"></div>
            @endif

            @auth
            <!-- User Dropdown -->
            <div class="relative flex" x-data="{ open: false }" @click.away="open = false">
                <button type="button" @click="open = !open" class="flex items-center gap-3 text-sm text-gray-600 hover:text-gray-900 transition-colors cursor-pointer focus:outline-none" aria-haspopup="true" :aria-expanded="open.toString()">
                    <span class="font-medium hidden sm:block">{{ Auth::user()->name }}</span>
                    <div class="w-8 h-8 rounded-full bg-primary-100 border border-primary-200 flex items-center justify-center text-primary-700 font-bold overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=fff" class="w-full h-full object-cover">
                    </div>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="origin-top-right absolute right-0 mt-10 w-56 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" tabindex="-1" style="display: none;">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <div class="py-1">
                        @if ($backUrl)
                            @if(Auth::user()->isPenjual())
                                <a href="{{ route('penjual.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary-600" role="menuitem">Dashboard</a>
                            @elseif(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary-600" role="menuitem">Dashboard</a>
                            @endif
                        @endif

                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary-600" role="menuitem">Profil</a>
                    </div>
                    
                    <div class="border-t border-gray-100 py-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50" role="menuitem">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <!-- Guest Buttons -->
            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-primary-600 px-1 sm:px-3 py-2 transition-colors hidden min-[360px]:block">Masuk</a>
            
            <div class="relative" x-data="{ openReg: false }" @click.away="openReg = false">
                <button @click="openReg = !openReg" class="flex items-center gap-1 text-xs sm:text-sm font-medium bg-primary-600 text-white px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg hover:bg-primary-700 transition-colors shadow-sm shadow-primary-200 shrink-0">
                    Daftar
                    <svg class="w-3 h-3 sm:w-4 sm:h-4 transition-transform duration-200" :class="{ 'rotate-180': openReg }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                <div x-show="openReg" x-transition.opacity.duration.200ms class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg ring-1 ring-black ring-opacity-5 py-1 z-50" style="display: none;">
                    <a href="{{ route('register.pembeli') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">Daftar Pembeli</a>
                    <a href="{{ route('register.penjual') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">Daftar Penjual</a>
                </div>
            </div>
            @endauth
        </div>
    </div>

    <!-- Mobile Menu Container -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200" 
         x-transition:enter-start="opacity-0 -translate-y-2" 
         x-transition:enter-end="opacity-100 translate-y-0" 
         x-transition:leave="transition ease-in duration-150" 
         x-transition:leave-start="opacity-100 translate-y-0" 
         x-transition:leave-end="opacity-0 -translate-y-2" 
         class="md:hidden bg-white border-t border-gray-100 absolute w-full shadow-lg" 
         style="display: none;">
        <div class="px-4 py-3 space-y-1">
            @if(!Auth::check() || (Auth::check() && Auth::user()->isPembeli()))
                <a href="/" class="block px-3 py-2.5 rounded-lg text-base transition {{ request()->is('/') ? $mobileActiveClass : $mobileInactiveClass }}">Beranda</a>
                <a href="{{ route('semua-produk') }}" class="block px-3 py-2.5 rounded-lg text-base transition {{ request()->routeIs('semua-produk') ? $mobileActiveClass : $mobileInactiveClass }}">Produk</a>
                <a href="{{ route('daftar-toko') }}" class="block px-3 py-2.5 rounded-lg text-base transition {{ request()->routeIs('daftar-toko') ? $mobileActiveClass : $mobileInactiveClass }}">Daftar Toko</a>
                <a href="{{ route('tentang-cemas') }}" class="block px-3 py-2.5 rounded-lg text-base transition {{ request()->routeIs('tentang-cemas') ? $mobileActiveClass : $mobileInactiveClass }}">Tentang Cemas</a>
                
                @if(Auth::check() && Auth::user()->isPembeli())
                    <div class="border-t border-gray-100 my-2 pt-2"></div>
                    <a href="{{ route('keranjang.index') }}" class="block px-3 py-2.5 rounded-lg text-base transition flex items-center justify-between {{ request()->routeIs('keranjang.index') ? $mobileActiveClass : $mobileInactiveClass }}">
                        Keranjang Belanja
                        <span id="mobileCartCountBadge" class="bg-red-500 text-white text-[10px] font-bold rounded-full px-2 py-0.5 hidden">0</span>
                    </a>
                    <a href="{{ route('riwayat-pesanan') }}" class="block px-3 py-2.5 rounded-lg text-base transition {{ request()->routeIs('riwayat-pesanan') ? $mobileActiveClass : $mobileInactiveClass }}">Riwayat Pesanan</a>
                @endif
            @elseif(Auth::check() && Auth::user()->isAdmin())
                <a href="/" class="block px-3 py-2.5 rounded-lg text-base transition {{ request()->is('/') ? $mobileActiveClass : $mobileInactiveClass }}">Beranda</a>
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2.5 rounded-lg text-base transition {{ request()->routeIs('admin.dashboard') ? $mobileActiveClass : $mobileInactiveClass }}">Dashboard Admin</a>
                <a href="{{ route('admin.semua-toko') }}" class="block px-3 py-2.5 rounded-lg text-base transition {{ request()->routeIs('admin.semua-toko') ? $mobileActiveClass : $mobileInactiveClass }}">Semua Toko</a>
            @elseif(Auth::check() && Auth::user()->isPenjual())
                <a href="/" class="block px-3 py-2.5 rounded-lg text-base transition {{ request()->is('/') ? $mobileActiveClass : $mobileInactiveClass }}">Beranda</a>
                <a href="{{ route('penjual.dashboard') }}" class="block px-3 py-2.5 rounded-lg text-base transition {{ request()->routeIs('penjual.dashboard') ? $mobileActiveClass : $mobileInactiveClass }}">Dashboard Penjual</a>
            @endif
        </div>
    </div>
</nav>
