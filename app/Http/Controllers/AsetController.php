<?php

namespace App\Http\Controllers;

use App\Models\UsulanAset as Usulan;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        $query = Usulan::where('stts_approval_mg', 'approved')
                       ->where('stts_approval_dir', 'approved');

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('kd_brg', 'like', "%{$request->search}%")
                  ->orWhere('nm_brg', 'like', "%{$request->search}%");
            });
        }

        // FILTER BY DATE
        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tgl_approval_dir', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $aset = $query->orderBy('tgl_approval_dir', 'desc')->get();

        return view('aset.index', compact('aset'));
    }
}
