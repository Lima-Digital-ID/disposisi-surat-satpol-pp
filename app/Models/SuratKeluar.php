<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;
    protected $table = 'surat_keluar';

    public function jenis_surat()
    {
        return $this->belongsTo('\App\Models\JenisSurat', 'id_jenis_surat')->withDefault(['jenis_surat' => '-']);
    }

    public function pengirim_keluar()
    {
        return $this->belongsTo('\App\Models\User', 'id_pengirim')->withDefault(['nama' => '-']);
    }

    public function penerima_keluar()
    {
        return $this->belongsTo('\App\Models\User', 'id_penerima')->withDefault(['nama' => '-']);
    }
}
