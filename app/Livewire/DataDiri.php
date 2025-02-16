<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\DataDiri as Biodata;
use App\Rules\customDateRule;

class DataDiri extends Component
{   
    use WithFileUploads;
    
    public $user;
    public $nama;
    public $foto;
    public $nisn;
    public $ss_nisn;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $bulan_lahir;
    public $tahun_lahir;
    public $kewarganegaraan;
    public $jenis_kelamin;
    public $agama;
    public $jumlah_saudara;
    public $anak_ke;
    public $cita_cita;
    public $buta_warna;
    public $berkebutuhan_khusus;
    public $alamat;
    public $kode_pos;
    public $RT_RW;
    public $kabupaten;
    public $telp;
    public $email;

    public $openFotoForm;

    public function mount()
    {
        $user = Auth::user();
        $dataDiri = $user->dataDiri;
        // dd($dataDiri);
        if ($dataDiri) {
            $this->nama = $dataDiri->nama_lengkap;
            $this->foto = $dataDiri->foto;
            $this->nisn = $dataDiri->nisn;
            $this->tempat_lahir = $dataDiri->tempat_lahir;
            
            // Extract date if exists in proper format
             if (isset($dataDiri->tanggal_lahir) && preg_match('/^(\d{1,2}) (\w+) (\d{4})$/', $dataDiri->tanggal_lahir, $matches)) {
                $this->tanggal_lahir = $matches[1];
                $this->bulan_lahir = strtoupper($matches[2]); 
                $this->tahun_lahir = $matches[3]; 
            }

            // dd([$this->tanggal_lahir, $this->bulan_lahir, $this->tahun_lahir]);
            $this->kewarganegaraan = $dataDiri->kewarganegaraan;
            $this->jenis_kelamin = $dataDiri->jenis_kelamin;
            $this->agama = $dataDiri->agama;
            $this->jumlah_saudara = $dataDiri->jumlah_saudara;
            $this->anak_ke = $dataDiri->anak_ke;
            $this->cita_cita = $dataDiri->cita_cita;
            $this->buta_warna = ($dataDiri->buta_warna)? "YA" : "TIDAK";
            $this->berkebutuhan_khusus = ($dataDiri->berkebutuhan_khusus)? "YA" : "TIDAK";
            $this->alamat = $dataDiri->alamat;
            $this->kode_pos = $dataDiri->kode_pos;
            $this->RT_RW = $dataDiri->RT_RW;
            $this->kabupaten = $dataDiri->kabupaten;
            $this->telp = $dataDiri->telp;
            $this->email = $dataDiri->email;
            // dd([$this->berkebutuhan_khusus, $this->buta_warna]);
        }
    }

    public function openFoto(){
        $this->openFotoForm = !$this->openFotoForm;
    }

    public function submitFotoProfil(){
        // Menyiapkan nama file ss nisn
        $nama_siswa = str_replace(" ", "-", Auth::user()->nama);
        $upload_time = now()->format('Y-m-d_H-i-s');
        
        // Ambil ekstensi file
        $extension = $this->foto->getClientOriginalExtension();
        
        // Satukan semua string menjadi filename
        $fileName = "{$upload_time}-foto-profile-" . Auth::user()->id . "-{$nama_siswa}.{$extension}";
        
        Biodata::updateOrCreate([
            'akun_id' => Auth::user()->id
        ], [
            'foto' => $fileName
        ]);

        try {
            // Simpan file ke storage private folder
            $this->foto->storeAs('foto-profile', $fileName, 'local');
            session()->flash('success', 'Foto profil diperbarui.');
        } catch (\Exception $e) {
            session()->flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }
    }

    public function submit()
    {
        $this->validate([
            'nisn' => 'required|min:7|max:13',
            'ss_nisn' => 'nullable|image|max:2048',
            'tempat_lahir' => 'required|min:3|max:60',
            'kewarganegaraan' => 'required|min:3|max:60',
            'tanggal_lahir' => ['required', new customDateRule],
            'bulan_lahir' => 'required',
            'tahun_lahir' => 'required|digits:4',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|min:3|max:60',
            'jumlah_saudara' => 'nullable|integer',
            'anak_ke' => 'nullable|integer',
            'cita_cita' => 'required|min:3|max:60',
            'buta_warna' => 'required|in:YA,TIDAK',
            'berkebutuhan_khusus' => 'required|in:YA,TIDAK',
            'alamat' => 'required|min:6',
            'kode_pos' => 'required|numeric',
            'RT_RW' => 'required|regex:/\d{3}\/\d{3}/',
            'kabupaten' => 'required|min:3|max:60',
            'telp' => 'required|min:3|max:60',
            'email' => 'required|email|min:3|max:60',
        ]);


        // Menyiapkan nama file ss nisn
        $nama_siswa = str_replace(" ", "-", Auth::user()->nama);
        $upload_time = now()->format('Y-m-d_H-i-s');
        
        // Ambil ekstensi file
        $extension = $this->ss_nisn->getClientOriginalExtension();
        
        // Satukan semua string menjadi filename
        $fileName = "{$upload_time}-screenshoot_nisn-" . Auth::user()->id . "-{$nama_siswa}.{$extension}";
    
        try {
            // Simpan file ke storage private folder
            $this->ss_nisn->storeAs('screenshoot-nisn', $fileName, 'local');
        } catch (\Exception $e) {
            session()->flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }

        // Combine date parts
        $this->tanggal_lahir = $this->tanggal_lahir." ".$this->bulan_lahir." ".$this->tahun_lahir;
        $tanggal_lahir = $this->tanggal_lahir;

        // Simpan data ke database
        $saved = Biodata::updateOrCreate([
            'akun_id' => Auth::user()->id
        ], [
            'nisn' => $this->nisn,
            'ss_nisn' => $fileName,
            'tempat_lahir' => $this->tempat_lahir,
            'kewarganegaraan' => $this->kewarganegaraan,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'agama' => $this->agama,
            'jumlah_saudara' => $this->jumlah_saudara,
            'anak_ke' => $this->anak_ke,
            'cita_cita' => $this->cita_cita,
            'buta_warna' => $this->convertToBoolean($this->buta_warna),
            'berkebutuhan_khusus' => $this->convertToBoolean($this->berkebutuhan_khusus),
            'alamat' => $this->alamat,
            'kode_pos' => $this->kode_pos,
            'RT_RW' => $this->RT_RW,
            'kabupaten' => $this->kabupaten,
            'telp' => $this->telp,
            'email' => $this->email,
        ]);

        // dd($saved);

        session()->flash('success', 'Biodata berhasil diperbarui.');
    }

    private function convertToBoolean($value)
    {
        return $value === 'YA';
    }

    public function render()
    {
        return view('livewire.data-diri');
    }
}
