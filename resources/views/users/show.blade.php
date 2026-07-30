<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-8 pb-12">
        
        <!-- HEADER PROFIL (BERLAKU UNTUK AKUN SENDIRI MAUPUN ORANG LAIN) -->
        <div class="bg-white/80 dark:bg-[#1a1c23]/80 backdrop-blur-xl border border-gray-200/80 dark:border-gray-700/50 rounded-3xl p-6 sm:p-10 shadow-lg">
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 sm:gap-10">
                
                <!-- Avatar Ring Gradient -->
                <div class="p-1 rounded-full bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 shadow-xl flex-shrink-0">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                         alt="{{ $user->name }}" 
                         class="w-28 h-28 sm:w-36 sm:h-36 rounded-full object-cover border-4 border-white dark:border-[#1a1c23]">
                </div>

                <!-- Info User & Statistik -->
                <div class="flex-grow text-center sm:text-left space-y-4 w-full">
                    
                    <!-- Username & Action Button -->
                    <div class="flex flex-col sm:flex-row items-center gap-4 justify-between">
                        <h1 class="text-2xl sm:text-3xl font-black text-gray-900 dark:text-white tracking-tight">
                            {{ $user->name }}
                        </h1>

                        <!-- Logika Tombol: Edit Profil (Jika Akun Sendiri) vs Follow/Unfollow (Jika Orang Lain) -->
                        @if(auth()->id() === $user->id)
                            <a href="{{ route('profile.edit') }}" 
                               class="px-5 py-2 text-xs font-bold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full transition">
                                Edit Profil
                            </a>
                        @else
                            <form action="{{ route('users.follow', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="px-6 py-2 text-xs font-black rounded-full transition-all duration-200 shadow-md hover:scale-105 active:scale-95 {{ $isFollowing ? 'bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200 hover:bg-red-500 hover:text-white' : 'bg-gradient-to-r from-purple-600 via-pink-500 to-orange-400 text-white shadow-pink-500/30' }}">
                                    <!-- Label diubah menjadi Unfollow / Follow -->
                                    {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- 3 Baris Statistik (Posts, Followers, Following) -->
                    <div class="flex items-center justify-center sm:justify-start gap-8 py-3 border-y border-gray-100 dark:border-gray-800/80 text-sm">
                        <div class="text-center sm:text-left">
                            <span class="font-black text-gray-900 dark:text-white block sm:inline">{{ $postsCount }}</span>
                            <span class="text-gray-500 dark:text-gray-400 text-xs font-semibold">Posts</span>
                        </div>
                        <div class="text-center sm:text-left">
                            <span class="font-black text-gray-900 dark:text-white block sm:inline">{{ $followersCount }}</span>
                            <span class="text-gray-500 dark:text-gray-400 text-xs font-semibold">Followers</span>
                        </div>
                        <div class="text-center sm:text-left">
                            <span class="font-black text-gray-900 dark:text-white block sm:inline">{{ $followingCount }}</span>
                            <span class="text-gray-500 dark:text-gray-400 text-xs font-semibold">Following</span>
                        </div>
                    </div>

                    <!-- Bio -->
                    <div>
                        <p class="text-sm text-gray-800 dark:text-gray-200 leading-relaxed font-medium">
                            {{ $user->bio ?? 'Belum ada biografi.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- GRID 3x3 POSTINGAN USER -->
        <div>
            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-200/60 dark:border-gray-800">
                <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"></path></svg>
                <span class="text-xs font-black uppercase tracking-wider text-gray-700 dark:text-gray-300">Galeri Postingan</span>
            </div>

            <div class="grid grid-cols-3 gap-2 sm:gap-4">
                @forelse ($user->posts as $post)
                    <a href="{{ route('posts.show', $post->id) }}" class="relative aspect-square rounded-2xl overflow-hidden group bg-gray-100 dark:bg-gray-800 shadow-sm">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        
                        <!-- Overlay Hover Likes & Comments -->
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-6 text-white font-black text-sm">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-5 h-5 fill-current text-pink-500" viewBox="0 0 24 24"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.18 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/></svg>
                                <span>{{ $post->likes_count }}</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-5 h-5 fill-current text-purple-400" viewBox="0 0 24 24"><path d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.06A11.818 11.818 0 0012 20.25z"></path></svg>
                                <span>{{ $post->comments_count }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white/50 dark:bg-[#1a1c23]/50 rounded-2xl border border-dashed border-gray-300 dark:border-gray-800">
                        <p class="text-sm font-bold text-gray-500">Belum ada postingan yang diunggah.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>