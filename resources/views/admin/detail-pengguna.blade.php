@extends('layouts.admin')

@section('title', 'Detail Pengguna')

@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush

@section('content')
    <div x-data="{ showConfirm: false, showToggle: false, actionType: null }">
        <div class="max-w-5xl mx-auto px-6 py-10 min-h-screen">

            <h2 class="text-3xl font-extrabold text-gray-900">Detail Pengguna</h2>
            <p class="text-gray-600 mt-2 mb-10">
                Informasi lengkap mengenai akun pengguna.
            </p>

            <div class="grid md:grid-cols-3 gap-8">

                <!-- SIDEBAR -->
                <div class="bg-white p-6 rounded-xl shadow border h-fit">

                    <div class="flex flex-col items-center text-center">

                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
                            class="w-24 h-24 rounded-full shadow mb-4">

                        <h3 class="text-xl font-bold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ $user->email }}</p>

                        @if ($user->role->value === 'penjual')
                            <span class="mt-4 px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                Penjual
                            </span>
                        @elseif($user->role->value === 'pembeli')
                            <span class="mt-4 px-3 py-1 text-xs rounded-full bg-purple-100 text-purple-700">
                                Pembeli
                            </span>
                        @else
                            <span class="mt-4 px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                {{ ucfirst($user->role->value) }}
                            </span>
                        @endif

                    </div>

                    <!-- STATUS AKUN -->
                    <div class="mt-6 border-t pt-5">
                        <h4 class="text-sm font-semibold text-gray-800 mb-2">Status Akun</h4>

                        <span
                            class="px-3 py-1 text-xs rounded-full 
                    {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>

                    <!-- STATUS TOKO (HANYA PENJUAL) -->
                    @if ($user->role->value === 'penjual' && $user->penjual && $user->penjual->toko)
                        <div class="mt-4">
                            <h4 class="text-sm font-semibold text-gray-800 mb-2">Status Toko</h4>

                            <span
                                class="px-3 py-1 text-xs rounded-full 
                    @if ($user->penjual->toko->status_verifikasi == 'Menunggu') bg-yellow-100 text-yellow-700
                    @elseif($user->penjual->toko->status_verifikasi == 'Terverifikasi')
                        bg-green-100 text-green-700
                    @else
                        bg-red-100 text-red-700 @endif
                ">
                                {{ $user->penjual->toko->status_verifikasi }}
                            </span>
                        </div>
                    @endif

                </div>

                <!-- MAIN CONTENT -->
                <div class="md:col-span-2 space-y-10">

                    <!-- INFORMASI AKUN -->
                    <div class="bg-white p-6 rounded-xl shadow border">
                        <div class="mb-6">

                            <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Akun</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-6">

                                <p><span class="font-semibold">Nama:</span> {{ $user->name }}</p>
                                <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                                <p><span class="font-semibold">Role:</span> {{ ucfirst($user->role->value) }}</p>
                                <p><span class="font-semibold">Tanggal Daftar:</span>
                                    {{ $user->created_at->format('d M Y') }}</p>
                            </div>

                        </div>
                        @if ($user->role->value === 'penjual')
                            <!-- Penjual -->
                            <div class="my-6 border-t">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Data Verifikasi Penjual</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    <div>
                                        <p class="font-semibold text-sm text-gray-700">NIK</p>
                                        <p class="mt-1 text-gray-800">{{ $user->penjual->nik ?? '-' }}</p>
                                    </div>

                                    <div>
                                        <p class="font-semibold text-sm text-gray-700 mb-2">Foto KTP</p>
                                        @if ($user->role->value === 'penjual')
                                            <img src="{{ $user->penjual->foto_ktp_url }}" class="rounded-lg border shadow">
                                        @else
                                            <span class="text-gray-400 italic">Tidak ada foto KTP</span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="mt-6 border-t pt-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Toko</h3>

                                @if ($user->penjual->toko)
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="text-sm space-y-3">
                                            <p><span class="font-semibold">Nama Toko:</span>
                                                {{ $user->penjual->toko->nama_toko }}</p>
                                            <p><span class="font-semibold">Jam Buka:</span>
                                                {{ $user->penjual->toko->jam_buka ?? '-' }}</p>
                                            <p><span class="font-semibold">Jam Tutup:</span>
                                                {{ $user->penjual->toko->jam_tutup ?? '-' }}</p>
                                            <p><span class="font-semibold">Alamat:</span>
                                                {{ $user->penjual->toko->lokasi ?? '-' }}</p>
                                            <p><span class="font-semibold">Deskripsi:</span>
                                                {{ $user->penjual->toko->deskripsi_toko ?? '-' }}</p>
                                        </div>

                                        <div>
                                            <p class="font-semibold text-sm text-gray-700 mb-2">Foto Toko</p>
                                            @if ($user->penjual->toko->foto_toko_url)
                                                <img src="{{ $user->penjual->toko->foto_toko_url ?? 'https://placehold.co/300x180?text=Toko' }}"
                                                    class="rounded-lg border shadow max-w-sm w-full">
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <p class="text-gray-500 italic">User ini belum memiliki data toko.</p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Penjual End -->
                    <!-- AKSI ADMIN -->
                    <div class="bg-white p-6 rounded-xl shadow border">

                        <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi Admin</h3>

                        <div class="flex flex-wrap gap-3">

                            {{-- TOMBOL SETUJUI / TOLAK TOKO (HANYA PENJUAL MENUNGGU) --}}
                            @if (
                                $user->role->value === 'penjual' &&
                                    $user->penjual &&
                                    $user->penjual->toko &&
                                    $user->penjual->toko->status_verifikasi === 'Menunggu')
                                <button @click="actionType='approve'; showConfirm=true"
                                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm">
                                    Setujui Toko
                                </button>
                                <button @click="actionType='reject'; showConfirm=true"
                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm">
                                    Tolak Toko
                                </button>
                            @endif

                            {{-- TOMBOL NONAKTIFKAN / AKTIFKAN AKUN --}}
                            @php
                                // Default logic: show if not self
                                $showAccountAction = auth()->id() !== $user->id;

                                // Logic khusus Penjual: Hanya muncul jika status tokonya SUDAH Terverifikasi ATAU Ditolak
                                // (Artinya jika masih "Menunggu" atau belum ada status, tombol ini sembunyi biar admin fokus Approve/Reject dulu)
                                if ($user->role->value === 'penjual') {
                                    $tokoStatus = $user->penjual?->toko?->status_verifikasi;
                                    if ($tokoStatus !== 'Terverifikasi' && $tokoStatus !== 'Ditolak') {
                                        $showAccountAction = false;
                                    }
                                }
                            @endphp

                            @if ($showAccountAction)
                                <button @click="showToggle = true"
                                    class="px-4 py-2 rounded-lg text-sm text-white transition
                        {{ $user->is_active ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-600 hover:bg-green-700' }}">
                                    {{ $user->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}
                                </button>
                            @endif


                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- POPUP KONFIRMASI (VERIFIKASI TOKO) -->
        @if ($user->role->value === 'penjual' && $user->penjual && $user->penjual->toko)
            <div x-show="showConfirm" x-transition.opacity.duration.300ms @click.self="showConfirm = false"
                class="fixed  inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50"
                style="display: none;">

                <!-- POPUP CARD -->
                <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-6 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 -translate-y-6 scale-95"
                    class="bg-white p-7 rounded-2xl shadow-2xl w-96 max-w-md border border-gray-200">

                    <h2 class="text-xl font-bold text-gray-900 mb-3 text-center">
                        <span
                            x-text="actionType === 'approve' ? 'Konfirmasi Verifikasi Toko' : 'Konfirmasi Penolakan Toko'"></span>
                    </h2>

                    <p class="text-sm text-gray-700 mb-6 text-center leading-relaxed">
                        <span x-show="actionType === 'approve'">
                            Anda yakin ingin menyetujui toko ini? Tindakan ini tidak dapat dibatalkan.
                        </span>
                        <span x-show="actionType === 'reject'">
                            Anda yakin ingin menolak toko ini? Pemilik toko perlu mengajukan ulang.
                        </span>
                    </p>

                    <div class="flex justify-center gap-4">
                        <!-- BATAL -->
                        <button @click="showConfirm = false"
                            class="px-5 py-2 text-sm rounded-lg bg-gray-200 hover:bg-gray-300 transition font-medium">
                            Batal
                        </button>

                        <form action="{{ route('admin.update-status-toko', $penjual->toko->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" :value="actionType">
                            <button class="px-5 py-2 text-sm rounded-lg transition font-medium shadow"
                                :class="actionType === 'approve' ? 'bg-green-600 hover:bg-green-700 text-white' :
                                    'bg-red-600 hover:bg-red-700 text-white'">
                                <span x-text="actionType === 'approve' ? 'Setujui' : 'Tolak'"></span>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @endif

        <!-- POPUP TOGGLE STATUS AKUN -->
        <div x-show="showToggle" x-transition.opacity.duration.300ms @click.self="showToggle = false"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50" style="display: none;">

            <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-6 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 -translate-y-6 scale-95"
                class="bg-white p-7 rounded-2xl shadow-2xl w-96 max-w-md border border-gray-200">

                <h2 class="text-xl font-bold text-gray-900 mb-3 text-center">
                    Konfirmasi Tindakan Akun
                </h2>

                <p class="text-sm text-gray-700 mb-6 text-center leading-relaxed">
                    Apakah Anda yakin ingin
                    <span class="font-semibold text-gray-800">
                        {{ $user->is_active ? 'menonaktifkan akun ini?' : 'mengaktifkan akun ini?' }}
                    </span>
                </p>

                <div class="flex justify-center gap-4">
                    <!-- BATAL -->
                    <button @click="showToggle = false"
                        class="px-5 py-2 text-sm rounded-lg bg-gray-200 hover:bg-gray-300 transition font-medium">
                        Batal
                    </button>

                    <!-- KONFIRMASI -->
                    <form action="{{ route('admin.toggle-status-user', $user->id) }}" method="POST">
                        @csrf
                        <button
                            class="px-5 py-2 text-sm rounded-lg {{ $user->is_active ? 'bg-yellow-500 hover:bg-yellow-600 text-white' : 'bg-green-600 hover:bg-green-700 text-white' }} transition font-medium shadow">
                            {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                </div>

            </div>
        </div>
    @endsection
