<x-guest-layout>

    <h2 class="text-center text-xl font-bold text-slate-800 mb-2">Buat Akun Pembeli</h2>
    <p class="text-center text-sm text-slate-500 mb-8">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-primary-600 font-semibold hover:text-primary-700 transition-colors">Login di sini</a>
    </p>

    <form method="POST" action="{{ route('register.pembeli') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="role" value="pembeli">

        {{-- NAMA --}}
        <div>
            <label class="text-sm font-semibold text-slate-700">Nama Lengkap *</label>
            <x-text-input id="name"
                class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-slate-50 border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors
                {{ $errors->has('name') ? 'border-red-500 bg-red-50 focus:ring-red-500' : '' }}"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required placeholder="Nama Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="text-sm font-semibold text-slate-700">Email *</label>
            <x-text-input id="email"
                class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-slate-50 border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors
                {{ $errors->has('email') ? 'border-red-500 bg-red-50 focus:ring-red-500' : '' }}"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required placeholder="email@contoh.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        {{-- PHONE --}}
        <div>
            <label class="text-sm font-semibold text-slate-700">No HP *</label>
            <x-text-input id="phone"
                class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-slate-50 border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors
                {{ $errors->has('phone') ? 'border-red-500 bg-red-50 focus:ring-red-500' : '' }}"
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                required placeholder="08xxxxxxxxxx" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2 text-xs" />
        </div>

        {{-- ALAMAT --}}
        <div>
            <label class="text-sm font-semibold text-slate-700">Alamat Lengkap *</label>
            <x-text-input id="alamat"
                class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-slate-50 border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors
                {{ $errors->has('alamat') ? 'border-red-500 bg-red-50 focus:ring-red-500' : '' }}"
                type="text"
                name="alamat"
                value="{{ old('alamat') }}"
                required placeholder="Jl. Aston Villa..." />
            <x-input-error :messages="$errors->get('alamat')" class="mt-2 text-xs" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            {{-- PASSWORD --}}
            <div>
                <label class="text-sm font-semibold text-slate-700">Password *</label>
                <x-text-input id="password"
                    class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-slate-50 border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors
                    {{ $errors->has('password') ? 'border-red-500 bg-red-50 focus:ring-red-500' : '' }}"
                    type="password"
                    name="password"
                    required placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
            </div>

            {{-- KONFIRMASI PASSWORD --}}
            <div>
                <label class="text-sm font-semibold text-slate-700">Konfirmasi *</label>
                <x-text-input id="password_confirmation"
                    class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-slate-50 border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors
                    {{ $errors->has('password_confirmation') ? 'border-red-500 bg-red-50 focus:ring-red-500' : '' }}"
                    type="password"
                    name="password_confirmation"
                    required placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
            </div>
        </div>

        <button type="submit"
            class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 rounded-xl shadow-lg shadow-primary-600/30 transition-all hover:-translate-y-0.5 mt-4">
            Daftar Sekarang
        </button>
    </form>

    <!-- Footer -->
    <p class="mt-8 text-center text-sm text-slate-500">
        Ingin daftar sebagai penjual?
        <a href="{{ route('register.penjual') }}" class="text-primary-600 hover:text-primary-700 font-semibold transition-colors">Daftar Penjual</a>
    </p>

</x-guest-layout>