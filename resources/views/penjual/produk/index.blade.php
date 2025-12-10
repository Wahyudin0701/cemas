@extends('layouts.penjual')

@section('title', 'Detail Produk - CeMas')

@section('content')

<!-- CONTAINER -->
<div class="max-w-5xl mx-auto px-6 py-10">

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
                    onclick="openDeleteModal()"
                    class="px-5 py-3 rounded-lg bg-red-500 hover:bg-red-600 text-white font-semibold text-sm shadow">
                    Hapus Produk
                </button>

            </div>
        </div>

    </div>
</div>

<!-- MODAL KONFIRMASI HAPUS -->
<div id="deleteModal"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden justify-center items-center p-6 z-[60]">

    <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-md">

        <h3 class="text-xl font-bold text-gray-900">Hapus Produk?</h3>
        <p class="text-gray-600 mt-2">
            Produk ini akan hilang permanen dari toko Anda. Yakin ingin menghapusnya?
        </p>

        <div class="mt-6 flex justify-end space-x-3">

            <button onclick="closeDeleteModal()"
                class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300">
                Batal
            </button>

            <form action="{{ route('penjual.produk.destroy', $produk->id) }}"
                  method="POST">
                @csrf
                @method('DELETE')

                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Hapus
                </button>
            </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Modal functions
    function openDeleteModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }
</script>
@endpush
