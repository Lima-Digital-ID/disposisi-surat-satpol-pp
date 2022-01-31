<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;
    protected $table = 'jenis_surat';

    public function surat_masuk()
    {
        return $this->hasMany('\App\Models\SuratMasuk', 'id_jenis_surat');
    }

    public function surat_keluar()
    {
        return $this->hasMany('\App\Models\SuratKeluar', 'id_jenis_surat');
    }
}
