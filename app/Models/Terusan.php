<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terusan extends Model
{
    use HasFactory;

    public function surat_keluar()
    {
        return $this->belongsTo('\App\Models\SuratKeluar', 'id_surat_keluar');
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
