<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSifatSuratMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->string('sifat_surat')->after('no_surat');
            $table->enum('status_tembusan', ['Tembusan', 'Langsung'])->after('status');
            $table->dropColumn('id_jenis_surat');
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
            $table->tinyInteger('id_jenis_surat')->after('no_surat');
            $table->dropColumn('status_tembusan');
            $table->dropColumn('sifat_surat');
        });
    }
}
