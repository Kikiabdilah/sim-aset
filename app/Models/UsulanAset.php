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
        return round($this->harga_brg * $this->persentase_sisa);
    }

    /* ============================
       PENYUSUTAN PER TAHUN
       ============================ */
    public function getPenyusutanTahunanAttribute()
    {
        if ($this->masa_manfaat <= 0) return 0;
        return ($this->harga_brg - $this->nilai_sisa) / $this->masa_manfaat;
    }

    /* ============================
       UMUR BERJALAN
       ============================ */
    public function getUmurBerjalanAttribute()
    {
        if (!$this->tgl_pengadaan) return 0;

        $umur = Carbon::now()->year - Carbon::parse($this->tgl_pengadaan)->year;
        return min(max($umur, 0), $this->masa_manfaat);
    }

    /* ============================
       AKUMULASI PENYUSUTAN
       ============================ */
    public function getAkumulasiPenyusutanAttribute()
    {
        return $this->penyusutan_tahunan * $this->umur_berjalan;
    }

    /* ============================
       NILAI BUKU
       ============================ */
    public function getNilaiBukuAttribute()
    {
        return max(
            $this->harga_brg - $this->akumulasi_penyusutan,
            $this->nilai_sisa
        );
    }

    /* ============================
       SISA UMUR
       ============================ */
    public function getSisaUmurAttribute()
    {
        return max($this->masa_manfaat - $this->umur_berjalan, 0);
    }

    /* ============================
       BOBOT KONDISI
       ============================ */
    public function getBobotKondisiAttribute()
    {
        return match ($this->kondisi_brg) {
            'PERBAIKAN BERAT'  => 3,
            'PERBAIKAN RINGAN' => 2,
            default            => 1,
        };
    }

    /* ============================
       BOBOT AKUMULASI
       ============================ */
    public function getBobotAkumulasiAttribute()
    {
        return match (true) {
            $this->umur_berjalan > 4 => 5,
            $this->umur_berjalan == 4 => 4,
            $this->umur_berjalan == 3 => 3,
            $this->umur_berjalan == 2 => 2,
            default => 1,
        };
    }

    /* ============================
       BOBOT SISA UMUR
       ============================ */
    public function getBobotSisaUmurAttribute()
    {
        return match (true) {
            $this->sisa_umur == 0 => 5,
            $this->sisa_umur <= 2 => 4,
            $this->sisa_umur <= 5 => 3,
            $this->sisa_umur <= 10 => 2,
            default => 1,
        };
    }

    /* ============================
       BOBOT NILAI BUKU (FIX BUG)
       ============================ */
    public function getBobotNilaiBukuAttribute()
    {
        $nb = $this->nilai_buku;

        return match (true) {
            $nb <= 500000  => 10,
            $nb <= 1000000 => 9,
            $nb <= 1500000 => 8,
            $nb <= 2000000 => 7,
            $nb <= 2500000 => 6,
            $nb <= 3000000 => 5,
            $nb <= 3500000 => 4,
            $nb <= 4000000 => 3,
            $nb <= 4500000 => 2,
            default        => 1,
        };
    }
    protected $casts = [
        'tgl_pengadaan' => 'date',
    ];

    public function getTglPengadaanFormattedAttribute()
    {
        return $this->tgl_pengadaan
            ? $this->tgl_pengadaan->format('d/m/Y')
            : '-';
    }
}
