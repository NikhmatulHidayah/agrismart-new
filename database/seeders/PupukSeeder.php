<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PupukSeeder extends Seeder
{
    public function run()
    {
        $tanamans = ['Padi', 'Jagung', 'Tomat'];
        $tanahs = ['Basah', 'Kering', 'Lembab'];
        $tahaps = ['Vegetatif', 'Generatif', 'Pembungaan'];

        foreach ($tanamans as $tanaman) {
            foreach ($tanahs as $tanah) {
                foreach ($tahaps as $tahap) {
                    DB::table('pupuk')->insert([
                        'jenis_tanaman' => $tanaman,
                        'kondisi_tanah' => $tanah,
                        'tahap_pertumbuhan' => $tahap,
                        'rekomendasi' => "Gunakan pupuk untuk {$tanaman} di tanah {$tanah} pada tahap {$tahap}.",
                        'gambar' => 'images/pupuk/default.jpg',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }
        }
    }
}
