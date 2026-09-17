<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('Image/logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
        
        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-slate-50 font-sans text-slate-800" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" class="fixed inset-0 z-20 transition-opacity bg-black bg-opacity-50 lg:hidden" @click="sidebarOpen = false" x-transition.opacity style="display: none;"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-slate-200 transition-transform duration-300 transform lg:static lg:translate-x-0 flex flex-col shadow-sm">
            
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-6 border-b border-slate-100 shrink-0">
                <a href="/" class="flex items-center gap-3 group py-2">
                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center p-1.5 shadow-sm border border-slate-200 group-hover:shadow-md transition-all shrink-0">
                        <img src="{{ asset('Image/logo.png') }}" alt="CeMas Logo" class="w-full h-full object-contain">
                    </div>
                    <span class="text-xl font-extrabold text-primary-600 tracking-tight group-hover:text-primary-700 transition-colors">CeMas Admin</span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-slate-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Sidebar Navigation -->
            <div class="flex-1 px-4 py-6 overflow-y-auto sidebar-scroll space-y-1">
                <p class="px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-4">Menu Utama</p>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-bold transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-primary-600' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-primary-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                
                <p class="px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-6">Manajemen</p>
                <a href="{{ route('admin.semua-toko') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-bold transition-colors {{ request()->routeIs('admin.semua-toko*') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-primary-600' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.semua-toko*') ? 'text-primary-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Data Toko
                </a>
                
                <a href="{{ route('admin.semua-pengguna') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-bold transition-colors {{ request()->routeIs('admin.semua-pengguna*') || request()->routeIs('admin.detail-pengguna*') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-primary-600' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.semua-pengguna*') || request()->routeIs('admin.detail-pengguna*') ? 'text-primary-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Data Pengguna
                </a>

                <p class="px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-6">Lainnya</p>
                <a href="/" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-bold text-slate-600 hover:bg-slate-50 hover:text-primary-600 transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Halaman Depan
                </a>
            </div>

            <!-- Sidebar Footer (Logout) -->
            <div class="p-4 border-t border-slate-100 shrink-0">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-3 py-2.5 rounded-xl font-bold text-rose-600 hover:bg-rose-50 transition-colors group">
                        <svg class="w-5 h-5 text-rose-500 group-hover:text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 bg-slate-50">
            
            <!-- Top Header -->
            <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 h-16 flex items-center justify-between px-4 sm:px-6 shrink-0 z-10 sticky top-0 shadow-sm">
                
                <div class="flex items-center gap-4">
                    <!-- Hamburger button for mobile -->
                    <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-slate-700 focus:outline-none bg-slate-100 p-2 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    
                    <h1 class="text-lg md:text-xl font-extrabold text-slate-800 tracking-tight hidden sm:block">
                        @yield('title', 'Admin Dashboard')
                    </h1>
                </div>
                
                <!-- Right Header Items -->
                <div class="flex items-center gap-4">
                    <!-- Date (Desktop Only) -->
                    <div class="hidden md:flex items-center gap-2 text-sm font-bold text-slate-500 px-3 py-1.5 bg-slate-100 rounded-lg">
                        <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ now()->format('d M Y') }}
                    </div>

                    <!-- User Profile Dropdown -->
                    <div class="relative flex" x-data="{ open: false }" @click.away="open = false">
                        <button type="button" @click="open = !open" class="flex items-center gap-3 text-sm text-slate-600 hover:text-slate-900 transition-colors cursor-pointer focus:outline-none" aria-haspopup="true" :aria-expanded="open.toString()">
                            <div class="text-right hidden md:block">
                                <p class="font-bold text-slate-800 leading-tight">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] font-bold text-primary-600 uppercase tracking-wider">Administrator</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-primary-100 border-2 border-primary-200 flex items-center justify-center text-primary-700 font-bold overflow-hidden shadow-sm">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=fff" class="w-full h-full object-cover">
                            </div>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="origin-top-right absolute right-0 mt-12 w-56 rounded-2xl shadow-lg shadow-slate-200/50 bg-white ring-1 ring-slate-100 focus:outline-none z-50 overflow-hidden" role="menu" aria-orientation="vertical" tabindex="-1" style="display: none;">
                            <div class="px-4 py-3 bg-slate-50 border-b border-slate-100">
                                <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500 font-medium truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <div class="py-1 p-1">
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-2 text-sm font-bold text-slate-700 hover:bg-slate-100 hover:text-primary-600 rounded-xl" role="menuitem">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Edit Profil
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-2 w-full text-left px-3 py-2 text-sm font-bold text-rose-600 hover:bg-rose-50 rounded-xl mt-1 transition-colors" role="menuitem">
                                        <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto fade-in">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        setTimeout(() => {
            document.querySelectorAll('.fade-in').forEach(el => el.classList.add('show'));
        }, 100);
    </script>

    @stack('scripts')
</body>

</html>