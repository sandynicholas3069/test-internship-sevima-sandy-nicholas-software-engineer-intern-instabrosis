<x-app-layout>
    <div class="space-y-8 max-w-xl mx-auto">
        
        <!-- Header Bookmark -->
        <div class="flex items-center justify-between pb-2 border-b border-gray-200/60 dark:border-gray-800">
            <h1 class="text-xl font-black tracking-tight text-gray-900 dark:text-white flex items-center gap-2">
                <svg class="w-6 h-6 text-pink-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" /></svg>
                Postingan Tersimpan
            </h1>
            <a href="{{ route('posts.index') }}" class="text-xs font-bold text-gray-500 hover:text-pink-500 transition">Kembali ke Feed</a>
        </div>

        @forelse ($posts as $post)
            <!-- Post Card Glassmorphism -->
            <article class="bg-white/90 dark:bg-[#1a1c23]/90 backdrop-blur-xl border border-gray-200/80 dark:border-gray-700/50 rounded-3xl shadow-[0_10px_30px_rgba(0,0,0,0.05)] dark:shadow-[0_10px_30px_rgba(0,0,0,0.3)] overflow-hidden transition-all duration-300 hover:shadow-[0_15px_40px_rgba(0,0,0,0.08)]">
                
                <header class="flex items-center justify-between p-4 border-b border-gray-100 dark:border-gray-800/60">
                    <div class="flex items-center gap-3">
                        <div class="p-0.5 rounded-full bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600">
                            <img src="{{ $post->user->avatar ? asset('storage/' . $post->user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($post->user->name) }}" alt="{{ $post->user->name }}" class="w-9 h-9 rounded-full object-cover border-2 border-white dark:border-[#1a1c23]">
                        </div>
                        <div>
                            <span class="font-extrabold text-sm text-gray-900 dark:text-gray-100">{{ $post->user->name }}</span>
                            <div class="text-[11px] text-gray-400 font-semibold">{{ $post->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </header>

                <div class="w-full bg-gray-100 dark:bg-black/40 overflow-hidden group relative">
                    <!-- Overlay klik menuju detail -->
                    <a href="{{ route('posts.show', $post->id) }}" class="absolute inset-0 z-20"></a>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="w-full object-cover max-h-[550px] group-hover:scale-[1.01] transition-transform duration-500 relative z-10">
                </div>

                <div class="p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-4">
                            <!-- Tombol Lihat -->
                            <a href="{{ route('posts.show', $post->id) }}" class="hover:scale-125 transition-transform duration-200">
                                <svg class="w-7 h-7 text-gray-700 dark:text-gray-200 hover:text-purple-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.06A11.818 11.818 0 0012 20.25z"></path></svg>
                            </a>
                        </div>
                        
                        <!-- Bookmark Unsave Button -->
                        <form action="{{ route('posts.bookmark', $post->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="hover:scale-125 transition-transform duration-200">
                                <svg class="w-7 h-7 text-gray-900 dark:text-white fill-current" viewBox="0 0 24 24"><path d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" /></svg>
                            </button>
                        </form>
                    </div>
                    @if($post->caption)
                        <div class="text-sm mb-2 text-gray-800 dark:text-gray-200">
                            <span class="font-black mr-1">{{ $post->user->name }}</span>{{ $post->caption }}
                        </div>
                    @endif
                </div>
            </article>
        @empty
            <!-- Empty State -->
            <div class="text-center bg-white/80 dark:bg-[#1a1c23]/80 backdrop-blur-xl border border-gray-200/80 dark:border-gray-700/50 rounded-3xl p-12 shadow-sm">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-pink-500/30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"></path></svg>
                </div>
                <h3 class="text-lg font-black text-gray-900 dark:text-white mb-1">Belum Ada yang Disimpan</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">Simpan postingan favorit Anda untuk dilihat lagi nanti.</p>
                <a href="{{ route('posts.index') }}" class="inline-flex px-6 py-3 font-bold text-xs text-white bg-gradient-to-r from-purple-600 to-pink-500 rounded-full hover:scale-105 transition-all shadow-lg shadow-pink-500/30">Jelajahi Feed</a>
            </div>
        @endforelse
    </div>
</x-app-layout>