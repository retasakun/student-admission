<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSekolahAsal extends Model
{
    use HasFactory;

    protected $fillable = [
        'akun_id',
        'nama_sekolah_asal',
        'npsn',
        'nsm',
        'alamat',
        'provinsi',
        'kabupaten',
    ];
    protected $primaryKey = null; 
    public $incrementing = false; // Disable auto-incrementing
    protected $table = 'data_sekolah_asal';

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
