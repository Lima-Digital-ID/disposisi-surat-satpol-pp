<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;
    protected $table = 'disposisi';
    protected $fillable = [
        'id_surat_masuk',
        'id_surat_keluar',
];

    public function pengirim()
    {
        return $this->belongsTo('\App\Models\User', 'id_pengirim')->withDefault(['nama' => '-']);
    }

    public function penerima()
    {
        return $this->belongsTo('\App\Models\User', 'id_penerima')->withDefault(['nama' => '-']);
    }

    public function masuk()
    {
        return $this->belongsTo('\App\Models\SuratMasuk', 'id_surat_masuk')->withDefault(['no_surat' => '-']);
    }

    public function keluar()
    {
        return $this->belongsTo('\App\Models\SuratKeluar', 'id_surat_keluar')->withDefault(['no_surat' => '-']);
    }
}
