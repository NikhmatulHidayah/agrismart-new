<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemupukanController extends Controller
{
    /**
     * Hardcode mapping rekomendasi pemupukan
     */
    public static function getPemupukanRecommendations()
    {
        return [
            'Lempung' => [
                'Padi' => [
                    'awal' => 'Gunakan Urea + SP-36 saat tanam',
                    'susulan1' => 'Berikan KCL pada hari ke-30',
                    'susulan2' => 'Tambahkan NPK pada hari ke-60'
                ],
                'Tomat' => [
                    'awal' => 'Gunakan Pupuk Organik saat olah tanah',
                    'susulan1' => 'Tambahkan NPK Mutiara hari ke-20',
                    'susulan2' => 'Pupuk Daun hari ke-45'
                ],
            ],
            'Berpasir' => [
                'Cabai' => [
                    'awal' => 'Gunakan Pupuk Kandang banyak saat olah tanah',
                    'susulan1' => 'Berikan NPK seimbang hari ke-15',
                    'susulan2' => 'Urea susulan hari ke-40'
                ]
            ],
            // Bisa tambah mapping lain di sini
        ];
    }

    /**
     * Menampilkan halaman form pemupukan
     */
    public function index()
    {
        $recommendations = self::getPemupukanRecommendations();
        $tanahs = array_keys($recommendations);

        // Ambil semua tanaman unik dari semua tanah
        $tanamans = [];
        foreach ($recommendations as $jenisTanah => $dataTanah) {
            foreach (array_keys($dataTanah) as $jenisTanaman) {
                $tanamans[] = $jenisTanaman;
            }
        }
        $tanamans = array_unique($tanamans); // Menghilangkan duplikat

        return view('pemupukan.index', compact('tanahs', 'tanamans'));
    }

    /**
     * Proses pencarian rekomendasi
     */
    public function search(Request $request)
    {
        $request->validate([
            'jenis_tanah' => 'required|string',
            'jenis_tanaman' => 'required|string'
        ]);

        $recommendations = self::getPemupukanRecommendations();
        $result = $recommendations[$request->jenis_tanah][$request->jenis_tanaman] ?? null;

        $tanahs = array_keys($recommendations);

        $tanamans = [];
        foreach ($recommendations as $jenisTanah => $dataTanah) {
            foreach (array_keys($dataTanah) as $jenisTanaman) {
                $tanamans[] = $jenisTanaman;
            }
        }
        $tanamans = array_unique($tanamans);

        return view('pemupukan.index', compact('tanahs', 'tanamans', 'result', 'request'));
    }
}
