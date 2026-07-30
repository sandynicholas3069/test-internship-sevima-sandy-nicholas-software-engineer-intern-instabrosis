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

    // Menampilkan daftar postingan yang disimpan oleh user di profil
    public function index()
    {
        $bookmarks = Auth::user()->bookmarks()->with('post.user')->latest()->get();

        return view('bookmarks.index', compact('bookmarks'));
    }
}