<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSifatSurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('disposisi', function (Blueprint $table) {
            \DB::statement("ALTER TABLE disposisi MODIFY COLUMN sifat_surat ENUM('Sangat Segera', 'Segera', 'Penting', 'Biasa') NULL");
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
            \DB::statement("ALTER TABLE disposisi MODIFY COLUMN sifat_surat ENUM('Penting', 'Rahasia', 'Biasa', 'Pribadi') NULL");
        });
    }
}
