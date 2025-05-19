<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hama;

class HamaController extends Controller
{
    // Menampilkan halaman utama rekomendasi hama
    public function index(Request $request)
    {
        // Ambil seluruh daftar nama hama dari database
        $hamas = Hama::pluck('nama_hama')->toArray();
        $data = null;

        // Jika user mengirimkan jenis_hama, ambil datanya
        if ($request->filled('jenis_hama')) {
            $data = Hama::where('nama_hama', $request->jenis_hama)->first();
        }

        return view('hama.index', compact('hamas', 'data', 'request'));
    }
}
