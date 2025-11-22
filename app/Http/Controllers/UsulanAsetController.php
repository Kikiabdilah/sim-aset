<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\UsulanAset;
use Illuminate\Support\Str;

class UsulanAsetController extends Controller
{
    public function index()
    {
        $usulan = UsulanAset::orderBy('created_at', 'desc')->get();
        return view('admin.usulan.index', compact('usulan'));
    }

    public function create()
    {
        $aset = Asset::all();
        return view('admin.usulan.create', compact('aset'));
    }

public function store(Request $req)
{
    $req->validate([
        'kd_brg' => 'required',
        'nm_brg' => 'required',
        'jmlh_brg' => 'required|integer|min:1',
        'harga_brg' => 'required|integer|min:1',
        'satuan_brg' => 'required',
        'masa_manfaat' => 'required|integer|min:1',
    ]);

   UsulanAset::create([
        'kd_usulan' => 'USL-' . Str::random(6),
        'kd_brg' => $req->kd_brg,
        'nm_brg' => $req->nm_brg,
        'jmlh_brg' => $req->jmlh_brg,
        'harga_brg' => $req->harga_brg,
        'satuan_brg' => $req->satuan_brg,
        'jns_brg' => $req->jns_brg,
        'masa_manfaat' => $req->masa_manfaat,
        'ket' => $req->ket,
    ]);


        return redirect()->route('admin.usulan.index')
            ->with('success', 'Usulan berhasil dikirim');
    }
}
