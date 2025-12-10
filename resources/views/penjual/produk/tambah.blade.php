@extends('layouts.penjual')

@section('title', 'Tambah Produk - CeMas')

@section('content')

<div class="max-w-6xl mx-auto px-6 py-10">

    <!-- Judul -->
    <div class="mb-10">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Tambah Produk Baru</h2>
        <p class="text-gray-600 mb-4">
            Lengkapi informasi berikut untuk menambah produk ke tokomu.
        </p>

        @if ($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg p-3">
            <p class="font-semibold mb-1">Terjadi kesalahan:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <form action="{{ route('penjual.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-2xl shadow-lg p-10 border pt-16">

            <div class="grid md:grid-cols-2 gap-10">

                <!-- FOTO PRODUK -->
                <div class="flex flex-col items-center space-y-4">
                    <img id="productPreview"
                        src="https://placehold.co/300x300?text=Preview+Produk"
                        class="w-80 h-[200px] object-cover rounded-xl shadow-sm border">

                    <div class="w-80 border-2 border-dashed border-gray-300 rounded-xl p-6 
                       text-center hover:bg-gray-50 flex flex-col justify-center">

                        <input type="file" name="foto_produk" id="foto_produk"
                            class="hidden" accept="images/*" onchange="previewImage(event)">

                        <label for="foto_produk" class="cursor-pointer text-blue-600 font-medium">
                            Upload Foto Produk
                        </label>

                        <p class="text-gray-500 text-sm mt-2">Format: JPG, PNG • Max 2MB</p>
                    </div>

                    @error('foto_produk')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- FORM INPUT -->
                <div class="space-y-6">

                    <!-- NAMA PRODUK -->
                    <div class="relative">
                        <input type="text" required name="nama_produk" id="nama_produk"
                            class="peer block w-full border border-gray-300 rounded-xl bg-white px-4 py-3
                           focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                            placeholder=" "
                            value="{{ old('nama_produk') }}">

                        <label for="nama_produk"
                            class="absolute left-4 top-3 text-gray-500 transition-all duration-150
                           peer-focus:text-xs peer-focus:-top-2 peer-focus:bg-white 
                           peer-focus:px-1 peer-focus:text-blue-600
                           peer-[:not(:placeholder-shown)]:text-xs 
                           peer-[:not(:placeholder-shown)]:-top-2 bg-white">
                            Nama Produk
                        </label>

                        @error('nama_produk')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- HARGA -->
                    <div class="relative">
                        <input type="number" required name="harga" id="harga" min="0"
                            class="peer block w-full border border-gray-300 rounded-xl bg-white px-4 py-3
                           focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                            placeholder=" "
                            value="{{ old('harga') }}">

                        <label for="harga"
                            class="absolute left-4 top-3 text-gray-500 transition-all duration-150
                           peer-focus:text-xs peer-focus:-top-2 peer-focus:bg-white 
                           peer-focus:px-1 peer-focus:text-blue-600
                           peer-[:not(:placeholder-shown)]:text-xs 
                           peer-[:not(:placeholder-shown)]:-top-2 bg-white">
                            Harga (Rp)
                        </label>

                        @error('harga')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>



                    <!-- STOK -->
                    <div class="relative" id="stokContainer">
                        <input type="number" required name="stok" id="stok" min="0"
                            class="peer block w-full border border-gray-300 rounded-xl bg-white px-4 py-3
                           focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                            placeholder=" "
                            value="{{ old('stok', 0) }}">

                        <label for="stok"
                            class="absolute left-4 top-3 text-gray-500 transition-all duration-150
                           peer-focus:text-xs peer-focus:-top-2 peer-focus:bg-white 
                           peer-focus:px-1 peer-focus:text-blue-600
                           peer-[:not(:placeholder-shown)]:text-xs 
                           peer-[:not(:placeholder-shown)]:-top-2 bg-white">
                            Stok Produk
                        </label>

                        @error('stok')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- DESKRIPSI -->
                    <div class="relative">
                        <textarea name="deskripsi" required id="deskripsi" rows="4"
                            class="peer block w-full border border-gray-300 rounded-xl bg-white px-4 py-3
                           focus:border-blue-500 focus:ring-blue-500 shadow-sm resize-none"
                            placeholder=" ">{{ old('deskripsi') }}</textarea>

                        <label for="deskripsi"
                            class="absolute left-4 top-3 text-gray-500 transition-all duration-150
                           peer-focus:text-xs peer-focus:-top-2 peer-focus:bg-white 
                           peer-focus:px-1 peer-focus:text-blue-600
                           peer-[:not(:placeholder-shown)]:text-xs 
                           peer-[:not(:placeholder-shown)]:-top-2 bg-white">
                            Deskripsi
                        </label>

                        @error('deskripsi')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="mt-10 flex justify-end space-x-4">
                <a href="{{ route('penjual.dashboard') }}"
                    class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg">
                    Batal
                </a>

                <button type="submit"
                    class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                    Simpan Produk
                </button>
            </div>

        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    // Preview image
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = () => {
            document.getElementById('productPreview').src = reader.result;
        };
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endpush