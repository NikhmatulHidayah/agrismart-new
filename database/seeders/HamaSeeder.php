<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HamaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hama')->insert([
            [
                'nama_hama' => 'Wereng',
                'rekomendasi' => 'Gunakan insektisida berbahan aktif imidakloprid, monitoring secara rutin.',
                'gambar' => 'images/hama/wereng.gif',
                'created_at' => Carbon::parse('2025-05-05 06:08:00'),
                'updated_at' => Carbon::parse('2025-05-05 06:08:00'),
            ],
            [
                'nama_hama' => 'Ulat Grayak',
                'rekomendasi' => 'Semprot dengan insektisida biologi berbahan Bacillus thuringiensis atau pestisida nabati.',
                'gambar' => 'images/hama/ulat_grayak.jpeg',
                'created_at' => Carbon::parse('2025-05-05 06:08:00'),
                'updated_at' => Carbon::parse('2025-05-05 06:08:00'),
            ],
            [
                'nama_hama' => 'Tungau Merah',
                'rekomendasi' => 'Gunakan akarisida dan jaga kelembaban tanah.',
                'gambar' => 'images/hama/tungau.jpg',
                'created_at' => Carbon::parse('2025-05-05 06:08:00'),
                'updated_at' => Carbon::parse('2025-05-05 06:08:00'),
            ],
            [
                'nama_hama' => 'Lalat Buah',
                'rekomendasi' => 'Gunakan perangkap lalat (fruit fly trap) dan buang buah terinfeksi.',
                'gambar' => 'images/hama/lalat-buah.jpg',
                'created_at' => Carbon::parse('2025-05-05 06:08:00'),
                'updated_at' => Carbon::parse('2025-05-05 06:08:00'),
            ]
        ]);
    }
}