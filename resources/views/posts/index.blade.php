<x-app-layout>
    <div class="space-y-8 max-w-xl mx-auto">
        
        <!-- Header Ringkas Feed dengan Bunderan Profil Sendiri -->
        <div class="flex items-center justify-between pb-4 border-b border-gray-200/60 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <!-- Bunderan Avatar Milik Sendiri (Klik untuk ke Profil) -->
                <a href="{{ route('users.show', auth()->id()) }}" class="p-0.5 rounded-full bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 hover:scale-105 active:scale-95 transition-transform flex-shrink-0 shadow-md">
                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name) }}" 
                         alt="Profil Saya" 
                         class="w-10 h-10 rounded-full object-cover border-2 border-white dark:border-[#1a1c23]">
                </a>
                <h1 class="text-xl font-black tracking-tight text-gray-900 dark:text-white">
                    Feed
                </h1>
            </div>
            
            <!-- Tombol Buat Postingan -->
            <a href="{{ route('posts.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 font-bold text-xs text-white bg-gradient-to-r from-purple-600 via-pink-500 to-orange-400 hover:from-purple-700 hover:via-pink-600 hover:to-orange-500 rounded-full shadow-md shadow-pink-500/20 hover:scale-105 active:scale-95 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                Buat Postingan
            </a>
        </div>

        @forelse ($posts as $post)
            <!-- Post Card Modern dengan Glassmorphism & Soft Elevation -->
            <article class="bg-white/90 dark:bg-[#1a1c23]/90 backdrop-blur-xl border border-gray-200/80 dark:border-gray-700/50 rounded-3xl shadow-[0_10px_30px_rgba(0,0,0,0.05)] dark:shadow-[0_10px_30px_rgba(0,0,0,0.3)] overflow-hidden transition-all duration-300 hover:shadow-[0_15px_40px_rgba(0,0,0,0.08)] dark:hover:shadow-[0_15px_40px_rgba(0,0,0,0.4)]">
                
                <!-- Post Header dengan Link Profil & Tombol Follow -->
                <header class="flex items-center justify-between p-4 border-b border-gray-100 dark:border-gray-800/60">
                    <div class="flex items-center gap-3">
                        <!-- Avatar Ring Gradient (Link ke Profil User Pembuat Post) -->
                        <a href="{{ route('users.show', $post->user->id) }}" class="p-0.5 rounded-full bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 hover:scale-105 transition-transform flex-shrink-0">
                            <img src="{{ $post->user->avatar ? asset('storage/' . $post->user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($post->user->name) }}" 
                                 alt="{{ $post->user->name }}" 
                                 class="w-9 h-9 rounded-full object-cover border-2 border-white dark:border-[#1a1c23]">
                        </a>
                        
                        <div>
                            <div class="flex items-center gap-2">
                                <!-- Nama User (Link ke Profil User Pembuat Post) -->
                                <a href="{{ route('users.show', $post->user->id) }}" class="font-extrabold text-sm text-gray-900 dark:text-gray-100 hover:text-pink-500 transition">
                                    {{ $post->user->name }}
                                </a>

                                <!-- Tombol Follow / Followed Kecil (Tampil jika bukan postingan milik sendiri) -->
                                @if(auth()->id() !== $post->user_id)
                                    <span class="text-gray-400 text-xs">•</span>
                                    <form action="{{ route('users.follow', $post->user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-xs font-black transition-colors {{ auth()->user()->isFollowing($post->user) ? 'text-gray-400 hover:text-red-500' : 'text-pink-500 hover:text-purple-600' }}">
                                            {{ auth()->user()->isFollowing($post->user) ? 'Followed' : 'Follow' }}
                                        </button>
                                    </form>
                                @endif
                            </div>

                            <div class="text-[11px] font-semibold text-gray-400 dark:text-gray-500 flex items-center gap-1">
                                <span>{{ $post->created_at->diffForHumans(null, true, true) }}</span>
                                @if(method_exists($post, 'isEdited') && $post->isEdited()) 
                                    <span class="italic text-gray-400">• (diedit)</span> 
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Opsi Post (Edit/Delete) jika milik sendiri -->
                    @if(auth()->id() === $post->user_id)
                        <div class="flex items-center gap-2">
                            <a href="{{ route('posts.edit', $post->id) }}" 
                               class="px-2.5 py-1 text-xs font-bold text-gray-500 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition">
                                Edit
                            </a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus postingan ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-2.5 py-1 text-xs font-bold text-gray-500 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @endif
                </header>

                <!-- Post Image -->
                <div class="w-full bg-gray-100 dark:bg-black/40 overflow-hidden group">
                    <img src="{{ asset('storage/' . $post->image) }}" 
                         alt="Post image" 
                         class="w-full object-cover max-h-[550px] group-hover:scale-[1.01] transition-transform duration-500">
                </div>

                <!-- Post Actions Bar -->
                <div class="p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-4">
                            <!-- Like Button -->
                            <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="hover:scale-125 active:scale-95 transition-transform duration-200 focus:outline-none">
                                    @if(method_exists($post, 'isLikedBy') && $post->isLikedBy(auth()->user()))
                                        <svg class="w-7 h-7 text-pink-500 fill-current drop-shadow-[0_2px_8px_rgba(236,72,153,0.4)]" viewBox="0 0 24 24">
                                            <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.18 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                        </svg>
                                    @else
                                        <svg class="w-7 h-7 text-gray-700 dark:text-gray-200 hover:text-pink-500 dark:hover:text-pink-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path>
                                        </svg>
                                    @endif
                                </button>
                            </form>
                            
                            <!-- Comment Button -->
                            <a href="{{ route('posts.show', $post->id) }}" class="hover:scale-125 active:scale-95 transition-transform duration-200">
                                <svg class="w-7 h-7 text-gray-700 dark:text-gray-200 hover:text-purple-500 dark:hover:text-purple-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.06A11.818 11.818 0 0012 20.25z"></path>
                                </svg>
                            </a>

                            <!-- Share Button (Universal Share Handler) -->
                            <button onclick="sharePost({{ $post->id }})" 
                                    class="hover:scale-125 active:scale-95 transition-transform duration-200 focus:outline-none"
                                    title="Bagikan Postingan">
                                <svg class="w-7 h-7 text-gray-700 dark:text-gray-200 hover:text-orange-500 dark:hover:text-orange-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Bookmark Button -->
                        <form action="{{ route('posts.bookmark', $post->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="hover:scale-125 active:scale-95 transition-transform duration-200 focus:outline-none">
                                @if(method_exists($post, 'isBookmarkedBy') && $post->isBookmarkedBy(auth()->user()))
                                    <svg class="w-7 h-7 text-gray-900 dark:text-white fill-current" viewBox="0 0 24 24">
                                        <path d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                    </svg>
                                @else
                                    <svg class="w-7 h-7 text-gray-700 dark:text-gray-200 hover:text-yellow-500 dark:hover:text-yellow-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"></path>
                                    </svg>
                                @endif
                            </button>
                        </form>
                    </div>

                    <!-- Likes Count -->
                    <p class="font-extrabold text-sm mb-1.5 text-gray-900 dark:text-gray-100">
                        {{ $post->likes->count() }} Menyukai ini
                    </p>

                    <!-- Caption -->
                    @if($post->caption)
                        <div class="text-sm mb-2 leading-relaxed text-gray-800 dark:text-gray-200">
                            <a href="{{ route('users.show', $post->user->id) }}" class="font-black mr-1.5 text-gray-900 dark:text-white hover:text-pink-500 transition">
                                {{ $post->user->name }}
                            </a>
                            <span>{{ $post->caption }}</span>
                        </div>
                    @endif

                    <!-- View All Comments Link -->
                    @if($post->comments->count() > 0)
                        <a href="{{ route('posts.show', $post->id) }}" class="text-xs font-bold text-gray-400 hover:text-pink-500 dark:text-gray-500 dark:hover:text-pink-400 mb-2 block transition">
                            Lihat semua {{ $post->comments->count() }} komentar...
                        </a>
                    @endif
                </div>

                <!-- Add Comment Inline -->
                <div class="border-t border-gray-100 dark:border-gray-800/80 px-4 py-3 bg-gray-50/50 dark:bg-gray-900/50">
                    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        <input type="text" 
                               name="content" 
                               placeholder="Tambahkan komentar..." 
                               class="w-full bg-transparent border-none focus:ring-0 text-sm p-0 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none" 
                               required 
                               autocomplete="off">
                        <button type="submit" class="text-xs font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500 hover:opacity-80 transition">
                            Kirim
                        </button>
                    </form>
                </div>
            </article>
        @empty
            <div class="text-center bg-white/80 dark:bg-[#1a1c23]/80 backdrop-blur-xl border border-gray-200/80 dark:border-gray-700/50 rounded-3xl p-12 shadow-sm">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-pink-500/30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"></path></svg>
                </div>
                <h3 class="text-lg font-black text-gray-900 dark:text-white mb-1">Belum Ada Postingan</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">Jadilah yang pertama membagikan momen berhargamu hari ini!</p>
                <a href="{{ route('posts.create') }}" class="inline-flex items-center gap-2 px-6 py-3 font-bold text-xs text-white bg-gradient-to-r from-purple-600 via-pink-500 to-orange-400 hover:from-purple-700 hover:via-pink-600 hover:to-orange-500 rounded-full shadow-lg shadow-pink-500/30 hover:scale-105 active:scale-95 transition-all">
                    Buat Postingan Pertama
                </a>
            </div>
        @endforelse
    </div>

    <!-- Universal Share Handler (Clipboard API + Fallback) -->
    <script>
        function sharePost(postId) {
            fetch(`/posts/${postId}/share`)
                .then(response => {
                    if (!response.ok) throw new Error('API Response Error');
                    return response.json();
                })
                .then(data => {
                    if (data.share_url) {
                        copyToClipboard(data.share_url);
                    } else {
                        copyToClipboard(`${window.location.origin}/posts/${postId}`);
                    }
                })
                .catch(() => {
                    // Fallback jika API endpoint offline/error
                    copyToClipboard(`${window.location.origin}/posts/${postId}`);
                });
        }

        function copyToClipboard(text) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text)
                    .then(() => alert('Tautan postingan InstaBroSis berhasil disalin!'))
                    .catch(() => fallbackCopyTextToClipboard(text));
            } else {
                fallbackCopyTextToClipboard(text);
            }
        }

        function fallbackCopyTextToClipboard(text) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.position = "fixed";
            textArea.style.top = "0";
            textArea.style.left = "0";
            textArea.style.opacity = "0";

            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                const successful = document.execCommand('copy');
                if (successful) {
                    alert('Tautan postingan InstaBroSis berhasil disalin!');
                } else {
                    alert('Gagal menyalin link. Silakan salin URL ini: ' + text);
                }
            } catch (err) {
                alert('Gagal menyalin link. Silakan salin URL ini: ' + text);
            }

            document.body.removeChild(textArea);
        }
    </script>
</x-app-layout>