<?php

namespace App\Http\Controllers;

use App\Models\UsulanAset;
use Illuminate\Http\Request;

class ApprovalManagerController extends Controller
{
    public function index()
    {
        // Hanya tampilkan yang belum di-ACC Direktur dan belum di-approve manager
        $usulan = UsulanAset::orderBy('created_at', 'desc')->get();

        return view('manager.approval.index', compact('usulan'));
    }

    public function approve($id)
    {
        $usulan = UsulanAset::findOrFail($id);

        $usulan->stts_approval_mg = 'approved';
        $usulan->tgl_approval_mg = now();
        $usulan->save();

        return redirect()
            ->route('manager.approval.index')
            ->with('success', 'Usulan berhasil di-ACC Manager!');
    }

    public function reject($id)
    {
        $usulan = UsulanAset::findOrFail($id);

        $usulan->stts_approval_mg = 'rejected';
        $usulan->tgl_approval_mg = now();
        $usulan->save();

        return redirect()
            ->route('manager.approval.index')
            ->with('success', 'Usulan berhasil ditolak oleh Manager.');
    }
}
