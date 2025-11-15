<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
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
}
