<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // [CREATE] Menyimpan komentar baru (Komentar Utama maupun Balasan)
    public function store(Request $request, Post $post)
    {
        // Validasi input content & parent_id (opsional)
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:1000'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ]);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id ?? null,
            'content' => $validated['content'],
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    // [UPDATE] Mengubah/mengedit isi komentar
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        // Pengecekan Otorisasi: Hanya pembuat komentar yang boleh mengedit
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengubah komentar ini.');
        }

        $validated = $request->validated();

        $comment->update([
            'content' => $validated['content'],
        ]);

        return back()->with('success', 'Komentar berhasil diperbarui.');
    }

    // [DELETE] Menghapus komentar
    public function destroy(Comment $comment)
    {
        // Pengecekan Otorisasi: Pembuat komentar ATAU pemilik postingan berhak menghapus
        if ($comment->user_id !== Auth::id() && $comment->post->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki hak akses untuk menghapus komentar ini.');
        }

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}