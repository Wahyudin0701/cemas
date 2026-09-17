@extends('layouts.pembeli')

@section('title', 'Beranda Pembeli - CeMas')

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

@section('content')

    <!-- HERO SECTION -->
    <section class="pt-32 pb-16 min-h-[60vh] flex items-center fade-in bg-gradient-to-br from-slate-50 via-primary-50/50 to-primary-100/30">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <div class="inline-block px-4 py-1.5 rounded-full bg-primary-100 text-primary-700 font-semibold text-sm mb-2 shadow-sm border border-primary-200">
                    👋 Selamat datang, {{ Auth::user()->name }}
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-[1.1] tracking-tight">
                    Mulai Belanja dari <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-primary-400">Toko Tetangga</span>
                </h1>
                
                <p class="text-lg text-slate-600 max-w-lg leading-relaxed font-medium">
                    Temukan bahan pokok, makanan, dan kebutuhan lainnya dari UMKM warga di sekitar Anda.
                </p>

                <div class="pt-4 flex items-center gap-4">
                    <a href="#daftar-toko" class="inline-flex items-center justify-center bg-primary-600 hover:bg-primary-700 text-white px-8 py-3.5 rounded-xl font-semibold shadow-lg shadow-primary-600/30 transition-all hover:-translate-y-0.5">
                        Jelajahi Toko
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
            <div class="hidden md:block relative">
                <div class="absolute inset-0 bg-primary-200 rounded-3xl transform rotate-3 scale-105 opacity-50 blur-lg"></div>
                <img src="{{ asset('Image/lorong_asvil.jpg') }}" class="relative rounded-3xl shadow-2xl object-cover h-[400px] w-full hover:scale-[1.02] transition-transform duration-500 border-4 border-white" alt="Lorong Aston Villa">
            </div>
        </div>
    </section>

    <!-- DAFTAR TOKO -->
    <section id="daftar-toko" class="min-h-screen py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16 fade-in">
                <span class="text-primary-600 font-semibold tracking-wider uppercase text-sm mb-2 block">Katalog Warga</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">Toko Warga Terverifikasi</h2>
                <p class="mt-4 text-slate-600 text-lg max-w-2xl mx-auto">
                    Pilih toko langganan Anda dan nikmati kemudahan berbelanja langsung dari warga sekitar.
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
                                    <span>Masuk ke Toko</span>
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
                        <p class="text-sm text-slate-400 mt-1">Coba kembali beberapa saat lagi.</p>
                    </div>
                @endif

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-white py-8 text-center border-t border-slate-800">
        <p class="text-slate-400 font-medium tracking-wide">© {{ date('Y') }} CeMas — Dibuat oleh Warga, untuk Warga.</p>
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
