@extends('layouts.index')

@section('title', 'Beranda - CeMas')

@push('styles')
    <style>
        /* Smooth fade animation */
        .fade-in {
            opacity: 0;
            transform: translateY(15px);
            transition: all 0.6s ease-out;
        }

        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }

        .navbar-blur {
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.6);
            transition: background-color 0.3s ease;
        }

        .navbar-solid {
            background-color: rgba(255, 255, 255, 1) !important;
        }

        .hero-bg {
            background: linear-gradient(135deg, #eef3ff 0%, #dee8ff 100%);
        }

        .card {
            transition: all 0.25s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.06);
        }

        .dropdown-anim {
            transform-origin: top right;
            transform: scale(0.95) translateY(-8px);
            opacity: 0;
            transition: all 0.18s ease-out;
        }

        .dropdown-open {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
@endpush

@section('konten')

    <x-navbar />

    <!-- HERO SECTION (E-Commerce Style: Solid Brand Color) -->
    <section class="relative pt-16 pb-24 lg:pt-20 lg:pb-32 bg-primary-600 overflow-hidden text-white">
        <!-- Abstract Shapes for Background -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary-500 rounded-full mix-blend-screen opacity-50 blur-3xl"></div>
            <div class="absolute bottom-10 -left-10 w-72 h-72 bg-primary-400 rounded-full mix-blend-screen opacity-40 blur-2xl animate-blob"></div>
            <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-white rounded-full mix-blend-overlay opacity-10 blur-2xl animate-blob animation-delay-2000"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            
            <!-- SMART BANNER: ACTIVE ORDERS -->
            @if(isset($pesananAktif) && $pesananAktif->count() > 0)
                <div class="mb-8 sm:mb-12 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-lg hover:bg-white/15 transition-colors fade-in show">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-amber-400/20 border border-amber-400/30 flex items-center justify-center text-amber-300 shrink-0">
                            <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-white text-base md:text-lg">📦 Pesanan Anda Sedang Diproses!</h3>
                            <p class="text-primary-100 text-xs md:text-sm mt-0.5">Anda memiliki <span class="font-bold text-white">{{ $pesananAktif->count() }} pesanan aktif</span>. Pantau statusnya sekarang.</p>
                        </div>
                    </div>
                    <a href="{{ route('riwayat-pesanan') }}" class="w-full sm:w-auto px-5 py-2.5 bg-white text-primary-600 font-bold text-sm rounded-xl hover:bg-slate-50 transition-all hover:scale-105 shadow-md flex justify-center items-center gap-2">
                        Lacak Pesanan
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            @endif

            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="space-y-8 text-center lg:text-left fade-in">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm text-white font-bold text-sm border border-white/20 mx-auto lg:mx-0 mt-8 lg:mt-0">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    Platform Resmi Warga Aston Villa
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight drop-shadow-sm">
                    Penuhi Kebutuhan Harian, <br class="hidden lg:block">
                    <span class="text-amber-300">Tanpa Harus Jauh.</span>
                </h1>
                
                <p class="text-lg md:text-xl text-primary-100 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-medium">
                    Jelajahi produk segar, sembako, dan jasa langsung dari tetangga. Cepat, aman, dan tanpa ongkir mahal.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start pt-2">
                    <a href="{{ route('daftar-toko') }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-white text-primary-600 hover:bg-slate-50 px-8 py-4 rounded-xl font-bold text-lg shadow-[0_8px_30px_rgb(0,0,0,0.12)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.2)] transition-all hover:-translate-y-1">
                        Mulai Belanja
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="flex items-center justify-center lg:justify-start gap-8 pt-8 border-t border-primary-500/50 mt-8 max-w-xl mx-auto lg:mx-0">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-400 border border-emerald-500/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="text-left">
                            <p class="text-xs text-primary-200 font-medium uppercase tracking-wider">Keamanan</p>
                            <p class="text-sm font-bold">Terverifikasi RT</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-amber-500/20 flex items-center justify-center text-amber-400 border border-amber-500/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div class="text-left">
                            <p class="text-xs text-primary-200 font-medium uppercase tracking-wider">Pengiriman</p>
                            <p class="text-sm font-bold">Instan / COD</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image/Visual Content -->
            <div class="relative hidden lg:block fade-in">
                <!-- Main Image Container -->
                <div class="relative z-10 w-full max-w-lg mx-auto mt-4">
                    <!-- Browser Chrome Mockup -->
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl shadow-2xl border border-white/20 overflow-hidden transform hover:-translate-y-2 transition-transform duration-500">
                        <!-- Browser Header -->
                        <div class="bg-white px-4 py-3 flex items-center gap-2 border-b border-slate-100">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                            <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                            <div class="ml-4 bg-slate-100 rounded-md h-6 w-48 mx-auto flex items-center px-2">
                                <svg class="w-3 h-3 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                                <span class="text-[11px] text-slate-600 font-medium">cemas-app.local</span>
                            </div>
                        </div>
                        <!-- Browser Body -->
                        <div class="relative">
                            <img src="{{ asset('Image/lorong_asvil.jpg') }}" class="w-full h-[400px] object-cover filter contrast-125 saturate-110" alt="Lorong Aston Villa">
                            <!-- Gradient Overlay for dramatic effect -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            
                            <!-- Inside Image overlay text -->
                            <div class="absolute bottom-6 left-6 right-6 text-left">
                                <div class="inline-flex items-center px-2.5 py-1 rounded-md bg-white/20 backdrop-blur-sm text-white text-xs font-bold border border-white/30 mb-2">
                                    <svg class="w-3 h-3 mr-1 text-amber-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    Terpercaya
                                </div>
                                <h3 class="text-xl font-bold text-white drop-shadow-md">Belanja dari Tetangga Sendiri.</h3>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating E-Commerce Style Badges -->
                    <div class="absolute -left-12 top-24 bg-white p-3.5 rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.2)] flex items-center gap-3 animate-bounce border border-slate-100" style="animation-duration: 3s;">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center text-orange-600 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div class="pr-2">
                            <p class="text-sm font-extrabold text-slate-800">Bebas Ongkir</p>
                            <p class="text-xs text-slate-500 font-medium">Khusus area warga</p>
                        </div>
                    </div>

                    <div class="absolute -right-8 bottom-12 bg-white p-3.5 rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.2)] flex items-center gap-3 animate-bounce border border-slate-100" style="animation-duration: 4s;">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="pr-2">
                            <p class="text-sm font-extrabold text-slate-800">Harga Warga</p>
                            <p class="text-xs text-slate-500 font-medium">Lebih ekonomis</p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Smooth Bottom Wave -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none transform translate-y-[1px]">
            <svg class="relative block w-full h-16 lg:h-32" viewBox="0 0 1440 320" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path fill="#f8fafc" d="M0,192L48,186.7C96,181,192,171,288,181.3C384,192,480,224,576,224C672,224,768,192,864,165.3C960,139,1056,117,1152,122.7C1248,128,1344,160,1392,176L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <!-- PRODUK TERBARU -->
    <section class="pt-12 pb-24 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16 fade-in flex flex-col items-center">
                <div class="inline-flex items-center justify-center px-4 py-1.5 mb-4 rounded-full bg-primary-100 text-primary-700 font-bold text-sm tracking-wider uppercase shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Produk Pilihan
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Produk Terbaru Warga</h2>
                <p class="mt-4 text-slate-600 text-lg max-w-2xl mx-auto font-medium">
                    Jelajahi berbagai kebutuhan sehari-hari yang ditawarkan langsung oleh warga di sekitar Anda.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 fade-in" x-data="{ showProductModal: false, activeProduct: null }">
                @foreach ($produkList as $produk)
                    <div class="group bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col">
                        <div class="aspect-square w-full overflow-hidden bg-slate-100 relative cursor-pointer"
                             @click="activeProduct = { id: '{{ $produk->id }}', nama: '{{ addslashes($produk->nama_produk) }}', harga: 'Rp{{ number_format($produk->harga, 0, ',', '.') }}', stok: {{ $produk->stok }}, deskripsi: '{{ addslashes(str_replace(array("\r", "\n"), '', $produk->deskripsi ?? 'Tidak ada deskripsi.')) }}', foto: '{{ $produk->foto_produk_url ?? 'https://placehold.co/400x400?text=Produk' }}', toko: '{{ addslashes($produk->toko->nama_toko) }}' }; showProductModal = true">
                            @if($produk->foto_produk_url)
                                <img src="{{ $produk->foto_produk_url }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $produk->nama_produk }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400 bg-gradient-to-br from-slate-100 to-slate-200">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-3 left-3 bg-white/90 backdrop-blur text-primary-700 text-xs font-bold px-2.5 py-1 rounded-lg shadow-sm">
                                {{ $produk->toko->nama_toko }}
                            </div>
                        </div>
                        
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="text-lg font-bold text-slate-900 cursor-pointer group-hover:text-primary-600 transition-colors line-clamp-1" title="{{ $produk->nama_produk }}"
                                @click="activeProduct = { id: '{{ $produk->id }}', nama: '{{ addslashes($produk->nama_produk) }}', harga: 'Rp{{ number_format($produk->harga, 0, ',', '.') }}', stok: {{ $produk->stok }}, deskripsi: '{{ addslashes(str_replace(array("\r", "\n"), '', $produk->deskripsi ?? 'Tidak ada deskripsi.')) }}', foto: '{{ $produk->foto_produk_url ?? 'https://placehold.co/400x400?text=Produk' }}', toko: '{{ addslashes($produk->toko->nama_toko) }}' }; showProductModal = true">
                                {{ $produk->nama_produk }}
                            </h3>

                            <p class="text-primary-600 font-extrabold mt-1 text-lg">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </p>
                            
                            <div class="mt-2 text-xs text-slate-500 font-medium">
                                Stok: <span class="{{ $produk->stok > 0 ? 'text-emerald-600' : 'text-red-500' }}">{{ $produk->stok > 0 ? $produk->stok : 'Habis' }}</span>
                            </div>

                            <div class="mt-auto pt-4 flex gap-2">
                                <a href="{{ route('detail-toko', $produk->toko->id) }}" class="w-full inline-flex items-center justify-center bg-white border-2 border-primary-100 text-primary-700 hover:border-primary-500 hover:bg-primary-50 px-4 py-2 rounded-xl font-bold transition-all text-sm shadow-sm group-hover:shadow">
                                    Lihat Toko
                                </a>
                                @auth
                                    @if(Auth::user()->isPembeli() && $produk->stok > 0)
                                    <button type="button" onclick="addToCart('{{ $produk->id }}')" class="flex-shrink-0 w-10 h-10 inline-flex items-center justify-center bg-primary-600 hover:bg-primary-700 text-white rounded-xl transition-colors shadow-sm" title="Tambah ke Keranjang">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </button>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Product Detail Modal -->
                <template x-teleport="body">
                    <div x-show="showProductModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6" style="display: none;">
                        <div x-show="showProductModal" x-transition.opacity class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showProductModal = false"></div>
                        
                        <div x-show="showProductModal" 
                             x-transition:enter="transition ease-out duration-300" 
                             x-transition:enter-start="opacity-0 scale-95 translate-y-4" 
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0" 
                             x-transition:leave="transition ease-in duration-200" 
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0" 
                             x-transition:leave-end="opacity-0 scale-95 translate-y-4" 
                             class="relative bg-white rounded-2xl sm:rounded-3xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-hidden flex flex-col md:flex-row z-10">
                            
                            <button @click="showProductModal = false" class="absolute top-4 right-4 z-20 w-8 h-8 flex items-center justify-center bg-white/80 backdrop-blur rounded-full text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>

                            <!-- Product Image Side -->
                            <div class="w-full md:w-2/5 bg-slate-50 aspect-square md:aspect-auto md:h-full relative shrink-0">
                                <template x-if="activeProduct">
                                    <img :src="activeProduct.foto" :alt="activeProduct.nama" class="w-full h-full object-cover">
                                </template>
                            </div>

                            <!-- Product Info Side -->
                            <div class="w-full md:w-3/5 p-6 sm:p-8 flex flex-col overflow-y-auto">
                                <template x-if="activeProduct">
                                    <div>
                                        <div class="mb-6">
                                            <div class="inline-block px-3 py-1 bg-primary-50 text-primary-700 text-xs font-bold rounded-lg mb-3" x-text="activeProduct.toko"></div>
                                            <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-2 leading-tight" x-text="activeProduct.nama"></h3>
                                            <p class="text-3xl font-black text-primary-600 mb-4" x-text="activeProduct.harga"></p>
                                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-100 text-sm font-bold text-slate-600">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                                Stok Tersedia: <span x-text="activeProduct.stok" :class="activeProduct.stok < 1 ? 'text-rose-600' : 'text-slate-800'"></span>
                                            </div>
                                        </div>

                                        <div class="mb-8">
                                            <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-3">Deskripsi Produk</h4>
                                            <div class="prose prose-sm text-slate-600 max-w-none bg-slate-50 p-4 rounded-xl border border-slate-100" x-text="activeProduct.deskripsi">
                                            </div>
                                        </div>

                                        <div class="mt-auto pt-4 border-t border-slate-100">
                                            @if(Auth::check() && Auth::user()->isPembeli())
                                            <button type="button" @click="if(activeProduct.stok > 0) { addToCart(activeProduct.id); showProductModal = false; }"
                                                class="w-full py-3.5 rounded-xl font-bold text-white shadow-lg transition-all flex items-center justify-center gap-2"
                                                :class="activeProduct.stok < 1 ? 'bg-slate-300 shadow-none cursor-not-allowed' : 'bg-primary-600 hover:bg-primary-700 shadow-primary-600/30 hover:-translate-y-0.5'"
                                                :disabled="activeProduct.stok < 1">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                                <span x-text="activeProduct.stok < 1 ? 'Stok Habis' : 'Masukkan Keranjang'"></span>
                                            </button>
                                            @else
                                            <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-2 py-3.5 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl transition-colors">
                                                Masuk untuk Membeli
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            
            <div class="mt-16 text-center fade-in">
                <a href="{{ route('semua-produk') }}" class="inline-flex items-center justify-center bg-white border-2 border-primary-100 hover:border-primary-500 text-primary-700 px-8 py-3.5 rounded-xl font-bold transition-all hover:bg-primary-50 hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)]">
                    Lihat Semua Produk
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- DAFTAR TOKO -->
    <section id="daftar-toko" class="min-h-screen pt-12 pb-24 bg-gradient-to-b from-slate-50 via-white to-slate-50 relative">
        <!-- Smooth Background Transition Overlay -->
        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-slate-50 to-transparent"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">

            <div class="text-center mb-16 fade-in flex flex-col items-center">
                <div class="inline-flex items-center justify-center px-4 py-1.5 mb-4 rounded-full bg-primary-100 text-primary-700 font-bold text-sm tracking-wider uppercase shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Katalog Warga
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Toko Warga Terverifikasi</h2>
                <p class="mt-4 text-slate-600 text-lg max-w-2xl mx-auto font-medium">
                    Belanja aman dan nyaman dari UMKM lokal yang telah diverifikasi secara resmi oleh pengurus RT.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 fade-in">

                @foreach ($tokoList as $toko)
                    <div class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="aspect-video w-full overflow-hidden bg-slate-100 relative">
                            @if($toko->foto_toko_url)
                                <img src="{{ $toko->foto_toko_url }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $toko->nama_toko }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-primary-700 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                Buka
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-primary-600 transition-colors">{{ $toko->nama_toko }}</h3>

                            <p class="text-slate-500 mt-2 text-sm line-clamp-2">
                                {{ $toko->deskripsi_toko ?? 'Toko ini belum menambahkan deskripsi.' }}
                            </p>

                            <div class="mt-4 flex items-center text-slate-500 text-sm">
                                <svg class="w-4 h-4 mr-1 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $toko->lokasi }}
                            </div>

                            <div class="mt-6 pt-4 border-t border-slate-100">
                                <a href="{{ route('detail-toko', $toko->id) }}" class="flex items-center justify-between text-primary-600 hover:text-primary-700 font-semibold text-sm transition-colors w-full">
                                    <span>Lihat Etalase Toko</span>
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($tokoList->isEmpty())
                    <div class="col-span-full py-12 text-center bg-white rounded-2xl border border-slate-100 border-dashed">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        <p class="text-slate-500 font-medium">Belum ada toko yang terverifikasi.</p>
                        <p class="text-sm text-slate-400 mt-1">Jadilah yang pertama membuka toko di lingkungan Anda!</p>
                    </div>
                @endif

            </div>
            
            <div class="mt-12 text-center fade-in">
                <a href="{{ route('daftar-toko') }}" class="inline-flex items-center justify-center bg-white border-2 border-primary-100 hover:border-primary-500 text-primary-700 px-8 py-3.5 rounded-xl font-bold transition-all hover:bg-primary-50 hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)]">
                    Lihat Semua Toko
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>




    <!-- FOOTER -->
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-8 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center p-1.5 shadow-sm">
                            <img src="{{ asset('Image/logo.png') }}" alt="CeMas Logo" class="w-full h-full object-contain">
                        </div>
                        <span class="text-2xl font-black text-white tracking-tight">CeMas.</span>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed pr-4">
                        Community E-Marketplace Aston Villa. Menggerakkan ekonomi warga melalui digitalisasi UMKM lokal dengan semangat gotong royong.
                    </p>
                    <div class="flex gap-3 pt-2">
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary-500 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary-500 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary-500 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.597 0 0 .597 0 1.325v21.351C0 23.403.597 24 1.325 24h11.495v-9.294H9.691v-3.622h3.129V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.597 1.323-1.325v-21.35C24 .597 23.403 0 22.675 0z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold mb-5 uppercase tracking-wider text-sm">Tautan Cepat</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-primary-400 transition-colors text-sm">Beranda</a></li>
                        <li><a href="{{ route('daftar-toko') }}" class="hover:text-primary-400 transition-colors text-sm">Katalog Warga</a></li>
                        <li><a href="{{ route('tentang-cemas') }}" class="hover:text-primary-400 transition-colors text-sm">Tentang CeMas</a></li>
                        <li><a href="{{ route('register.pembeli') }}" class="hover:text-primary-400 transition-colors text-sm">Daftar sebagai Pembeli</a></li>
                        <li><a href="{{ route('register.penjual') }}" class="hover:text-primary-400 transition-colors text-sm">Buka Toko Warga</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-white font-bold mb-5 uppercase tracking-wider text-sm">Kategori</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('daftar-toko') }}" class="hover:text-primary-400 transition-colors text-sm">Sembako</a></li>
                        <li><a href="{{ route('daftar-toko') }}" class="hover:text-primary-400 transition-colors text-sm">Makanan & Minuman</a></li>
                        <li><a href="{{ route('daftar-toko') }}" class="hover:text-primary-400 transition-colors text-sm">Jasa & Servis</a></li>
                        <li><a href="{{ route('daftar-toko') }}" class="hover:text-primary-400 transition-colors text-sm">Pakaian</a></li>
                        <li><a href="{{ route('daftar-toko') }}" class="hover:text-primary-400 transition-colors text-sm">Kesehatan</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-white font-bold mb-5 uppercase tracking-wider text-sm">Hubungi Pengurus</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-sm">Sekretariat RT Aston Villa, <br>Perumahan Warga</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span class="text-sm">Grup WhatsApp Pengurus</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="text-sm">admin@cemas.local</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="pt-8 border-t border-slate-800 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} CeMas (Community E-Marketplace). Dibuat oleh Warga, untuk Warga.
                </p>
                <div class="flex gap-4 text-xs text-slate-500">
                    <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>
@endsection

@push('scripts')
    <script>
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('show');
            });
        });
        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

    </script>
@endpush
