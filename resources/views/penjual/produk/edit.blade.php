@extends('layouts.penjual')

@section('title', 'Edit Produk')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-12 min-h-screen" x-data="{ showDeleteModal: false }">

    <!-- Judul -->
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Edit Produk</h2>
            <p class="text-slate-500 font-medium">
                Perbarui informasi barang jualan Anda.
            </p>
        </div>
        
        <!-- Hapus Button - Move out of main form to avoid nested forms or complex logic -->
        <button type="button" @click="showDeleteModal = true" class="px-5 py-2.5 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white font-bold rounded-xl transition-colors border border-rose-200 hover:border-transparent flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Hapus Produk
        </button>
    </div>

    @if ($errors->any())
    <div class="mb-8 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-5 shadow-sm">
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

    <form action="{{ route('penjual.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-8 md:p-10 grid md:grid-cols-[300px_1fr] gap-10">

                <!-- FOTO PRODUK -->
                <div class="flex flex-col items-center">
                    <label class="w-full block text-sm font-bold text-slate-700 mb-3 text-center">Foto Produk <span class="text-red-500">*</span></label>
                    
                    <!-- PREVIEW BOX -->
                    <div class="relative w-full aspect-square md:w-[260px] md:h-[260px] rounded-2xl overflow-hidden border-2 border-dashed border-slate-300 bg-slate-50 group cursor-pointer transition-all hover:border-primary-500 hover:bg-primary-50/50" onclick="document.getElementById('foto_produk').click()">
                        
                        <!-- Image -->
                        <img id="productPreview" src="{{ $produk->foto_produk_url }}" class="absolute inset-0 w-full h-full object-cover">
                        
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center pointer-events-none backdrop-blur-[2px]">
                            <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                            <span class="text-white font-bold text-sm tracking-wide uppercase">Ubah Foto</span>
                        </div>
                    </div>

                    <input type="file" name="foto_produk" id="foto_produk" class="hidden" accept="image/*" onchange="previewImage(event)">

                    <p class="text-[11px] text-slate-500 mt-4 text-center px-4 font-medium uppercase tracking-wider leading-relaxed">Format JPG/PNG.<br>Maksimal ukuran 2MB.</p>

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
                            value="{{ old('nama_produk', $produk->nama_produk) }}">
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
                                    value="{{ old('harga', $produk->harga) }}">
                            </div>
                            @error('harga')
                                <p class="text-red-500 text-xs font-semibold mt-1.5 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- STOK -->
                        <div>
                            <label for="stok" class="block text-sm font-bold text-slate-700 mb-2">Stok Tersedia <span class="text-red-500">*</span></label>
                            <input type="number" required name="stok" id="stok" min="0"
                                class="w-full border-slate-200 rounded-xl bg-slate-50 px-4 py-3 text-slate-800 placeholder-slate-400
                                       focus:bg-white focus:border-primary-500 focus:ring-primary-500/20 shadow-sm transition-all outline-none font-bold"
                                value="{{ old('stok', $produk->stok) }}">
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
                                   focus:bg-white focus:border-primary-500 focus:ring-primary-500/20 shadow-sm resize-none transition-all outline-none font-medium">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
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
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Update Produk
                </button>
            </div>
        </div>
    </form>
    
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
                    <button @click="showDeleteModal = false" type="button"
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

@push('scripts')
<script>
    function previewImage(event) {
        const reader = new FileReader();
        const preview = document.getElementById('productPreview');
        
        reader.onload = () => {
            preview.src = reader.result;
        };
        
        if (event.target.files && event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endpush