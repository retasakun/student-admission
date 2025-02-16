<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\Complete;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use File;
use PDF;

class SimpanPermanen extends Component
{
    public $agree;

    public function simpanPermanen(){
        // dd(Auth::user());

        if(!Complete::isSubmitable()) return abort(401, "Data belum lengkap");

        // validasi centang agreement
        $this->validate([
            'agree' => 'accepted'
        ],
        [
            'agree' => "Kamu belum menyetujui!"
        ]);

        // tuliskan tanggal simpan permanen
        $now = now()->toDateTime();

        $this->createFormulir($now);
        $this->createProofOfReg($now);

        Auth::user()->update([
            "submited" => $now,
            "formulir" => $this->createFormulir($now),
            "bukti" => $this->createProofOfReg($now),
        ]);


    }

    private function writeText($text, $x, $y, $img){
        $img->text($text, $x, $y, function($font){
            $font->file('assets/fonts/ARIALBD1.TTF');
            $font->size(50);
            $font->valign("top");
            
        });
    }

    private function createFormulir($now){
        $manager = new ImageManager(new Driver());

        //retrieve template
        $img = $manager->read(file_get_contents(public_path("/assets/mutaman/formulirpendaftaran.png")));
        // foto profil
        $path = "private/foto-profile/".Auth::user()->dataDiri->foto;
        $fullPath = storage_path("app/{$path}"); // Pastikan menuju ke storage/app/private/foto-profile

        if (!file_exists($fullPath)) {
            abort(404, 'File tidak ditemukan');
        }

        // Proses gambar dengan Intervention Image
        $profil = $manager->read($fullPath);
        $profil->resize(400, 589);
        $img->place($profil, 'top-left', 360, 855);
        
        //data siswa
        $img->text(Auth::user()->id, 2200, 645, function($font){
            $font->file('assets/fonts/ARIALBD1.TTF');
            $font->size(50);
            $font->valign("center");
        });
        
        $username = strtolower(strtok(Auth::user()->nama, " ")[1]);
        
        
        $alamat = wordwrap(Auth::user()->dataDiri->alamat.' '.Auth::user()->dataDiri->kabupaten.' '.Auth::user()->dataDiri->kode_pos, 45, '\n', false);
        $alamat = explode('\n', $alamat);
        
        $this->writeText(Auth::user()->dataDiri->nama_lengkap, 1425, 855, $img);
        $this->writeText(Auth::user()->dataDiri->tempat_lahir.', '.Auth::user()->dataDiri->tanggal_lahir, 1425, 945, $img);
        $this->writeText(Auth::user()->dataDiri->jenis_kelamin, 1425, 1035,$img);
        $this->writeText(Auth::user()->dataDiri->nisn, 1425, 1125, $img);
        $this->writeText(Auth::user()->peminatan, 1425, 1215, $img);
        // $this->writeText(Auth::user()->kualifikasi, 1425, 1305, $img);
        $this->writeText(Auth::user()->dataSekolahAsal->nama_sekolah_asal, 1425, 1395, $img);
        $space = 1485;
        foreach($alamat as $alm){
            $this->writeText($alm, 1425, $space, $img);
            $space += 90;
        }
       

        $this->writeText(Auth::user()->dataDiri->kewarganegaraan, 1425, 1755, $img);
        $this->writeText(Auth::user()->dataDiri->agama, 1425, 1845, $img);
        $this->writeText(Auth::user()->dataDiri->telp, 1425, 1935, $img);
        $this->writeText(Auth::user()->dataDiri->jumlah_saudara, 1425, 2025, $img);
        $this->writeText(Auth::user()->dataDiri->anak_ke, 1425, 2115, $img);
        
        $dataAyah = Auth::user()->dataOrangTua->firstWhere('jenis', 'Ayah');
        $dataIbu = Auth::user()->dataOrangTua->firstWhere('jenis', 'Ibu');
        $dataWali = Auth::user()->dataOrangTua->firstWhere('jenis', 'Wali');

        $this->writeText($dataAyah->nama, 930, 2520, $img);
        $this->writeText($dataAyah->pendidikan, 930, 2775, $img);
        $this->writeText($dataAyah->pekerjaan, 930, 3030, $img);
        $this->writeText($dataAyah->penghasilan, 930, 3285, $img);
        $this->writeText($dataAyah->telp, 930, 3570, $img);

        $this->writeText($dataIbu->nama, 930, 2610, $img);
        $this->writeText($dataIbu->pendidikan, 930, 2865, $img);
        $this->writeText($dataIbu->pekerjaan, 930, 3125, $img);
        $this->writeText($dataIbu->penghasilan, 930, 3380, $img);
        $this->writeText($dataIbu->telp, 930, 3665, $img);

        if($dataWali){
            $this->writeText($dataWali->nama, 990, 3810, $img);
            $this->writeText($dataWali->pendidikan, 990, 3900, $img);
            $this->writeText($dataWali->hubungan, 990, 3990, $img);
            $this->writeText($dataWali->telp, 990, 4080, $img);
        }


        // save image
        $nama_siswa = str_replace(" ", "-", Auth::user()->nama);
        $fileName =  "formulir-pendaftaran-".Auth::user()->id."-".$nama_siswa.".png";

        $imgData = $img->toPng();
   
        Storage::put("formulir-pendaftaran/{$fileName}", $imgData);

        return $fileName;
    }

