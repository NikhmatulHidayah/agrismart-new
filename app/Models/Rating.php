<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'rating';

    protected $fillable = [
        'star',
        'feedback',
        'id_ahli_tani',
        'id_petani',
        'id_order_konsultasi',
        'id_order_meet',
    ];

    public function ahliTani()
    {
        return $this->belongsTo(User::class, 'id_ahli_tani');
    }

    public function petani()
    {
        return $this->belongsTo(User::class, 'id_petani');
    }

    public function orderKonsultasi()
    {
        return $this->belongsTo(OrderKonsultasi::class, 'id_order_konsultasi');
    }

    public function orderMeet()
    {
        return $this->belongsTo(OrderMeet::class, 'id_order_meet');
    }
}
