<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapor extends Model
{
    use HasFactory;

    protected $fillable = [
        'akun_id',
        'nilai_sem1',
        'file_sem1',
        'nilai_sem2',
        'file_sem2',
        'nilai_sem3',
        'file_sem3',
        'nilai_sem4',
        'file_sem4',
        'nilai_sem5',
        'file_sem5',
        'file_rekap',
    ];

    protected $primaryKey = 'akun_id'; 
    public $incrementing = false; // Disable auto-incrementing
    protected $table = 'rapor';

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
