<x-guest-layout>
    <!-- Card Container dengan Efek Glassmorphism & Timbul -->
    <div class="relative bg-white/80 dark:bg-[#1a1c23]/80 backdrop-blur-xl border border-white/50 dark:border-gray-700/50 p-8 sm:p-10 rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.5)] transition-all duration-300">
        
        <!-- Header Branding InstaBroSis -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 shadow-lg shadow-pink-500/30 mb-3 hover:scale-105 transition-transform duration-200">
                <!-- SVG Kamera dari Welcome Page -->
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-black tracking-tight text-gray-900 dark:text-white">
                Selamat Datang Kembali!
            </h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 font-medium">
                Masuk ke akun <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500 font-bold">InstaBroSis</span> milikmu
            </p>
        </div>

        <!-- Session Status (Pesan Notifikasi/Error) -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                    Email
                </label>
                <div class="relative">
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                        class="w-full px-4 py-3 text-sm rounded-xl bg-gray-50/80 dark:bg-gray-900/80 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all shadow-inner"
                        placeholder="nama@email.com">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-500" />
            </div>

            <!-- Password Input -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300">
                        Kata Sandi
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-xs text-pink-500 hover:text-pink-600 dark:hover:text-pink-400 font-semibold transition" href="{{ route('password.request') }}">
                            Lupa kata sandi?
                        </a>
                    @endif
                </div>
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-3 text-sm rounded-xl bg-gray-50/80 dark:bg-gray-900/80 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all shadow-inner"
                        placeholder="••••••••">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-500" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="w-4 h-4 rounded-md border-gray-300 dark:border-gray-700 text-pink-500 shadow-sm focus:ring-pink-500 dark:bg-gray-900 transition cursor-pointer">
                    <span class="ms-2 text-xs font-semibold text-gray-600 dark:text-gray-400 select-none">
                        Ingat Saya
                    </span>
                </label>
            </div>

            <!-- Submit Button (Gradient Instagram Button) -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full py-3.5 px-4 font-bold text-white text-sm bg-gradient-to-r from-purple-600 via-pink-500 to-orange-400 hover:from-purple-700 hover:via-pink-600 hover:to-orange-500 rounded-xl shadow-[0_10px_20px_rgba(236,72,153,0.3)] hover:shadow-[0_15px_25px_rgba(236,72,153,0.4)] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                    Masuk Sekarang
                </button>
            </div>
        </form>

        <!-- Footer Redirect ke Register -->
        <div class="mt-8 pt-6 border-t border-gray-200/60 dark:border-gray-800 text-center text-xs text-gray-600 dark:text-gray-400">
            Belum memiliki akun?
            <a href="{{ route('register') }}" class="text-pink-500 hover:text-pink-600 dark:hover:text-pink-400 font-extrabold ml-1 hover:underline transition">
                Daftar Akun Baru
            </a>
        </div>
    </div>
</x-guest-layout>