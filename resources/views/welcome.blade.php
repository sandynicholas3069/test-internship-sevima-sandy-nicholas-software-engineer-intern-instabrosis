<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InstaBroSis - Bagikan Momen Terbaikmu</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Vite Styles & Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback Tailwind CSS via CDN untuk testing jika Vite belum jalan -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: { extend: { fontFamily: { sans: ['Figtree', 'sans-serif'], } } }
            }
        </script>
    @endif

    <!-- Script inisialisasi Dark Mode (Mencegah FOUC / kedipan warna) -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50 dark:bg-[#0f1115] dark:text-gray-100 transition-colors duration-300 relative overflow-x-hidden">

    <!-- Efek Glowing Background (Biar gak full whitespace) -->
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] bg-gradient-to-br from-purple-500/30 to-pink-500/30 dark:from-purple-900/40 dark:to-pink-900/40 rounded-full blur-[100px] pointer-events-none -z-10"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-gradient-to-tl from-orange-400/20 to-yellow-400/20 dark:from-orange-800/30 dark:to-yellow-800/30 rounded-full blur-[100px] pointer-events-none -z-10"></div>

    <!-- Navbar Sticky Glassmorphism -->
    <nav class="fixed w-full z-50 top-0 transition-all duration-300 backdrop-blur-lg bg-white/70 dark:bg-[#16181d]/70 border-b border-gray-200/50 dark:border-gray-800/50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2 cursor-pointer" onclick="window.scrollTo(0,0)">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 flex items-center justify-center shadow-lg shadow-pink-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"></path></svg>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-500 dark:from-purple-400 dark:to-pink-400">InstaBroSis</span>
                </div>

                <!-- Nav Links & Actions -->
                <div class="flex items-center gap-4 sm:gap-6">
                    <a href="#fitur" class="hidden sm:block font-semibold text-sm text-gray-600 hover:text-pink-500 dark:text-gray-300 dark:hover:text-pink-400 transition">Fitur</a>
                    <a href="#tentang" class="hidden sm:block font-semibold text-sm text-gray-600 hover:text-pink-500 dark:text-gray-300 dark:hover:text-pink-400 transition">Tentang</a>
                    
                    <!-- Dark Mode Toggle Button (Efek Timbul) -->
                    <button id="theme-toggle" class="relative p-2.5 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-[2px_2px_5px_rgba(0,0,0,0.05),-2px_-2px_5px_rgba(255,255,255,0.5)] dark:shadow-[2px_2px_5px_rgba(0,0,0,0.3),-1px_-1px_3px_rgba(255,255,255,0.05)] hover:scale-105 active:scale-95 transition-all duration-200 focus:outline-none">
                        <!-- Sun Icon -->
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>
                        <!-- Moon Icon -->
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    </button>

                    @if (Route::has('login'))
                        <div class="flex gap-3 items-center border-l pl-4 sm:pl-6 border-gray-300 dark:border-gray-700">
                            @auth
                                <a href="{{ url('/posts') }}" class="font-bold text-sm text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 px-5 py-2.5 rounded-full shadow-lg shadow-pink-500/30 hover:shadow-pink-500/50 hover:-translate-y-0.5 transition-all">Ke Feed Utama</a>
                            @else
                                <a href="{{ route('login') }}" class="font-bold text-sm text-gray-700 dark:text-gray-200 hover:text-pink-500 dark:hover:text-pink-400 transition">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="font-bold text-sm text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 px-5 py-2.5 rounded-full shadow-lg shadow-pink-500/30 hover:shadow-pink-500/50 hover:-translate-y-0.5 transition-all">Daftar</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-12">
        <!-- Text Content -->
        <div class="w-full lg:w-1/2 text-center lg:text-left z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pink-100/80 dark:bg-pink-900/30 text-pink-600 dark:text-pink-400 font-semibold text-xs tracking-wide uppercase mb-6 border border-pink-200 dark:border-pink-800/50 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-pink-500 animate-pulse"></span> Generasi Baru Sosial Media
            </div>
            <h1 class="text-5xl lg:text-6xl font-black tracking-tight mb-6 leading-tight">
                Bagikan Ceritamu, <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 via-pink-500 to-purple-600">Temukan Duniamu.</span>
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                InstaBroSis adalah platform modern untuk mengekspresikan diri melalui foto dan cerita. Berkoneksi dengan teman, temukan inspirasi, dan bangun komunitasmu di sini.
            </p>
            <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 font-bold text-white bg-gradient-to-r from-purple-600 to-pink-500 rounded-full shadow-[0_10px_20px_rgba(236,72,153,0.3)] hover:shadow-[0_15px_30px_rgba(236,72,153,0.4)] hover:-translate-y-1 transition-all text-center">
                    Mulai Sekarang - Gratis
                </a>
                <a href="#fitur" class="w-full sm:w-auto px-8 py-4 font-bold text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-full shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 hover:-translate-y-1 transition-all text-center">
                    Pelajari Fitur
                </a>
            </div>
        </div>

        <!-- UI Mockup Graphic (Glassmorphism Phone) -->
        <div class="w-full lg:w-1/2 flex justify-center z-10 perspective-1000">
            <div class="relative w-[300px] sm:w-[340px] h-[600px] bg-white/60 dark:bg-[#1a1c23]/60 backdrop-blur-xl border border-white/40 dark:border-gray-700/50 rounded-[3rem] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.15)] dark:shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] p-4 transform rotate-y-[-10deg] rotate-x-[5deg] hover:rotate-y-0 hover:rotate-x-0 transition-transform duration-700 ease-out">
                <!-- Screen Area -->
                <div class="w-full h-full bg-gray-100 dark:bg-black rounded-[2.2rem] overflow-hidden flex flex-col relative shadow-inner border border-gray-200 dark:border-gray-800">
                    <!-- App Header Mock -->
                    <div class="h-16 flex items-center justify-between px-5 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-black">
                        <span class="font-bold text-lg font-serif">InstaBroSis</span>
                        <div class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center"><div class="w-3 h-3 bg-pink-500 rounded-full"></div></div>
                    </div>
                    <!-- Feed Mock -->
                    <div class="p-4 space-y-4 overflow-hidden">
                        <!-- Post 1 -->
                        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 pb-3">
                            <div class="flex items-center gap-2 p-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-yellow-400 to-pink-500"></div>
                                <div class="w-20 h-3 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                            </div>
                            <div class="w-full h-40 bg-gradient-to-br from-indigo-400 to-purple-400"></div>
                            <div class="flex gap-2 p-3">
                                <div class="w-5 h-5 rounded-full bg-pink-100 dark:bg-pink-900/50 flex items-center justify-center"><div class="w-3 h-3 bg-pink-500 rounded-full"></div></div>
                                <div class="w-5 h-5 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                            </div>
                        </div>
                        <!-- Post 2 -->
                        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 pb-3">
                            <div class="flex items-center gap-2 p-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-cyan-400 to-blue-500"></div>
                                <div class="w-24 h-3 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                            </div>
                            <div class="w-full h-24 bg-gradient-to-br from-emerald-400 to-teal-500"></div>
                        </div>
                    </div>
                    <!-- Bottom Nav Mock -->
                    <div class="absolute bottom-0 w-full h-14 bg-white dark:bg-black border-t border-gray-200 dark:border-gray-800 flex justify-around items-center px-6">
                        <div class="w-5 h-5 bg-gray-800 dark:bg-white rounded-[4px]"></div>
                        <div class="w-5 h-5 bg-gray-300 dark:bg-gray-700 rounded-full"></div>
                        <div class="w-6 h-6 bg-pink-500 rounded-full shadow-md shadow-pink-500/40 border-2 border-white dark:border-black transform -translate-y-2"></div>
                        <div class="w-5 h-5 bg-gray-300 dark:bg-gray-700 rounded-sm"></div>
                        <div class="w-5 h-5 bg-gray-300 dark:bg-gray-700 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="fitur" class="py-24 bg-white dark:bg-[#12141a] border-t border-gray-200/50 dark:border-gray-800/50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Pengalaman Media Sosial <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500">Premium</span></h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Kami merancang setiap fitur agar Anda bisa berfokus pada konten dan interaksi, tanpa gangguan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Card 1 -->
                <div class="bg-gray-50 dark:bg-[#1a1c23] p-8 rounded-3xl border border-gray-200 dark:border-gray-700/50 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Posting Estetik</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Unggah foto momen harianmu dengan caption menarik. Tampilan feed responsif dan elegan di segala perangkat.</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-gray-50 dark:bg-[#1a1c23] p-8 rounded-3xl border border-gray-200 dark:border-gray-700/50 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-pink-100 dark:bg-pink-900/30 text-pink-600 dark:text-pink-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Interaksi Nyata</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Berikan 'Like' pada postingan yang kamu suka dan tinggalkan jejak komentar untuk memulai diskusi asik.</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-gray-50 dark:bg-[#1a1c23] p-8 rounded-3xl border border-gray-200 dark:border-gray-700/50 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Simpan Inspirasi</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Fitur Bookmark memudahkanmu menyimpan konten inspiratif secara privat untuk dilihat kembali kapan saja.</p>
                </div>

                <!-- Card 4 -->
                <div class="bg-gray-50 dark:bg-[#1a1c23] p-8 rounded-3xl border border-gray-200 dark:border-gray-700/50 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Bangun Koneksi</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Follow kreator favoritmu dan bangun lingkaran pertemanan. Timeline yang relevan dengan minatmu.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-24 relative overflow-hidden">
        <!-- Background Gradient Full Width -->
        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-500 opacity-90 dark:opacity-100"></div>
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white z-10">
            <h2 class="text-4xl font-extrabold mb-6 tracking-tight drop-shadow-md">Siap Memulai Perjalananmu?</h2>
            <p class="text-lg text-pink-100 mb-10 max-w-2xl mx-auto">Bergabunglah dengan ribuan pengguna lainnya yang telah membagikan cerita dan inspirasi mereka setiap hari di InstaBroSis.</p>
            <a href="{{ route('register') }}" class="inline-block px-10 py-4 font-bold text-pink-600 bg-white rounded-full shadow-[0_10px_25px_rgba(0,0,0,0.2)] hover:shadow-[0_15px_35px_rgba(0,0,0,0.3)] hover:scale-105 transition-all">
                Buat Akun Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer id="tentang" class="bg-gray-50 dark:bg-[#0a0a0a] py-12 border-t border-gray-200 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-md bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 flex items-center justify-center"></div>
                <span class="font-bold text-xl tracking-tight text-gray-900 dark:text-white">InstaBroSis</span>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} InstaBroSis. Dibuat dengan cinta menggunakan Laravel & Tailwind CSS.
            </p>
            <div class="flex gap-4">
                <a href="#" class="text-gray-400 hover:text-pink-500 transition">Panduan</a>
                <a href="#" class="text-gray-400 hover:text-pink-500 transition">Privasi</a>
                <a href="#" class="text-gray-400 hover:text-pink-500 transition">Ketentuan</a>
            </div>
        </div>
    </footer>

    <!-- Logic Script Toggle Dark Mode -->
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Cek mode awal saat halaman dimuat
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            // Toggle icon
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // Ganti tema dan simpan preferensi ke local storage
            if (localStorage.getItem('theme')) {
                if (localStorage.getItem('theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            }
        });
    </script>
</body>
</html>