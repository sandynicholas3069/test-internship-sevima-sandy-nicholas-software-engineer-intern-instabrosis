<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // [READ] Menampilkan Feed Beranda
    public function index()
    {
        $posts = Post::with(['user', 'comments.user', 'likes'])
            ->latest()
            ->get();

        return view('posts.index', compact('posts'));
    }

    // [CREATE] Menampilkan Form Buat Post
    public function create()
    {
        return view('posts.create');
    }

    // [CREATE] Menyimpan Post Baru
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $imagePath = $request->file('image')->store('posts', 'public');

        Auth::user()->posts()->create([
            'image' => $imagePath,
            'caption' => $validated['caption'] ?? null,
        ]);

        return redirect()->route('posts.index')->with('success', 'Postingan berhasil dibagikan!');
    }

    // [READ] Menampilkan Detail Satu Post (Optional/Single Post View)
    public function show(Post $post)
    {
        $post->load(['user', 'comments.user', 'likes']);
        return view('posts.show', compact('post'));
    }

    // [SHARE] Membuat Link Share Postingan
    public function share(Post $post)
    {
        $shareUrl = route('posts.show', $post->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Link postingan berhasil dibuat.',
            'post_id' => $post->id,
            'share_url' => $shareUrl,
        ]);
    }

    // [UPDATE] Menampilkan Form Edit Post
    public function edit(Post $post)
    {
        // Cek Hak Akses (Authorization)
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit postingan ini.');
        }

        return view('posts.edit', compact('post'));
    }

    // [UPDATE] Menyimpan Perubahan Post
    public function update(UpdatePostRequest $request, Post $post)
    {
        // Cek Hak Akses
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah postingan ini.');
        }

        $validated = $request->validated();

        // Jika user mengunggah gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            // Simpan gambar baru
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->caption = $validated['caption'] ?? null;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Postingan berhasil diperbarui!');
    }

    // [DELETE] Menghapus Post
    public function destroy(Post $post)
    {
        // Cek Hak Akses
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus postingan ini.');
        }

        // Hapus file gambar dari storage
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        // Hapus record di DB (Cascade akan otomatis hapus comment & like terkait)
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Postingan berhasil dihapus.');
    }
}