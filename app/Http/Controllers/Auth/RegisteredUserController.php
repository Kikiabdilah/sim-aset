<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:25', 'unique:app_users,username'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nama_pegawai' => ['required', 'string', 'max:60'],
            'nik' => ['required', 'string', 'max:10'],
            'role' => ['required', 'in:1,2,3'],
            'image' => ['nullable', 'string', 'max:50'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_pegawai' => $request->nama_pegawai,
            'nik' => $request->nik,
            'role' => $request->role,
            'status' => 1,
            'valid' => 1,
            'image' => $request->image,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
