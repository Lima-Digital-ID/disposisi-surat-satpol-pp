<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiarsipkanPadaSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_masuk', function(Blueprint $table) {
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
        Schema::table('surat_masuk', function(Blueprint $table) {
            $table->dropColumn('diarsipkan_pada');
        });
    }
}
