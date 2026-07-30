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
                <h1 class="text-2xl font-black tracking-tight text-gray-900 dark:text-white">Edit Postingan</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Perbarui caption atau ganti foto postinganmu</p>
            </div>
        </div>

        <div class="bg-white/80 dark:bg-[#1a1c23]/80 backdrop-blur-xl border border-white/50 dark:border-gray-700/50 rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.08)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.4)] overflow-hidden p-6 sm:p-8 transition-all duration-300">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Photo Edit Area -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300">Foto Postingan</label>
                        <span class="text-[10px] font-extrabold text-pink-500 bg-pink-100 dark:bg-pink-900/40 px-2.5 py-0.5 rounded-full">Opsional</span>
                    </div>
                    <div class="relative w-full h-80 rounded-2xl border-2 border-dashed border-gray-300/80 dark:border-gray-700/80 bg-gray-50/50 dark:bg-gray-900/50 hover:bg-gray-100/50 dark:hover:bg-gray-800/50 transition-colors flex flex-col items-center justify-center overflow-hidden group cursor-pointer" onclick="document.getElementById('image-upload').click()">
                        
                        <!-- Gambar Lama sebagai Default Preview -->
                        <img id="image-preview" src="{{ asset('storage/' . $post->image) }}" alt="Preview" class="absolute inset-0 w-full h-full object-cover z-10 opacity-70 group-hover:opacity-40 transition-opacity">
                        
                        <div id="upload-placeholder" class="flex flex-col items-center z-20 text-gray-900 dark:text-white drop-shadow-md text-center p-4">
                            <div class="p-3 rounded-full bg-black/40 backdrop-blur-md mb-2">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path></svg>
                            </div>
                            <span class="text-xs font-black bg-black/50 text-white px-3 py-1 rounded-full backdrop-blur-md">Klik jika ingin mengganti foto</span>
                        </div>

                        <input id="image-upload" type="file" name="image" accept="image/*" class="hidden" onchange="previewImage(event)">
                    </div>
                    @error('image') <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p> @enderror
                </div>

                <!-- Input Caption -->
                <div>
                    <label for="caption" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Caption</label>
                    <textarea id="caption" name="caption" rows="4" 
                        class="w-full px-4 py-3 text-sm rounded-xl bg-gray-50/80 dark:bg-gray-900/80 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all shadow-inner resize-none">{{ old('caption', $post->caption) }}</textarea>
                    @error('caption') <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p> @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 px-4 font-bold text-white text-sm bg-gradient-to-r from-purple-600 via-pink-500 to-orange-400 hover:from-purple-700 hover:via-pink-600 hover:to-orange-500 rounded-xl shadow-[0_10px_20px_rgba(236,72,153,0.3)] hover:shadow-[0_15px_25px_rgba(236,72,153,0.4)] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                        Simpan Perubahan
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
                output.src = reader.result;
                output.classList.remove('opacity-70');
                output.classList.add('opacity-100');
                document.getElementById('upload-placeholder').classList.add('hidden');
            };
            if(event.target.files[0]){
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</x-app-layout>