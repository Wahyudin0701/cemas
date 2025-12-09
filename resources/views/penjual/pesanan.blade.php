@extends('layouts.penjual')

@section('title', 'Kelola Pesanan - Penjual CeMas')

@section('content')

<div class="max-w-6xl mx-auto px-6 py-8">

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="mb-6 flex items-center justify-between">
        <h1 class="font-bold text-xl text-blue-600">Pesanan Masuk</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4 text-sm font-semibold text-gray-600">ID Pesanan</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Pembeli</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Barang</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Total</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Status</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 text-sm font-mono text-gray-500">
                        #{{ $order->id }}
                        <div class="text-xs text-gray-400 mt-1">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                    </td>
                    <td class="p-4">
                        <div class="font-medium text-gray-800">{{ $order->pembeli->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $order->pembeli->phone ?? '-' }}</div>
                        <div class="text-xs text-gray-500 truncate w-32" title="{{ $order->pembeli->alamat }}">
                            {{ $order->pembeli->alamat ?? 'Alamat tidak ada' }}
                        </div>
                    </td>
                    <td class="p-4">
                        <ul class="text-sm space-y-1">
                            @foreach($order->detailPesanans as $detail)
                            <li class="flex justify-between w-36">
                                <span class="truncate pr-2">{{ $detail->produk->nama_produk }}</span>
                                <span class="font-semibold">x{{ $detail->kuantitas }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="p-4 font-bold text-blue-600">
                        Rp {{ number_format($order->total_harga_final, 0, ',', '.') }}
                    </td>
                    <td class="p-4">
                        @php
                        $statusColor = 'bg-gray-100 text-gray-600';
                        if(Str::contains($order->status_pesanan, 'Menunggu')) $statusColor = 'bg-yellow-100 text-yellow-700';
                        if(Str::contains($order->status_pesanan, 'Proses')) $statusColor = 'bg-blue-100 text-blue-700';
                        if(Str::contains($order->status_pesanan, 'Siap')) $statusColor = 'bg-green-100 text-green-700';
                        if(Str::contains($order->status_pesanan, 'Selesai')) $statusColor = 'bg-green-100 text-green-700';
                        if(Str::contains($order->status_pesanan, 'Batal')) $statusColor = 'bg-red-100 text-red-700';
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColor }}">
                            {{ $order->status_pesanan }}
                        </span>
                    </td>
                    <td class="p-4">
                        <form action="{{ route('penjual.pesanan.update', $order->id) }}" method="POST">
                            @csrf
                            <!-- No select needed, action is inferred from current status in controller -->

                            @if($order->status_pesanan == 'Menunggu Konfirmasi')
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-1 px-3 rounded text-xs transition duration-150">
                                Konfirmasi Pesanan
                            </button>
                            @elseif($order->status_pesanan == 'Dikonfirmasi/Diproses')
                            <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-1 px-3 rounded text-xs transition duration-150">
                                Tandai Siap
                            </button>
                            @elseif($order->status_pesanan == 'Siap Diambil/Diantar')
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-1 px-3 rounded text-xs transition duration-150">
                                Selesai
                            </button>
                            @elseif($order->status_pesanan == 'Selesai')
                            <span class="text-green-600 text-xs font-semibold flex items-center justify-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Selesai
                            </span>
                            @elseif($order->status_pesanan == 'Dibatalkan')
                            <span class="text-gray-400 text-xs font-medium">Dibatalkan</span>
                            @endif
                        </form>

                        @if(in_array($order->status_pesanan, ['Menunggu Konfirmasi', 'Dikonfirmasi/Diproses']))
                        <form action="{{ route('penjual.pesanan.cancel', $order->id) }}" method="POST" class="mt-2" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini? Aksi ini tidak dapat dibatalkan.');">
                            @csrf
                            <button type="submit" class="w-full text-red-500 hover:text-red-700 hover:bg-red-50 font-medium py-1 px-3 rounded text-xs transition duration-150 border border-red-200">
                                Batalkan Pesanan
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-10 text-center text-gray-500">
                        Belum ada pesanan masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
