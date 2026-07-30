<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'InstaBroSis') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles via Vite -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
            <script>
                tailwind.config = {
                    darkMode: 'class',
                    theme: { extend: { fontFamily: { sans: ['Figtree', 'sans-serif'], } } }
                }
            </script>
        @endif

        <!-- Script inisialisasi Dark Mode (Mencegah Kedipan Mode) -->
        <script>
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50 dark:bg-[#0f1115] dark:text-gray-100 transition-colors duration-300 min-h-screen flex flex-col relative overflow-x-hidden">

        <!-- Background Glowing Orbs (Latar Belakang Konsisten) -->
        <div class="fixed top-[-10%] left-[-10%] w-[45%] h-[45%] bg-gradient-to-br from-purple-500/20 to-pink-500/20 dark:from-purple-900/30 dark:to-pink-900/30 rounded-full blur-[120px] pointer-events-none -z-10"></div>
        <div class="fixed bottom-[-10%] right-[-10%] w-[45%] h-[45%] bg-gradient-to-tl from-orange-400/15 to-yellow-400/15 dark:from-orange-800/20 dark:to-yellow-800/20 rounded-full blur-[120px] pointer-events-none -z-10"></div>

        <!-- Navigation Bar -->
        @include('layouts.navigation')

        <!-- Main Page Content -->
        <main class="flex-grow max-w-5xl w-full mx-auto py-8 px-4 sm:px-6 lg:px-8 z-10">
            
            <!-- Alert Messages (Notifikasi Sukses/Gagal) -->
            @if (session('success'))
                <div class="max-w-xl mx-auto mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-xs font-bold flex items-center justify-between backdrop-blur-md shadow-sm">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('success') }}
                    </span>
                    <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">&times;</button>
                </div>
            @endif

            @if (session('error'))
                <div class="max-w-xl mx-auto mb-6 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 text-xs font-bold flex items-center justify-between backdrop-blur-md shadow-sm">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path></svg>
                        {{ session('error') }}
                    </span>
                    <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700">&times;</button>
                </div>
            @endif

            <!-- Konten Halaman Blade Disisipkan Di Sini -->
            {{ $slot }}
        </main>

        <!-- Simple App Footer -->
        <footer class="py-6 border-t border-gray-200/50 dark:border-gray-800/50 text-center text-xs text-gray-500 dark:text-gray-400 z-10">
            &copy; {{ date('Y') }} InstaBroSis. Built with Laravel & Tailwind CSS.
        </footer>
    </body>
</html>