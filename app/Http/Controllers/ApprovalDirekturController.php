<?php

namespace App\Http\Controllers;

use App\Models\UsulanAset;
use Illuminate\Http\Request;

class ApprovalDirekturController extends Controller
{
    public function index()
    {
        // HANYA tampilkan data yang sudah di-approve Manager
        $usulan = UsulanAset::where('stts_approval_mg', 'approved')->get();

        return view('direktur.approval.index', compact('usulan'));
    }

    public function approve($id)
    {
        $data = UsulanAset::findOrFail($id);
        $data->stts_approval_dir = 'approved';
        $data->tgl_approval_dir = now();
        $data->save();

        return redirect()->back()->with('success', 'Usulan disetujui Direktur.');
    }

    public function reject($id)
    {
        $data = UsulanAset::findOrFail($id);
        $data->stts_approval_dir = 'rejected';
        $data->tgl_approval_dir = now();
        $data->save();

        return redirect()->back()->with('success', 'Usulan ditolak Direktur.');
    }
}
