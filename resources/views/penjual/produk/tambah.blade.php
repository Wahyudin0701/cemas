@extends('layouts.penjual')

@section('title', 'Tambah Produk')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-12 min-h-screen">

    <!-- Judul -->
    <div class="mb-10">
        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Tambah Produk Baru</h2>
        <p class="text-slate-500 font-medium">
            Lengkapi informasi berikut untuk menambahkan barang jualan Anda.
        </p>

        @if ($errors->any())
        <div class="mt-6 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-5 shadow-sm">
            <p class="font-bold mb-2 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Terjadi kesalahan:
            </p>
            <ul class="list-disc list-inside space-y-1 font-medium">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <form action="{{ route('penjual.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

            <div class="p-8 md:p-10 grid md:grid-cols-[300px_1fr] gap-10">

                <!-- FOTO PRODUK -->
                <div class="flex flex-col items-center">
                    <label class="w-full block text-sm font-bold text-slate-700 mb-3 text-center">Foto Produk <span class="text-red-500">*</span></label>
                    
                    <!-- PREVIEW BOX -->
                    <div class="relative w-full aspect-square md:w-[260px] md:h-[260px] rounded-2xl overflow-hidden border-2 border-dashed border-slate-300 bg-slate-50 group cursor-pointer transition-all hover:border-primary-500 hover:bg-primary-50/50" onclick="document.getElementById('foto_produk').click()">
                        
                        <!-- Placeholder -->
                        <div id="previewPlaceholder" class="absolute inset-0 flex flex-col items-center justify-center text-slate-400">
                            <svg class="w-12 h-12 mb-3 text-slate-300 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-sm font-bold group-hover:text-primary-600 transition-colors">Pilih Foto</span>
                            <span class="text-[10px] text-slate-400 mt-1 uppercase tracking-wider font-semibold">JPG, PNG (Maks 2MB)</span>
                        </div>

                        <!-- Image -->
                        <img id="productPreview" src="" class="absolute inset-0 w-full h-full object-cover hidden">
                        
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center pointer-events-none backdrop-blur-[2px]">
                            <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                            <span class="text-white font-bold text-sm tracking-wide uppercase">Ubah Foto</span>
                        </div>
                    </div>

                    <input type="file" name="foto_produk" id="foto_produk" class="hidden" accept="image/*" onchange="previewImage(event)">

                    @error('foto_produk')
                        <p class="text-red-500 text-xs font-semibold mt-3 text-center bg-red-50 px-3 py-1.5 rounded-lg w-full">{{ $message }}</p>
                    @enderror
                </div>

                <!-- FORM INPUT -->
                <div class="space-y-6">

                    <!-- NAMA PRODUK -->
                    <div>
                        <label for="nama_produk" class="block text-sm font-bold text-slate-700 mb-2">Nama Produk <span class="text-red-500">*</span></label>
                        <input type="text" required name="nama_produk" id="nama_produk"
                            class="w-full border-slate-200 rounded-xl bg-slate-50 px-4 py-3 text-slate-800 placeholder-slate-400
                                   focus:bg-white focus:border-primary-500 focus:ring-primary-500/20 shadow-sm transition-all outline-none font-medium"
                            placeholder="Contoh: Sayur Bayam Segar"
                            value="{{ old('nama_produk') }}">
                        @error('nama_produk')
                            <p class="text-red-500 text-xs font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- HARGA -->
                        <div>
                            <label for="harga" class="block text-sm font-bold text-slate-700 mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-slate-400 font-bold">Rp</span>
                                </div>
                                <input type="number" required name="harga" id="harga" min="0"
                                    class="w-full border-slate-200 rounded-xl bg-slate-50 pl-11 pr-4 py-3 text-slate-800 placeholder-slate-400
                                           focus:bg-white focus:border-primary-500 focus:ring-primary-500/20 shadow-sm transition-all outline-none font-bold"
                                    placeholder="0"
                                    value="{{ old('harga') }}">
                            </div>
                            @error('harga')
                                <p class="text-red-500 text-xs font-semibold mt-1.5 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- STOK -->
                        <div>
                            <label for="stok" class="block text-sm font-bold text-slate-700 mb-2">Stok Awal <span class="text-red-500">*</span></label>
                            <input type="number" required name="stok" id="stok" min="0"
                                class="w-full border-slate-200 rounded-xl bg-slate-50 px-4 py-3 text-slate-800 placeholder-slate-400
                                       focus:bg-white focus:border-primary-500 focus:ring-primary-500/20 shadow-sm transition-all outline-none font-bold"
                                placeholder="0"
                                value="{{ old('stok', 0) }}">
                            @error('stok')
                                <p class="text-red-500 text-xs font-semibold mt-1.5 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- DESKRIPSI -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Produk <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi" required id="deskripsi" rows="5"
                            class="w-full border-slate-200 rounded-xl bg-slate-50 px-4 py-3 text-slate-800 placeholder-slate-400
                                   focus:bg-white focus:border-primary-500 focus:ring-primary-500/20 shadow-sm resize-none transition-all outline-none font-medium"
                            placeholder="Deskripsikan kondisi, berat, atau keunggulan produk Anda...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

            </div>

            <!-- FOOTER BUTTONS -->
            <div class="bg-slate-50/80 px-8 py-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row items-center justify-end gap-3 sm:gap-4">
                <a href="{{ route('penjual.dashboard') }}"
                    class="w-full sm:w-auto px-6 py-3 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold rounded-xl transition-colors text-center shadow-sm">
                    Batal
                </a>

                <button type="submit"
                    class="w-full sm:w-auto px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-600/30 transition-all hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Simpan Produk
                </button>
            </div>

        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const reader = new FileReader();
        const placeholder = document.getElementById('previewPlaceholder');
        const preview = document.getElementById('productPreview');
        
        reader.onload = () => {
            preview.src = reader.result;
            preview.classList.remove('hidden');
            if(placeholder) placeholder.classList.add('hidden');
        };
        
        if (event.target.files && event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endpush