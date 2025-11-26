<?php

namespace App\Http\Controllers;

use App\Models\UsulanAset as Usulan;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index()
    {
        // hanya tampilkan aset yang double-approved
        $aset = Usulan::where('stts_approval_mg', 'approved')
            ->where('stts_approval_dir', 'approved')
            ->get();

        return view('aset.index', compact('aset'));
    }
}
