<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    protected $fillable = [
        'akun_id',
        'ranking',
        'file',
    ];

    protected $primaryKey = null; 
    public $incrementing = false; // Disable auto-incrementing
    protected $table = 'ranking';

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
