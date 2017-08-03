<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = ['nis', 'user_id', 'kelas_id', 'angkatan'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function kelas()
    {
    	return $this->belongsTo('App\Kelas');
    }

    public function pembayaran()
    {
    	return $this->hasMany('App\Pembayaran');
    }

    public function registrasi()
    {
        return $this->hasMany(registrasi::class);
    }
}
