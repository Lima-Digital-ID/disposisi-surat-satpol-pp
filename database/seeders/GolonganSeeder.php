<?php

namespace Database\Seeders;

use App\Models\Golongan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Golongan::truncate();
        $golongan = new Golongan();
        $golongan->pangkat = 'Penegakan Peraturan Daerah';
        $golongan->save();

        $golongan = new Golongan();
        $golongan->pangkat = 'Ketentraman dan Ketertiban Umum';
        $golongan->save();

        $golongan = new Golongan();
        $golongan->pangkat = 'Pemadam Kebakaran dan Penyelamatan';
        $golongan->save();

        $golongan = new Golongan();
        $golongan->pangkat = 'Perlindungan Masyarakat';
        $golongan->save();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
