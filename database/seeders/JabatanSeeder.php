<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Jabatan::truncate();
        $jabatan = new Jabatan();
        $jabatan->jabatan = 'TU';
        $jabatan->save();

        $jabatan = new Jabatan();
        $jabatan->jabatan = 'Kasat';
        $jabatan->save();

        $jabatan = new Jabatan();
        $jabatan->jabatan = 'Sekretaris';
        $jabatan->save();

        $jabatan = new Jabatan();
        $jabatan->jabatan = 'Kabid';
        $jabatan->save();

        $jabatan = new Jabatan();
        $jabatan->jabatan = 'Kabag';
        $jabatan->save();

        $jabatan = new Jabatan();
        $jabatan->jabatan = 'Kasubag';
        $jabatan->save();

        $jabatan = new Jabatan();
        $jabatan->jabatan = 'Kasi';
        $jabatan->save();

        $jabatan = new Jabatan();
        $jabatan->jabatan = 'Staff';
        $jabatan->save();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
