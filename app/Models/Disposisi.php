<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;
    protected $table = 'disposisi';

    public function pengirim()
    {
        return $this->belongsTo('\App\Models\User', 'id_pengirim')->withDefault(['nama' => '-']);
    }

    public function penerima()
    {
        return $this->belongsTo('\App\Models\User', 'id_penerima')->withDefault(['nama' => '-']);
    }
}
