<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsulanAset;

class ApprovalManagerController extends Controller
{
    public function index()
    {
        $data = UsulanAset::where('stts_approval_mg', '1')->get();
        return view('manager.approval.index', compact('data'));
    }

    public function approve($id)
    {
        UsulanAset::find($id)->update([
            'stts_approval_mg' => '2',
            'tgl_approval_mg' => now(),
        ]);

        return back()->with('success', 'Usulan disetujui Manager');
    }

    public function reject($id)
    {
        UsulanAset::find($id)->update([
            'stts_approval_mg' => '3',
            'tgl_approval_mg' => now(),
        ]);

        return back()->with('success', 'Usulan ditolak Manager');
    }
}
