@extends('layouts.penjual')

@section('title', 'Dashboard Penjual - CeMas')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10 space-y-10">

    <!-- Heading -->
    <div>
        <h2 class="text-3xl font-extrabold text-gray-900">Dashboard {{ $toko->nama_toko }}</h2>
        <p class="text-gray-600 mt-2">
           Kelola toko dan produk serta pesanan anda dengan mudah.
        </p>

    </div>

    <!-- STAT CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white shadow-md p-6 rounded-xl border">
            <p class="text-blue-600 xl font-bold">Total Produk</p>
            <h3 class="text-4xl font-bold text-gray-900 mt-2">{{ $totalProduk }}</h3>
        </div>

        <div class="bg-white shadow-md p-6 rounded-xl border">
            <p class="text-red-600 xl font-bold">Barang</p>
            <h3 class="text-4xl font-bold text-gray-900 mt-2">{{ $totalBarang }}</h3>
        </div>

        <div class="bg-white shadow-md p-6 rounded-xl border">
            <p class="text-green-600 xl font-bold">Jasa</p>
            <h3 class="text-4xl font-bold text-gray-900 mt-2">{{ $totalJasa }}</h3>
        </div>
    </div>

    <!-- AKSI CEPAT -->
    <div>
        <h3 class="text-xl font-bold text-gray-800 mb-4">Aksi Cepat</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <a href="{{ route('penjual.tambah-produk') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white p-5 rounded-xl shadow text-center font-semibold transition">
                + Tambah Produk
            </a>

            <a href="{{ route('penjual.pesanan') }}"
                class="bg-white border p-5 rounded-xl shadow text-center font-semibold hover:bg-gray-50 transition">
                Lihat Pesanan
            </a>

            <a href="{{ route('penjual.toko') }}"
                class="bg-white border p-5 rounded-xl shadow text-center font-semibold hover:bg-gray-50 transition">
                Edit Profil Toko
            </a>

        </div>
    </div>

    <!-- AKTIVITAS TERBARU -->
    <div>
        <h3 class="text-xl font-bold text-gray-800 mb-4">Produk Anda</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @forelse($produkList as $produk)
            <div class="bg-white rounded-xl shadow hover:shadow-xl border border-gray-100 transition overflow-hidden">

                <!-- FOTO PRODUK -->
                <img src="{{ $produk->foto_produk ? asset($produk->foto_produk) : 'https://placehold.co/400x400?text=Produk' }}"
                    class="w-full h-36 object-cover">

                <div class="p-4">

                    <h3 class="font-semibold text-gray-900 text-sm">
                        {{ $produk->nama_produk }}
                    </h3>

                    <span class="inline-block mt-1 text-xs px-2 py-1 rounded-full
                    {{ $produk->jenis === 'Jasa' ? 'bg-purple-100 text-purple-700' : 'bg-green-100 text-green-700' }}">
                        {{ $produk->jenis }}
                    </span>

                    <p class="text-blue-600 font-bold mt-2 text-lg">
                        Rp{{ number_format($produk->harga, 0, ',', '.') }}
                    </p>

                    <p class="font-semibold text-gray-900 text-sm truncate">
                        {{ $produk->deskripsi }}
                    </p>

                    <a href="{{ route('penjual.detail-produk', $produk->id) }}"
                        class="mt-3 block text-center w-full bg-blue-600 hover:bg-blue-700 
                           text-white text-sm py-2 rounded-lg shadow">
                        Detail Produk
                    </a>

                </div>
            </div>

            @empty

            <p class="text-gray-600 text-center col-span-full">
                Belum ada produk di toko Anda.
            </p>

            @endforelse

        </div>

    </div>

</div>
@endsection