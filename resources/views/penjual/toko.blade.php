@extends('layouts.penjual')

@section('title', 'Edit Profil Toko')

@section('content')

    <div class="max-w-7xl mx-auto px-6 py-12 min-h-screen">
        <div class="mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Profil Toko</h1>
            <p class="text-slate-500 mt-2 font-medium">Lengkapi informasi toko Anda agar lebih menarik bagi pembeli.</p>
        </div>

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <form action="{{ route('penjual.toko.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if (session('success'))
                    <div class="m-8 mb-0 bg-green-50 border border-green-200 text-green-700 px-4 py-4 rounded-xl flex items-center gap-3 shadow-sm">
                        <div class="bg-green-100 rounded-full p-1 text-green-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="m-8 mb-0 bg-red-50 border border-red-200 text-red-700 px-4 py-4 rounded-xl shadow-sm">
                        <ul class="list-disc list-inside text-sm font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="p-8 md:p-10 grid md:grid-cols-[300px_1fr] gap-10">

                    <!-- FOTO TOKO -->
                    <div class="flex flex-col items-center">
                        <label class="w-full block text-sm font-bold text-slate-700 mb-3 text-center">Banner Toko</label>
                        <!-- PREVIEW -->
                        <div
                            class="w-full aspect-video md:aspect-square md:w-[260px] md:h-[260px] rounded-2xl overflow-hidden border-2 border-dashed border-slate-300 bg-slate-50 relative group cursor-pointer transition-all hover:border-primary-500 hover:bg-primary-50/50" onclick="document.getElementById('foto_toko_input').click()">
                            
                            @if($toko->foto_toko_url)
                                <img id="previewFoto" src="{{ $toko->foto_toko_url }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div id="previewFotoPlaceholder" class="absolute inset-0 flex flex-col items-center justify-center text-slate-400">
                                    <svg class="w-12 h-12 mb-2 text-slate-300 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm font-medium group-hover:text-primary-600 transition-colors">Upload Foto</span>
                                </div>
                                <img id="previewFoto" src="" class="w-full h-full object-cover hidden">
                            @endif

                            <div
                                class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center pointer-events-none backdrop-blur-[2px]">
                                <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="text-white font-bold text-sm tracking-wide">GANTI FOTO</span>
                            </div>
                        </div>

                        <!-- INPUT -->
                        <input id="foto_toko_input" type="file" name="foto_toko" accept="image/*" class="hidden" onchange="previewImg(event)">
                        <p class="text-[11px] text-slate-500 mt-4 text-center px-4 font-medium uppercase tracking-wider leading-relaxed">Rekomendasi rasio 1:1 atau 16:9.<br>Maksimal ukuran 2MB.</p>
                    </div>

                    <!-- FORM -->
                    <div class="space-y-6">

                        <!-- Nama Toko -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Toko <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_toko" placeholder="Masukkan nama toko"
                                value="{{ old('nama_toko', $toko->nama_toko) }}"
                                class="w-full border-slate-200 rounded-xl bg-slate-50 px-4 py-3 text-slate-800 placeholder-slate-400
                                       focus:bg-white focus:border-primary-500 focus:ring-primary-500/20 shadow-sm transition-all outline-none font-medium">
                        </div>

                        <!-- Kontak -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nomor Telepon/WhatsApp <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <input type="text" name="kontak" placeholder="Contoh: 081234567890"
                                    value="{{ old('kontak', $penjual->phone) }}"
                                    class="w-full border-slate-200 rounded-xl bg-slate-50 pl-11 pr-4 py-3 text-slate-800 placeholder-slate-400
                                           focus:bg-white focus:border-primary-500 focus:ring-primary-500/20 shadow-sm transition-all outline-none font-medium">
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Lengkap Toko <span class="text-red-500">*</span></label>
                            <textarea name="alamat" placeholder="Tuliskan alamat lengkap agar mudah dicari..." rows="3"
                                class="w-full border-slate-200 rounded-xl bg-slate-50 px-4 py-3 text-slate-800 placeholder-slate-400
                                       focus:bg-white focus:border-primary-500 focus:ring-primary-500/20 shadow-sm resize-none transition-all outline-none font-medium">{{ old('alamat', $toko->lokasi) }}</textarea>
                        </div>

                        <!-- Jam Operasional -->
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Jam Buka <span class="text-rose-500">*</span></label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-4 text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <input type="time" name="jam_buka" required
                                        value="{{ old('jam_buka', $toko->jam_buka ? \Carbon\Carbon::parse($toko->jam_buka)->format('H:i') : '') }}"
                                        class="w-full border-slate-200 rounded-xl bg-slate-50 pl-11 pr-4 py-3 text-slate-800 focus:bg-white focus:border-primary-500 focus:ring-primary-500/20 shadow-sm transition-all outline-none font-medium">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Jam Tutup <span class="text-rose-500">*</span></label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-4 text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <input type="time" name="jam_tutup" required
                                        value="{{ old('jam_tutup', $toko->jam_tutup ? \Carbon\Carbon::parse($toko->jam_tutup)->format('H:i') : '') }}"
                                        class="w-full border-slate-200 rounded-xl bg-slate-50 pl-11 pr-4 py-3 text-slate-800 focus:bg-white focus:border-primary-500 focus:ring-primary-500/20 shadow-sm transition-all outline-none font-medium">
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Toko (Opsional)</label>
                            <textarea name="deskripsi" placeholder="Ceritakan singkat tentang toko Anda, jam buka, atau produk unggulan..." rows="4"
                                class="w-full border-slate-200 rounded-xl bg-slate-50 px-4 py-3 text-slate-800 placeholder-slate-400
                                       focus:bg-white focus:border-primary-500 focus:ring-primary-500/20 shadow-sm resize-none transition-all outline-none font-medium">{{ old('deskripsi', $toko->deskripsi_toko) }}</textarea>
                        </div>

                    </div>
                </div>

                <!-- BUTTON -->
                <div class="bg-slate-50/80 px-8 py-6 border-t border-slate-100 flex items-center justify-end gap-4">
                    <a href="{{ route('penjual.dashboard') }}"
                        class="px-6 py-2.5 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold rounded-xl transition-colors shadow-sm">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-8 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-600/30 transition-all hover:-translate-y-0.5 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function previewImg(event) {
            let reader = new FileReader();
            reader.onload = () => {
                const preview = document.getElementById('previewFoto');
                const placeholder = document.getElementById('previewFotoPlaceholder');
                preview.src = reader.result;
                preview.classList.remove('hidden');
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            };
            if (event.target.files && event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
@endpush
