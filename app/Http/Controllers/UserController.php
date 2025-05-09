<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            // Eski avatarı sil
            if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
                Storage::delete('public/avatars/' . $user->avatar);
            }

            // Yeni avatarı yükle
            $file = $request->file('avatar');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/avatars', $filename);

            // Kullanıcı avatarını güncelle
            $user->avatar = $filename;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profil fotoğrafı başarıyla güncellendi.');
    }
} 