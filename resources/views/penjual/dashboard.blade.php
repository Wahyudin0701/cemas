@extends('layouts.penjual')

@section('title', 'Dashboard Penjual')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 fade-in min-h-screen">
    
    <!-- Welcome Header Card -->
    <div class="bg-white rounded-[2rem] p-6 sm:p-10 shadow-sm border border-slate-100 relative overflow-hidden mb-10 flex flex-col sm:flex-row items-center sm:items-start gap-6 sm:gap-8 text-center sm:text-left">
        <!-- Decorative bg -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-primary-50 to-primary-100/50 rounded-full translate-x-1/3 -translate-y-1/3 blur-2xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-slate-50 rounded-full -translate-x-1/2 translate-y-1/2 blur-xl pointer-events-none"></div>
        
        <!-- Store Image -->
        <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-3xl overflow-hidden shrink-0 shadow-lg shadow-slate-200/50 border-4 border-white relative z-10 group">
            @if($toko->foto_toko_url)
                <img src="{{ $toko->foto_toko_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            @else
                <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
            @endif
        </div>
        
        <!-- Greeting -->
        <div class="relative z-10 flex-1 pt-2">
            <span class="inline-block px-3 py-1 rounded-full bg-primary-100 text-primary-700 text-xs font-bold tracking-wide uppercase mb-3">Toko Anda</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">{{ $toko->nama_toko }}</h2>
            <p class="text-slate-500 font-medium mt-2 max-w-2xl">Selamat datang kembali! Kelola produk, pantau pesanan masuk, dan tingkatkan penjualan toko Anda hari ini.</p>
        </div>
    </div>

    <!-- STATS & QUICK ACTIONS -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-12">
        
        <!-- Stat Card -->
        <div class="lg:col-span-4 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary-50 rounded-full translate-x-16 -translate-y-16 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-2">Total Produk</p>
                    <h3 class="text-4xl font-extrabold text-slate-800">{{ $totalProduk }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-primary-100 text-primary-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>
            <div class="relative z-10 mt-6 pt-4 border-t border-slate-50">
                <a href="{{ route('penjual.tambah-produk') }}" class="text-sm font-bold text-primary-600 hover:text-primary-700 flex items-center gap-1 group/link">
                    Tambah produk baru
                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="lg:col-span-8 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex flex-col justify-center">
            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Aksi Cepat</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('penjual.pesanan') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-slate-100 bg-slate-50 hover:bg-white hover:border-primary-200 hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 group-hover:text-primary-700 transition-colors">Kelola Pesanan</h4>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Lihat pesanan masuk & diproses</p>
                    </div>
                </a>

                <a href="{{ route('penjual.toko') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-slate-100 bg-slate-50 hover:bg-white hover:border-primary-200 hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 group-hover:text-primary-700 transition-colors">Pengaturan Toko</h4>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Edit profil dan info toko</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- ETALASE PRODUK -->
    <div>
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
            <div>
                <h3 class="text-2xl font-bold text-slate-900 tracking-tight">Etalase Produk</h3>
                <p class="text-slate-500 font-medium mt-1">Daftar produk yang Anda jual di toko ini.</p>
            </div>
            <a href="{{ route('penjual.tambah-produk') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah
            </a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            @forelse($produkList as $produk)
                <div class="group bg-white rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-xl overflow-hidden flex flex-col">
                    <!-- FOTO PRODUK -->
                    <div class="aspect-square bg-slate-100 relative overflow-hidden">
                        @if($produk->foto_produk_url)
                            <img src="{{ $produk->foto_produk_url }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        
                        @if($produk->stok < 1)
                            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-[2px] flex items-center justify-center">
                                <span class="bg-rose-500 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider shadow-lg">Habis</span>
                            </div>
                        @endif
                    </div>

                    <div class="p-4 sm:p-5 flex flex-col flex-grow">
                        <h3 class="font-bold text-slate-800 text-sm md:text-base line-clamp-2 leading-tight flex-grow group-hover:text-primary-600 transition-colors">
                            {{ $produk->nama_produk }}
                        </h3>

                        <div class="mt-3">
                            <p class="text-primary-600 font-extrabold text-lg tracking-tight">
                                Rp{{ number_format($produk->harga, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-slate-400 font-medium mt-1">Stok: {{ $produk->stok }}</p>
                        </div>

                        <a href="{{ route('penjual.detail-produk', $produk->id) }}"
                            class="mt-4 w-full bg-slate-50 hover:bg-slate-100 text-slate-700 font-bold text-sm py-2.5 rounded-xl border border-slate-200 transition-colors text-center block">
                            Kelola Produk
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-slate-200 border-dashed">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Belum Ada Produk</h3>
                    <p class="text-slate-500 mt-1 mb-6 max-w-md mx-auto">Toko Anda belum memiliki produk. Tambahkan produk pertama Anda sekarang untuk mulai berjualan.</p>
                    <a href="{{ route('penjual.tambah-produk') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-primary-600/30 hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Produk
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
