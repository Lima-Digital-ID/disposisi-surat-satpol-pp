<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    public function masuk()
    {
        return $this->belongsTo('\App\Models\SuratMasuk', 'id_surat_masuk')->withDefault(['no_surat' => '-']);
    }

    public function keluar()
    {
        return $this->belongsTo('\App\Models\SuratKeluar', 'id_surat_keluar')->withDefault(['no_surat' => '-']);
    }

    use HasFactory;
    protected $table = 'arsip_surat';
    
}
