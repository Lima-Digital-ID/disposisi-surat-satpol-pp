<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_surat_masuk');
            $table->enum('sifat_surat', ['Penting', 'Rahasia', 'Biasa', 'Pribadi']);
            $table->bigInteger('id_surat_keluar');
            $table->tinyInteger('id_pengirim');
            $table->tinyInteger('id_penerima');
            $table->dateTime('tgl_disposisi');
            $table->string('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disposisi');
    }
}
