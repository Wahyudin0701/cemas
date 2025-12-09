@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10 space-y-10">

    <!-- HEADER -->
    <div>
        <h2 class="text-3xl font-extrabold text-gray-900">Dashboard Admin</h2>
        <p class="text-gray-600 mt-2">Kelola data pengguna, penjual, dan toko di CeMas.</p>
    </div>

    <!-- STAT CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-white shadow-md p-6 rounded-xl border">
            <p class="text-gray-600 text-sm">Total Pengguna</p>
            <h3 class="text-3xl font-bold text-blue-600 mt-2">{{ $totalPengguna }}</h3>
        </div>

        <div class="bg-white shadow-md p-6 rounded-xl border">
            <p class="text-gray-600 text-sm">Toko Menunggu Verifikasi</p>
            <h3 class="text-3xl font-bold text-yellow-600 mt-2">{{ $tokoMenunggu }}</h3>
        </div>

        <div class="bg-white shadow-md p-6 rounded-xl border">
            <p class="text-gray-600 text-sm">Toko Terverifikasi</p>
            <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $tokoTerverifikasi }}</h3>
        </div>

        <div class="bg-white shadow-md p-6 rounded-xl border">
            <p class="text-gray-600 text-sm">Toko Ditolak</p>
            <h3 class="text-3xl font-bold text-red-600 mt-2">{{ $tokoDitolak }}</h3>
        </div>

    </div>


    <!-- AKSI CEPAT -->
    <div>
        <h3 class="text-xl font-bold text-gray-800 mb-4">Aksi Cepat</h3>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <a href="{{ route('admin.semua-pengguna') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white p-5 rounded-xl shadow text-center font-semibold transition">
                Lihat Pengguna
            </a>

            <!-- Placeholder or fix route if exists -->
            <a href="{{ route('admin.semua-toko', ['status' => 'Menunggu']) }}"
                class="bg-white border p-5 rounded-xl shadow text-center font-semibold hover:bg-gray-50 transition">
                Toko Menunggu Verifikasi
            </a>

            <a href="{{ route('admin.semua-toko', ['status' => 'Terverifikasi']) }}"
                class="bg-white border p-5 rounded-xl shadow text-center font-semibold hover:bg-gray-50 transition">
                Toko Terverifikasi
            </a>

            <a href="{{ route('admin.semua-toko', ['status' => 'Ditolak']) }}"
                class="bg-white border p-5 rounded-xl shadow text-center font-semibold hover:bg-gray-50 transition">
                Toko Ditolak
            </a>

        </div>
    </div>

    <!-- VERIFIKASI PENJUAL -->
    <div>
        <h3 class="text-xl font-bold text-gray-800 mb-4">Menunggu Verifikasi</h3>

        <div class="overflow-x-auto bg-white rounded-xl shadow border p-6">

            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b text-gray-600">
                        <th class="py-2">Nama Penjual</th>
                        <th class="py-2">Nama Toko</th>
                        <th class="py-2">Tanggal Daftar</th>
                        <th class="py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penjualPending as $toko)
                    <tr class="border-b">
                        <td class="py-3 font-medium">
                            {{ $toko->penjual->user->name }}
                        </td>

                        <td>{{ $toko->nama_toko }}</td>

                        <td>
                            {{ $toko->created_at->format('d F Y') }}
                        </td>

                        <td>
                            <a href="{{ route('admin.detail-pengguna', $toko->penjual->user->id) }}"
                                class="px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-xs">
                                Tinjau
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">
                            Tidak ada penjual yang menunggu verifikasi
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
