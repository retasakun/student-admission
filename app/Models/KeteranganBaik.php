<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeteranganBaik extends Model
{
    use HasFactory;

    protected $fillable = [
        'akun_id',
        'file',
    ];

    protected $primaryKey = null; 
    public $incrementing = false; // Disable auto-incrementing
    protected $table = 'keterangan_baik';

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
