<nav class="sticky top-0 z-50 backdrop-blur-xl bg-white/70 dark:bg-[#16181d]/70 border-b border-gray-200/50 dark:border-gray-800/50 shadow-sm transition-colors duration-300">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <!-- Logo Brand Kiri -->
            <div class="flex items-center gap-3 cursor-pointer" onclick="window.location.href='{{ route('posts.index') }}'">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 flex items-center justify-center shadow-lg shadow-pink-500/30 hover:scale-105 transition-transform duration-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"></path>
                    </svg>
                </div>
                <span class="font-black text-xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-500 to-orange-400 dark:from-purple-400 dark:via-pink-400 dark:to-orange-300">
                    InstaBroSis
                </span>
            </div>

            <!-- Menu Kanan (Navigasi, Dark Mode Toggle & Profile Dropdown) -->
            <div class="flex items-center gap-3 sm:gap-5">
                
                <!-- Home Feed Icon -->
                <a href="{{ route('posts.index') }}" 
                   class="p-2 text-gray-700 dark:text-gray-200 hover:text-pink-500 dark:hover:text-pink-400 hover:scale-110 transition-all duration-200" 
                   title="Feed Beranda">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path></svg>
                </a>

                <!-- Create Post Icon -->
                <a href="{{ route('posts.create') }}" 
                   class="p-2 text-gray-700 dark:text-gray-200 hover:text-pink-500 dark:hover:text-pink-400 hover:scale-110 transition-all duration-200" 
                   title="Buat Postingan">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </a>

                <!-- Saved Posts / Bookmarks -->
                <a href="{{ route('bookmarks.index') }}" 
                   class="p-2 text-gray-700 dark:text-gray-200 hover:text-pink-500 dark:hover:text-pink-400 hover:scale-110 transition-all duration-200" 
                   title="Tersimpan">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"></path></svg>
                </a>

                <!-- Dark Mode Toggle Button Global App -->
                <button id="theme-toggle-app" class="p-2 rounded-full bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:scale-105 active:scale-95 transition-all duration-200 focus:outline-none">
                    <svg id="theme-toggle-light-icon-app" class="hidden w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>
                    <svg id="theme-toggle-dark-icon-app" class="hidden w-5 h-5 text-indigo-400" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                </button>

                <!-- Profile Dropdown (Alpine.js) -->
                <div class="relative ml-2" x-data="{ open: false }">
                    <button @click="open = ! open" class="flex items-center gap-2 p-1 rounded-full focus:outline-none hover:opacity-80 transition">
                        <div class="p-0.5 rounded-full bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600">
                            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name) }}" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="w-8 h-8 rounded-full object-cover border-2 border-white dark:border-gray-900">
                        </div>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         @click.outside="open = false" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-xl py-2 z-50 overflow-hidden" 
                         style="display: none;">
                        
                        <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700/60">
                            <p class="text-xs font-bold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email }}</p>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-semibold text-gray-700 dark:text-gray-200 hover:bg-pink-50 dark:hover:bg-pink-900/20 hover:text-pink-600 dark:hover:text-pink-400 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path></svg>
                            Edit Profil
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-xs font-semibold text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"></path></svg>
                                Keluar (Logout)
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>

<!-- Script Logic Dark Mode Navbar App -->
<script>
    var darkIconApp = document.getElementById('theme-toggle-dark-icon-app');
    var lightIconApp = document.getElementById('theme-toggle-light-icon-app');

    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        lightIconApp.classList.remove('hidden');
    } else {
        darkIconApp.classList.remove('hidden');
    }

    document.getElementById('theme-toggle-app').addEventListener('click', function() {
        darkIconApp.classList.toggle('hidden');
        lightIconApp.classList.toggle('hidden');

        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    });
</script>