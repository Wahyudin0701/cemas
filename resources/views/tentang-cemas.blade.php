@extends('layouts.index')

@section('title', 'Tentang CeMas')

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

    <!-- TENTANG KAMI -->
    <section class="min-h-screen pt-24 pb-24 relative overflow-hidden bg-slate-50">
        <!-- Decorative Blurs -->
        <div class="absolute top-20 -left-32 w-96 h-96 bg-primary-200/40 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-20 -right-32 w-96 h-96 bg-amber-200/30 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                
                <!-- Left Content: Text & Context -->
                <div class="fade-in space-y-8">
                    <div>
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-slate-200 text-slate-700 font-bold text-xs tracking-widest uppercase shadow-sm mb-6">
                            <span class="w-2 h-2 rounded-full bg-primary-500"></span>
                            Tentang Cemas
                        </div>
                        <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.15]">
                            Mengenal CeMas <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-blue-400">Lebih Dekat.</span>
                        </h1>
                        <p class="mt-6 text-slate-600 text-lg leading-relaxed font-medium max-w-lg">
                            Community E-Marketplace Aston Villa hadir untuk menciptakan ekosistem ekonomi digital yang saling mendukung antartetangga. Belanja jadi lebih mudah, cepat, dan terpercaya.
                        </p>
                    </div>

                    <!-- List Features -->
                    <div class="space-y-5 pt-4">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 shrink-0 rounded-2xl bg-white shadow-sm border border-slate-100 flex items-center justify-center text-emerald-500 mt-1">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.956 11.956 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900">Aman & Terverifikasi</h4>
                                <p class="text-slate-500 text-sm mt-1 leading-relaxed">Keamanan adalah prioritas. Setiap toko dan penjual telah melalui proses verifikasi oleh pengurus RT.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 shrink-0 rounded-2xl bg-white shadow-sm border border-slate-100 flex items-center justify-center text-amber-500 mt-1">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900">Dari dan Untuk Komunitas</h4>
                                <p class="text-slate-500 text-sm mt-1 leading-relaxed">Dirancang eksklusif untuk lingkungan warga. Ongkos kirim lebih murah dan silaturahmi tetap terjaga.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-4">
                        @guest
                            <a href="{{ route('register.pembeli') }}" class="inline-flex items-center justify-center bg-primary-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-primary-700 transition-colors shadow-[0_4px_14px_0_rgb(37,99,235,0.39)]">
                                Gabung Sekarang
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        @else
                            <a href="{{ route('daftar-toko') }}" class="inline-flex items-center justify-center bg-white border border-slate-200 text-slate-700 px-6 py-3 rounded-xl font-bold hover:bg-slate-50 transition-colors shadow-sm">
                                Jelajahi Toko Warga
                            </a>
                        @endguest
                    </div>
                </div>

                <!-- Right Content: Staggered Bento Grid -->
                <div class="relative fade-in">
                    <!-- Grid Container -->
                    <div class="grid grid-cols-2 gap-4 md:gap-6 relative z-10">
                        
                        <!-- Left Column (Pushed Down) -->
                        <div class="space-y-4 md:space-y-6 pt-12 md:pt-16">
                            <!-- Image/Decorative Card -->
                            <div class="bg-white rounded-3xl p-6 h-48 md:h-56 relative overflow-hidden border border-slate-100 shadow-xl shadow-slate-200/40 group">
                                <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-primary-50 opacity-50 group-hover:scale-150 transition-transform duration-700 ease-out"></div>
                                <div class="relative z-10 h-full flex flex-col justify-end">
                                    <div class="w-12 h-12 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 mb-4 group-hover:bg-primary-500 group-hover:text-white transition-colors duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                    </div>
                                    <h4 class="text-slate-900 font-bold text-lg md:text-xl leading-tight group-hover:text-primary-600 transition-colors duration-300">Pertumbuhan<br>Ekonomi Lokal</h4>
                                </div>
                            </div>
                            
                            <!-- Stat Card -->
                            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-xl shadow-slate-200/40 text-center">
                                <p class="text-4xl font-black text-slate-800 tracking-tighter">100<span class="text-primary-500">%</span></p>
                                <p class="text-sm font-bold text-slate-500 mt-1 uppercase tracking-wider">Amanah</p>
                            </div>
                        </div>
                        
                        <!-- Right Column -->
                        <div class="space-y-4 md:space-y-6">
                            <!-- Stat Card -->
                            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-xl shadow-slate-200/40">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="flex -space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 border-2 border-white flex items-center justify-center text-xs font-bold text-blue-600">RT</div>
                                        <div class="w-8 h-8 rounded-full bg-amber-100 border-2 border-white flex items-center justify-center text-xs font-bold text-amber-600">RW</div>
                                        <div class="w-8 h-8 rounded-full bg-slate-100 border-2 border-white flex items-center justify-center text-xs font-bold text-slate-600">+</div>
                                    </div>
                                </div>
                                <h4 class="font-bold text-slate-800">Dukungan Penuh</h4>
                                <p class="text-xs text-slate-500 mt-1">Sistem disetujui resmi.</p>
                            </div>
                            
                            <!-- Main Feature Card -->
                            <div class="bg-white rounded-3xl p-6 md:p-8 border border-slate-100 shadow-xl shadow-slate-200/40">
                                <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 mb-2">Pemberdayaan UMKM</h3>
                                <p class="text-slate-600 text-sm leading-relaxed">
                                    Membuka peluang bagi warga untuk mandiri secara ekonomi melalui platform jualan digital yang terstruktur.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
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
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold mb-5 uppercase tracking-wider text-sm">Tautan Cepat</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ url('/') }}" class="hover:text-primary-400 transition-colors text-sm">Beranda</a></li>
                        <li><a href="{{ route('semua-produk') }}" class="hover:text-primary-400 transition-colors text-sm">Produk</a></li>
                        <li><a href="{{ route('daftar-toko') }}" class="hover:text-primary-400 transition-colors text-sm">Katalog Warga</a></li>
                        <li><a href="{{ route('tentang-cemas') }}" class="hover:text-primary-400 transition-colors text-sm">Tentang CeMas</a></li>
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
                            <span class="text-sm">Sekretariat RT Aston Villa</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="pt-8 border-t border-slate-800 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} CeMas (Community E-Marketplace). Dibuat oleh Warga, untuk Warga.
                </p>
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
