@extends('layouts.pembeli')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8 fade-in min-h-screen">

        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Riwayat Pesanan</h2>
        <p class="text-slate-500 mt-2 mb-10 font-medium">
            Lacak status pesanan dan lihat daftar belanja Anda sebelumnya.
        </p>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-4 rounded-xl mb-6 flex items-center gap-3 shadow-sm">
                <div class="bg-green-100 rounded-full p-1 text-green-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if ($orders->isEmpty())
            <div class="text-center py-24 bg-white rounded-3xl shadow-sm border border-dashed border-slate-300">
                <svg class="w-24 h-24 text-slate-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
                <h3 class="text-xl font-bold text-slate-700">Belum ada pesanan</h3>
                <p class="text-slate-500 mt-2 mb-6">Mulai belanja kebutuhan Anda dari toko tetangga terdekat.</p>
                <a href="{{ route('pembeli.dashboard') }}"
                    class="inline-flex items-center px-8 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 hover:-translate-y-0.5 transition-all shadow-lg shadow-primary-600/30">Belanja Sekarang</a>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($orders as $order)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <!-- Header Order -->
                        <div class="bg-slate-50/50 px-6 md:px-8 py-5 border-b border-slate-100 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="font-bold text-slate-800 text-lg">{{ $order->toko->nama_toko }}</h3>
                                    </div>
                                    <div class="flex flex-wrap gap-x-2 gap-y-1 text-xs text-slate-500 font-medium">
                                        <p class="text-slate-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                        <span class="hidden sm:inline text-slate-300">•</span>
                                        <p>Order ID: #{{ $order->id }}</p>
                                        <span class="hidden sm:inline text-slate-300">•</span>
                                        <p class="text-primary-700 bg-primary-50 px-2 py-0.5 rounded-md flex items-center gap-1">
                                            @if($order->metode_pengambilan == 'Diantar Penjual')
                                                🛵 {{ $order->metode_pengambilan }}
                                            @else
                                                🏪 {{ $order->metode_pengambilan }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                @php
                                    $statusClasses = 'bg-slate-100 text-slate-600 border border-slate-200';
                                    if (Str::contains($order->status_pesanan, 'Menunggu')) {
                                        $statusClasses = 'bg-amber-50 text-amber-700 border border-amber-200';
                                    }
                                    if (Str::contains($order->status_pesanan, 'Proses')) {
                                        $statusClasses = 'bg-blue-50 text-blue-700 border border-blue-200';
                                    }
                                    if (Str::contains($order->status_pesanan, 'Siap') || Str::contains($order->status_pesanan, 'Selesai')) {
                                        $statusClasses = 'bg-emerald-50 text-emerald-700 border border-emerald-200';
                                    }
                                    if (Str::contains($order->status_pesanan, 'Batal')) {
                                        $statusClasses = 'bg-rose-50 text-rose-700 border border-rose-200';
                                    }
                                @endphp
                                <span class="px-4 py-1.5 rounded-full text-xs font-bold tracking-wide uppercase {{ $statusClasses }} shadow-sm">
                                    {{ $order->status_pesanan }}
                                </span>
                            </div>
                        </div>

                        <!-- Content Items -->
                        <div class="p-6 md:p-8">
                            <div class="space-y-4">
                                @foreach ($order->detailPesanans as $detail)
                                    <div class="flex items-start gap-4">
                                        <div class="w-16 h-16 bg-slate-100 rounded-xl border border-slate-200 overflow-hidden flex-shrink-0">
                                            @if ($detail->produk->foto_produk_url)
                                                <img src="{{ asset($detail->produk->foto_produk_url) }}"
                                                    class="w-full h-full object-cover"
                                                    alt="{{ $detail->produk->nama_produk }}">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center text-slate-300">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 mt-1">
                                            <h4 class="font-bold text-slate-800 text-sm md:text-base">
                                                {{ $detail->produk->nama_produk }}
                                            </h4>
                                            <p class="text-sm font-medium text-slate-500 mt-1">{{ $detail->kuantitas }} x Rp{{ number_format($detail->harga_saat_pesan, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="text-sm md:text-base font-extrabold text-slate-700 mt-1">
                                            Rp{{ number_format($detail->kuantitas * $detail->harga_saat_pesan, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if ($order->catatan_pembeli)
                                <div class="mt-6 p-4 bg-orange-50/50 rounded-xl border border-orange-100 text-orange-800">
                                    <h5 class="text-xs font-bold uppercase tracking-wider mb-1.5 flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Catatan Pembeli
                                    </h5>
                                    <p class="text-sm font-medium">{{ $order->catatan_pembeli }}</p>
                                </div>
                            @endif

                            <hr class="my-6 border-slate-100">

                            <div class="flex justify-between items-center">
                                <div class="text-sm font-bold text-slate-500 uppercase tracking-wider">Total Belanja</div>
                                <div class="text-2xl font-extrabold text-primary-600 tracking-tight">Rp{{ number_format($order->total_harga_final, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
