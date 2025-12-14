<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
                Storage::delete('public/avatars/' . $user->avatar);
            }

            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/avatars', $imageName);
            $user->avatar = $imageName;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah!']);
        }

        Auth::user()->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }

    public function updatePreferences(Request $request)
    {
        $request->validate([
            'language' => 'required|in:id,en',
            'theme' => 'required|in:light,dark',
        ]);

        $user = Auth::user();
        
        $user->update([
            'language' => $request->language,
            'theme' => $request->theme,
            'email_notification' => $request->has('email_notification'), // Checkbox behavior
        ]);

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }

    public function editPassword()
    {
        return view('profile.password');
    }

    public function editSettings()
    {
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }
}