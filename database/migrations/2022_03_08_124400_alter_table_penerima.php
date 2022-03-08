<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePenerima extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengirim', function (Blueprint $table) {
            $table->string('pengirim')->after('id');
            $table->dropColumn('penerima');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengirim', function (Blueprint $table) {
            $table->string('penerima')->after('id');
            $table->dropColumn('pengirim');
        });
    }
}
