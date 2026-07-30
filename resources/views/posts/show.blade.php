<x-app-layout>
    <div class="max-w-5xl mx-auto">
        
        <!-- Tombol Kembali Show dengan Dark Mode Presisi -->
        <div class="mb-6">
            <a href="{{ url()->previous() == url()->current() ? route('posts.index') : url()->previous() }}" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-100 shadow-sm hover:scale-105 active:scale-95 transition-all text-xs font-extrabold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                </svg>
                Kembali
            </a>
        </div>

        <!-- Layout 2 Kolom (Gambar & Sidebar Komentar) -->
        <div class="bg-white/80 dark:bg-[#1a1c23]/80 backdrop-blur-xl border border-white/50 dark:border-gray-700/50 rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.08)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.4)] overflow-hidden flex flex-col md:flex-row min-h-[500px] max-h-[85vh]">
            
            <!-- Sisi Kiri: Gambar Postingan dengan Blur Background -->
            <div class="w-full md:w-[55%] lg:w-[60%] bg-black flex items-center justify-center relative overflow-hidden group">
                <!-- Background blur estetik -->
                <div class="absolute inset-0 bg-cover bg-center opacity-30 blur-2xl transform scale-110" style="background-image: url('{{ asset('storage/' . $post->image) }}')"></div>
                
                <!-- Foto Utama -->
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="relative max-w-full max-h-full object-contain z-10">
            </div>

            <!-- Sisi Kanan: Header, Caption Terpisah, Scroll Komentar, & Action Box -->
            <div class="w-full md:w-[45%] lg:w-[40%] flex flex-col bg-white dark:bg-gray-900 border-l border-gray-200/80 dark:border-gray-800">
                
                <!-- 1. HEADER USER -->
                <header class="flex items-center justify-between p-4 border-b border-gray-100 dark:border-gray-800/60 flex-shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="p-0.5 rounded-full bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600">
                            <img src="{{ $post->user->avatar ? asset('storage/' . $post->user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($post->user->name) }}" 
                                 alt="{{ $post->user->name }}" class="w-9 h-9 rounded-full object-cover border-2 border-white dark:border-[#1a1c23]">
                        </div>
                        <div>
                            <span class="font-extrabold text-sm text-gray-900 dark:text-gray-100 block">{{ $post->user->name }}</span>
                            <span class="text-[10px] text-gray-400 font-medium">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    
                    @if(auth()->id() === $post->user_id)
                        <a href="{{ route('posts.edit', $post->id) }}" class="p-2 text-gray-500 hover:text-blue-500 bg-gray-50 dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path></svg>
                        </a>
                    @endif
                </header>

                <!-- 2. BAGIAN CAPTION TERPISAH (Statis) -->
                @if($post->caption)
                    <div class="p-4 bg-gray-50/60 dark:bg-gray-800/40 border-b border-gray-100 dark:border-gray-800/80 flex-shrink-0">
                        <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Caption Penulis</div>
                        <p class="text-sm text-gray-800 dark:text-gray-200 leading-relaxed break-words">
                            {{ $post->caption }}
                        </p>
                    </div>
                @endif

                <!-- 3. BAGIAN DAFTAR KOMENTAR (Scrollable Area) -->
                <div class="p-4 flex-grow overflow-y-auto scrollbar-hide space-y-4">
                    <div class="text-[11px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2">
                        Komentar ({{ $post->comments->count() }})
                    </div>

                    @forelse ($post->comments as $comment)
                        <div class="flex gap-3 group relative bg-gray-50/30 dark:bg-gray-800/20 p-2.5 rounded-2xl border border-gray-100/50 dark:border-gray-800/40">
                            <img src="{{ $comment->user->avatar ? asset('storage/' . $comment->user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($comment->user->name) }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                            <div class="flex-grow pr-6">
                                <span class="font-extrabold text-sm text-gray-900 dark:text-gray-100 mr-1.5">{{ $comment->user->name }}</span>
                                <span class="text-sm text-gray-800 dark:text-gray-200 break-words leading-relaxed">{{ $comment->content }}</span>
                                <div class="text-[10px] text-gray-400 mt-1 font-semibold">{{ $comment->created_at->diffForHumans() }}</div>
                            </div>
                            
                            <!-- Tombol Hapus Komentar -->
                            @if(auth()->id() === $comment->user_id)
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="absolute right-2 top-2 opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Hapus komentar ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1 text-gray-400 hover:text-red-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <div class="h-full flex flex-col items-center justify-center text-center text-gray-400 py-8">
                            <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mb-2">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.06A11.818 11.818 0 0012 20.25z"></path></svg>
                            </div>
                            <p class="text-sm font-bold text-gray-600 dark:text-gray-300">Belum Ada Komentar</p>
                            <p class="text-xs text-gray-400 mt-0.5">Mulai percakapan dengan menambahkan komentar.</p>
                        </div>
                    @endforelse
                </div>

                <!-- 4. BOTTOM ACTION BOX & INPUT KOMENTAR -->
                <div class="border-t border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 flex-shrink-0">
                    
                    <div class="p-4 pb-2">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-4">
                                <!-- Like Button -->
                                <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="hover:scale-125 active:scale-95 transition-transform focus:outline-none">
                                        @if(method_exists($post, 'isLikedBy') && $post->isLikedBy(auth()->user()))
                                            <svg class="w-7 h-7 text-pink-500 fill-current drop-shadow-md" viewBox="0 0 24 24"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.18 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/></svg>
                                        @else
                                            <svg class="w-7 h-7 text-gray-700 dark:text-gray-200 hover:text-pink-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path></svg>
                                        @endif
                                    </button>
                                </form>
                                <!-- Focus to Input -->
                                <button onclick="document.getElementById('comment-input').focus()" class="hover:scale-125 active:scale-95 transition-transform focus:outline-none">
                                    <svg class="w-7 h-7 text-gray-700 dark:text-gray-200 hover:text-purple-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.06A11.818 11.818 0 0012 20.25z"></path></svg>
                                </button>
                                <!-- Share Button (Universal Share Handler) -->
                                <button onclick="sharePost({{ $post->id }})" class="hover:scale-125 active:scale-95 transition-transform focus:outline-none">
                                    <svg class="w-7 h-7 text-gray-700 dark:text-gray-200 hover:text-orange-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"></path></svg>
                                </button>
                            </div>
                            
                            <!-- Bookmark Button -->
                            <form action="{{ route('posts.bookmark', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="hover:scale-125 active:scale-95 transition-transform focus:outline-none">
                                    @if(method_exists($post, 'isBookmarkedBy') && $post->isBookmarkedBy(auth()->user()))
                                        <svg class="w-7 h-7 text-gray-900 dark:text-white fill-current" viewBox="0 0 24 24"><path d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" /></svg>
                                    @else
                                        <svg class="w-7 h-7 text-gray-700 dark:text-gray-200 hover:text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"></path></svg>
                                    @endif
                                </button>
                            </form>
                        </div>
                        <p class="font-black text-sm text-gray-900 dark:text-gray-100">{{ $post->likes->count() }} Menyukai ini</p>
                        <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-wide">{{ $post->created_at->translatedFormat('j F Y') }}</p>
                    </div>

                    <!-- Input Komentar Bawah -->
                    <div class="border-t border-gray-100 dark:border-gray-800 p-4 bg-white dark:bg-gray-900">
                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="flex items-center gap-3">
                            @csrf
                            <input id="comment-input" type="text" name="content" placeholder="Tambahkan komentar..." 
                                   class="w-full bg-transparent border-none focus:ring-0 text-sm p-0 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none" 
                                   required autocomplete="off">
                            <button type="submit" class="text-xs font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500 hover:opacity-80 transition-opacity focus:outline-none">
                                Kirim
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Universal Share Script -->
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

    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</x-app-layout>