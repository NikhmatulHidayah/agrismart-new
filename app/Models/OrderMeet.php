<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class OrderMeet extends Model
{
    use HasFactory;

    protected $table = 'order_meet';

    protected $fillable = [
        'is_payment',
        'amount',
        'topic',
        'link_meet',
        'date',
        'is_done',
        'is_confirmation',
        'payment_ahli',
        'id_petani',
        'id_ahli_tani',
    ];

    protected $casts = [
        'is_payment' => 'boolean',
        'is_done' => 'boolean',
        'is_confirmation' => 'boolean',
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