    private function createProofOfReg($now){
        $manager = new ImageManager(new Driver());

        $dataDiri = Auth::user()->dataDiri;    

        //retrive template
        $img = $manager->read(file_get_contents(public_path("/assets/mutaman/registrationproof.png")));

        // qr
        $qrcode = QrCode::format('png')->generate(url('qr')."/".Auth::user()->id) ;
        $qrcodepath = "data:image/png;base64, ".base64_encode($qrcode);
        $qrcodepng = $manager->read($qrcodepath)->greyscale();
        $qrcodepng->resize(433, 433);

        // insert QrCode
        $img->place($qrcodepng, 'top-left', 961, 711);


        // foto profil
        $path = "private/foto-profile/".Auth::user()->dataDiri->foto;
        $fullPath = storage_path("app/{$path}"); // Pastikan menuju ke storage/app/private/foto-profile

        if (!file_exists($fullPath)) {
            abort(404, 'File tidak ditemukan');
        }

        // Proses gambar dengan Intervention Image
        $profil = $manager->read($fullPath);
        $profil->resize(348, 512);
        $img->place($profil, 'top-left', 187, 691);

        //  text
        $img->text(Auth::user()->id, 600, 1258, function($font){
            $font->file('assets/fonts/ARIALBD1.TTF');
            $font->size(20);
            $font->valign("center");
        });

        $img->text($dataDiri->nama_lengkap, 600, 1315, function($font){
            $font->file('assets/fonts/ARIALBD1.TTF');
            $font->size(20);
            $font->valign("center");
        });

        $img->text($dataDiri->tempat_lahir.", ".$dataDiri->tanggal_lahir, 600, 1372, function($font){
            $font->file('assets/fonts/ARIALBD1.TTF');
            $font->size(20);
            $font->valign("center");
        });

        $img->text($dataDiri->nisn, 600, 1429, function($font){
            $font->file('assets/fonts/ARIALBD1.TTF');
            $font->size(20);
            $font->valign("center");
        });

        $img->text(Auth::user()->email, 600, 1486, function($font){
            $font->file('assets/fonts/ARIALBD1.TTF');
            $font->size(20);
            $font->valign("center");
        });

        $img->text(Auth::user()->created_at, 600, 1543, function($font){
            $font->file('assets/fonts/ARIALBD1.TTF');
            $font->size(20);
            $font->valign("center");
        });

        $img->text($now->format('Y-m-d H:i:s'), 600, 1657, function($font){
            $font->file('assets/fonts/ARIALBD1.TTF');
            $font->size(20);
            $font->color("#d40000");
            $font->valign("center");
        });
        
        $sign = $manager->read(file_get_contents(public_path("/assets/mutaman/signs.png")));
        $sign->resize(519, 410);
        
        $stemps = $manager->read(file_get_contents(public_path("/assets/mutaman/stemps.png")));
        $stemps->resize(340, 410);
        
        $img->place($sign, "top-left",991, 1424 );
        $img->place($stemps, "top-left",931, 1430);

        // save image
        $nama_siswa = str_replace(" ", "-", Auth::user()->nama);
        $fileName =  "bukti-pendaftaran-".Auth::user()->id."-".$nama_siswa.".png";

        $imgData = $img->toPng();
   
        Storage::put("bukti-pendaftaran/{$fileName}", $imgData);

        return $fileName;
    }

    public function render()
    {
        return view('livewire.simpan-permanen');
    }
}
