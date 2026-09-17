@extends('layouts.penjual')

@section('title', 'Detail Produk')

@section('content')

<!-- CONTAINER -->
<div class="max-w-7xl mx-auto px-6 py-10" x-data="{ showDeleteModal: false }">

    <!-- TITLE -->
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-gray-900">Detail Produk</h2>
        <p class="text-gray-600 mt-2">Informasi lengkap mengenai produk Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

        <!-- FOTO PRODUK -->
        <div>
            <img src="{{ $produk->foto_produk_url ?? 'https://placehold.co/600x600?text=Produk' }}"
                class="rounded-xl shadow-lg border w-full object-cover">
        </div>

        <!-- INFORMASI PRODUK -->
        <div class="space-y-5">

            <div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $produk->nama_produk }}</h3>

                <p class="text-blue-600 font-bold text-3xl mt-2">
                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                </p>
            </div>  

            <div class="text-gray-700 space-y-2 text-sm">



                <p>
                    <span class="font-semibold">Stok:</span>
                    {{ $produk->stok }}
                </p>

                <p><span class="font-semibold">Deskripsi:</span></p>
                <p class="bg-gray-100 p-3 rounded-lg text-gray-600 leading-relaxed">
                    {{ $produk->deskripsi ?? 'Tidak ada deskripsi.' }}
                </p>
            </div>

            <!-- TOMBOL AKSI -->
            <div class="flex space-x-4 pt-4">

                <a href="{{ route('penjual.edit-produk', $produk->id) }}"
                    class="px-5 py-3 text-center rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow">
                    Edit Produk
                </a>

                <button
                    @click="showDeleteModal = true"
                    class="px-5 py-3 rounded-lg bg-red-500 hover:bg-red-600 text-white font-semibold text-sm shadow">
                    Hapus Produk
                </button>

            </div>
        </div>

    </div>

    <!-- MODAL KONFIRMASI HAPUS -->
    <template x-teleport="body">
        <div x-show="showDeleteModal" x-transition.opacity.duration.300ms @click.self="showDeleteModal = false"
            class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm flex justify-center items-center p-6 z-[100]" style="display: none;">
            
            <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                class="bg-white p-6 rounded-3xl shadow-2xl w-full max-w-md border border-slate-100 relative overflow-hidden text-center">
                
                <div class="absolute top-0 left-0 w-full h-2 bg-rose-500"></div>

                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto bg-rose-100 text-rose-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>

                <h3 class="text-2xl font-extrabold text-slate-800 mb-2">Hapus Produk?</h3>
                <p class="text-slate-500 font-medium mt-2 mb-8 leading-relaxed">
                    Produk ini akan hilang permanen dari toko Anda. Yakin ingin menghapusnya?
                </p>

                <div class="flex items-center gap-3 w-full">
                    <button @click="showDeleteModal = false"
                        class="flex-1 py-3 text-slate-600 font-bold bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                        Batal
                    </button>

                    <form action="{{ route('penjual.produk.destroy', $produk->id) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full py-3 font-bold text-white rounded-xl transition-all shadow-lg hover:-translate-y-0.5 bg-rose-600 hover:bg-rose-700 shadow-rose-600/30">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>

@endsection
