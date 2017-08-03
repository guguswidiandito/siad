<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = new user();
        $users->name = 'Admin';
        $users->username = 'admin';
        $users->email = 'admin@siad.com';
        $users->hak_akses = 'admin';
        $users->password = bcrypt('rahasia');
        $users->save();

        $users = new user();
        $users->name = 'Gugus Widiandito';
        $users->username = 'guguswidiandito';
        $users->email = 'guguswidiandito@siad.com';
        $users->hak_akses = 'siswa';
        $users->password = bcrypt('rahasia');
        $users->save();

        $users = new user();
        $users->name = 'Kepala Sekolah';
        $users->username = 'kepsek';
        $users->email = 'kepsek@siad.com';
        $users->hak_akses = 'kepsek';
        $users->password = bcrypt('rahasia');
        $users->save();
    }
}
