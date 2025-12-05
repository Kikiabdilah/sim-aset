<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'usulan_aset_id',
        'tgl_maintenance',
        'jenis',
        'biaya',
        'catatan',
        'bukti'
    ];

    public function aset()
    {
        return $this->belongsTo(UsulanAset::class, 'usulan_aset_id');
    }
}
