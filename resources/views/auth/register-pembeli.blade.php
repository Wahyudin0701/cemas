<x-guest-layout>

    <h2 class="text-center text-lg font-semibold mb-1">Buat Akun Pembeli</h2>
    <p class="text-center text-xs text-gray-500 mb-6">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Login</a>
    </p>

    <form method="POST" action="{{ route('register.pembeli') }}" class="space-y-4">
        @csrf

        <input type="hidden" name="role" value="pembeli">

        {{-- NAMA --}}
        <div>
            <label class="text-sm font-medium">Nama Lengkap *</label>
            <x-text-input id="name"
                class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm 
                {{ $errors->has('name') ? 'border-red-500 bg-red-50' : '' }}"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required />
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-600" />
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="text-sm font-medium">Email *</label>
            <x-text-input id="email"
                class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                {{ $errors->has('email') ? 'border-red-500 bg-red-50' : '' }}"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-600" />
        </div>

        {{-- PHONE --}}
        <div>
            <label class="text-sm font-medium">No HP *</label>
            <x-text-input id="phone"
                class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                {{ $errors->has('phone') ? 'border-red-500 bg-red-50' : '' }}"
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                required />
            <x-input-error :messages="$errors->get('phone')" class="mt-1 text-xs text-red-600" />
        </div>

        {{-- ALAMAT --}}
        <div>
            <label class="text-sm font-medium">Alamat *</label>
            <x-text-input id="alamat"
                class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                {{ $errors->has('alamat') ? 'border-red-500 bg-red-50' : '' }}"
                type="text"
                name="alamat"
                value="{{ old('alamat') }}"
                required />
            <x-input-error :messages="$errors->get('alamat')" class="mt-1 text-xs text-red-600" />
        </div>

        {{-- PASSWORD --}}
        <div>
            <label class="text-sm font-medium">Password *</label>
            <x-text-input id="password"
                class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                {{ $errors->has('password') ? 'border-red-500 bg-red-50' : '' }}"
                type="password"
                name="password"
                required />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-600" />
        </div>

        {{-- KONFIRMASI PASSWORD --}}
        <div>
            <label class="text-sm font-medium">Konfirmasi Password *</label>
            <x-text-input id="password_confirmation"
                class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm
                {{ $errors->has('password_confirmation') ? 'border-red-500 bg-red-50' : '' }}"
                type="password"
                name="password_confirmation"
                required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-600" />
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-xl text-sm font-medium shadow">
            Register Pembeli
        </button>
    </form>

    <!-- Footer -->
    <p class="mt-6 text-center text-xs text-gray-500">
        Ingin daftar sebagai penjual?
        <a href="{{ route('register.penjual') }}" class="text-blue-600 hover:underline">Daftar sekarang</a>
    </p>

</x-guest-layout>