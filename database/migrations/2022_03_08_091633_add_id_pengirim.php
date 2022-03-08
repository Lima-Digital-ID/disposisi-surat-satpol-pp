<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdPengirim extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->bigInteger('id_pengirim')->after('pengirim')->nullable();
            $table->string('pengirim')->nullable()->change();
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
            $table->dropColumn('id_pengirim');
            $table->string('pengirim')->nullable(false)->change();
        });
    }
}
