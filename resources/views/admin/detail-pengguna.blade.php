@extends('layouts.admin')

@section('title', 'Detail Pengguna')

@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush

@section('content')
    <div x-data="{ showConfirm: false, showToggle: false, actionType: null }">
        <div class="max-w-6xl mx-auto px-6 py-12 min-h-screen">
            
            <!-- BREADCRUMB & HEADER -->
            <div class="mb-10">
                <div class="flex items-center gap-2 text-sm font-medium text-slate-500 mb-4">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-primary-600 transition-colors">Dashboard</a>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <a href="{{ route('admin.semua-pengguna') }}" class="hover:text-primary-600 transition-colors">Pengguna</a>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="text-slate-800 font-bold">Detail Pengguna</span>
                </div>
                
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Profil Pengguna</h2>
            </div>

            <div class="grid lg:grid-cols-[350px_1fr] gap-8">

                <!-- SIDEBAR: PROFILE CARD -->
                <div class="space-y-6">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200 text-center relative overflow-hidden group">
                        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-br from-primary-50 to-primary-100 z-0"></div>
                        
                        <div class="relative z-10 flex flex-col items-center pt-8">
                            <div class="w-32 h-32 rounded-full border-4 border-white shadow-lg bg-white overflow-hidden mb-5">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=200"
                                    class="w-full h-full object-cover">
                            </div>

                            <h3 class="text-2xl font-extrabold text-slate-900 mb-1">{{ $user->name }}</h3>
                            <p class="text-slate-500 font-medium mb-4">{{ $user->email }}</p>

                            @if ($user->role->value === 'penjual')
                                <span class="px-4 py-1.5 text-xs font-bold uppercase tracking-wider rounded-xl bg-primary-50 text-primary-700 border border-primary-200">
                                    Penjual
                                </span>
                            @elseif($user->role->value === 'pembeli')
                                <span class="px-4 py-1.5 text-xs font-bold uppercase tracking-wider rounded-xl bg-purple-50 text-purple-700 border border-purple-200">
                                    Pembeli
                                </span>
                            @else
                                <span class="px-4 py-1.5 text-xs font-bold uppercase tracking-wider rounded-xl bg-slate-50 text-slate-700 border border-slate-200">
                                    {{ ucfirst($user->role->value) }}
                                </span>
                            @endif
                        </div>

                        <!-- STATUS BADGES -->
                        <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col gap-4 relative z-10">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">Status Akun</span>
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold rounded-xl">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-rose-50 text-rose-700 border border-rose-200 text-xs font-bold rounded-xl">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Nonaktif
                                    </span>
                                @endif
                            </div>

                            @if ($user->role->value === 'penjual' && $user->penjual && $user->penjual->toko)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">Status Toko</span>
                                    
                                    @if ($user->penjual->toko->status_verifikasi == 'Menunggu')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold rounded-xl">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Menunggu
                                        </span>
                                    @elseif($user->penjual->toko->status_verifikasi == 'Terverifikasi')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold rounded-xl">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Terverifikasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-rose-50 text-rose-700 border border-rose-200 text-xs font-bold rounded-xl">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> {{ $user->penjual->toko->status_verifikasi }}
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- AKSI ADMIN PANEL (DIPINDAHKAN KE SIDEBAR UNTUK AKSES CEPAT) -->
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200">
                        <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-5">Kontrol Admin</h3>
                        
                        <div class="flex flex-col gap-3">
                            {{-- TOMBOL SETUJUI / TOLAK TOKO (HANYA PENJUAL MENUNGGU) --}}
                            @if ($user->role->value === 'penjual' && $user->penjual && $user->penjual->toko && $user->penjual->toko->status_verifikasi === 'Menunggu')
                                <button @click="actionType='approve'; showConfirm=true"
                                    class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/30 transition-all hover:-translate-y-0.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    Setujui Toko
                                </button>
                                <button @click="actionType='reject'; showConfirm=true"
                                    class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-white hover:bg-rose-50 text-rose-600 border border-rose-200 font-bold rounded-xl transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Tolak Toko
                                </button>
                            @endif

                            {{-- TOMBOL NONAKTIFKAN / AKTIFKAN AKUN --}}
                            @php
                                $showAccountAction = auth()->id() !== $user->id;
                                if ($user->role->value === 'penjual') {
                                    $tokoStatus = $user->penjual?->toko?->status_verifikasi;
                                    if ($tokoStatus !== 'Terverifikasi' && $tokoStatus !== 'Ditolak') {
                                        $showAccountAction = false;
                                    }
                                }
                            @endphp

                            @if ($showAccountAction)
                                <button @click="showToggle = true"
                                    class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl font-bold transition-all border
                                    {{ $user->is_active ? 'bg-white hover:bg-rose-50 border-rose-200 text-rose-600' : 'bg-emerald-600 hover:bg-emerald-700 shadow-lg shadow-emerald-600/30 text-white border-transparent hover:-translate-y-0.5' }}">
                                    @if($user->is_active)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                        Blokir Akun
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                                        Aktifkan Akun
                                    @endif
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- MAIN CONTENT AREA -->
                <div class="space-y-8">

                    <!-- INFORMASI DASAR -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                        <h3 class="text-xl font-extrabold text-slate-800 mb-6 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            Data Pribadi
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                            <div>
                                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Nama Lengkap</p>
                                <p class="text-slate-800 font-medium text-lg">{{ $user->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Email</p>
                                <p class="text-slate-800 font-medium text-lg">{{ $user->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Tipe Akun</p>
                                <p class="text-slate-800 font-medium text-lg">{{ ucfirst($user->role->value) }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Bergabung Sejak</p>
                                <p class="text-slate-800 font-medium text-lg">{{ $user->created_at->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>

                    @if ($user->role->value === 'penjual')
                        
                        <!-- VERIFIKASI PENJUAL -->
                        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                            <h3 class="text-xl font-extrabold text-slate-800 mb-6 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                </div>
                                Berkas Verifikasi
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-[1fr_2fr] gap-8">
                                <div>
                                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Nomor Induk Kependudukan (NIK)</p>
                                    <p class="text-slate-800 font-bold text-lg font-mono">{{ $user->penjual->nik ?? 'Belum dilengkapi' }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-3">Foto KTP / Identitas</p>
                                    @if ($user->penjual->foto_ktp)
                                        <div class="rounded-2xl border-2 border-slate-100 overflow-hidden shadow-sm inline-block max-w-sm">
                                            <img src="{{ $user->penjual->foto_ktp_url }}" class="w-full h-auto object-cover hover:scale-105 transition-transform duration-500">
                                        </div>
                                    @else
                                        <div class="p-6 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl text-center text-slate-500 font-medium">
                                            Penjual belum mengunggah foto KTP.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- INFORMASI TOKO -->
                        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-extrabold text-slate-800 flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    </div>
                                    Profil Toko
                                </h3>
                                @if ($user->penjual->toko && $user->penjual->toko->status_verifikasi === 'Terverifikasi')
                                    <a href="{{ route('detail-toko', $user->penjual->toko->id) }}" target="_blank" class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 font-bold text-sm transition-colors border border-blue-200 flex items-center gap-2">
                                        Lihat Etalase
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                @endif
                            </div>

                            @if ($user->penjual->toko)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-6">
                                        <div>
                                            <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Nama Toko</p>
                                            <p class="text-slate-800 font-bold text-lg">{{ $user->penjual->toko->nama_toko }}</p>
                                        </div>
                                        
                                        <div class="flex gap-8">
                                            <div>
                                                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Jam Buka</p>
                                                <p class="text-slate-800 font-medium text-lg flex items-center gap-2">
                                                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    {{ $user->penjual->toko->jam_buka ?? '-' }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Jam Tutup</p>
                                                <p class="text-slate-800 font-medium text-lg flex items-center gap-2">
                                                    <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    {{ $user->penjual->toko->jam_tutup ?? '-' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div>
                                            <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Alamat Lengkap</p>
                                            <p class="text-slate-800 font-medium">{{ $user->penjual->toko->lokasi ?? 'Belum diisi' }}</p>
                                        </div>
                                        
                                        <div>
                                            <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Deskripsi</p>
                                            <p class="text-slate-600 leading-relaxed">{{ $user->penjual->toko->deskripsi_toko ?? 'Belum ada deskripsi toko.' }}</p>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-3">Foto Penampilan Toko</p>
                                        @if ($user->penjual->toko->foto_toko)
                                            <div class="rounded-2xl border border-slate-200 overflow-hidden shadow-sm aspect-video bg-slate-50 relative">
                                                <img src="{{ $user->penjual->toko->foto_toko_url }}" class="absolute inset-0 w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="aspect-video bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center text-slate-400 p-6 text-center">
                                                <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                <p class="font-medium">Belum ada foto toko yang diunggah.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-10 bg-slate-50 rounded-2xl border border-slate-100">
                                    <p class="text-slate-500 font-medium">Penjual belum melengkapi profil toko.</p>
                                </div>
                            @endif
                        </div>
                    @endif

                </div>

            </div>

        </div>

        <!-- MODAL KONFIRMASI (VERIFIKASI TOKO) -->
        @if ($user->role->value === 'penjual' && $user->penjual && $user->penjual->toko)
            <template x-teleport="body">
                <div x-show="showConfirm" x-transition.opacity.duration.300ms @click.self="showConfirm = false"
                    class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm flex items-center justify-center z-[100] p-4"
                    style="display: none;">

                    <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                        class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md border border-slate-100 relative overflow-hidden">

                        <!-- Decorative Background -->
                        <div class="absolute top-0 left-0 w-full h-2" :class="actionType === 'approve' ? 'bg-emerald-500' : 'bg-rose-500'"></div>

                        <div class="flex flex-col items-center text-center">
                            <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4" :class="actionType === 'approve' ? 'bg-emerald-100 text-emerald-600' : 'bg-rose-100 text-rose-600'">
                                <svg x-show="actionType === 'approve'" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <svg x-show="actionType === 'reject'" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </div>

                            <h2 class="text-2xl font-extrabold text-slate-800 mb-2">
                                <span x-text="actionType === 'approve' ? 'Setujui Toko?' : 'Tolak Toko?'"></span>
                            </h2>

                            <p class="text-slate-500 font-medium mb-8 leading-relaxed">
                                <span x-show="actionType === 'approve'">
                                    Dengan menyetujui, toko ini dapat mulai berjualan dan produknya akan tampil untuk pembeli.
                                </span>
                                <span x-show="actionType === 'reject'">
                                    Dengan menolak, penjual harus memperbaiki data dan mengajukan verifikasi ulang.
                                </span>
                            </p>

                            <div class="flex items-center gap-3 w-full">
                                <button @click="showConfirm = false"
                                    class="flex-1 py-3 text-slate-600 font-bold bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                                    Batal
                                </button>

                                <form action="{{ route('admin.update-status-toko', $penjual->toko->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="action" :value="actionType">
                                    <button type="submit" class="w-full py-3 font-bold text-white rounded-xl transition-all shadow-lg hover:-translate-y-0.5"
                                        :class="actionType === 'approve' ? 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-600/30' : 'bg-rose-600 hover:bg-rose-700 shadow-rose-600/30'">
                                        <span x-text="actionType === 'approve' ? 'Ya, Setujui' : 'Ya, Tolak'"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        @endif

        <!-- MODAL TOGGLE STATUS AKUN -->
        <template x-teleport="body">
            <div x-show="showToggle" x-transition.opacity.duration.300ms @click.self="showToggle = false"
                class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm flex items-center justify-center z-[100] p-4" style="display: none;">

                <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                    class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md border border-slate-100 relative overflow-hidden">

                    <!-- Decorative Background -->
                    <div class="absolute top-0 left-0 w-full h-2 {{ $user->is_active ? 'bg-rose-500' : 'bg-emerald-500' }}"></div>

                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 {{ $user->is_active ? 'bg-rose-100 text-rose-600' : 'bg-emerald-100 text-emerald-600' }}">
                            @if($user->is_active)
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            @else
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                            @endif
                        </div>

                        <h2 class="text-2xl font-extrabold text-slate-800 mb-2">
                            {{ $user->is_active ? 'Blokir Akun?' : 'Aktifkan Akun?' }}
                        </h2>

                        <p class="text-slate-500 font-medium mb-8 leading-relaxed">
                            @if($user->is_active)
                                Pengguna ini tidak akan bisa login atau mengakses sistem hingga akun diaktifkan kembali.
                            @else
                                Pengguna ini akan mendapatkan kembali akses penuh ke sistem sesuai dengan rolenya.
                            @endif
                        </p>

                        <div class="flex items-center gap-3 w-full">
                            <button @click="showToggle = false"
                                class="flex-1 py-3 text-slate-600 font-bold bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                                Batal
                            </button>

                            <form action="{{ route('admin.toggle-status-user', $user->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit"
                                    class="w-full py-3 font-bold text-white rounded-xl transition-all shadow-lg hover:-translate-y-0.5 {{ $user->is_active ? 'bg-rose-600 hover:bg-rose-700 shadow-rose-600/30' : 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-600/30' }}">
                                    Ya, {{ $user->is_active ? 'Blokir' : 'Aktifkan' }}
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </template>
    </div>
@endsection
