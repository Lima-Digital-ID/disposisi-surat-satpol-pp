<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeLevelUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->enum('level', ['Administrator', 'Kasat', 'Admin', 'Anggota', 'Kabid', 'Kabag', 'Kasubag', 'Sekretaris', 'Staff', 'TU']);
            \DB::statement("ALTER TABLE users MODIFY COLUMN level ENUM('Administrator', 'Kasat', 'Admin', 'Anggota', 'Kabid', 'Kabag', 'Kasubag', 'Sekretaris', 'Staff', 'TU')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->enum('level', ['Administrator', 'Kasat', 'Admin', 'Anggota']);
            \DB::statement("ALTER TABLE users MODIFY COLUMN level ENUM('Administrator', 'Kasat', 'Admin', 'Anggota')");
        });
    }
}
