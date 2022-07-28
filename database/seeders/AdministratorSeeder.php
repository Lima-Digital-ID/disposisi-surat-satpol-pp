<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        User::truncate();
        $admin = new User();
        $admin->nama = 'Administrator';
        $admin->email = 'administrator@gmail.com';
        $admin->username = 'administrator';
        $admin->password = Hash::make('password');
        $admin->jenis_pegawai = 'ASN';
        $admin->jenis_kelamin = 'L';
        $admin->nip = rand ( 10000 , 99999 );
        $admin->level = 'Administrator';
        $admin->save();

        $admin = new User();
        $admin->nama = 'Kasat';
        $admin->email = 'kasat@gmail.com';
        $admin->id_jabatan = 2;
        $admin->username = 'kasat';
        $admin->password = Hash::make('password');
        $admin->jenis_pegawai = 'ASN';
        $admin->jenis_kelamin = 'L';
        $admin->nip = rand ( 10000 , 99999 );
        $admin->level = 'Kasat';
        $admin->save();

        $admin = new User();
        $admin->nama = 'Kabid';
        $admin->email = 'kabid@gmail.com';
        $admin->id_golongan = 1;
        $admin->id_jabatan = 4;
        $admin->username = 'kabid';
        $admin->password = Hash::make('password');
        $admin->jenis_pegawai = 'ASN';
        $admin->jenis_kelamin = 'L';
        $admin->nip = rand ( 10000 , 99999 );
        $admin->level = 'Kabid';
        $admin->save();

        $admin = new User();
        $admin->nama = 'Kabag';
        $admin->email = 'kabag@gmail.com';
        $admin->username = 'kabag';
        $admin->password = Hash::make('password');
        $admin->jenis_pegawai = 'ASN';
        $admin->jenis_kelamin = 'L';
        $admin->nip = rand ( 10000 , 99999 );
        $admin->level = 'Kabag';
        $admin->save();

        $admin = new User();
        $admin->nama = 'Kasubag';
        $admin->email = 'kasubag@gmail.com';
        $admin->username = 'kasubag';
        $admin->password = Hash::make('password');
        $admin->jenis_pegawai = 'ASN';
        $admin->jenis_kelamin = 'L';
        $admin->nip = rand ( 10000 , 99999 );
        $admin->level = 'Kasubag';
        $admin->save();

        $admin = new User();
        $admin->nama = 'Sekretaris';
        $admin->email = 'sekretaris@gmail.com';
        $admin->username = 'sekretaris';
        $admin->password = Hash::make('password');
        $admin->jenis_pegawai = 'ASN';
        $admin->jenis_kelamin = 'L';
        $admin->nip = rand ( 10000 , 99999 );
        $admin->level = 'Sekretaris';
        $admin->save();

        $admin = new User();
        $admin->nama = 'Staff';
        $admin->email = 'staff@gmail.com';
        $admin->username = 'staff';
        $admin->password = Hash::make('password');
        $admin->jenis_pegawai = 'ASN';
        $admin->jenis_kelamin = 'L';
        $admin->nip = rand ( 10000 , 99999 );
        $admin->level = 'Staff';
        $admin->save();

        $admin = new User();
        $admin->nama = 'Tu';
        $admin->email = 'tu@gmail.com';
        $admin->username = 'tu';
        $admin->password = Hash::make('password');
        $admin->jenis_pegawai = 'ASN';
        $admin->jenis_kelamin = 'L';
        $admin->nip = rand ( 10000 , 99999 );
        $admin->level = 'Tu';
        $admin->save();

        $admin = new User();
        $admin->nama = 'Kasi';
        $admin->email = 'kasi@gmail.com';
        $admin->username = 'kasi';
        $admin->password = Hash::make('password');
        $admin->jenis_pegawai = 'ASN';
        $admin->jenis_kelamin = 'L';
        $admin->nip = rand ( 10000 , 99999 );
        $admin->level = 'Kasi';
        $admin->save();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
