<?php

namespace App\Http\Controllers;

use App\Models\UsulanAset;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        $query = UsulanAset::where('stts_approval_mg', 'approved')
            ->where('stts_approval_dir', 'approved');

        // ============= FILTER SEARCH =============
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nm_brg', 'like', '%' . $request->search . '%')
                    ->orWhere('kd_brg', 'like', '%' . $request->search . '%');
            });
        }

        // ============= FILTER TANGGAL =============
        if ($request->tanggal_awal && $request->tanggal_akhir) {

            try {
                $tgl_awal = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->format('Y-m-d');
                $tgl_akhir = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->format('Y-m-d');
            } catch (\Exception $e) {
                $tgl_awal = null;
                $tgl_akhir = null;
            }

            if ($tgl_awal && $tgl_akhir) {
                $query->whereBetween('tgl_pengadaan', [$tgl_awal, $tgl_akhir]);
            }
        }

        // Ambil data
        $aset = $query->orderBy('tgl_pengadaan', 'desc')->get();

        // ============= PERHITUNGAN PENYUSUTAN =============
        foreach ($aset as $item) {

            // Tentukan persentase sesuai umur ekonomis
            $umur = (int)$item->masa_manfaat;
            if ($umur == 4) {
                $persen = 25;
            } elseif ($umur == 8) {
                $persen = 12.5;
            } elseif ($umur == 16) {
                $persen = 6.25;
            } elseif ($umur == 20) {
                $persen = 5;
            } else {
                $persen = 0;
            }

            $item->persentase = $persen;

            // ============ NILAI SISA ============
            $item->nilai_sisa = $item->harga_brg * ($persen / 100);

            // ============ PENYUSUTAN PER TAHUN ============
            $item->penyusutan_tahunan =
                ($item->harga_brg - $item->nilai_sisa) / $umur;

            // ============ HITUNG LAMA PEMAKAIAN ============
            $tahun_pengadaan = Carbon::parse($item->tgl_pengadaan)->year;
            $tahun_sekarang = Carbon::now()->year;

            $pemakaian = $tahun_sekarang - $tahun_pengadaan;
            if ($pemakaian > $umur) {
                $pemakaian = $umur; // tidak boleh lebih dari umur ekonomis
            }
            if ($pemakaian < 0) {
                $pemakaian = 0;
            }

            $item->lama_pemakaian = $pemakaian;

            // ============ AKUMULASI PENYUSUTAN ============
            $item->akumulasi_penyusutan =
                $item->penyusutan_tahunan * $pemakaian;

            // ============ NILAI BUKU ============
            $item->nilai_buku =
                $item->harga_brg - $item->akumulasi_penyusutan;
        }

        return view('aset.index', compact('aset'));
    }
}
