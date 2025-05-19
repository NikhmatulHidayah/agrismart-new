<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HamaSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        DB::table('hama')->insert([
            [
                'nama_hama' => 'Wereng',
                'rekomendasi' => 'Gunakan insektisida berbahan aktif imidakloprid, monitoring rutin tanaman',
                'gambar' => 'images/hama/wereng.gif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_hama' => 'Ulat Grayak',
                'rekomendasi' => 'Semprot dengan insektisida biologi berbahan Bacillus thuringiensis',
                'gambar' => 'images/hama/ulat_grayak.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_hama' => 'Tungau Merah',
                'rekomendasi' => 'Gunakan akarisida dan jaga kelembaban tanah',
                'gambar' => 'images/hama/tungau.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_hama' => 'Lalat Buah',
                'rekomendasi' => 'Gunakan perangkap lalat (fruit fly trap) dan buang buah terinfeksi',
                'gambar' => 'images/hama/lalat-buah.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
