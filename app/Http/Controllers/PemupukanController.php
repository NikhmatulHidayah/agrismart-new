<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pupuk;

class PemupukanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil pilihan untuk dropdown
        $tanamans = Pupuk::select('jenis_tanaman')->distinct()->pluck('jenis_tanaman');
        $tanahs = Pupuk::select('kondisi_tanah')->distinct()->pluck('kondisi_tanah');
        $tahaps = Pupuk::select('tahap_pertumbuhan')->distinct()->pluck('tahap_pertumbuhan');

        $data = null;

        // Cek apakah user sudah memilih semua input
        if ($request->filled(['jenis_tanaman', 'kondisi_tanah', 'tahap_pertumbuhan'])) {
            $data = Pupuk::where('jenis_tanaman', $request->jenis_tanaman)
                ->where('kondisi_tanah', $request->kondisi_tanah)
                ->where('tahap_pertumbuhan', $request->tahap_pertumbuhan)
                ->first();
        }

        return view('pemupukan.index', [
            'tanamans' => $tanamans,
            'tanahs' => $tanahs,
            'tahaps' => $tahaps,
            'rekomendasi' => $data,
            'request' => $request,
        ]);
    }
}
