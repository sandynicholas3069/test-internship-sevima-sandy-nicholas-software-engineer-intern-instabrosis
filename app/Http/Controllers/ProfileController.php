<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the public user profile page (Instagram Style).
     */
    public function show(User $user): View
    {
        // Load postingan user beserta jumlah likes & comments untuk tiap postingan
        $user->load(['posts' => function ($query) {
            $query->withCount(['likes', 'comments'])->latest();
        }]);

        // Hitung statistik
        $postsCount = $user->posts->count();
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();

        // Cek apakah user yang sedang login sudah follow user ini
        $isFollowing = Auth::check() ? Auth::user()->isFollowing($user) : false;

        return view('users.show', compact('user', 'postsCount', 'followersCount', 'followingCount', 'isFollowing'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // 1. Fill data name, email, dan bio
        $user->fill($request->safe()->only(['name', 'email', 'bio']));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // 2. Simpan Foto Avatar jika di-upload
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada file fisiknya
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Upload avatar baru ke folder storage/app/public/avatars
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Hapus file avatar user jika akun dihapus
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}