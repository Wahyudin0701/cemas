@extends('layouts.index')

@section('title', 'Katalog Toko Warga')

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
    </style>
@endpush

@section('konten')
    <x-navbar />

    <div class="min-h-screen bg-slate-50 pt-8 pb-24 relative">
        <!-- Smooth Background Transition Overlay -->
        <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-primary-50 to-transparent pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">

            <div class="text-center mb-10 fade-in flex flex-col items-center">
                <div class="inline-flex items-center justify-center px-4 py-1.5 mb-4 rounded-full bg-primary-100 text-primary-700 font-bold text-sm tracking-wider uppercase shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Katalog Warga
                </div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight mb-4">Toko Warga Terverifikasi</h1>
                <p class="mt-2 text-slate-600 text-lg max-w-2xl mx-auto font-medium">
                    Belanja aman dan nyaman dari UMKM lokal yang telah diverifikasi secara resmi oleh pengurus RT.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 fade-in">

                @foreach ($tokoList as $toko)
                    <div class="group bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="aspect-video w-full overflow-hidden bg-slate-100 relative">
                            @if($toko->foto_toko_url)
                                <img src="{{ $toko->foto_toko_url }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $toko->nama_toko }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400 bg-gradient-to-br from-slate-100 to-slate-200">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-primary-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Buka
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-primary-600 transition-colors">{{ $toko->nama_toko }}</h3>

                            <p class="text-slate-500 mt-2 text-sm line-clamp-2 leading-relaxed">
                                {{ $toko->deskripsi_toko ?? 'Toko ini belum menambahkan deskripsi.' }}
                            </p>

                            <div class="mt-4 flex items-start text-slate-500 text-sm">
                                <svg class="w-4 h-4 mr-2 mt-0.5 text-primary-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="line-clamp-1" title="{{ $toko->lokasi }}">{{ $toko->lokasi }}</span>
                            </div>

                            <div class="mt-6 pt-4 border-t border-slate-100">
                                <a href="{{ route('detail-toko', $toko->id) }}" class="flex items-center justify-between text-primary-600 hover:text-primary-700 font-semibold text-sm transition-colors w-full group/btn">
                                    <span>Lihat Etalase Toko</span>
                                    <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center group-hover/btn:bg-primary-100 transition-colors">
                                        <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($tokoList->isEmpty())
                    <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-slate-200 shadow-sm border-dashed">
                        <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Toko Belum Tersedia</h3>
                        <p class="text-slate-500 font-medium">Belum ada toko yang terverifikasi.</p>
                        <p class="text-sm text-slate-400 mt-1">Jadilah yang pertama membuka toko di lingkungan Anda!</p>
                        
                        @guest
                        <div class="mt-8">
                            <a href="{{ route('register.penjual') }}" class="inline-flex items-center justify-center bg-primary-600 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-primary-700 transition-colors shadow-sm">
                                Buka Toko Sekarang
                            </a>
                        </div>
                        @endguest
                    </div>
                @endif

            </div>
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
