<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPembayaran extends Model
{
	protected $fillable = ['pembayaran', 'nominal']; 

	public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }   

    public function registrasi()
    {
    	return $this->hasMany(registrasi::class);
    }
}
