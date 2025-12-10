<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        .login-bg {
            background-image: url('{{ asset('images/lorong_asvil.jpg') }}');
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased 
             bg-cover bg-center bg-no-repeat bg-fixed login-bg">
    <!-- FULL CENTER -->
    <div class="min-h-screen flex items-center justify-center px-4">

        <!-- BLUR FOLLOW CONTENT -->
        <div class="w-full max-w-5xl bg-white/30 backdrop-blur-2xl 
                    rounded-3xl shadow-2xl p-8">

            <!-- Header -->
            <div class="flex flex-col items-center mb-6">
                <div
                    class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center font-bold text-xl">
                    C
                </div>
                <h1 class="mt-2 text-xl font-bold">CeMas</h1>
                <p class="text-xs text-gray-600 -mt-1">Community E-Marketplace Aston Villa</p>
            </div>

            <!-- FORM -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow p-6">
                <h2 class="text-center text-lg font-semibold mb-1">Registrasi Penjual & Toko</h2>
                <p class="text-center text-xs text-gray-500 mb-6">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Login</a>
                </p>

                <form method="POST" action="{{ route('register.penjual') }}" class="space-y-6"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="role" value="penjual">

                    <!-- GRID FORM PENJUAL + TOKO -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- ========================= -->
                        <!-- BAGIAN DATA PENJUAL -->
                        <!-- ========================= -->
                        <div class="space-y-4 p-4 border rounded-xl bg-white shadow-sm">

                            <h3 class="text-base font-semibold mb-2">Data Penjual</h3>

                            {{-- NAMA --}}
                            <div>
                                <label class="text-sm font-medium">Nama Lengkap *</label>
                                <x-text-input id="name"
                                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm 
                        {{ $errors->has('name') ? 'border-red-500 bg-red-50' : '' }}"
                                    type="text" name="name" value="{{ old('name') }}" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-600" />
                            </div>

                            {{-- EMAIL --}}
                            <div>
                                <label class="text-sm font-medium">Email *</label>
                                <x-text-input id="email"
                                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm 
                        {{ $errors->has('email') ? 'border-red-500 bg-red-50' : '' }}"
                                    type="email" name="email" value="{{ old('email') }}" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-600" />
                            </div>

                            {{-- NIK --}}
                            <div>
                                <label class="text-sm font-medium">NIK *</label>
                                <x-text-input id="nik"
                                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                        {{ $errors->has('nik') ? 'border-red-500 bg-red-50' : '' }}"
                                    type="text" name="nik" value="{{ old('nik') }}" required />
                                <x-input-error :messages="$errors->get('nik')" class="mt-1 text-xs text-red-600" />
                            </div>

                            {{-- FOTO KTP --}}
                            <div>
                                <label class="text-sm font-medium">Foto KTP *</label>
                                <input type="file"
                                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                        {{ $errors->has('foto_ktp') ? 'border-red-500 bg-red-50' : '' }}"
                                    name="foto_ktp" accept="image/*" required>
                                <x-input-error :messages="$errors->get('foto_ktp')" class="mt-1 text-xs text-red-600" />
                            </div>

                            {{-- PHONE --}}
                            <div>
                                <label class="text-sm font-medium">No HP *</label>
                                <x-text-input id="phone"
                                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                        {{ $errors->has('phone') ? 'border-red-500 bg-red-50' : '' }}"
                                    type="text" name="phone" value="{{ old('phone') }}" required />
                                <x-input-error :messages="$errors->get('phone')" class="mt-1 text-xs text-red-600" />
                            </div>

                            {{-- ALAMAT --}}
                            <div>
                                <label class="text-sm font-medium">Alamat *</label>
                                <x-text-input id="alamat"
                                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                        {{ $errors->has('alamat') ? 'border-red-500 bg-red-50' : '' }}"
                                    type="text" name="alamat" value="{{ old('alamat') }}" required />
                                <x-input-error :messages="$errors->get('alamat')" class="mt-1 text-xs text-red-600" />
                            </div>

                            {{-- PASSWORD --}}
                            <div>
                                <label class="text-sm font-medium">Password *</label>
                                <x-text-input id="password"
                                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                        {{ $errors->has('password') ? 'border-red-500 bg-red-50' : '' }}"
                                    type="password" name="password" required />
                                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-600" />
                            </div>

                            {{-- KONFIRMASI PASSWORD --}}
                            <div>
                                <label class="text-sm font-medium">Konfirmasi Password *</label>
                                <x-text-input id="password_confirmation"
                                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                        {{ $errors->has('password_confirmation') ? 'border-red-500 bg-red-50' : '' }}"
                                    type="password" name="password_confirmation" required />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-600" />
                            </div>

                        </div>

                        <!-- ========================= -->
                        <!-- BAGIAN DATA TOKO -->
                        <!-- ========================= -->
                        <div class="space-y-4 p-4 border rounded-xl bg-white shadow-sm">

                            <h3 class="text-base font-semibold mb-2">Data Toko</h3>

                            {{-- NAMA TOKO --}}
                            <div>
                                <label class="text-sm font-medium">Nama Toko *</label>
                                <x-text-input id="nama_toko"
                                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                        {{ $errors->has('nama_toko') ? 'border-red-500 bg-red-50' : '' }}"
                                    type="text" name="nama_toko" value="{{ old('nama_toko') }}" required />
                                <x-input-error :messages="$errors->get('nama_toko')" class="mt-1 text-xs text-red-600" />
                            </div>

                            {{-- DESKRIPSI TOKO --}}
                            <div>
                                <label class="text-sm font-medium">Deskripsi Toko *</label>
                                <textarea name="deskripsi_toko" rows="3"
                                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                        {{ $errors->has('deskripsi_toko') ? 'border-red-500 bg-red-50' : '' }}"
                                    required>{{ old('deskripsi_toko') }}</textarea>
                                <x-input-error :messages="$errors->get('deskripsi_toko')" class="mt-1 text-xs text-red-600" />
                            </div>

                            {{-- FOTO TOKO --}}
                            <div>
                                <label class="text-sm font-medium">Foto Toko *</label>
                                <input type="file"
                                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                        {{ $errors->has('foto_toko') ? 'border-red-500 bg-red-50' : '' }}"
                                    name="foto_toko" accept="image/*" required>
                                <x-input-error :messages="$errors->get('foto_toko')" class="mt-1 text-xs text-red-600" />
                            </div>

                            {{-- JAM BUKA --}}
                            <div>
                                <label class="text-sm font-medium">Jam Buka *</label>
                                <input type="time" name="jam_buka" value="{{ old('jam_buka') }}"
                                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm 
                        {{ $errors->has('jam_buka') ? 'border-red-500 bg-red-50' : '' }}"
                                    required>
                                <x-input-error :messages="$errors->get('jam_buka')" class="mt-1 text-xs text-red-600" />
                            </div>

                            {{-- JAM TUTUP --}}
                            <div>
                                <label class="text-sm font-medium">Jam Tutup *</label>
                                <input type="time" name="jam_tutup" value="{{ old('jam_tutup') }}"
                                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm 
                        {{ $errors->has('jam_tutup') ? 'border-red-500 bg-red-50' : '' }}"
                                    required>
                                <x-input-error :messages="$errors->get('jam_tutup')" class="mt-1 text-xs text-red-600" />
                            </div>

                            {{-- LOKASI --}}
                            <div>
                                <label class="text-sm font-medium">Lokasi *</label>
                                <x-text-input id="lokasi"
                                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                        {{ $errors->has('lokasi') ? 'border-red-500 bg-red-50' : '' }}"
                                    type="text" name="lokasi" value="{{ old('lokasi') }}" required />
                                <x-input-error :messages="$errors->get('lokasi')" class="mt-1 text-xs text-red-600" />
                            </div>

                            <!-- SUBMIT BUTTON -->
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-xl text-sm font-medium shadow">
                                Daftar Sebagai Penjual
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>



</html>
