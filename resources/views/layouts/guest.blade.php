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
            <!-- Fallback CDN untuk Pengujian -->
            <script src="https://cdn.tailwindcss.com"></script>
            <script>
                tailwind.config = {
                    darkMode: 'class',
                    theme: { extend: { fontFamily: { sans: ['Figtree', 'sans-serif'], } } }
                }
            </script>
        @endif

        <!-- Script inisialisasi Dark Mode (Cegah Flicker) -->
        <script>
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50 dark:bg-[#0f1115] dark:text-gray-100 transition-colors duration-300 min-h-screen flex flex-col justify-between relative overflow-x-hidden">

        <!-- Background Glowing Orbs (Latar belakang estetik & konsisten dengan Landing Page) -->
        <div class="fixed top-[-10%] left-[-10%] w-[45%] h-[45%] bg-gradient-to-br from-purple-500/25 to-pink-500/25 dark:from-purple-900/35 dark:to-pink-900/35 rounded-full blur-[120px] pointer-events-none -z-10"></div>
        <div class="fixed bottom-[-10%] right-[-10%] w-[45%] h-[45%] bg-gradient-to-tl from-orange-400/20 to-yellow-400/20 dark:from-orange-800/30 dark:to-yellow-800/30 rounded-full blur-[120px] pointer-events-none -z-10"></div>

        <!-- Floating Top Bar (Tombol Kembali & Dark Mode) -->
        <header class="w-full max-w-7xl mx-auto px-6 py-6 flex justify-between items-center z-50">
            <!-- Back to Home -->
            <a href="/" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gray-600 hover:text-pink-500 dark:text-gray-400 dark:hover:text-pink-400 transition group">
                <div class="w-8 h-8 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg>
                </div>
                <span class="hidden sm:inline">Kembali ke Beranda</span>
            </a>

            <!-- Dark Mode Toggle Button -->
            <button id="theme-toggle-guest" class="p-2.5 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm hover:scale-105 active:scale-95 transition-all duration-200 focus:outline-none">
                <svg id="theme-toggle-light-icon-guest" class="hidden w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>
                <svg id="theme-toggle-dark-icon-guest" class="hidden w-5 h-5 text-indigo-400" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            </button>
        </header>

        <!-- Main Form Container -->
        <main class="flex-grow flex items-center justify-center px-4 py-8 z-10">
            <div class="w-full sm:max-w-md">
                {{ $slot }}
            </div>
        </main>

        <!-- Simple Footer -->
        <footer class="py-6 text-center text-xs text-gray-500 dark:text-gray-400 z-10">
            &copy; {{ date('Y') }} InstaBroSis. All rights reserved.
        </footer>

        <!-- Script Logic Dark Mode Guest -->
        <script>
            var darkIcon = document.getElementById('theme-toggle-dark-icon-guest');
            var lightIcon = document.getElementById('theme-toggle-light-icon-guest');

            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                lightIcon.classList.remove('hidden');
            } else {
                darkIcon.classList.remove('hidden');
            }

            document.getElementById('theme-toggle-guest').addEventListener('click', function() {
                darkIcon.classList.toggle('hidden');
                lightIcon.classList.toggle('hidden');

                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            });
        </script>
    </body>
</html>