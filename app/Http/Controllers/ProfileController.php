<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Show the user's profile form.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'nama_pegawai' => $request->nama_pegawai,
            'username'     => $request->username,
        ]);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user.
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'password' => ['required'],
        ]);

        // cek password
        if (!\Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah.']);
        }

        $user->delete();

        auth()->logout();

        return Redirect::to('/');
    }
}
