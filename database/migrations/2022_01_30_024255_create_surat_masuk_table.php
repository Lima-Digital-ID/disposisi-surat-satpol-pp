<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat');
            $table->tinyInteger('id_jenis_surat');
            $table->tinyInteger('id_pengirim');
            $table->tinyInteger('id_penerima');
            $table->dateTime('tgl_pengirim');
            $table->dateTime('tgl_penerima');
            $table->string('perihal');
            $table->string('file_surat');
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
        Schema::dropIfExists('surat_masuk');
    }
}
