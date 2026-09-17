@extends('layouts.penjual')

@section('title', 'Kelola Pesanan')

@section('content')

    <div class="max-w-7xl mx-auto px-6 py-10 min-h-screen" x-data="{ showCancelModal: false, cancelFormAction: '' }">

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-4 rounded-xl mb-6 flex items-center gap-3 shadow-sm">
                <div class="bg-green-100 rounded-full p-1 text-green-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="font-extrabold text-3xl text-slate-900 tracking-tight">Pesanan Masuk</h1>
                <p class="text-slate-500 mt-1 font-medium">Kelola semua pesanan dari pelanggan Anda di sini.</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/80 border-b border-slate-200">
                        <tr>
                            <th class="p-5 text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap">ID Pesanan</th>
                            <th class="p-5 text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap">Pembeli</th>
                            <th class="p-5 text-xs font-bold text-slate-500 uppercase tracking-wider">Barang</th>
                            <th class="p-5 text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap">Total</th>
                            <th class="p-5 text-xs font-bold text-slate-500 uppercase tracking-wider">Catatan</th>
                            <th class="p-5 text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap">Status</th>
                            <th class="p-5 text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($orders as $order)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="p-5 align-top">
                                    <div class="font-mono text-sm font-bold text-slate-700">#{{ $order->id }}</div>
                                    <div class="text-xs font-medium text-slate-400 mt-1">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                                    <div class="mt-2 inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-slate-100 text-slate-500">
                                        @if($order->metode_pengambilan == 'Diantar Penjual')
                                            🛵 Diantar
                                        @else
                                            🏪 Ambil
                                        @endif
                                    </div>
                                </td>
                                <td class="p-5 align-top">
                                    <div class="font-bold text-slate-800">{{ $order->pembeli->user->name }}</div>
                                    <div class="text-sm text-slate-500 mt-0.5 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        {{ $order->pembeli->phone ?? '-' }}
                                    </div>
                                    <div class="text-xs font-medium text-slate-500 mt-1.5 line-clamp-2 max-w-[200px]" title="{{ $order->pembeli->alamat }}">
                                        {{ $order->pembeli->alamat ?? 'Alamat tidak ada' }}
                                    </div>
                                </td>
                                <td class="p-5 align-top">
                                    <ul class="text-sm space-y-2">
                                        @foreach ($order->detailPesanans as $detail)
                                            <li class="flex items-start justify-between gap-3 min-w-[150px]">
                                                <span class="font-medium text-slate-700 line-clamp-2 leading-tight">{{ $detail->produk->nama_produk }}</span>
                                                <span class="font-bold text-slate-900 bg-slate-100 px-1.5 py-0.5 rounded text-xs">x{{ $detail->kuantitas }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="p-5 align-top whitespace-nowrap">
                                    <div class="font-extrabold text-primary-600 text-lg tracking-tight">
                                        Rp{{ number_format($order->total_harga_final, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="p-5 align-top">
                                    @if ($order->catatan_pembeli)
                                        <div class="text-xs font-medium text-amber-700 bg-amber-50 p-2.5 rounded-lg border border-amber-100 max-w-[200px] line-clamp-3"
                                            title="{{ $order->catatan_pembeli }}">
                                            "{{ $order->catatan_pembeli }}"
                                        </div>
                                    @else
                                        <span class="text-xs font-medium text-slate-300 italic">Tidak ada catatan</span>
                                    @endif
                                </td>
                                <td class="p-5 align-top whitespace-nowrap">
                                    @php
                                        $statusClasses = 'bg-slate-100 text-slate-600 border-slate-200';
                                        if (Str::contains($order->status_pesanan, 'Menunggu')) {
                                            $statusClasses = 'bg-amber-50 text-amber-700 border-amber-200';
                                        }
                                        if (Str::contains($order->status_pesanan, 'Proses')) {
                                            $statusClasses = 'bg-blue-50 text-blue-700 border-blue-200';
                                        }
                                        if (Str::contains($order->status_pesanan, 'Siap')) {
                                            $statusClasses = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                        }
                                        if (Str::contains($order->status_pesanan, 'Selesai')) {
                                            $statusClasses = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                        }
                                        if (Str::contains($order->status_pesanan, 'Batal')) {
                                            $statusClasses = 'bg-rose-50 text-rose-700 border-rose-200';
                                        }
                                    @endphp
                                    <span class="px-3 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider border {{ $statusClasses }} shadow-sm">
                                        {{ $order->status_pesanan }}
                                    </span>
                                </td>
                                <td class="p-5 align-top text-right min-w-[140px]">
                                    <form action="{{ route('penjual.pesanan.update', $order->id) }}" method="POST">
                                        @csrf
                                        @if ($order->status_pesanan == 'Menunggu Konfirmasi')
                                            <button type="submit"
                                                class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-3 rounded-lg text-xs transition-colors shadow-sm shadow-primary-600/20">
                                                Konfirmasi
                                            </button>
                                        @elseif($order->status_pesanan == 'Dikonfirmasi/Diproses')
                                            <button type="submit"
                                                class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-3 rounded-lg text-xs transition-colors shadow-sm shadow-amber-500/20">
                                                Tandai Siap
                                            </button>
                                        @elseif($order->status_pesanan == 'Siap Diambil/Diantar')
                                            <button type="submit"
                                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-3 rounded-lg text-xs transition-colors shadow-sm shadow-emerald-600/20">
                                                Selesai
                                            </button>
                                        @elseif($order->status_pesanan == 'Selesai')
                                            <span class="inline-flex items-center justify-end gap-1.5 text-emerald-600 text-xs font-bold bg-emerald-50 px-3 py-1.5 rounded-lg w-full">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                Selesai
                                            </span>
                                        @elseif($order->status_pesanan == 'Dibatalkan')
                                            <span class="inline-block text-slate-400 text-xs font-bold bg-slate-50 px-3 py-1.5 rounded-lg w-full text-center">Dibatalkan</span>
                                        @endif
                                    </form>

                                    @if (in_array($order->status_pesanan, ['Menunggu Konfirmasi', 'Dikonfirmasi/Diproses']))
                                        <button type="button"
                                            @click="cancelFormAction = '{{ route('penjual.pesanan.cancel', $order->id) }}'; showCancelModal = true"
                                            class="mt-2 w-full text-rose-600 hover:text-white hover:bg-rose-600 font-bold py-1.5 px-3 rounded-lg text-xs transition-colors border border-rose-200 hover:border-transparent">
                                            Batalkan
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-16 text-center">
                                    <div class="flex flex-col items-center justify-center text-slate-400">
                                        <svg class="w-16 h-16 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                        <p class="text-lg font-bold text-slate-600">Belum ada pesanan</p>
                                        <p class="text-sm mt-1">Pesanan masuk akan tampil di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- CANCEL MODAL -->
        <template x-teleport="body">
            <div x-show="showCancelModal" x-transition.opacity.duration.300ms @click.self="showCancelModal = false"
                class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm flex items-center justify-center z-[100] p-4" style="display: none;">
                
                <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                    class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md border border-slate-100 relative overflow-hidden">
                    
                    <!-- Decorative Background -->
                    <div class="absolute top-0 left-0 w-full h-2 bg-rose-500"></div>

                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 bg-rose-100 text-rose-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>

                        <h2 class="text-2xl font-extrabold text-slate-800 mb-2">Batalkan Pesanan?</h2>

                        <p class="text-slate-500 font-medium mb-8 leading-relaxed">
                            Apakah Anda yakin ingin membatalkan pesanan ini? Aksi ini tidak dapat dibatalkan.
                        </p>

                        <div class="flex items-center gap-3 w-full">
                            <button @click="showCancelModal = false"
                                class="flex-1 py-3 text-slate-600 font-bold bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                                Kembali
                            </button>

                            <form :action="cancelFormAction" method="POST" class="flex-1">
                                @csrf
                                <button type="submit"
                                    class="w-full py-3 font-bold text-white rounded-xl transition-all shadow-lg hover:-translate-y-0.5 bg-rose-600 hover:bg-rose-700 shadow-rose-600/30">
                                    Ya, Batalkan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

@endsection
