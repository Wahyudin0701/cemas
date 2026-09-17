@extends('layouts.admin')

@section('title', 'Semua Toko')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 fade-in min-h-screen">

    <!-- HEADER -->
    <div class="mb-10">
        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Semua Toko</h2>
        <p class="text-slate-500 mt-2 font-medium">Pantau dan kelola seluruh toko yang terdaftar di CeMas.</p>
    </div>

    <!-- SEARCH + FILTER -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 mb-10">
        <form method="GET" action="{{ route('admin.semua-toko') }}" class="flex flex-col md:flex-row md:items-center gap-4">
            
            <!-- Search Input -->
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama toko atau penjual..."
                    class="w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-2xl bg-slate-50 font-medium text-slate-700 focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none">
            </div>

            <!-- Filter Status -->
            <div class="relative w-full md:w-64">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                </div>
                <select name="status" onchange="this.form.submit()" class="w-full pl-11 pr-10 py-3.5 border border-slate-200 rounded-2xl bg-slate-50 font-medium text-slate-700 focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none cursor-pointer appearance-none bg-none">
                    <option value="">Semua Status</option>
                    <option value="Terverifikasi" {{ request('status') == 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
            
            <!-- Submit Button (Hidden on change, but useful for Enter key on search) -->
            <button type="submit" class="hidden md:flex px-6 py-3.5 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-2xl shadow-lg shadow-primary-600/30 transition-all hover:-translate-y-0.5">
                Cari
            </button>
        </form>
    </div>

    <!-- PENJUAL LIST -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="toko-grid">
        @forelse($tokos as $toko)
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all group flex flex-col h-full toko-card" data-status="{{ strtolower($toko->status_verifikasi) }}">
                
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-primary-50 border-2 border-white shadow flex items-center justify-center font-bold text-xl text-primary-700 overflow-hidden relative">
                        @if(isset($toko->foto_toko) && $toko->foto_toko)
                            <img src="{{ $toko->foto_toko_url }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($toko->nama_toko, 0, 1) }}
                        @endif
                    </div>
                    
                    @if($toko->status_verifikasi === 'Terverifikasi')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold uppercase tracking-wider rounded-xl">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Terverifikasi
                        </span>
                    @elseif($toko->status_verifikasi === 'Menunggu')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-700 border border-amber-200 text-[10px] font-bold uppercase tracking-wider rounded-xl">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                            Menunggu
                        </span>
                    @elseif($toko->status_verifikasi === 'Ditolak')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-bold uppercase tracking-wider rounded-xl">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                            Ditolak
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-50 text-slate-700 border border-slate-200 text-[10px] font-bold uppercase tracking-wider rounded-xl">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                            {{ $toko->status_verifikasi }}
                        </span>
                    @endif
                </div>

                <div class="flex-grow">
                    <h3 class="text-xl font-extrabold text-slate-800 line-clamp-1 mb-1 group-hover:text-primary-600 transition-colors">{{ $toko->nama_toko }}</h3>
                    <p class="text-sm font-medium text-slate-500 flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        {{ $toko->penjual->user->name }}
                    </p>
                    
                    <p class="text-xs text-slate-400 mt-4 flex items-center gap-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Didaftarkan {{ $toko->created_at->format('d M Y') }}
                    </p>
                </div>

                <div class="mt-6 pt-5 border-t border-slate-100">
                    <a href="{{ route('admin.detail-pengguna', $toko->penjual->user->id) }}" class="flex items-center justify-center gap-2 w-full py-2.5 bg-slate-50 hover:bg-primary-50 text-slate-700 hover:text-primary-700 font-bold text-sm rounded-xl transition-colors border border-slate-200 hover:border-primary-200">
                        Lihat Detail
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-slate-200 shadow-sm">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 text-slate-400 mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Toko Tidak Ditemukan</h3>
                <p class="text-slate-500 font-medium max-w-md mx-auto">{{ request('status') || request('search') ? 'Tidak ada toko yang sesuai dengan filter pencarian Anda.' : 'Belum ada penjual yang mendaftarkan toko di sistem.' }}</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
