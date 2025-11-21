<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AppUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'app_users';

    protected $fillable = [
        'username',
        'password',
        'nama_pegawai',
        'nik',
        'role',
        'status',
        'valid',
        'image'
    ];

    // untuk menyembunyikan data sensitif
    protected $hidden = [
        'password',
    ];
}
