<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('Password Saat Ini')" class="text-slate-700 font-bold mb-2 block"/>
            <x-text-input id="current_password" name="current_password" type="password" class="p-3 block w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-amber-500 focus:ring-amber-500 shadow-sm transition-colors" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password Baru')" class="text-slate-700 font-bold mb-2 block"/>
            <x-text-input id="password" name="password" type="password" class="p-3 block w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-amber-500 focus:ring-amber-500 shadow-sm transition-colors" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" class="text-slate-700 font-bold mb-2 block"/>
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="p-3 block w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-amber-500 focus:ring-amber-500 shadow-sm transition-colors" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-6">
            <button type="submit" class="px-6 py-3 bg-slate-800 hover:bg-slate-900 text-white text-sm font-bold rounded-xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 flex items-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
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
