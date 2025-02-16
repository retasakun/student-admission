<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class Akun extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'password',
        'peminatan',
        'kualifikasi',
        'pengumuman_berkas',
        'pesan_berkas',
        'pengumuman_ujian',
        'pesan_ujian',
        'last_login_at',
        'submited',
        'bukti',
        'formulir',
    ];

    protected $guard = 'akun'; 
    protected $table = 'akun';
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $incrementing = false;
    public function getKeyType(){
        return 'string';
    }

    protected $keyType = "string";
    protected $primaryKey = "id";

    protected static function boot(){
        parent::boot();
        static::creating(function($model){
            if(empty($model->{$model->getKeyName()})){
                $model->{$model->getKeyName()} = "PPDB-PSU-2025-".substr(strtoupper(Str::uuid()->toString()), 0, 8);
            }
        });
    }

    public function dataDiri()
    {
        return $this->hasOne(DataDiri::class);
    }

    public function dataOrangTua()
    {
        return $this->hasMany(DataOrangTua::class);
    }

    public function dataSekolahAsal()
    {
        return $this->hasOne(DataSekolahAsal::class);
    }

    public function kartuUjian()
    {
        return $this->hasOne(KartuUjian::class);
    }

    public function rapor()
    {
        return $this->hasOne(Rapor::class, 'akun_id', 'id');
    }

    public function ranking()
    {
        return $this->hasOne(Ranking::class);
    }

    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class);
    }

    public function keteranganBaik()
    {
        return $this->hasOne(KeteranganBaik::class);
    }

    public function undangan()
    {
        return $this->hasOne(Undangan::class);
    }
}

// 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


