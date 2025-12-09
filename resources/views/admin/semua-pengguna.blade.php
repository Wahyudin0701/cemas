@extends('layouts.admin')

@section('title', 'Semua Pengguna - Admin CeMas')

@push('styles')
<style>
    .fade-in {
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.5s ease;
    }

    .fade-in.show {
        opacity: 1;
        transform: translateY(0);
    }

    .badge {
        @apply px-3 py-1 text-xs rounded-full font-medium;
    }
</style>
@endpush

@section('content')
<!-- MAIN CONTENT -->
<div class="max-w-7xl mx-auto px-6 py-10 fade-in">

    <h2 class="text-3xl font-extrabold text-gray-900">Semua Pengguna</h2>
    <p class="text-gray-600 mt-2 mb-8">
        Daftar seluruh pengguna sistem berdasarkan role dan statusnya.
    </p>

    <!-- FILTER BUTTONS -->
    <div class="flex flex-wrap gap-3 mb-6">
        <button type="button" id="filter-all" onclick="filterUsers('all')"
            class="filter-btn px-4 py-2 rounded-lg border text-sm font-medium
               bg-blue-600 text-white shadow-sm">
            Semua
        </button>

        <button type="button" id="filter-penjual" onclick="filterUsers('penjual')"
            class="filter-btn px-4 py-2 rounded-lg border text-sm font-medium
               bg-white text-gray-700">
            Penjual
        </button>

        <button type="button" id="filter-pembeli" onclick="filterUsers('pembeli')"
            class="filter-btn px-4 py-2 rounded-lg border text-sm font-medium
               bg-white text-gray-700">
            Pembeli
        </button>
    </div>


    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow-md border overflow-hidden">

        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b bg-gray-50 text-gray-700 text-center">
                    <th class="p-4">Nama</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Sebagai</th>
                    <th class="p-4">Status Toko</th>
                    <th class="p-4">Status Akun</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>

            <tbody id="userTable">
                @forelse ($pengguna as $user)

                @php
                $role = $user->role->value ?? 'lainnya';

                $status = null;
                if ($role === 'penjual') {
                $status = $user->penjual->toko->status_verifikasi ?? 'Tidak Ada';
                }
                @endphp


                <tr class="border-b user-row" data-role="{{ $role }}">
                    <!-- NAMA -->
                    <td class="p-4 font-medium text-center">
                        <div class="font-bold">{{ $user->name }}</div>
                        <div class="text-xs text-gray-500">Joined: {{ $user->created_at->format('d M Y') }}</div>
                    </td>

                    <!-- EMAIL -->
                    <td class="p-4 text-gray-600 text-center">{{ $user->email }}</td>

                    <!-- ROLE -->
                    <td class="p-4 text-center">
                        @if ($role === 'penjual')
                        <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                            Penjual
                        </span>
                        @elseif ($role === 'pembeli')
                        <span class="px-3 py-1 text-xs rounded-full bg-purple-100 text-purple-700">
                            Pembeli
                        </span>
                        @else
                        <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-600">
                            Lainnya
                        </span>
                        @endif
                    </td>

                    <!-- STATUS TOKO (Only for Sellers) -->
                    <td class="p-4 text-center">
                        @if ($role === 'penjual')
                        @if ($status === 'Terverifikasi')
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            Terverifikasi
                        </span>
                        @elseif ($status === 'Menunggu')
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                            Menunggu
                        </span>
                        @elseif ($status === 'Ditolak')
                        <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                            Ditolak
                        </span>
                        @else
                        <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-500">
                            Pending
                        </span>
                        @endif
                        @else
                        <span class="text-gray-400">Tidak Ada</span>
                        @endif
                    </td>

                    <!-- STATUS AKUN (User Active/Inactive) -->
                    <td class="p-4 text-center">
                        @if($user->is_active)
                        <span
                            class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 flex items-center w-fit gap-1 mx-auto">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Aktif
                        </span>
                        @else
                        <span
                            class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700 flex items-center w-fit gap-1 mx-auto">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Nonaktif
                        </span>
                        @endif
                    </td>

                    <!-- Aksi -->
                    <td class="p-4 text-center">
                        <div class="flex items-center space-x-2 justify-center">
                            <a href="{{ route('admin.detail-pengguna', $user->id) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium border border-blue-200 px-3 py-1 rounded hover:bg-blue-50 transition">
                                Detail
                            </a>

                            <form action="{{ route('admin.toggle-status-user', $user->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin mengubah status akun ini?');">
                                @csrf
                                <button type="submit"
                                    class="text-sm font-medium px-3 py-1 rounded transition {{ $user->is_active ? 'text-red-600 border border-red-200 hover:bg-red-50' : 'text-green-600 border border-green-200 hover:bg-green-50' }}">
                                    {{ $user->is_active ? 'Blokir' : 'Aktifkan' }}
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">
                        Belum ada data pengguna.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Fade-in animation
    setTimeout(() => {
        document.querySelectorAll('.fade-in').forEach(el => el.classList.add('show'));
    }, 80);

    // Filter role + update tampilan tombol
    function filterUsers(type) {
        const rows = document.querySelectorAll('.user-row');

        // Tampilkan/sembunyikan baris tabel
        rows.forEach(row => {
            const role = row.dataset.role;
            row.style.display = (type === 'all' || role === type) ? '' : 'none';
        });

        // Reset semua tombol filter
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('bg-blue-600', 'text-white', 'shadow-sm');
            btn.classList.add('bg-white', 'text-gray-700');
        });

        // Aktifkan tombol yang dipilih
        const activeBtn = document.getElementById('filter-' + type);
        if (activeBtn) {
            activeBtn.classList.add('bg-blue-600', 'text-white', 'shadow-sm');
            activeBtn.classList.remove('bg-white', 'text-gray-700');
        }
    }

    // Default: tampilkan semua pengguna
    filterUsers('all');
</script>
@endpush