<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-slate-700 font-bold mb-2 block"/>
            <div class="relative">
                <x-text-input id="name" name="name" type="text" class="p-3 block w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-primary-500 focus:ring-primary-500 shadow-sm transition-colors" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="text-slate-700 font-bold mb-2 block"/>
            <div class="relative">
                <x-text-input id="email" name="email" type="email" class="p-3 block w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-primary-500 focus:ring-primary-500 shadow-sm transition-colors" :value="old('email', $user->email)" required autocomplete="username" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-4 bg-amber-50 rounded-xl border border-amber-200 flex items-start gap-3">
                    <svg class="w-5 h-5 text-amber-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <div>
                        <p class="text-sm text-amber-800 font-medium">
                            {{ __('Email Anda belum diverifikasi.') }}
                        </p>
                        <button form="send-verification" class="text-sm font-bold text-amber-700 hover:text-amber-900 underline mt-1 transition-colors">
                            {{ __('Kirim ulang link verifikasi.') }}
                        </button>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-sm text-emerald-600">
                            {{ __('Link verifikasi baru telah dikirim.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-6">
            <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white text-sm font-bold rounded-xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 flex items-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm text-emerald-600 font-bold flex items-center gap-1 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-100"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ __('Tersimpan') }}
                </p>
            @endif
        </div>
    </form>
</section>
