<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    protected $fillable = ['no_reg', 'pembayaran_id', 'kelas_id', 'siswa_id', 'user_id', 'jenis_pembayaran_id', 'semester', 'bayar', 'tunggakan', 'keterangan'];
    
    public function pembayaran()
    {
        return $this->belongsTo(pembayaran::class);
    }

    public function jenispembayaran()
    {
        return $this->belongsTo(jenispembayaran::class, 'jenis_pembayaran_id');
    }

    public function siswa()
    {
        return $this->belongsTo(siswa::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }

    public function getUpdatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }
}
