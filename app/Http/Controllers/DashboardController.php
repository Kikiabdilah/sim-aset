<?php

namespace App\Http\Controllers;

use App\Models\UsulanAset;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // TOTAL ASET AKTIF
        $totalAsetAktif = UsulanAset::where('stts_approval_mg', 'approved')
            ->where('stts_approval_dir', 'approved')
            ->count();

        // HITUNG JUMLAH PER KATEGORI (berdasarkan jns_brg)
        $kategori = UsulanAset::selectRaw('jns_brg, COUNT(*) as total')
            ->groupBy('jns_brg')
            ->get();

        // Siapkan untuk chart.js
        $labels = $kategori->pluck('jns_brg');
        $data = $kategori->pluck('total');

        return view('dashboard.index', compact(
            'totalAsetAktif',
            'labels',
            'data'
        ));
    }
}
