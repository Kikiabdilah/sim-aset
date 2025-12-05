<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\UsulanAset;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $asets = UsulanAset::where('stts_approval_mg', 'approved')
            ->where('stts_approval_dir', 'approved')
            ->get();

        return view('maintenance.index', compact('asets'));
    }

    public function show($id)
    {
        $aset = UsulanAset::findOrFail($id);
        $riwayat = Maintenance::where('usulan_aset_id', $id)->get();

        return view('maintenance.show', compact('aset', 'riwayat'));
    }

    public function create($id)
    {
        $aset = UsulanAset::findOrFail($id);
        return view('maintenance.create', compact('aset'));
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'tgl_maintenance' => 'required|date',
            'jenis' => 'required|string',
            'biaya' => 'nullable|numeric',
            'catatan' => 'nullable|string',
            'bukti' => 'nullable|file|mimes:jpg,png,pdf'
        ]);

        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $request->file('bukti')->store('bukti-maintenance');
        }

        $validated['usulan_aset_id'] = $id;

        Maintenance::create($validated);

        return redirect()->route('maintenance.show', $id)
            ->with('success', 'Riwayat maintenance berhasil ditambahkan.');
    }
}
