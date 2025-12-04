<?php

namespace App\Http\Controllers;

use App\Models\UsulanAset;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        $sort  = $request->get('sort', 'tgl_pengadaan');
        $order = $request->get('order', 'desc');

        $query = UsulanAset::where('stts_approval_mg', 'approved')
            ->where('stts_approval_dir', 'approved');

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nm_brg', 'like', '%' . $request->search . '%')
                  ->orWhere('kd_brg', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER TANGGAL (DD/MM/YYYY)
        if ($request->tanggal_awal && $request->tanggal_akhir) {
            try {
                $awal  = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->format('Y-m-d');
                $akhir = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->format('Y-m-d');

                $query->whereBetween('tgl_pengadaan', [$awal, $akhir]);
            } catch (\Exception $e) {}
        }

        // ORDER
        $aset = $query->orderBy($sort, $order)->get();

        return view('aset.index', compact('aset', 'sort', 'order'));
    }
}
