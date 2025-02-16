<?php 

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\DataDiri;

class Complete{


    public function __construct()
    {
        // Ambil data dari user yang sedang login
        
    }

    public static function dataDiri()
    {
        $missingFields = [];
        $dataDiri = Auth::user()->dataDiri;

        // List semua kolom yang harus dicek
        $fields = [
            'foto' => 'Foto',
            'nama_lengkap' => 'Nama Lengkap',
            'nisn' => 'NISN',
            'ss_nisn' => 'Screenshot NISN',
            'kewarganegaraan' => 'Kewarganegaraan',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
            'tempat_lahir' => 'Tempat Lahir',
            'agama' => 'Agama',
            'anak_ke' => 'Anak Ke-berapa',
            'jumlah_saudara' => 'Jumlah Saudara',
            'cita_cita' => 'Cita-cita',
            'buta_warna' => 'Buta Warna',
            'berkebutuhan_khusus' => 'Berkebutuhan Khusus',
            'alamat' => 'Alamat',
            'kode_pos' => 'Kode Pos',
            'RT_RW' => 'RT/RW',
            'kabupaten' => 'Kabupaten',
            'telp' => 'Telepon',
            'email' => 'Email',
        ];

        // Cek setiap kolom, jika kosong, tambahkan ke daftar yang belum terisi
        foreach ($fields as $field => $label) {
            if (is_null($dataDiri->$field) || $dataDiri->$field === '') {
                $missingFields[] = $label;
            }
        }

        return $missingFields;
    }

    public static function dataAyah()
    {
        $missingFields = [];
        $data = Auth::user()->dataOrangTua->firstWhere('jenis', 'Ayah');

        // Jika data tidak ditemukan, langsung kembalikan semua kolom sebagai belum terisi
        if (!$data) {
            return array_values([
                'nama ayah kandung',
                'Tempat lahir ayah kandung',
                'Alamat ayah kandung',
                'Nomor telepon ayah kandung',
                'Pendidikan ayah kandung',
                'Pekerjaan ayah kandung',
                'RT/RW ayah kandung',
                'penghasilan ayah kandung'
            ]);
        }

        // List semua kolom yang harus dicek
        $fields = [
            'nama' => 'nama ayah kandung',
            'tempat_lahir' => "Tempat lahir ayah kandung",
            'alamat' => 'Alamat ayah kandung',
            'telp' => 'Nomor telepon ayah kandung',
            'pendidikan' => 'Pendidikan ayah kandung',
            'pekerjaan' => 'Pekerjaan ayah kandung',
            'RT_RW' => 'RT/RW ayah kandung',
            'penghasilan' => 'penghasilan ayah kandung'
        ];

        // Cek setiap kolom, jika kosong, tambahkan ke daftar yang belum terisi
        foreach ($fields as $field => $label) {
            if (is_null($data->$field) || $data->$field === '') {
                $missingFields[] = $label;
            }
        }

        // Jika status ayah "nonaktif", anggap semua data sudah lengkap
        return ($data->status == 'nonaktif') ? [] : $missingFields;
    }

    public static function dataIbu()
    {
        $missingFields = [];
        $data = Auth::user()->dataOrangTua->firstWhere('jenis', 'Ibu');
    
        // Jika data tidak ditemukan, langsung kembalikan semua kolom sebagai belum terisi
        if (!$data) {
            return array_values([
                'nama ibu kandung',
                'Tempat lahir ibu kandung',
                'Alamat ibu kandung',
                'Nomor telepon ibu kandung',
                'Pendidikan ibu kandung',
                'Pekerjaan ibu kandung',
                'RT/RW ibu kandung',
                'penghasilan ibu kandung'
            ]);
        }
    
        // List semua kolom yang harus dicek
        $fields = [
            'nama' => 'nama ibu kandung',
            'tempat_lahir' => "Tempat lahir ibu kandung",
            'alamat' => 'Alamat ibu kandung',
            'telp' => 'Nomor telepon ibu kandung',
            'pendidikan' => 'Pendidikan ibu kandung',
            'pekerjaan' => 'Pekerjaan ibu kandung',
            'RT_RW' => 'RT/RW ibu kandung',
            'penghasilan' => 'penghasilan ibu kandung'
        ];
    
        // Cek setiap kolom, jika kosong, tambahkan ke daftar yang belum terisi
        foreach ($fields as $field => $label) {
            if (is_null($data->$field) || $data->$field === '') {
                $missingFields[] = $label;
            }
        }
    
        // Jika status ibu "nonaktif", anggap semua data sudah lengkap
        return ($data->status == 'nonaktif') ? [] : $missingFields;
    }
    
