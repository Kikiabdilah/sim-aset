<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'assets';

    protected $fillable = [
        'kd_aset',
        'nama_aset',
        'jumlah',
        'harga',
        'umur_ekonomis',
        'satuan',
        'keterangan',
    ];
}
