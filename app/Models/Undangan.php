<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'akun_id',
        'file',
        'jenis',
    ];

    protected $primaryKey = null; 
    public $incrementing = false; // Disable auto-incrementing
    protected $table = 'undangan';

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
