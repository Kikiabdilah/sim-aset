<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsulanAset extends Model
{
    protected $table = 'usulan_asets';

    protected $fillable = [
        'kd_usulan',
        'kd_brg',
        'nm_brg',
        'jns_brg',
        'jmlh_brg',
        'satuan_brg',
        'harga_brg',
        'masa_manfaat',
        'ket',
        'stts_approval_mg',
        'tgl_approval_mg',
        'stts_approval_dir',
        'tgl_approval_dir',
        'stts_pengadaan',
        'tgl_pengadaan'
    ];
}
