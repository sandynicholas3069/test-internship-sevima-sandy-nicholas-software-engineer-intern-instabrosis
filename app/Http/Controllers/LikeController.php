<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // Toggle Like & Unlike
    public function toggle(Post $post)
    {
        $user = Auth::user();

        // Cari apakah user sudah pernah like post ini
        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            // Jika sudah di-like, hapus (UNLIKE)
            $like->delete();
            $message = 'Suka dibatalkan.';
        } else {
            // Jika belum di-like, tambahkan (LIKE)
            $post->likes()->create([
                'user_id' => $user->id,
            ]);
            $message = 'Postingan disukai.';
        }

        return back()->with('success', $message);
    }
}