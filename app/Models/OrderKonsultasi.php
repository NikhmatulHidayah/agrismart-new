<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class OrderKonsultasi extends Model
{
    use HasFactory;

    protected $table = 'order_konsultasi';

    protected $fillable = [
        'is_payment',
        'amount',
        'question',
        'feedback',
        'picture_feedback',
        'picture_question',
        'is_done',
        'payment_ahli',
        'id_petani',
        'id_ahli_tani',
    ];

    protected $casts = [
        'is_payment' => 'boolean',
        'is_done' => 'boolean',
        'payment_ahli' => 'boolean',
    ];

    public function petani()
    {
        return $this->belongsTo(User::class, 'id_petani');
    }

    public function ahliTani()
    {
        return $this->belongsTo(User::class, 'id_ahli_tani');
    }
}
