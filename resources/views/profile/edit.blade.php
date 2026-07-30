<x-app-layout>
    <!-- Header Page -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <h2 class="text-3xl font-black tracking-tight text-gray-900 dark:text-white flex items-center gap-3">
            <div class="p-2 bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 rounded-xl shadow-lg shadow-pink-500/30 text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path></svg>
            </div>
            Pengaturan Profil
        </h2>
    </div>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8 pb-12">
        
        <!-- 1. Form Gabungan (Avatar, Bio, Name, Email) -->
        <div class="p-6 sm:p-8 bg-white/80 dark:bg-[#1a1c23]/80 backdrop-blur-xl border border-gray-200/80 dark:border-gray-700/50 shadow-[0_15px_40px_rgba(0,0,0,0.05)] dark:shadow-[0_15px_40px_rgba(0,0,0,0.3)] sm:rounded-3xl">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- 2. Form Ubah Password -->
        <div class="p-6 sm:p-8 bg-white/80 dark:bg-[#1a1c23]/80 backdrop-blur-xl border border-gray-200/80 dark:border-gray-700/50 shadow-[0_15px_40px_rgba(0,0,0,0.05)] dark:shadow-[0_15px_40px_rgba(0,0,0,0.3)] sm:rounded-3xl">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- 3. Form Hapus Akun (Danger Zone) -->
        <div class="p-6 sm:p-8 bg-red-50/50 dark:bg-red-900/10 backdrop-blur-xl border border-red-100 dark:border-red-900/30 shadow-sm sm:rounded-3xl">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>