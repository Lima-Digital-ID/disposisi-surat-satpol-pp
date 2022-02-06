<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSuratKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_keluar', function (Blueprint $table) {
            $table->dropColumn('id_penerima');
            $table->string('penerima')->after('id_pengirim');
            $table->date('tgl_kirim')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_keluar', function (Blueprint $table) {
            $table->integer('id_penerima');
            $table->dateTime('tgl_kirim')->change();
            $table->dropColumn('penerima');
        });
    }
}
