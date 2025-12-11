@extends('layouts.penjual')

@section('title', 'Edit Profil Toko - CeMas')

@section('content')

    <div class="max-w-5xl mx-auto px-6 py-12">

        <h1 class="text-3xl font-extrabold text-gray-900 mb-10">Edit Profil Toko</h1>

        <!-- CARD -->
        <div class="bg-white rounded-2xl shadow-lg p-10 border">
            <form action="{{ route('penjual.toko.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if (session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid md:grid-cols-2 gap-10">

                    <!-- FOTO TOKO -->
                    <div class="flex flex-col items-center">

                        <!-- PREVIEW -->
                        <div
                            class="w-[320px] h-[240px] rounded-xl overflow-hidden border shadow bg-gray-100 relative group">
                            <img id="previewFoto" src="{{ $toko->foto_toko_url ?? '/Images/lorong_asvil.jpg' }}"
                                class="w-full h-full object-cover">

                            <div
                                class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                                <span class="text-white font-medium">Pratinjau Foto</span>
                            </div>
                        </div>

                        <!-- INPUT -->
                        <label
                            class="mt-5 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow cursor-pointer text-sm transition-colors">
                            Ganti Foto Toko
                            <input type="file" name="foto_toko" accept="image/*" class="hidden"
                                onchange="previewImg(event)">
                        </label>

                        <p class="text-xs text-gray-500 mt-3">* Maksimal 2MB. Format JPG/PNG.</p>
                    </div>

                    <!-- FORM -->
                    <div class="space-y-6">

                        <!-- Nama Toko -->
                        <div class="relative">
                            <input type="text" name="nama_toko" placeholder=" "
                                value="{{ old('nama_toko', $toko->nama_toko) }}"
                                class="peer block w-full border border-gray-300 rounded-xl bg-white px-4 py-3
                                       focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all outline-none">
                            <label
                                class="absolute left-4 top-3 bg-white px-1 text-gray-500 transition-all duration-150
                                          peer-focus:text-xs peer-focus:-top-2 peer-focus:text-blue-600
                                          peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-top-2">
                                Nama Toko
                            </label>
                        </div>

                        <!-- Alamat -->
                        <div class="relative">
                            <textarea name="alamat" placeholder=" " rows="3"
                                class="peer block w-full border border-gray-300 rounded-xl bg-white px-4 py-3
                                       focus:border-blue-500 focus:ring-blue-500 shadow-sm resize-none transition-all outline-none">{{ old('alamat', $toko->lokasi) }}</textarea>
                            <label
                                class="absolute left-4 top-3 bg-white px-1 text-gray-500 transition-all duration-150
                                          peer-focus:text-xs peer-focus:-top-2 peer-focus:text-blue-600 
                                          peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-top-2">
                                Alamat Toko
                            </label>
                        </div>

                        <!-- Kontak -->
                        <div class="relative">
                            <input type="text" name="kontak" placeholder=" "
                                value="{{ old('kontak', $penjual->phone) }}"
                                class="peer block w-full border border-gray-300 rounded-xl bg-white px-4 py-3
                                       focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all outline-none">
                            <label
                                class="absolute left-4 top-3 bg-white px-1 text-gray-500 transition-all duration-150
                                          peer-focus:text-xs peer-focus:-top-2 peer-focus:text-blue-600
                                          peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-top-2">
                                Nomor Kontak
                            </label>
                        </div>

                        <!-- Deskripsi -->
                        <div class="relative">
                            <textarea name="deskripsi" placeholder=" " rows="4"
                                class="peer block w-full border border-gray-300 rounded-xl bg-white px-4 py-3
                                       focus:border-blue-500 focus:ring-blue-500 shadow-sm resize-none transition-all outline-none">{{ old('deskripsi', $toko->deskripsi_toko) }}</textarea>
                            <label
                                class="absolute left-4 top-3 bg-white px-1 text-gray-500 transition-all duration-150
                                          peer-focus:text-xs peer-focus:-top-2 peer-focus:text-blue-600 
                                          peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-top-2">
                                Deskripsi Toko
                            </label>
                        </div>

                    </div>
                </div>

                <!-- BUTTON -->
                <div class="mt-10 flex justify-end space-x-4">
                    <a href="{{ route('penjual.dashboard') }}"
                        class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition-colors">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow transition-colors">
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
                document.getElementById('previewFoto').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endpush
