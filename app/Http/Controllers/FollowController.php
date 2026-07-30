<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    // Toggle Follow / Unfollow User
    public function toggle(User $user)
    {
        $currentUser = Auth::user();

        // Mencegah user mem-follow diri sendiri
        if ($currentUser->id === $user->id) {
            return back()->with('error', 'Anda tidak dapat mengikuti akun sendiri.');
        }

        // Jika sudah follow -> detach (Unfollow), jika belum -> attach (Follow)
        if ($currentUser->isFollowing($user)) {
            $currentUser->followings()->detach($user->id);
            $message = 'Berhenti mengikuti ' . $user->name;
        } else {
            $currentUser->followings()->attach($user->id);
            $message = 'Mulai mengikuti ' . $user->name;
        }

        return back()->with('success', $message);
    }
}