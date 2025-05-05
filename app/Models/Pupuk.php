<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pupuk extends Model
{
    protected $table = 'pupuk';

    protected $fillable = [
        'jenis_tanaman',
        'kondisi_tanah',
        'tahap_pertumbuhan',
        'rekomendasi',
        'gambar'
    ];
}
