<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $fillable = [
        'akun_id',
        'utama',
        'judul',
        'desc',
        'tingkat',
        'sebagai',
        'file',
    ];

    protected $primaryKey = null; 
    public $incrementing = false; // Disable auto-incrementing
    protected $table = 'sertifikat';

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
