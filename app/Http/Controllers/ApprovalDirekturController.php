<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsulanAset;

class ApprovalDirekturController extends Controller
{
    public function index()
    {
        $data = UsulanAset::where('stts_approval_mg', '2')
                          ->where('stts_approval_dir', '1')
                          ->get();

        return view('direktur.approval.index', compact('data'));
    }

    public function approve($id)
    {
        UsulanAset::find($id)->update([
            'stts_approval_dir' => '2',
            'tgl_approval_dir' => now(),
        ]);

        return back()->with('success', 'Usulan disetujui Direktur');
    }

    public function reject($id)
    {
        UsulanAset::find($id)->update([
            'stts_approval_dir' => '3',
            'tgl_approval_dir' => now(),
        ]);

        return back()->with('success', 'Usulan ditolak Direktur');
    }
}
