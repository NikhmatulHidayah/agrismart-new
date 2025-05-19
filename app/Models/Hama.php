<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hama extends Model
{
    protected $table = 'hama';

    protected $fillable = [
        'nama_hama',
        'rekomendasi',
        'gambar',
    ];
}
