<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        .login-bg {
            background-image: url('{{ asset('Image/lorong_asvil.jpg') }}');
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-slate-900 antialiased bg-cover bg-center bg-no-repeat bg-fixed login-bg py-10">
    <!-- FULL CENTER -->
    <div class="min-h-screen flex items-center justify-center px-4">

        <!-- BLUR FOLLOW CONTENT -->
        <div class="w-full max-w-5xl bg-white/40 backdrop-blur-3xl rounded-3xl shadow-2xl p-6 md:p-8 border border-white/50">

            <!-- Header -->
            <div class="flex flex-col items-center mb-8">
                <a href="/">
                    <img src="{{ asset('Image/logo.png') }}" alt="CeMas Logo" class="h-16 object-contain drop-shadow-md hover:scale-105 transition-transform">
                </a>
                <p class="text-sm font-medium text-slate-700 mt-3 tracking-wide">Community E-Marketplace Aston Villa</p>
            </div>

            <!-- FORM -->
            <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl shadow-slate-200/50 p-6 md:p-8 border border-white">
                <h2 class="text-center text-xl font-bold text-slate-800 mb-2">Registrasi Penjual & Toko</h2>
                <p class="text-center text-sm text-slate-500 mb-8">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-primary-600 font-semibold hover:text-primary-700 transition-colors">Login di sini</a>
                </p>

                <form method="POST" action="{{ route('register.penjual') }}" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="role" value="penjual">

                    <!-- GRID FORM PENJUAL + TOKO -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- ========================= -->
                        <!-- BAGIAN DATA PENJUAL -->
                        <!-- ========================= -->
                        <div class="space-y-5 p-6 border border-slate-100 rounded-2xl bg-slate-50/50 shadow-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold">1</div>
                                <h3 class="text-lg font-bold text-slate-800">Data Pemilik</h3>
                            </div>

                            {{-- NAMA --}}
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Nama Lengkap *</label>
                                <x-text-input id="name"
                                    class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-white border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors {{ $errors->has('name') ? 'border-red-500 bg-red-50' : '' }}"
                                    type="text" name="name" value="{{ old('name') }}" required placeholder="Nama sesuai KTP" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
                            </div>

                            {{-- EMAIL --}}
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Email *</label>
                                <x-text-input id="email"
                                    class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-white border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors {{ $errors->has('email') ? 'border-red-500 bg-red-50' : '' }}"
                                    type="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
                            </div>

                            {{-- NIK --}}
                            <div>
                                <label class="text-sm font-semibold text-slate-700">NIK *</label>
                                <x-text-input id="nik"
                                    class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-white border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors {{ $errors->has('nik') ? 'border-red-500 bg-red-50' : '' }}"
                                    type="text" name="nik" value="{{ old('nik') }}" required placeholder="16 digit NIK" />
                                <x-input-error :messages="$errors->get('nik')" class="mt-2 text-xs" />
                            </div>

                            {{-- FOTO KTP --}}
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Foto KTP *</label>
                                <input type="file"
                                    class="block w-full px-4 py-2 mt-1.5 rounded-xl bg-white border border-slate-200 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition-colors cursor-pointer {{ $errors->has('foto_ktp') ? 'border-red-500 bg-red-50' : '' }}"
                                    name="foto_ktp" accept="image/*" required>
                                <x-input-error :messages="$errors->get('foto_ktp')" class="mt-2 text-xs" />
                            </div>

                            {{-- PHONE --}}
                            <div>
                                <label class="text-sm font-semibold text-slate-700">No HP *</label>
                                <x-text-input id="phone"
                                    class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-white border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors {{ $errors->has('phone') ? 'border-red-500 bg-red-50' : '' }}"
                                    type="text" name="phone" value="{{ old('phone') }}" required placeholder="08xxxxxxxxxx" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2 text-xs" />
                            </div>

                            {{-- ALAMAT --}}
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Alamat Lengkap *</label>
                                <x-text-input id="alamat"
                                    class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-white border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors {{ $errors->has('alamat') ? 'border-red-500 bg-red-50' : '' }}"
                                    type="text" name="alamat" value="{{ old('alamat') }}" required placeholder="Jl. Aston Villa..." />
                                <x-input-error :messages="$errors->get('alamat')" class="mt-2 text-xs" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                {{-- PASSWORD --}}
                                <div>
                                    <label class="text-sm font-semibold text-slate-700">Password *</label>
                                    <x-text-input id="password"
                                        class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-white border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors {{ $errors->has('password') ? 'border-red-500 bg-red-50' : '' }}"
                                        type="password" name="password" required placeholder="••••••••" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
                                </div>

                                {{-- KONFIRMASI PASSWORD --}}
                                <div>
                                    <label class="text-sm font-semibold text-slate-700">Konfirmasi *</label>
                                    <x-text-input id="password_confirmation"
                                        class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-white border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors {{ $errors->has('password_confirmation') ? 'border-red-500 bg-red-50' : '' }}"
                                        type="password" name="password_confirmation" required placeholder="••••••••" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
                                </div>
                            </div>
                        </div>

                        <!-- ========================= -->
                        <!-- BAGIAN DATA TOKO -->
                        <!-- ========================= -->
                        <div class="space-y-5 p-6 border border-slate-100 rounded-2xl bg-slate-50/50 shadow-sm flex flex-col justify-between">
                            <div class="space-y-5">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold">2</div>
                                    <h3 class="text-lg font-bold text-slate-800">Data Toko</h3>
                                </div>

                                {{-- NAMA TOKO --}}
                                <div>
                                    <label class="text-sm font-semibold text-slate-700">Nama Toko *</label>
                                    <x-text-input id="nama_toko"
                                        class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-white border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors {{ $errors->has('nama_toko') ? 'border-red-500 bg-red-50' : '' }}"
                                        type="text" name="nama_toko" value="{{ old('nama_toko') }}" required placeholder="Toko Berkah" />
                                    <x-input-error :messages="$errors->get('nama_toko')" class="mt-2 text-xs" />
                                </div>

                                {{-- DESKRIPSI TOKO --}}
                                <div>
                                    <label class="text-sm font-semibold text-slate-700">Deskripsi Singkat *</label>
                                    <textarea name="deskripsi_toko" rows="3"
                                        class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-white border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors resize-none {{ $errors->has('deskripsi_toko') ? 'border-red-500 bg-red-50' : '' }}"
                                        required placeholder="Menjual berbagai macam kebutuhan pokok...">{{ old('deskripsi_toko') }}</textarea>
                                    <x-input-error :messages="$errors->get('deskripsi_toko')" class="mt-2 text-xs" />
                                </div>

                                {{-- FOTO TOKO --}}
                                <div>
                                    <label class="text-sm font-semibold text-slate-700">Foto Toko *</label>
                                    <input type="file"
                                        class="block w-full px-4 py-2 mt-1.5 rounded-xl bg-white border border-slate-200 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition-colors cursor-pointer {{ $errors->has('foto_toko') ? 'border-red-500 bg-red-50' : '' }}"
                                        name="foto_toko" accept="image/*" required>
                                    <x-input-error :messages="$errors->get('foto_toko')" class="mt-2 text-xs" />
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    {{-- JAM BUKA --}}
                                    <div>
                                        <label class="text-sm font-semibold text-slate-700">Jam Buka *</label>
                                        <input type="time" name="jam_buka" value="{{ old('jam_buka') }}"
                                            class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-white border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors {{ $errors->has('jam_buka') ? 'border-red-500 bg-red-50' : '' }}"
                                            required>
                                        <x-input-error :messages="$errors->get('jam_buka')" class="mt-2 text-xs" />
                                    </div>

                                    {{-- JAM TUTUP --}}
                                    <div>
                                        <label class="text-sm font-semibold text-slate-700">Jam Tutup *</label>
                                        <input type="time" name="jam_tutup" value="{{ old('jam_tutup') }}"
                                            class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-white border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors {{ $errors->has('jam_tutup') ? 'border-red-500 bg-red-50' : '' }}"
                                            required>
                                        <x-input-error :messages="$errors->get('jam_tutup')" class="mt-2 text-xs" />
                                    </div>
                                </div>

                                {{-- LOKASI --}}
                                <div>
                                    <label class="text-sm font-semibold text-slate-700">Lokasi / Patokan *</label>
                                    <x-text-input id="lokasi"
                                        class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-white border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors {{ $errors->has('lokasi') ? 'border-red-500 bg-red-50' : '' }}"
                                        type="text" name="lokasi" value="{{ old('lokasi') }}" required placeholder="Misal: Blok B No. 12" />
                                    <x-input-error :messages="$errors->get('lokasi')" class="mt-2 text-xs" />
                                </div>
                            </div>

                            <!-- SUBMIT BUTTON -->
                            <button type="submit"
                                class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-primary-600/30 transition-all hover:-translate-y-0.5 mt-6 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Daftarkan Toko Sekarang
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
