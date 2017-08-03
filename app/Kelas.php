<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['nama_kelas', 'nama_jurusan'];

    public function registrasi()
    {
    	return $this->hasMany(Registrasi::class);
    }

    public function siswa()
    {
    	return $this->hasMany(Siswa::class);
    }


}
