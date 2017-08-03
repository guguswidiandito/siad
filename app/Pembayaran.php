<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['no_pembayaran', 'user_id', 'operator', 'siswa_id', 'jenis_pembayaran_id'];

    public function user()
    {
    	return $this->belongsTo(user::class);
    }

    public function siswa()
    {
    	return $this->belongsTo(siswa::class);
    }

    public function jenispembayaran()
    {
    	return $this->belongsTo('App\JenisPembayaran', 'jenis_pembayaran_id');
    }

    public function registrasi()
    {
        return $this->hasMany(registrasi::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }
}
