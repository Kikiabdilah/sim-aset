<?php

namespace App\Http\Controllers;

use App\Models\UsulanAset;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        // ============================
        // SORTING DEFAULT
        // ============================
        $sort  = $request->get('sort', 'tgl_pengadaan');
        $order = $request->get('order', 'desc');

        // ============================
        // BASE QUERY
        // ============================
        $query = UsulanAset::query()
            ->where('stts_approval_mg', 'approved')
            ->where('stts_approval_dir', 'approved');

        // ============================
        // SEARCH (NAMA / KODE)
        // ============================
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nm_brg', 'like', "%{$search}%")
                  ->orWhere('kd_brg', 'like', "%{$search}%");
            });
        }

        // ============================
        // FILTER TANGGAL (dd/mm/yyyy)
        // ============================
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            try {
                $awal  = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
                $akhir = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();

                $query->whereBetween('tgl_pengadaan', [$awal, $akhir]);
            } catch (\Exception $e) {}
        }

        // ============================
        // VALIDASI SORT FIELD
        // ============================
        $allowedSort = [
            'kd_brg',
            'nm_brg',
            'tgl_pengadaan',
            'masa_manfaat',
            'harga_brg'
        ];

        if (!in_array($sort, $allowedSort)) {
            $sort = 'tgl_pengadaan';
        }

        $order = $order === 'asc' ? 'asc' : 'desc';

        // ============================
        // EXECUTE QUERY + PAGINATION
        // ============================
        $aset = $query->orderBy($sort, $order)
                      ->paginate(10)
                      ->withQueryString();

        return view('aset.index', compact('aset', 'sort', 'order'));
    }
}
