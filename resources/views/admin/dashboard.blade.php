@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 min-h-screen">

    <!-- HEADER -->
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Dashboard Admin</h2>
            <p class="text-slate-500 mt-2 font-medium">Kelola data pengguna, penjual, dan toko di CeMas.</p>
        </div>
        <div class="text-sm font-bold text-slate-400 uppercase tracking-wider">
            {{ now()->format('l, d F Y') }}
        </div>
    </div>

    <!-- STAT CARDS -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-10">
        <!-- Total Pengguna -->
        <div class="bg-white rounded-[1.25rem] sm:rounded-3xl p-4 sm:p-6 border border-slate-100 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 sm:w-32 sm:h-32 bg-primary-50 rounded-full translate-x-10 -translate-y-10 sm:translate-x-16 sm:-translate-y-16 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10 flex flex-col-reverse sm:flex-row sm:items-start justify-between gap-2 sm:gap-0">
                <div>
                    <p class="text-[10px] sm:text-sm font-bold text-slate-400 uppercase tracking-wider mb-1 sm:mb-2 line-clamp-2 sm:line-clamp-1">Total Pengguna</p>
                    <h3 class="text-2xl sm:text-4xl font-extrabold text-slate-800">{{ $totalPengguna }}</h3>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-primary-100 text-primary-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Menunggu -->
        <div class="bg-white rounded-[1.25rem] sm:rounded-3xl p-4 sm:p-6 border border-slate-100 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 sm:w-32 sm:h-32 bg-amber-50 rounded-full translate-x-10 -translate-y-10 sm:translate-x-16 sm:-translate-y-16 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10 flex flex-col-reverse sm:flex-row sm:items-start justify-between gap-2 sm:gap-0">
                <div>
                    <p class="text-[10px] sm:text-sm font-bold text-slate-400 uppercase tracking-wider mb-1 sm:mb-2 line-clamp-2 sm:line-clamp-1">Toko Menunggu</p>
                    <h3 class="text-2xl sm:text-4xl font-extrabold text-amber-600">{{ $tokoMenunggu }}</h3>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Terverifikasi -->
        <div class="bg-white rounded-[1.25rem] sm:rounded-3xl p-4 sm:p-6 border border-slate-100 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 sm:w-32 sm:h-32 bg-emerald-50 rounded-full translate-x-10 -translate-y-10 sm:translate-x-16 sm:-translate-y-16 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10 flex flex-col-reverse sm:flex-row sm:items-start justify-between gap-2 sm:gap-0">
                <div>
                    <p class="text-[10px] sm:text-sm font-bold text-slate-400 uppercase tracking-wider mb-1 sm:mb-2 line-clamp-2 sm:line-clamp-1">Toko Terverif</p>
                    <h3 class="text-2xl sm:text-4xl font-extrabold text-emerald-600">{{ $tokoTerverifikasi }}</h3>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Ditolak -->
        <div class="bg-white rounded-[1.25rem] sm:rounded-3xl p-4 sm:p-6 border border-slate-100 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 sm:w-32 sm:h-32 bg-rose-50 rounded-full translate-x-10 -translate-y-10 sm:translate-x-16 sm:-translate-y-16 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10 flex flex-col-reverse sm:flex-row sm:items-start justify-between gap-2 sm:gap-0">
                <div>
                    <p class="text-[10px] sm:text-sm font-bold text-slate-400 uppercase tracking-wider mb-1 sm:mb-2 line-clamp-2 sm:line-clamp-1">Toko Ditolak</p>
                    <h3 class="text-2xl sm:text-4xl font-extrabold text-rose-600">{{ $tokoDitolak }}</h3>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>
    </div>


    <!-- AKSI CEPAT & TABEL -->
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-10">
        
        <!-- VERIFIKASI PENJUAL -->
        <div class="order-2 lg:order-1">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-extrabold text-slate-800">Menunggu Verifikasi</h3>
                <a href="{{ route('admin.semua-toko', ['status' => 'Menunggu']) }}" class="text-sm font-bold text-primary-600 hover:text-primary-700">Lihat Semua</a>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="py-4 px-6 font-bold text-slate-500 uppercase tracking-wider text-xs">Penjual & Toko</th>
                                <th class="py-4 px-6 font-bold text-slate-500 uppercase tracking-wider text-xs">Tanggal Daftar</th>
                                <th class="py-4 px-6 font-bold text-slate-500 uppercase tracking-wider text-xs text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($penjualPending as $toko)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold">
                                            {{ substr($toko->penjual->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">{{ $toko->penjual->user->name }}</p>
                                            <p class="text-xs font-medium text-slate-500">{{ $toko->nama_toko }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-4 px-6">
                                    <span class="font-medium text-slate-600">{{ $toko->created_at->format('d M Y') }}</span>
                                    <p class="text-xs text-slate-400 mt-0.5">{{ $toko->created_at->format('H:i') }} WIB</p>
                                </td>

                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('admin.detail-pengguna', $toko->penjual->user->id) }}"
                                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary-50 text-primary-700 font-bold rounded-xl hover:bg-primary-600 hover:text-white transition-colors text-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Tinjau
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-12 px-6 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 text-slate-400 mb-4">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-800 mb-1">Semua Toko Terverifikasi</h3>
                                    <p class="text-slate-500 font-medium">Tidak ada penjual yang menunggu verifikasi saat ini.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- AKSI CEPAT -->
        <div class="order-1 lg:order-2">
            <h3 class="text-xl font-extrabold text-slate-800 mb-6">Aksi Cepat</h3>

            <div class="flex flex-col gap-4">
                <a href="{{ route('admin.semua-pengguna') }}"
                    class="group flex items-center justify-between p-5 bg-primary-600 hover:bg-primary-700 text-white rounded-2xl shadow-lg shadow-primary-600/20 transition-all hover:-translate-y-1">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <span class="font-bold">Kelola Pengguna</span>
                    </div>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>

                <a href="{{ route('admin.semua-toko', ['status' => 'Terverifikasi']) }}"
                    class="group flex items-center justify-between p-5 bg-white border border-slate-200 hover:border-emerald-300 hover:bg-emerald-50 rounded-2xl transition-all">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-slate-100 group-hover:bg-emerald-100 text-slate-500 group-hover:text-emerald-600 rounded-xl flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="font-bold text-slate-700 group-hover:text-emerald-700 transition-colors">Toko Aktif</span>
                    </div>
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-emerald-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>

                <a href="{{ route('admin.semua-toko', ['status' => 'Ditolak']) }}"
                    class="group flex items-center justify-between p-5 bg-white border border-slate-200 hover:border-rose-300 hover:bg-rose-50 rounded-2xl transition-all">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-slate-100 group-hover:bg-rose-100 text-slate-500 group-hover:text-rose-600 rounded-xl flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="font-bold text-slate-700 group-hover:text-rose-700 transition-colors">Toko Ditolak</span>
                    </div>
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-rose-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
