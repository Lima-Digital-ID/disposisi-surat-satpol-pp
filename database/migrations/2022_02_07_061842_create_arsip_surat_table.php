<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arsip_surat', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_surat_masuk', false, true)->nullable();
            $table->bigInteger('id_surat_keluar', false, true)->nullable();
            $table->bigInteger('id_lokasi_surat', false, true);
            $table->timestamps();

            $table->foreign('id_surat_masuk')->references('id')->on('surat_masuk');
            $table->foreign('id_surat_keluar')->references('id')->on('surat_keluar');
            $table->foreign('id_lokasi_surat')->references('id')->on('lokasi_surat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arsip_surat');
    }
}
