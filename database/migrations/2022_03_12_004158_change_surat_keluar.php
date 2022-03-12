<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSuratKeluar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_keluar', function (Blueprint $table) {
            $table->bigInteger('id_penerima')->nullable()->after('penerima');
            $table->text('catatan')->nullable()->after('perihal');
            $table->string('paraf')->nullable()->after('diarsipkan_pada');
            $table->string('ttd')->nullable()->after('paraf');
            $table->text('penerima')->nullable()->change();
            $table->date('tgl_kirim')->nullable()->change();
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
            $table->dropColumn('id_penerima');
            $table->string('penerima')->nullable(false)->change();
            $table->date('tgl_kirim')->nullable(false)->change();
            $table->dropColumn('catatan');
            $table->dropColumn('paraf');
            $table->dropColumn('ttd');
        });
    }
}
