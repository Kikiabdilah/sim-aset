<?php

namespace App\Http\Controllers;

use App\Models\UsulanAset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
   public function index(Request $request)
{
    $query = UsulanAset::where('stts_approval_mg', 'approved')
                       ->where('stts_approval_dir', 'approved');

    // FILTER SEARCH
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('nm_brg', 'like', '%' . $request->search . '%')
              ->orWhere('kd_brg', 'like', '%' . $request->search . '%');
        });
    }

    // FILTER TANGGAL
    if ($request->tanggal_awal && $request->tanggal_akhir) {

        // convert d/m/Y → Y-m-d
        try {
            $tgl_awal = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->format('Y-m-d');
            $tgl_akhir = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->format('Y-m-d');
        } catch (\Exception $e) {
            $tgl_awal = null;
            $tgl_akhir = null;
        }

        if ($tgl_awal && $tgl_akhir) {
            $query->whereBetween('tgl_approval_dir', [$tgl_awal, $tgl_akhir]);
        }
    }

    $aset = $query->orderBy('tgl_approval_dir', 'desc')->get();

    return view('aset.index', compact('aset'));
}
}
