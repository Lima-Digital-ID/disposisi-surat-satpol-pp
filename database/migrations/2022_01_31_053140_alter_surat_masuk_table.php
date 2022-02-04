<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->dropColumn('id_pengirim');
            $table->string('pengirim')->after('id_jenis_surat');
            $table->date('tgl_pengirim')->change();
            $table->date('tgl_penerima')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->integer('id_pengirim');
            $table->dropColumn('pengirim');
            $table->dateTime('tgl_pengirim')->change();
            $table->dateTime('tgl_penerima')->change();
        });
    }
}
