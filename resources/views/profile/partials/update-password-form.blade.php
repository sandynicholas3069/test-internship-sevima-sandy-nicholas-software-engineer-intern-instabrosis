<section>
    <header>
        <h2 class="text-lg font-black text-gray-900 dark:text-white">
            Ubah Kata Sandi
        </h2>
        <p class="mt-1 text-xs text-gray-600 dark:text-gray-400 font-medium">
            Pastikan akun Anda menggunakan kata sandi panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full px-4 py-3 text-sm rounded-xl bg-gray-50/80 dark:bg-gray-900/80 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all shadow-inner" autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-xs" />
        </div>

        <div>
            <label for="update_password_password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" class="w-full px-4 py-3 text-sm rounded-xl bg-gray-50/80 dark:bg-gray-900/80 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all shadow-inner" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-xs" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Konfirmasi Kata Sandi Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full px-4 py-3 text-sm rounded-xl bg-gray-50/80 dark:bg-gray-900/80 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all shadow-inner" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-xs" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-6 py-2.5 font-bold text-white text-xs bg-gradient-to-r from-purple-600 to-pink-500 hover:from-purple-700 hover:to-pink-600 rounded-xl shadow-lg shadow-pink-500/30 hover:scale-105 active:scale-95 transition-all duration-200">
                Perbarui Sandi
            </button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-bold text-emerald-500">Tersimpan.</p>
            @endif
        </div>
    </form>
</section>