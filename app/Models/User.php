<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    public function golongan()
    {
        return $this->belongsTo('\App\Models\Golongan', 'id_golongan')->withDefault(['pangkat' => '-']);
    }

    public function jabatan()
    {
        return $this->belongsTo('\App\Models\Jabatan', 'id_jabatan')->withDefault(['jabatan' => '-']);
    }

    public function penerima_masuk()
    {
        return $this->belongsTo('\App\Models\SuratMasuk', 'id_penerima')->withDefault(['nama' => '-']);
    }

    public function pengirim_masuk()
    {
        return $this->belongsTo('\App\Models\SuratMasuk', 'id_pengirim')->withDefault(['nama' => '-']);
    }

    public function penerima_keluar()
    {
        return $this->belongsTo('\App\Models\SuratKeluar', 'id_penerima')->withDefault(['nama' => '-']);
    }

    public function pengirim_keluar()
    {
        return $this->belongsTo('\App\Models\SuratKeluar', 'id_pengirim')->withDefault(['nama' => '-']);
    }

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
