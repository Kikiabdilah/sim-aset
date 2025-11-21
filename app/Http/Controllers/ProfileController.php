<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => auth()->user(),
        ]);
    }

public function update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'nama_pegawai' => 'required|string|max:60',
        'username'     => 'required|string|max:25|unique:app_users,username,' . $user->id,
        'nik'          => 'required|string|max:20',
        'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Upload foto
    if ($request->hasFile('image')) {

        // Hapus foto lama
        if ($user->image && \Storage::disk('public')->exists($user->image)) {
            \Storage::disk('public')->delete($user->image);
        }

        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('profile', $imageName, 'public');

        $user->image = 'profile/' . $imageName;
    }

    // Update field lain
    $user->update([
        'nama_pegawai' => $request->nama_pegawai,
        'username'     => $request->username,
        'nik'          => $request->nik,
    ]);

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}

public function deletePhoto()
{
    $user = auth()->user();

    if ($user->image && \Storage::disk('public')->exists($user->image)) {
        \Storage::disk('public')->delete($user->image);
    }

    $user->image = null;
    $user->save();

    return back()->with('status', 'photo-deleted');
}


}
