@extends('layouts.admin')

@section('title', 'Semua Toko')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10 fade-in space-y-8">

    <!-- HEADER -->
    <div>
        <h2 class="text-3xl font-extrabold text-gray-900">Semua Toko</h2>
        <p class="text-gray-600 mt-2">Daftar seluruh toko yang terdaftar di CeMas.</p>
    </div>

    <!-- SEARCH + FILTER -->
    <form method="GET" action="{{ route('admin.semua-toko') }}" class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        
        <!-- Search Input -->
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari toko atau penjual..."
            class="w-full md:w-1/2 px-4 py-3 border rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">

        <!-- Filter Status -->
        <select name="status" onchange="this.form.submit()" class="px-4 py-3 border rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 cursor-pointer">
            <option value="">Semua Status</option>
            <option value="Terverifikasi" {{ request('status') == 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
            <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu Verifikasi</option>
            <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
    </form>

    <!-- PENJUAL LIST -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="toko-grid">
        @forelse($tokos as $toko)
            <div class="bg-white p-6 rounded-xl shadow border hover:shadow-lg transition toko-card" data-status="{{ strtolower($toko->status_verifikasi) }}">
                <div class="flex items-center space-x-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($toko->penjual->user->name) }}&background=random"
                        class="w-12 h-12 rounded-full shadow">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 line-clamp-1">{{ $toko->penjual->user->name }}</h3>
                        <p class="text-sm text-gray-600 line-clamp-1">{{ $toko->nama_toko }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    @if($toko->status_verifikasi === 'Terverifikasi')
                        <span class="px-3 py-2 bg-green-100 text-green-700 text-xs rounded-lg font-medium">Terverifikasi</span>
                    @elseif($toko->status_verifikasi === 'Menunggu')
                        <span class="px-3 py-2 bg-yellow-100 text-yellow-700 text-xs rounded-lg font-medium">Menunggu Verifikasi</span>
                    @elseif($toko->status_verifikasi === 'Ditolak')
                        <span class="px-3 py-2 bg-red-100 text-red-700 text-xs rounded-lg font-medium">Ditolak</span>
                    @else
                        <span class="px-3 py-2 bg-gray-100 text-gray-700 text-xs rounded-lg font-medium">{{ $toko->status_verifikasi }}</span>
                    @endif
                </div>

                <div class="mt-5 flex gap-3">
                    <a href="{{ route('admin.detail-pengguna', $toko->penjual->user->id) }}" class="w-full px-4 py-2 text-sm text-blue-600 hover:text-blue-800 font-semibold text-center border border-blue-100 rounded-lg hover:bg-blue-50 transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-gray-500">
                <p>{{ request('status') || request('search') ? 'Tidak ada toko yang sesuai dengan filter.' : 'Belum ada penjual yang terdaftar.' }}</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
