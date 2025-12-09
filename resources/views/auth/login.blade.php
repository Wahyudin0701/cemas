<x-guest-layout>
        <!-- Judul -->
        <h2 class="text-center text-lg font-semibold mb-1">Masuk ke Akun Anda</h2>
        <p class="text-center text-xs text-gray-500 mb-6">
            Silakan login untuk melanjutkan
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-xs text-green-600" :status="session('status')" />

        <!-- FORM LOGIN -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label class="text-sm font-medium">Email</label>
                <x-text-input id="email"
                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm outline-none"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autofocus autocomplete="username" />

                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="text-sm font-medium">Password</label>
                <x-text-input id="password"
                    class="block w-full px-4 py-2 mt-1 rounded-xl bg-gray-50 border text-sm outline-none"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
            </div>

            <!-- Remember + Lupa Password -->
            <div class="flex items-center justify-between mb-5 text-xs">
                <label class="flex items-center gap-2">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                        name="remember">
                    Ingat saya
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Tombol Login -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-xl shadow text-sm">
                Masuk
            </button>
        </form>

        <!-- Footer -->
        <p class="mt-6 text-center text-xs text-gray-500">
            Belum punya akun?
            <a href="{{ route('register.pembeli') }}" class="text-blue-600 hover:underline">Daftar sekarang</a>
        </p>

</x-guest-layout>