    public static function dataWali()
    {   
        $statusAyah = optional(Auth::user()->dataOrangTua->firstWhere('jenis', 'Ayah'))->status;
        $statusIbu = optional(Auth::user()->dataOrangTua->firstWhere('jenis', 'Ibu'))->status;

        
        if($statusAyah == 'nonaktif' && $statusIbu == 'nonaktif'){

            $missingFields = [];
            $data = Auth::user()->dataOrangTua->firstWhere('jenis', 'Wali');
    
            // Jika data tidak ditemukan, langsung kembalikan semua kolom sebagai belum terisi
            if (!$data) {
                return array_values([
                    'nama wali siswa',
                    'Tempat lahir wali siswa',
                    'Alamat wali siswa',
                    'Nomor telepon wali siswa',
                    'Pendidikan wali siswa',
                    'Pekerjaan wali siswa',
                    'RT/RW wali siswa',
                    'penghasilan wali siswa'
                ]);
            }
                
            
    
            // List semua kolom yang harus dicek
            $fields = [
                'nama' => 'nama wali siswa',
                'tempat_lahir' => "Tempat lahir wali siswa",
                'alamat' => 'Alamat ibu wali siswa',
                'telp' => 'Nomor telepon wali siswa',
                'pendidikan' => 'Pendidikan wali siswa',
                'pekerjaan' => 'Pekerjaan wali siswa',
                'RT_RW' => 'RT/RW wali siswa',
                'penghasilan' => 'penghasilan wali siswa'
            ];
    
            // Cek setiap kolom, jika kosong, tambahkan ke daftar yang belum terisi
            foreach ($fields as $field => $label) {
                if (is_null($data->$field) || $data->$field === '') {
                    $missingFields[] = $label;
                }
            }
    
            $statusAyah = Auth::user()->dataOrangTua->firstWhere('jenis', 'Ayah')->status;
            $statusIbu = Auth::user()->dataOrangTua->firstWhere('jenis', 'Ibu')->status;
    
            return $missingFields;
    
        }else{
            return []; 
        }

       

    }

    public static function statusDataOrangTua(){
        $data = [
            "dataAyah" => self::dataAyah(),
            "dataIbu" => self::dataIbu(),
            "dataWali" => self::dataWali() 
        ];

        return empty(array_filter($data));

    } 

    public static function dataSekolahAsal()
    {
        $missingFields = [];
        $data = Auth::user()->dataSekolahAsal;

        // Jika data tidak ditemukan, langsung kembalikan semua kolom sebagai belum terisi
        if (!$data) {
            return array_values([
                'Nama sekolah asal',
                'NPSN sekolah asal',
                'Alamat sekolah asal',
                'provinsi sekolah asal',
                'kabupaten sekolah asal'
            ]);
        }

        // List semua kolom yang harus dicek
        $fields = [
            "nama_sekolah_asal" => 'Nama sekolah asal',
            "npsn" => 'NPSN sekolah asal',
            "alamat" => 'Alamat sekolah asal',
            "provinsi" => 'Provinsi sekolah asal',
            "kabupaten" => 'Kabupaten sekolah asal'
        ];

        // Cek setiap kolom, jika kosong, tambahkan ke daftar yang belum terisi
        foreach ($fields as $field => $label) {
            if (is_null($data->$field) || $data->$field === '') {
                $missingFields[] = $label;
            }
        }

        return $missingFields;
    }

    public static function pilihanPeminatan(){
        if(!in_array(Auth::user()->peminatan, ["Kelas Timur Tengah", "Kelas Umum","Kelas Tahfidz"])){
         return ["Pilihan peminatan"];   
        }else{
            return [];
        }
    }

    public static function statusPilihanPeminatan(){
        return in_array(Auth::user()->peminatan, 
        [
            "Kelas Timur Tengah", 
            "Kelas Umum",
            "Kelas Tahfidz"
        ]);
    }

    public static function rapor(){
        $missingFields = [];
        $data = Auth::user()->rapor;

        if (!$data) {
            return array_values([
                "Nilai semester 1",
                "Berkas Rapor semester 1",
                "Nilai semester 2",
                "Berkas Rapor semester 2",
                "Nilai semester 3",
                "Berkas Rapor semester 3",
                "Nilai semester 4",
                "Berkas Rapor semester 4",
                "Nilai semester 5",
                "Berkas Rapor semester 5",
                "Berkas Rekap nilai",
            ]);
        }

        // List semua kolom yang harus dicek
        $fields = [
            "nilai_sem1" => "Nilai semester 1",
            "file_sem1" => "Berkas Rapor semester 1",
            "nilai_sem2" => "Nilai semester 2",
            "file_sem2" => "Berkas Rapor semester 2",
            "nilai_sem3" => "Nilai semester 3",
            "file_sem3" => "Berkas Rapor semester 3",
            "nilai_sem4" => "Nilai semester 4",
            "file_sem4" => "Berkas Rapor semester 4",
            "nilai_sem5" => "Nilai semester 5",
            "file_sem5" => "Berkas Rapor semester 5",
            "file_rekap" => "Berkas Rekap nilai",
        ];

        // Cek setiap kolom, jika kosong, tambahkan ke daftar yang belum terisi
        foreach ($fields as $field => $label) {
            if (is_null($data->$field) || $data->$field === '') {
                $missingFields[] = $label;
            }
        }

        return $missingFields;
    }

    public static function statusRapor(){
        return empty(self::rapor());
    }

    public static function keteranganBaik(){
       if(!isset(optional(Auth::user()->keteranganBaik)->file)){
            return ["Surat keterangan berkelakuan baik"];
       }else{
            return [];
       }
    }

    public static function statusKeteranganBaik(){
        return isset(optional(Auth::user()->keteranganBaik)->file);
    }
      
    public static function isSubmitable(){
        // dd(
        //     empty(self::dataDiri()) && self::statusDataOrangTua() && empty(self::dataSekolahAsal())
        // && self::statusPilihanPeminatan() && self::statusRapor() 
        // && self::statusKeteranganBaik()
        // );
        
        return 
        empty(self::dataDiri()) && self::statusDataOrangTua() && empty(self::dataSekolahAsal())
        && self::statusPilihanPeminatan() && self::statusRapor() 
        && self::statusKeteranganBaik();
    }

    public static function getAllMissingFields(){
        return array_merge(
            self::dataDiri(), 
            self::dataAyah(),
            self::dataIbu(),
            self::dataWali(),
            self::dataSekolahAsal(),
            self::pilihanPeminatan(),
            (!self::statusRapor())? ["berkas rapor"] : [],
            self::keteranganBaik()
        );
    }
}