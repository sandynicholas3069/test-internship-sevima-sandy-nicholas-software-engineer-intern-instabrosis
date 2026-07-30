<x-app-layout>
    <div class="max-w-2xl mx-auto">
        <!-- Header Halaman -->
        <div class="flex items-center gap-3 mb-6">
            <!-- Tombol Kembali dengan Dark Mode Kontras -->
            <a href="{{ route('posts.index') }}" 
               class="p-2.5 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-100 shadow-sm hover:scale-105 active:scale-95 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-black tracking-tight text-gray-900 dark:text-white">Buat Postingan Baru</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Bagikan foto dan ceritamu ke InstaBroSis</p>
            </div>
        </div>

        <!-- Card Form Glassmorphism -->
        <div class="bg-white/80 dark:bg-[#1a1c23]/80 backdrop-blur-xl border border-white/50 dark:border-gray-700/50 rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.08)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.4)] overflow-hidden p-6 sm:p-8 transition-all duration-300">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Dropzone Upload Foto -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Pilih Foto Postingan</label>
                    <div class="relative w-full h-80 rounded-2xl border-2 border-dashed border-gray-300/80 dark:border-gray-700/80 bg-gray-50/50 dark:bg-gray-900/50 hover:bg-gray-100/50 dark:hover:bg-gray-800/50 transition-colors flex flex-col items-center justify-center overflow-hidden group cursor-pointer" onclick="document.getElementById('image-upload').click()">
                        
                        <!-- Preview Image Container -->
                        <img id="image-preview" src="#" alt="Preview" class="hidden absolute inset-0 w-full h-full object-cover z-10">
                        
                        <!-- Upload Placeholder -->
                        <div id="upload-placeholder" class="flex flex-col items-center z-0 text-gray-400 dark:text-gray-500 group-hover:text-pink-500 transition-colors p-4 text-center">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-yellow-400/20 via-pink-500/20 to-purple-600/20 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path></svg>
                            </div>
                            <span class="text-sm font-bold text-gray-700 dark:text-gray-300">Klik untuk memilih foto</span>
                            <span class="text-xs mt-1 text-gray-400">Format yang didukung: PNG, JPG, JPEG, WEBP (Maks 2MB)</span>
                        </div>

                        <!-- Actual File Input -->
                        <input id="image-upload" type="file" name="image" accept="image/*" class="hidden" required onchange="previewImage(event)">
                    </div>
                    @error('image') <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p> @enderror
                </div>

                <!-- Input Caption -->
                <div>
                    <label for="caption" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Caption</label>
                    <textarea id="caption" name="caption" rows="4" placeholder="Tuliskan cerita menarik tentang fotomu..."
                        class="w-full px-4 py-3 text-sm rounded-xl bg-gray-50/80 dark:bg-gray-900/80 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all shadow-inner resize-none"></textarea>
                    @error('caption') <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p> @enderror
                </div>

                <!-- Tombol Submit Gradient -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 px-4 font-bold text-white text-sm bg-gradient-to-r from-purple-600 via-pink-500 to-orange-400 hover:from-purple-700 hover:via-pink-600 hover:to-orange-500 rounded-xl shadow-[0_10px_20px_rgba(236,72,153,0.3)] hover:shadow-[0_15px_25px_rgba(236,72,153,0.4)] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                        Bagikan Postingan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Preview Gambar -->
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('image-preview');
                var placeholder = document.getElementById('upload-placeholder');
                output.src = reader.result;
                output.classList.remove('hidden');
                placeholder.classList.add('hidden');
            };
            if(event.target.files[0]){
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</x-app-layout>