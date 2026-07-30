<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    // Toggle Save (Bookmark) & Unsave
    public function toggle(Post $post)
    {
        $user = Auth::user();

        $bookmark = $post->bookmarks()->where('user_id', $user->id)->first();

        if ($bookmark) {
            // Jika sudah disimpan, hapus dari simpanan (UNSAVE)
            $bookmark->delete();
            $message = 'Postingan dihapus dari simpanan.';
        } else {
            // Jika belum, simpan post (SAVE)
            $post->bookmarks()->create([
                'user_id' => $user->id,
            ]);
            $message = 'Postingan berhasil disimpan!';
        }

        return back()->with('success', $message);
    }

    // Menampilkan daftar postingan yang disimpan oleh user
    public function index()
    {
        $user = Auth::user();

        // Mengambil postingan yang di-bookmark beserta relasi user, likes, dan comments
        $posts = Post::whereHas('bookmarks', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['user', 'likes', 'comments'])->latest()->get();

        return view('bookmarks.index', compact('posts'));
    }
}