<?php

namespace App\Http\Controllers;

use App\Models\UsulanAset;

class PenghapusanController extends Controller
{
    public function index()
    {
        $asets = UsulanAset::all();

        // Bobot kriteria MAUT
        $bobot = [
            'sisa_umur'  => 0.4,
            'akumulasi'  => 0.3,
            'nilai_buku' => 0.2,
            'kondisi'    => 0.1,
        ];

        // Nilai maksimum sub-kriteria
        $max = [
            'sisa_umur'  => 5,
            'akumulasi'  => 5,
            'nilai_buku' => 10,
            'kondisi'    => 3,
        ];

        $threshold = 0.66;
        $hasil = [];

        foreach ($asets as $aset) {

            // Normalisasi
            $nSisa  = $aset->bobot_sisa_umur  / $max['sisa_umur'];
            $nAkum  = $aset->bobot_akumulasi  / $max['akumulasi'];
            $nNilai = $aset->bobot_nilai_buku / $max['nilai_buku'];
            $nKond  = $aset->bobot_kondisi    / $max['kondisi'];

            // Nilai preferensi MAUT
            $nilaiMaut =
                ($nSisa  * $bobot['sisa_umur']) +
                ($nAkum  * $bobot['akumulasi']) +
                ($nNilai * $bobot['nilai_buku']) +
                ($nKond  * $bobot['kondisi']);

            $hasil[] = [
                'aset' => $aset,
                'nilai_maut' => round($nilaiMaut, 4),
                'layak' => $nilaiMaut >= $threshold,
            ];
        }

        // Ranking
        usort($hasil, fn($a, $b) => $b['nilai_maut'] <=> $a['nilai_maut']);

        return view('hapus.index', compact('hasil', 'threshold'));
    }
}
