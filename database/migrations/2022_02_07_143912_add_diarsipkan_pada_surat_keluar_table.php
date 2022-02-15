<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiarsipkanPadaSuratKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_keluar', function(Blueprint $table) {
            $table->datetime('diarsipkan_pada')->nullable()->after('diarsipkan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_keluar', function(Blueprint $table) {
            $table->dropColumn('diarsipkan_pada');
        });
    }
}
