<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDiri extends Model
{
    use HasFactory;

    protected $fillable = [
        'akun_id',
        'foto',
        'nama_lengkap',
        'nisn',
        'ss_nisn',
        'kewarganegaraan',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'agama',
        'anak_ke',
        'jumlah_saudara',
        'cita_cita',
        'buta_warna',
        'berkebutuhan_khusus',
        'alamat',
        'kode_pos',
        'RT_RW',
        'kabupaten',
        'telp',
        'email',
    ];

    protected $primaryKey = null; 
    public $incrementing = false; // Disable auto-incrementing
    protected $table = 'data_diri';

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
