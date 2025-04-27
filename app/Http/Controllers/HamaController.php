<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HamaController extends Controller
{
    // Hardcode daftar hama dan penanganannya (rekomendasi + gambar)
    public static function getHamaRecommendations()
    {
        return [
            'Wereng' => [
                'rekomendasi' => 'Gunakan insektisida berbahan aktif imidakloprid, monitoring rutin tanaman',
                'gambar' => '/images/hama/wereng.gif'
            ],
            'Ulat Grayak' => [
                'rekomendasi' => 'Semprot dengan insektisida biologi berbahan Bacillus thuringiensis',
                'gambar' => '/images/hama/ulat_grayak.jpeg'
            ],
            'Tungau Merah' => [
                'rekomendasi' => 'Gunakan akarisida dan jaga kelembaban tanah',
                'gambar' => '/images/hama/tungau.jpg'
            ],
            'Lalat Buah' => [
                'rekomendasi' => 'Gunakan perangkap lalat (fruit fly trap) dan buang buah terinfeksi',
                'gambar' => '/images/hama/lalat-buah.jpg'
            ],
            // Bisa tambah hama lain di sini
        ];
    }

    // Menampilkan halaman rekomendasi
    public function index()
    {
        $hamas = array_keys(self::getHamaRecommendations());
        return view('hama.index', compact('hamas'));
    }

    // Mencari rekomendasi berdasarkan input user
    public function search(Request $request)
    {
        $request->validate([
            'jenis_hama' => 'required|string'
        ]);

        $rekomendasiList = self::getHamaRecommendations();
        $data = $rekomendasiList[$request->jenis_hama] ?? null;

        $hamas = array_keys($rekomendasiList);

        return view('hama.index', compact('hamas', 'data', 'request'));
    }
}
