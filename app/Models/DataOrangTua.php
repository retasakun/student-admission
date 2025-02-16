<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DataOrangTua extends Model
{
    use HasFactory;

    protected $fillable = [
        'akun_id',
        'jenis',
        'status',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'RT_RW',
        'telp',
        'pendidikan',
        'pekerjaan',
        'penghasilan',
    ];

    protected $primaryKey = null; 
    public $incrementing = false; // Disable auto-incrementing
    protected $table = 'data_orang_tua';



    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
