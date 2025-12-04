<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UsulanAset extends Model
{
    protected $table = 'usulan_asets';
    protected $guarded = [];

    /* ============================
       PERSENTASE NILAI SISA
       ============================ */
    public function getPersentaseSisaAttribute()
    {
        return match ((int) $this->masa_manfaat) {
            4  => 0.25,
            8  => 0.125,
            16 => 0.0625,
            20 => 0.05,
            default => 0,
        };
    }

    /* ============================
       NILAI SISA
       ============================ */
    public function getNilaiSisaAttribute()
    {
        return round((float) $this->harga_brg * (float) $this->persentase_sisa);
    }

    /* ============================
       PENYUSUTAN PER TAHUN (GARIS LURUS)
       ============================ */
    public function getPenyusutanTahunanAttribute()
    {
        $harga = (float) $this->harga_brg;
        $nilaiSisa = (float) $this->nilai_sisa;
        $umur = (int) $this->masa_manfaat;

        if ($umur <= 0) return 0;

        return ($harga - $nilaiSisa) / $umur;
    }

    /* ============================
       UMUR BERJALAN
       ============================ */
    public function getUmurBerjalanAttribute()
    {
        $tgl = $this->tgl_pengadaan ?: ($this->created_at?->toDateString() ?? null);
        if (!$tgl) return 0;

        $tahunBeli = Carbon::parse($tgl)->year;
        $tahunNow = Carbon::now()->year;

        $umur = $tahunNow - $tahunBeli;

        if ($umur < 0) $umur = 0;

        return min($umur, (int) $this->masa_manfaat);
    }

    /* ============================
       AKUMULASI PENYUSUTAN
       ============================ */
    public function getAkumulasiPenyusutanAttribute()
    {
        return $this->penyusutan_tahunan * $this->umur_berjalan;
    }

    /* ============================
       NILAI BUKU SAAT INI
       ============================ */
    public function getNilaiBukuAttribute()
    {
        $nilai = (float) $this->harga_brg - (float) $this->akumulasi_penyusutan;

        // jangan lebih kecil dari nilai sisa
        return max($nilai, (float) $this->nilai_sisa);
    }

    /* ============================
       FORMAT TANGGAL PENGADAAN (DD/MM/YYYY)
       ============================ */
    public function getTglPengadaanFormattedAttribute()
    {
        $tgl = $this->tgl_pengadaan ?: ($this->created_at?->toDateString() ?? null);
        return $tgl ? Carbon::parse($tgl)->format('d/m/Y') : '-';
    }
}
