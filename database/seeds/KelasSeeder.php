<?php

use Illuminate\Database\Seeder;
use App\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Kelas::create([
        	'nama_kelas' => 'XII-IPA1',
        	'nama_jurusan' => 'IPA'
        	]);
        App\Kelas::create([
        	'nama_kelas' => 'XII-IPS1',
        	'nama_jurusan' => 'IPS'
        	]);
        App\Kelas::create([
        	'nama_kelas' => 'XI-IPA1',
        	'nama_jurusan' => 'IPA'
        	]);
        App\Kelas::create([
        	'nama_kelas' => 'XI-IPS1',
        	'nama_jurusan' => 'IPA'
        	]);
        App\Kelas::create([
            'nama_kelas' => 'X-IPA-IPS',
            'nama_jurusan' => ''
            ]);
    }
}
