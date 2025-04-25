<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTanaman extends Model
{
    use HasFactory;

    protected $table = 'data_tanaman';

    protected $fillable = [
        'nama_tanaman',
        'picture',
        'deskripsi',
        'tanggal_ditanam',
        'id_petani',
    ];

    public function petani()
    {
        return $this->belongsTo(User::class, 'id_petani');
    }
}
