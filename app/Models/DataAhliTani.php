<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataAhliTani extends Model
{
    use HasFactory;

    protected $table = 'data_ahli_tani';

    protected $fillable = [
        'status',
        'certificate',
        'expired_certificate',
        'price',
        'yoe',
        'alumni',
        'id_ahli_tani',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_ahli_tani');
    }
}
