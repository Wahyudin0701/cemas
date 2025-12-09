<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('Password Saat Ini')" class="text-gray-700 font-medium"/>
            <x-text-input id="current_password" name="current_password" type="password" class="p-2 mt-1 block w-full rounded-lg border focus:border-yellow-500 focus:ring-yellow-500 shadow-sm" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password Baru')" class="text-gray-700 font-medium"/>
            <x-text-input id="password" name="password" type="password" class="p-2 mt-1 block w-full rounded-lg border focus:border-yellow-500 focus:ring-yellow-500 shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" class="text-gray-700 font-medium"/>
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="p-2 mt-1 block w-full rounded-lg border focus:border-yellow-500 focus:ring-yellow-500 shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="px-5 py-2.5 bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium rounded-lg shadow-sm transition-all focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium flex items-center gap-1"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ __('Tersimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>
