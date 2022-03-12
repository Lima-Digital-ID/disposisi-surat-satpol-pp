<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;
    protected $table = 'surat_masuk';

    // public function jenis_surat()
    // {
    //     return $this->belongsTo('\App\Models\JenisSurat', 'id_jenis_surat')->withDefault(['jenis_surat' => '-']);
    // }

    public function pengirim_masuk()
    {
        return $this->belongsTo('\App\Models\Pengirim', 'id_pengirim')->withDefault(['pengirim' => '-']);
    }

    public function penerima_masuk()
    {
        return $this->belongsTo('\App\Models\User', 'id_penerima')->withDefault(['nama' => '-']);
    }
}