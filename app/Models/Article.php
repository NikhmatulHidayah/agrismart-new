<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'picture',
        'date',
        'content',
        'id_ahli_tani',
    ];

    public function ahliTani()
    {
        return $this->belongsTo(User::class, 'id_ahli_tani');
    }
}
