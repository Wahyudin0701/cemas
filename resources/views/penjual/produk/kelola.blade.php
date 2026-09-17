@extends('layouts.penjual')

@section('title', 'Kelola Produk')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10 min-h-screen">

    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="font-extrabold text-3xl text-slate-900 tracking-tight">Kelola Produk</h1>
            <p class="text-slate-500 mt-1 font-medium">Tambah, ubah, atau hapus produk yang ada di toko Anda.</p>
        </div>
        <a href="{{ route('penjual.tambah-produk') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-primary-600/30 hover:-translate-y-0.5 whitespace-nowrap">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            Tambah Produk Baru
        </a>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        @forelse($produkList as $produk)
            <div class="group bg-white rounded-2xl shadow-sm border border-slate-200 transition-all duration-300 hover:shadow-xl overflow-hidden flex flex-col">
                <!-- FOTO PRODUK -->
                <div class="aspect-square bg-slate-50 relative overflow-hidden">
                    @if($produk->foto_produk_url)
                        <img src="{{ $produk->foto_produk_url }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    
                    @if($produk->stok < 1)
                        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-[2px] flex items-center justify-center">
                            <span class="bg-rose-500 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider shadow-lg">Habis</span>
                        </div>
                    @endif
                </div>

                <div class="p-4 sm:p-5 flex flex-col flex-grow">
                    <h3 class="font-bold text-slate-800 text-sm md:text-base line-clamp-2 leading-tight flex-grow group-hover:text-primary-600 transition-colors">
                        {{ $produk->nama_produk }}
                    </h3>

                    <div class="mt-3">
                        <p class="text-primary-600 font-extrabold text-lg tracking-tight">
                            Rp{{ number_format($produk->harga, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-slate-400 font-medium mt-1">Stok: {{ $produk->stok }}</p>
                    </div>

                    <a href="{{ route('penjual.detail-produk', $produk->id) }}"
                        class="mt-4 w-full bg-slate-50 hover:bg-slate-100 text-slate-700 font-bold text-sm py-2.5 rounded-xl border border-slate-200 transition-colors text-center block">
                        Detail Produk
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-slate-200 border-dashed">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Belum Ada Produk</h3>
                <p class="text-slate-500 mt-1 mb-6 max-w-md mx-auto">Toko Anda belum memiliki produk. Tambahkan produk pertama Anda sekarang untuk mulai berjualan.</p>
                <a href="{{ route('penjual.tambah-produk') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-primary-600/30 hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Produk
                </a>
            </div>
        @endforelse
    </div>

</div>

@endsection
