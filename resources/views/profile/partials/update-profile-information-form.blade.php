<section>
    <header>
        <h2 class="text-lg font-black text-gray-900 dark:text-white">
            Informasi Profil & Bio
        </h2>
        <p class="mt-1 text-xs text-gray-600 dark:text-gray-400 font-medium">
            Perbarui foto profil, bio, nama lengkap, dan alamat email Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

    <!-- FORM UTAMA DENGAN ENCTYPE MULTIPART -->
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- 1. AVATAR UPLOAD -->
        <div class="flex items-center gap-6 pb-2 border-b border-gray-100 dark:border-gray-800">
            <div class="relative group cursor-pointer" onclick="document.getElementById('avatar-upload').click()">
                <div class="w-20 h-20 rounded-full p-1 bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 shadow-md group-hover:scale-105 transition-transform">
                    <img id="avatar-preview" 
                         src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                         alt="Avatar" 
                         class="w-full h-full rounded-full object-cover border-2 border-white dark:border-[#1a1c23]">
                </div>
                <!-- Overlay Icon Kamera -->
                <div class="absolute inset-0 bg-black/40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"></path></svg>
                </div>
            </div>
            <div>
                <button type="button" onclick="document.getElementById('avatar-upload').click()" class="text-xs font-bold text-pink-500 hover:text-pink-600 dark:hover:text-pink-400 bg-pink-50 dark:bg-pink-900/30 px-3.5 py-1.5 rounded-full transition-colors">
                    Ganti Foto Profil
                </button>
                <input id="avatar-upload" type="file" name="avatar" accept="image/*" class="hidden" onchange="previewAvatar(event)">
                <x-input-error class="mt-1 text-xs" :messages="$errors->get('avatar')" />
            </div>
        </div>

        <!-- 2. NAMA LENGKAP -->
        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                class="w-full px-4 py-3 text-sm rounded-xl bg-gray-50/80 dark:bg-gray-900/80 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all shadow-inner">
            <x-input-error class="mt-2 text-xs" :messages="$errors->get('name')" />
        </div>

        <!-- 3. EMAIL -->
        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Alamat Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                class="w-full px-4 py-3 text-sm rounded-xl bg-gray-50/80 dark:bg-gray-900/80 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all shadow-inner">
            <x-input-error class="mt-2 text-xs" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="text-xs font-semibold text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-900/20 p-3 rounded-lg border border-amber-200 dark:border-amber-800">
                        Email Anda belum diverifikasi.
                        <button form="send-verification" class="text-amber-700 dark:text-amber-300 underline ml-1 hover:text-amber-800 focus:outline-none">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-xs text-emerald-600 dark:text-emerald-400">
                            Tautan verifikasi baru telah dikirim ke email Anda!
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- 4. BIOGRAFI -->
        <div>
            <label for="bio" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Biografi Singkat</label>
            <textarea id="bio" name="bio" rows="3" placeholder="Tuliskan cerita singkat tentang dirimu..."
                class="w-full px-4 py-3 text-sm rounded-xl bg-gray-50/80 dark:bg-gray-900/80 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all shadow-inner resize-none">{{ old('bio', $user->bio ?? '') }}</textarea>
            <x-input-error class="mt-2 text-xs" :messages="$errors->get('bio')" />
        </div>

        <!-- SUBMIT BUTTON -->
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-6 py-2.5 font-bold text-white text-xs bg-gradient-to-r from-purple-600 to-pink-500 hover:from-purple-700 hover:to-pink-600 rounded-xl shadow-lg shadow-pink-500/30 hover:scale-105 active:scale-95 transition-all duration-200">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-bold text-emerald-500">Tersimpan dengan sukses!</p>
            @endif
        </div>
    </form>

    <script>
        function previewAvatar(event) {
            var reader = new FileReader();
            reader.onload = function(){ document.getElementById('avatar-preview').src = reader.result; };
            if(event.target.files[0]) reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</section>