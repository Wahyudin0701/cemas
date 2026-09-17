@extends('layouts.index')

@section('title', 'Katalog Produk')

@push('styles')
    <style>
        .fade-in {
            opacity: 0;
            transform: translateY(15px);
            transition: all 0.6s ease-out;
        }

        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
@endpush

@section('konten')
    <x-navbar />

    <div class="min-h-screen bg-slate-50 pt-8 pb-24 relative">
        <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-primary-50 to-transparent pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">

            <div class="text-center mb-10 fade-in flex flex-col items-center">
                <div class="inline-flex items-center justify-center px-4 py-1.5 mb-4 rounded-full bg-primary-100 text-primary-700 font-bold text-sm tracking-wider uppercase shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Semua Produk
                </div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight mb-4">Temukan Kebutuhan Anda</h1>
                <p class="mt-2 text-slate-600 text-lg max-w-2xl mx-auto font-medium">
                    Jelajahi berbagai produk dari semua toko terverifikasi di lingkungan Anda.
                </p>
                
                <!-- Search Filter -->
                <form action="{{ route('semua-produk') }}" method="GET" class="w-full max-w-lg mt-8 relative flex items-center">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." class="w-full pl-11 pr-32 py-3.5 rounded-2xl border-none ring-1 ring-slate-200 shadow-sm focus:ring-2 focus:ring-primary-500 bg-white text-slate-900 placeholder-slate-400">
                    <button type="submit" class="absolute right-2 px-5 py-2 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-sm text-sm">
                        Cari
                    </button>
                </form>
                
                @if(request()->has('search') && request()->search != '')
                    <div class="mt-4 text-slate-500">
                        Menampilkan hasil pencarian untuk: <span class="font-bold text-slate-800">"{{ request('search') }}"</span>
                        <a href="{{ route('semua-produk') }}" class="ml-2 text-primary-600 hover:underline text-sm">Reset</a>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 fade-in" x-data="{ showProductModal: false, activeProduct: null }">
                @forelse ($produks as $produk)
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
                @empty
                    <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-slate-200 shadow-sm border-dashed">
                        <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Produk Tidak Ditemukan</h3>
                        <p class="text-slate-500 font-medium">Maaf, kami tidak menemukan produk yang sesuai dengan pencarian Anda.</p>
                        @if(request()->has('search'))
                            <a href="{{ route('semua-produk') }}" class="mt-4 inline-flex px-6 py-2.5 bg-primary-50 text-primary-700 font-bold rounded-xl hover:bg-primary-100 transition-colors">Tampilkan Semua Produk</a>
                        @endif
                    </div>
                @endforelse

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
            
            @if($produks->hasPages())
                <div class="mt-12 flex justify-center fade-in">
                    {{ $produks->links() }}
                </div>
            @endif

        </div>
    </div>

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
                        <li><a href="{{ url('/') }}" class="hover:text-primary-400 transition-colors text-sm">Beranda</a></li>
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
