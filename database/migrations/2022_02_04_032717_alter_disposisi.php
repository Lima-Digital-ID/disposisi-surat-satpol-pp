<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDisposisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('disposisi', function (Blueprint $table) {
            $table->integer('id_surat_masuk')->nullable()->change();
            $table->integer('id_surat_keluar')->nullable()->change();
            $table->date('tgl_disposisi')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('disposisi', function (Blueprint $table) {
            $table->bigInteger('id_surat_masuk')->nullable(false)->change();
            $table->bigInteger('id_surat_keluar')->nullable(false)->change();
            $table->dateTime('tgl_disposisi')->change();
        });
    }
}
