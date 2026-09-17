<x-guest-layout>
        <!-- Judul -->
        <h2 class="text-center text-xl font-bold text-slate-800 mb-2">Masuk ke Akun Anda</h2>
        <p class="text-center text-sm text-slate-500 mb-8">
            Senang melihat Anda kembali
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-6 text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-100 text-center" :status="session('status')" />

        <!-- FORM LOGIN -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="text-sm font-semibold text-slate-700">Email</label>
                <x-text-input id="email"
                    class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-slate-50 border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autofocus autocomplete="username" placeholder="Masukkan email Anda" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
            </div>

            <!-- Password -->
            <div>
                <label class="text-sm font-semibold text-slate-700">Password</label>
                <x-text-input id="password"
                    class="block w-full px-4 py-3 mt-1.5 rounded-xl bg-slate-50 border-slate-200 text-sm focus:ring-primary-500 focus:border-primary-500 transition-colors"
                    type="password"
                    name="password"
                    required autocomplete="current-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
            </div>

            <!-- Remember + Lupa Password -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-slate-300 text-primary-600 shadow-sm focus:ring-primary-500 w-4 h-4 cursor-pointer"
                        name="remember">
                    <span class="text-slate-600 group-hover:text-slate-800 transition-colors">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-primary-600 hover:text-primary-700 font-semibold transition-colors">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Tombol Login -->
            <button type="submit"
                class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 rounded-xl shadow-lg shadow-primary-600/30 transition-all hover:-translate-y-0.5 mt-2">
                Masuk ke Dashboard
            </button>
        </form>

        <!-- Footer -->
        <p class="mt-8 text-center text-sm text-slate-500">
            Belum punya akun?
            <a href="{{ route('register.pembeli') }}" class="text-primary-600 hover:text-primary-700 font-semibold transition-colors">Daftar sekarang</a>
        </p>

</x-guest-layout>
