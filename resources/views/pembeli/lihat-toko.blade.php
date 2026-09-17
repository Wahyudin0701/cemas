@extends('layouts.index')

@section('title', "$toko->nama_toko - CeMas")

@push('styles')
    <style>
        .fade-in {
            animation: fadeIn 0.6s ease-in-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
@endpush

@section('konten')
    <div id="mainWrapper" class="min-h-screen bg-gray-50 pb-24 transition-all duration-300">
        <!-- NAVBAR -->
        <nav class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between gap-4">
                <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('pembeli.dashboard') }}"
                    class="flex items-center text-gray-700 hover:text-blue-600 transition-colors text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
                
                @if(Auth::check() && Auth::user()->isPembeli())
                <a href="{{ route('keranjang.index') }}" class="relative p-2 text-gray-700 hover:text-blue-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <span id="cartCountBadge"
                        class="absolute top-0 right-0 bg-red-500 text-white text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center hidden border-2 border-white">0</span>
                </a>
                @endif
            </div>
        </nav>

        <div>
            @php
                $now = \Carbon\Carbon::now('Asia/Jakarta')->format('H:i:s');
                $buka = $toko->jam_buka;
                $tutup = $toko->jam_tutup;
                
                if ($tutup < $buka) {
                    $isOpen = $now >= $buka || $now <= $tutup;
                } else {
                    $isOpen = $now >= $buka && $now <= $tutup;
                }
            @endphp
            
            <!-- HEADER / BANNER TOKO (Storefront Awning Style) -->
            <header class="relative w-full pt-16 pb-32 sm:pb-40 bg-gray-900 overflow-hidden fade-in" style="animation-delay: 0.1s;">
                @if ($toko->foto_toko_url)
                    <img src="{{ $toko->foto_toko_url }}"
                        class="absolute inset-0 w-full h-full object-cover opacity-40">
                @else
                    <div class="absolute inset-0 bg-gradient-to-b from-gray-800 to-gray-900 opacity-80"></div>
                @endif
                <!-- Storefront Awning Pattern (CSS Striped Background) -->
                <div class="absolute top-0 w-full h-8 sm:h-12 shadow-lg z-10" style="background: repeating-linear-gradient(90deg, #ef4444 0, #ef4444 60px, #ffffff 60px, #ffffff 120px);"></div>
                <div class="absolute top-8 sm:top-12 w-full flex h-4 z-10 overflow-hidden opacity-90">
                    <!-- Scalloped edges for awning -->
                    <div class="w-full h-full" style="background-image: radial-gradient(circle at 30px 0, transparent 0, transparent 30px, #ef4444 31px); background-size: 120px 20px; background-position: 0 0; background-repeat: repeat-x;"></div>
                </div>

                <!-- Overlay gradient -->
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
                
                <!-- Welcome Text -->
                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 text-center pt-8">
                    <p class="text-white/80 font-bold tracking-widest uppercase text-sm mb-2">Selamat Datang di</p>
                    <h1 class="text-4xl md:text-5xl font-black text-white drop-shadow-lg mb-4">{{ $toko->nama_toko }}</h1>
                </div>
            </header>

            <!-- KONTEN -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 relative z-20 -mt-24 sm:-mt-28">
                <!-- INFO TOKO / PROFIL SIGNBOARD -->
                <div class="bg-white rounded-t-3xl rounded-b-xl shadow-2xl border-4 border-gray-100 p-6 sm:p-8 fade-in relative" style="animation-delay: 0.2s;">
                    <!-- Hanging Sign UI elements -->
                    <div class="hidden sm:block absolute -top-16 left-12 w-2 h-16 bg-gray-300 shadow-sm"></div>
                    <div class="hidden sm:block absolute -top-16 right-12 w-2 h-16 bg-gray-300 shadow-sm"></div>
                    
                    <div class="flex flex-col sm:flex-row gap-6 items-start sm:items-center">
                        <!-- Avatar Toko -->
                        <div class="relative shrink-0">
                            @if ($toko->foto_toko_url)
                                <img src="{{ $toko->foto_toko_url }}" alt="{{ $toko->nama_toko }}" class="w-24 h-24 sm:w-32 sm:h-32 rounded-2xl object-cover shadow-inner border-4 border-gray-50 ring-4 ring-white">
                            @else
                                <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-700 shadow-inner border-4 border-gray-50 flex items-center justify-center text-4xl sm:text-5xl font-black text-white uppercase ring-4 ring-white">
                                    {{ substr($toko->nama_toko, 0, 1) }}
                                </div>
                            @endif
                            <!-- Status Badge -->
                            @if($isOpen)
                                <div class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg border-2 border-white whitespace-nowrap flex items-center gap-1.5">
                                    <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span> BUKA
                                </div>
                            @else
                                <div class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 bg-red-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg border-2 border-white whitespace-nowrap flex items-center gap-1.5">
                                    TUTUP
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex-1 w-full pt-2 sm:pt-0">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2 flex items-center gap-2">
                                Profil Toko
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.956 11.956 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </h2>
                            <p class="text-gray-600 mb-6 max-w-3xl leading-relaxed text-sm sm:text-base">{{ $toko->deskripsi_toko ?? 'Toko ini belum menambahkan deskripsi.' }}</p>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="bg-gray-50 p-3 sm:p-4 rounded-xl border border-gray-100 flex flex-col justify-center">
                                    <p class="text-[10px] sm:text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Pemilik</p>
                                    <p class="text-sm font-semibold text-gray-900 truncate flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        {{ $toko->penjual->user->name }}
                                    </p>
                                </div>
                                
                                <div class="bg-gray-50 p-3 sm:p-4 rounded-xl border border-gray-100 flex flex-col justify-center">
                                    <p class="text-[10px] sm:text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Lokasi</p>
                                    <div class="text-sm font-semibold text-gray-900 flex items-start gap-2">
                                        <svg class="w-4 h-4 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <span class="break-words leading-snug">{{ $toko->lokasi }}</span>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 p-3 sm:p-4 rounded-xl border border-gray-100 flex flex-col justify-center">
                                    <p class="text-[10px] sm:text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Kontak</p>
                                    <p class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        {{ $toko->penjual->phone }}
                                    </p>
                                </div>
                                
                                <div class="bg-gray-50 p-3 sm:p-4 rounded-xl border border-gray-100 flex flex-col justify-center relative overflow-hidden">
                                    <div class="absolute top-0 right-0 w-10 h-10 bg-blue-100 rounded-bl-full -mr-2 -mt-2"></div>
                                    <p class="text-[10px] sm:text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Jam Operasional</p>
                                    <p class="text-sm font-semibold {{ $isOpen ? 'text-green-600' : 'text-red-600' }} flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ \Carbon\Carbon::parse($toko->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($toko->jam_tutup)->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PRODUK SECTION (Shelf Style) -->
                <div class="mt-8 mb-12 fade-in relative" style="animation-delay: 0.3s;">
                    
                    <div class="flex items-center justify-between mb-6 bg-gray-800 text-white p-4 rounded-xl shadow-md border-b-4 border-gray-900">
                        <h2 class="text-xl sm:text-2xl font-bold flex items-center gap-2">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                            Etalase Produk
                        </h2>
                        <span class="bg-gray-900 text-gray-300 text-xs font-bold px-3 py-1 rounded-full shadow-inner">{{ $toko->produks->count() }} Produk</span>
                    </div>

                    <!-- Papan Rak / Shelf background -->
                    <div class="bg-[#f4f1ea] rounded-2xl p-4 sm:p-6 shadow-inner border-t-8 border-[#e6e2d8] relative" x-data="{ showProductModal: false, activeProduct: null }">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6 relative z-10">
                            @forelse ($toko->produks as $produk)
                                <div class="bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 group flex flex-col h-full transform hover:-translate-y-1">
                                    <div class="relative overflow-hidden aspect-square bg-gray-50 border-b border-gray-100 cursor-pointer" 
                                         @click="activeProduct = { id: '{{ $produk->id }}', nama: '{{ addslashes($produk->nama_produk) }}', harga: 'Rp{{ number_format($produk->harga, 0, ',', '.') }}', stok: {{ $produk->stok }}, deskripsi: '{{ addslashes(str_replace(array("\r", "\n"), '', $produk->deskripsi ?? 'Tidak ada deskripsi.')) }}', foto: '{{ $produk->foto_produk_url ?? 'https://placehold.co/400x400?text=Produk' }}' }; showProductModal = true">
                                    @if ($produk->foto_produk_url)
                                        <img src="{{ $produk->foto_produk_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $produk->nama_produk }}">
                                    @else
                                        <img src="https://placehold.co/400x400?text=Produk" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Placeholder">
                                    @endif
                                    
                                    @if($produk->stok < 1)
                                    <div class="absolute inset-0 bg-white/60 backdrop-blur-[2px] flex items-center justify-center">
                                        <span class="bg-red-500 text-white font-bold px-3 py-1.5 rounded shadow-lg text-sm rotate-[-10deg]">STOK HABIS</span>
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="p-4 flex flex-col flex-1">
                                    <h3 class="font-semibold text-gray-800 text-sm mb-1 line-clamp-2 flex-1 cursor-pointer hover:text-blue-600 transition-colors" title="{{ $produk->nama_produk }}"
                                        @click="activeProduct = { id: '{{ $produk->id }}', nama: '{{ addslashes($produk->nama_produk) }}', harga: 'Rp{{ number_format($produk->harga, 0, ',', '.') }}', stok: {{ $produk->stok }}, deskripsi: '{{ addslashes(str_replace(array("\r", "\n"), '', $produk->deskripsi ?? 'Tidak ada deskripsi.')) }}', foto: '{{ $produk->foto_produk_url ?? 'https://placehold.co/400x400?text=Produk' }}' }; showProductModal = true">
                                        {{ $produk->nama_produk }}
                                    </h3>

                                    <div class="mt-2 mb-3">
                                        <p class="text-blue-600 font-bold text-lg">Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                                        <p class="text-xs text-gray-500 mt-1 flex items-center">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                            Stok: <span class="font-semibold text-gray-700 ml-1">{{ $produk->stok }}</span>
                                        </p>
                                    </div>

                                    @if(Auth::check() && Auth::user()->isPembeli())
                                    <button type="button" onclick="addToCart('{{ $produk->id }}')"
                                        class="mt-auto w-full bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm py-2 rounded-xl flex items-center justify-center gap-2 transition active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                                        {{ $produk->stok < 1 ? 'disabled' : '' }}>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        {{ $produk->stok < 1 ? 'Habis' : '+ Keranjang' }}
                                    </button>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white rounded-2xl shadow-sm border border-gray-100 p-12 flex flex-col items-center justify-center text-center">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                <h3 class="text-lg font-bold text-gray-800 mb-2">Belum ada produk</h3>
                                <p class="text-gray-500 max-w-md text-sm">Toko ini masih kosong dan belum menambahkan produk apapun ke etalase.</p>
                            </div>
                        @endforelse
                        </div>

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
                                                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-2 leading-tight" x-text="activeProduct.nama"></h3>
                                                    <p class="text-3xl font-black text-blue-600 mb-4" x-text="activeProduct.harga"></p>
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
                                                        :class="activeProduct.stok < 1 ? 'bg-slate-300 shadow-none cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700 shadow-blue-600/30 hover:-translate-y-0.5'"
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
                </div>
            </section>
        </div>
    </div>

@endsection
