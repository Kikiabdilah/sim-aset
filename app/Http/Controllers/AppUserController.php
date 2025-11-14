<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use Illuminate\Http\Request;

class AppUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $users = AppUser::all();
    return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     AppUser::create([
        'username' => $request->username,
        'password' => bcrypt($request->password),
        'nama_pegawai' => $request->nama_pegawai,
        'nik' => $request->nik,
        'ktp' => $request->ktp,
        'role' => $request->role,
        'genre' => $request->genre,
        'status' => 1,
        'valid' => 1,
        'image' => null,
    ]);

    return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(AppUser $appUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AppUser $appUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AppUser $appUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppUser $appUser)
    {
        //
    }
}
