<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes / Guest Redirection
|--------------------------------------------------------------------------
*/

// Mengarahkan halaman utama (/) langsung ke Feed Postingan
Route::get('/', function () {
    return redirect()->route('posts.index');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Requirement D: Autentifikasi Pengguna)
|--------------------------------------------------------------------------
| Seluruh rute di dalam grup ini terproteksi oleh middleware 'auth'.
| Pengguna anonim/guest akan otomatis ditolak dan diarahkan ke halaman Login.
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Redirect Dashboard bawaan Breeze langsung ke Feed utama
    Route::get('/dashboard', function () {
        return redirect()->route('posts.index');
    })->name('dashboard');

    // ==========================================
    // 1. MANAJEMEN PROFIL (Requirement A & Extra Avatar/Bio)
    // ==========================================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==========================================
    // 2. FITUR POSTINGAN / FEED (Requirement B & E - Full CRUD & Hak Akses)
    // ==========================================
    // Otomatis mendaftarkan:
    // - GET  /posts           (index   -> posts.index)
    // - GET  /posts/create    (create  -> posts.create)
    // - POST /posts           (store   -> posts.store)
    // - GET  /posts/{post}    (show    -> posts.show)
    // - GET  /posts/{post}/edit (edit  -> posts.edit)
    // - PUT/PATCH /posts/{post} (update -> posts.update)
    // - DELETE /posts/{post}  (destroy -> posts.destroy)
    Route::resource('posts', PostController::class);

    // ==========================================
    // 3. FITUR LIKE & KOMENTAR (Requirement C & E)
    // ==========================================
    // Toggle Like / Unlike
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');

    // CRUD Komentar
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // ==========================================
    // 4. FITUR SOSIAL TAMBAHAN (Bookmark & Social Graph)
    // ==========================================
    // Toggle Save / Unsave Post
    Route::post('/posts/{post}/bookmark', [BookmarkController::class, 'toggle'])->name('posts.bookmark');
    Route::get('/saved-posts', [BookmarkController::class, 'index'])->name('bookmarks.index');

    // Toggle Follow / Unfollow User
    Route::post('/users/{user}/follow', [FollowController::class, 'toggle'])->name('users.follow');

});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Requirement A: Register & Login Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';