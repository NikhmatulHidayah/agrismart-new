<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'picture',
        'phone_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi: User sebagai ahli tani (1:1)
    public function dataAhliTani()
    {
        return $this->hasOne(DataAhliTani::class, 'id_ahli_tani');
    }

    // Relasi: User menulis banyak artikel
    public function articles()
    {
        return $this->hasMany(Article::class, 'id_ahli_tani');
    }

    // Relasi: User sebagai petani menanam banyak tanaman
    public function dataTanaman()
    {
        return $this->hasMany(DataTanaman::class, 'id_petani');
    }

    // Relasi: User sebagai petani memesan banyak konsultasi
    public function orderKonsultasiAsPetani()
    {
        return $this->hasMany(OrderKonsultasi::class, 'id_petani');
    }

    // Relasi: User sebagai ahli tani menerima banyak konsultasi
    public function orderKonsultasiAsAhli()
    {
        return $this->hasMany(OrderKonsultasi::class, 'id_ahli_tani');
    }

    // Relasi: User sebagai petani memesan banyak pertemuan
    public function orderMeetAsPetani()
    {
        return $this->hasMany(OrderMeet::class, 'id_petani');
    }

    // Relasi: User sebagai ahli tani menerima banyak pertemuan
    public function orderMeetAsAhli()
    {
        return $this->hasMany(OrderMeet::class, 'id_ahli_tani');
    }

    // Relasi: User sebagai petani memberikan banyak rating
    public function ratingsAsPetani()
    {
        return $this->hasMany(Rating::class, 'id_petani');
    }

    // Relasi: User sebagai ahli tani menerima banyak rating
    public function ratingsAsAhli()
    {
        return $this->hasMany(Rating::class, 'id_ahli_tani');
    }
}
