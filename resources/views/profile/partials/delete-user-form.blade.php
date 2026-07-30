<section class="space-y-6">
    <header>
        <h2 class="text-lg font-black text-red-600 dark:text-red-500">
            Hapus Akun Permanen
        </h2>
        <p class="mt-1 text-xs text-red-500 dark:text-red-400 font-medium">
            Tindakan ini tidak dapat dibatalkan. Semua data, postingan, dan pengaturan Anda akan dihapus selamanya.
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="px-6 py-2.5 font-bold text-white text-xs bg-red-600 hover:bg-red-700 rounded-xl shadow-lg shadow-red-500/30 hover:scale-105 active:scale-95 transition-all duration-200">
        Hapus Akun Saya
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl">
            @csrf
            @method('delete')

            <h2 class="text-lg font-black text-gray-900 dark:text-white">
                Anda yakin ingin menghapus akun?
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Tindakan ini permanen. Masukkan kata sandi Anda untuk mengonfirmasi penghapusan akun.
            </p>

            <div class="mt-6">
                <input id="password" name="password" type="password" class="w-full px-4 py-3 text-sm rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all shadow-inner" placeholder="Masukkan kata sandi">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-xs" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-5 py-2 font-bold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 font-bold text-white bg-red-600 hover:bg-red-700 rounded-xl shadow-lg shadow-red-500/30 transition-colors">
                    Hapus Akun Permanen
                </button>
            </div>
        </form>
    </x-modal>
</section>