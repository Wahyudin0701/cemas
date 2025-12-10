@extends('layouts.pembeli')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">

        <h2 class="text-3xl font-extrabold text-gray-900">Riwayat Pesanan</h2>
        <p class="text-gray-600 mt-2 mb-10">
            Informasi lengkap mengenai riwayat pesanan.
        </p>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if ($orders->isEmpty())
            <div class="text-center py-20 bg-white rounded-xl shadow-sm border border-dashed border-gray-300">
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
                <h3 class="text-xl font-medium text-gray-400">Belum ada pesanan</h3>
                <a href="{{ route('pembeli.dashboard') }}"
                    class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Belanja
                    Sekarang</a>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($orders as $order)
                    <div class="bg-white rounded-xl shadow-sm border overflow-hidden hover:shadow-md transition">
                        <!-- Header Order -->
                        <div class="bg-gray-50 px-6 py-4 border-b flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-bold text-gray-800">{{ $order->toko->nama_toko }}</h3>
                                        <span class="text-xs text-gray-500">•
                                            {{ $order->created_at->format('d M Y H:i') }}</span>
                                    </div>
                                    <div class="flex flex-wrap gap-x-3 gap-y-1 text-xs text-gray-500 mt-0.5">
                                        <p>Order ID: #{{ $order->id }}</p>
                                        <span class="hidden sm:inline">•</span>
                                        <p
                                            class="font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full text-[10px] uppercase tracking-wider">
                                            {{ $order->metode_pengambilan }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                @php
                                    $statusColor = 'bg-gray-100 text-gray-600';
                                    if (Str::contains($order->status_pesanan, 'Menunggu')) {
                                        $statusColor = 'bg-yellow-100 text-yellow-700';
                                    }
                                    if (Str::contains($order->status_pesanan, 'Proses')) {
                                        $statusColor = 'bg-blue-100 text-blue-700';
                                    }
                                    if (Str::contains($order->status_pesanan, 'Siap')) {
                                        $statusColor = 'bg-green-100 text-green-700';
                                    }
                                    if (Str::contains($order->status_pesanan, 'Selesai')) {
                                        $statusColor = 'bg-green-100 text-green-700';
                                    }
                                    if (Str::contains($order->status_pesanan, 'Batal')) {
                                        $statusColor = 'bg-red-100 text-red-700';
                                    }
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColor }}">
                                    {{ $order->status_pesanan }}
                                </span>
                            </div>
                        </div>

                        <!-- Content Items -->
                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach ($order->detailPesanans as $detail)
                                    <div class="flex items-start gap-4">
                                        <div class="w-16 h-16 bg-gray-100 rounded-md overflow-hidden flex-shrink-0">
                                            @if ($detail->produk->foto_produk)
                                                <img src="{{ asset($detail->produk->foto_produk) }}"
                                                    class="w-full h-full object-cover"
                                                    alt="{{ $detail->produk->nama_produk }}">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center text-gray-400 text-xs">
                                                    IMG</div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-sm font-medium text-gray-900">
                                                {{ $detail->produk->nama_produk }}
                                            </h4>
                                            <p class="text-xs text-gray-500">{{ $detail->kuantitas }} x Rp
                                                {{ number_format($detail->harga_saat_pesan, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="text-sm font-bold text-gray-700">
                                            Rp
                                            {{ number_format($detail->kuantitas * $detail->harga_saat_pesan, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if ($order->catatan_pembeli)
                                <div class="mt-4 p-4 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                                    <h5
                                        class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Catatan Pesanan
                                    </h5>
                                    <p class="text-sm text-gray-700 leading-relaxed">{{ $order->catatan_pembeli }}</p>
                                </div>
                            @endif

                            <hr class="my-4 border-gray-100">

                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-500">Total Belanja</div>
                                <div class="text-lg font-bold text-blue-600">Rp
                                    {{ number_format($order->total_harga_final, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
