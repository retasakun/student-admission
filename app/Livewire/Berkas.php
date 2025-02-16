<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Berkas extends Component
{   
    use WithFileUploads;

    public $inputKetBaik, $file_rekap, $rapor, $nilai_ipa, $nilai_ips, $nilai_binggris, $nilai_mtk, $nilai_pai, $file_rapor;
    public $openSemester = null; // Track which semester form is open
    public $fileKetBaik = null;

    protected $listeners  = ["refreshRapor"];

    public function mount(){
        
        $this->initializeAttributes();
    }

    public function initializeAttributes(){

        $this->fileKetBaik = optional(Auth::user()->keteranganBaik)->file;

        // ambil data rapor untuk ditampilkan di blade
        $this->rapor = Auth::user()->rapor;

        // jika data rapor tidak ada, isi dengan object null
        if(!$this->rapor){  
            $this->rapor = (object)[
                'nilai_sem1' => null,
                'file_sem1' => null,
                'nilai_sem2' => null,
                'file_sem2' => null,
                'nilai_sem3' => null,
                'file_sem3' => null,
                'nilai_sem4' => null,
                'file_sem4' => null,
                'nilai_sem5' => null,
                'file_sem5' => null,
                'file_rekap' => null
            ];
        }
    }
    
    public function openForm($semester)
    {
        $this->openSemester = $semester;
    }
    
    private function validateRapor()
    {

        $this->validate([
            'nilai_ipa' => 'required|numeric|min:0|max:100',
            'nilai_ips' => 'required|numeric|min:0|max:100',
            'nilai_binggris' => 'required|numeric|min:0|max:100',
            'nilai_mtk' => 'required|numeric|min:0|max:100',
            'nilai_pai' => 'required|numeric|min:0|max:100',
            'file_rapor' => 'required|file|mimes:pdf,jpg,png|max:2048', // max 2MB
        ], [
            'nilai_ipa.required' => 'Nilai IPA wajib diisi.',
            'nilai_ipa.numeric' => 'Nilai IPA harus berupa angka.',
            'nilai_ipa.min' => 'Nilai IPA minimal 0.',
            'nilai_ipa.max' => 'Nilai IPA maksimal 100.',
            
            'nilai_ips.required' => 'Nilai IPS wajib diisi.',
            'nilai_ips.numeric' => 'Nilai IPS harus berupa angka.',
            'nilai_ips.min' => 'Nilai IPS minimal 0.',
            'nilai_ips.max' => 'Nilai IPS maksimal 100.',
        
            'nilai_binggris.required' => 'Nilai Bahasa Inggris wajib diisi.',
            'nilai_binggris.numeric' => 'Nilai Bahasa Inggris harus berupa angka.',
            'nilai_binggris.min' => 'Nilai Bahasa Inggris minimal 0.',
            'nilai_binggris.max' => 'Nilai Bahasa Inggris maksimal 100.',
        
            'nilai_mtk.required' => 'Nilai Matematika wajib diisi.',
            'nilai_mtk.numeric' => 'Nilai Matematika harus berupa angka.',
            'nilai_mtk.min' => 'Nilai Matematika minimal 0.',
            'nilai_mtk.max' => 'Nilai Matematika maksimal 100.',
        
            'nilai_pai.required' => 'Nilai PAI wajib diisi.',
            'nilai_pai.numeric' => 'Nilai PAI harus berupa angka.',
            'nilai_pai.min' => 'Nilai PAI minimal 0.',
            'nilai_pai.max' => 'Nilai PAI maksimal 100.',
        
            'file_rapor.required' => 'File rapor wajib diunggah.',
            'file_rapor.file' => 'File rapor harus berupa file.',
            'file_rapor.mimes' => 'File rapor harus berformat PDF, JPG, atau PNG.',
            'file_rapor.max' => 'Ukuran file rapor maksimal 2MB.',
        ]);
        
    }

    public function hapusRapor($semester){

        $path = "rapor/".Auth::user()->rapor->{"file_sem$semester"};

        if (Storage::disk('local')->exists($path)) {
            Storage::disk('local')->delete($path);
            
            // update data rapor
            Auth::user()->rapor()->update([
                "nilai_sem".$semester => null,
                "file_sem".$semester => null
            ]);

            // reload model rapor agar data berubah
            Auth::user()->load('rapor'); 

            
            // reset atribut rapor
            $this->reset("rapor");          
            $this->initializeAttributes();


            session()->flash('success', 'File rapor berhasil dihapus.');
            $this->render();
        } else {
            
            session()->flash('error', 'File tidak ditemukan.');
        }
        
    }

     public function hapusRekap(){

        $path = "rekap-nilai/".Auth::user()->rapor->file_rekap;

        if (Storage::disk('local')->exists($path)) {
            Storage::disk('local')->delete($path);
            
            // update data rapor
            Auth::user()->rapor()->update([
                "file_rekap" => null
            ]);

            // reload model rapor agar data berubah
            Auth::user()->load('rapor'); 

            
            // reset atribut rapor
            $this->reset("rapor");          
            $this->initializeAttributes();


            session()->flash('success', 'File rekap nilai rapor berhasil dihapus.');
            $this->render();
        } else {
            
            session()->flash('error', 'File tidak ditemukan.');
        }
        
    }

    public function hapusKetBaik(){

        $path = "surat-berkelakuan-baik/".Auth::user()->keteranganBaik->file;

        if (Storage::disk('local')->exists($path)) {
            Storage::disk('local')->delete($path);
            
            // update data rapor
            Auth::user()->keteranganBaik()->update([
                "file" => null
            ]);

            // reload model rapor agar data berubah
            Auth::user()->load('keteranganBaik'); 

            
            // reset atribut rapor
            $this->reset("fileKetBaik");          
            $this->initializeAttributes();


            session()->flash('success', 'File keterangan berkelakuan baik berhasil dihapus.');
            $this->render();
        } else {
            
            session()->flash('error', 'File tidak ditemukan.');
        }
        
    }

    public function submitRekap()
    {

        $this->validate([
            'file_rekap' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Menyiapkan nama file rekap
        $nama_siswa = str_replace(" ", "-", Auth::user()->nama);
        $upload_time = now()->format('Y-m-d_H-i-s');
        
        // Ambil ekstensi file
        $extension = $this->file_rekap->getClientOriginalExtension();
        
        // Satukan semua string menjadi filename
        $fileName = "{$upload_time}-rekap_rapor-" . Auth::user()->id . "-{$nama_siswa}.{$extension}";
    
        try {
            // Simpan file ke storage private folder
            $this->file_rekap->storeAs('rekap-nilai', $fileName, 'local');
            
            //Update atau simpan data rapor
            $rapor = Auth::user()->rapor()->firstOrNew(['akun_id' => Auth::id()]);
            $rapor->file_rekap = $fileName;
            $rapor->save();

            // reload model rapor agar data berubah
            Auth::user()->load('rapor'); 

            // reset atribut rapor
            $this->reset("rapor");          
            $this->initializeAttributes();

            session()->flash('success', "File nilai rekap rapor berhasil disimpan");
        } catch (\Exception $e) {
            session()->flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }
    }

    public function submitRapor($semester)
    {
        // Validasi
        $this->validateRapor();

        // Menyiapkan nama file rapor
        $nama_siswa = str_replace(" ", "-", Auth::user()->nama);
        $upload_time = now()->format('Y-m-d_H-i-s');
        
        // Ambil ekstensi file
        $extension = $this->file_rapor->getClientOriginalExtension();
        
        // Satukan semua string menjadi filename
        $fileName = "{$upload_time}-semester{$semester}-" . Auth::user()->id . "-{$nama_siswa}.{$extension}";
    
        // JSON Encode data nilai (Hanya sekali!)
        $nilai = [
            "IPA" => $this->nilai_ipa,
            "IPS" => $this->nilai_ips,
            "BING" => $this->nilai_binggris,
            "MTK" => $this->nilai_mtk,
            "PAI" => $this->nilai_pai
        ];
        
        try {
            // Simpan file ke storage private folder
            $this->file_rapor->storeAs('rapor', $fileName, 'local');
            
            //Update atau simpan data rapor
            $rapor = Auth::user()->rapor()->firstOrNew(['akun_id' => Auth::id()]);
            $rapor->{"nilai_sem$semester"} = json_encode($nilai);
            $rapor->{"file_sem$semester"} = $fileName;
            $rapor->save();

            // reload model rapor agar data berubah
            Auth::user()->load('rapor'); 

            // reset atribut rapor
            $this->reset("rapor");          
            $this->initializeAttributes();

            // tutup form 
            $this->reset("openSemester");
            
            session()->flash('success', "Data rapor semester ke-{$semester} berhasil disimpan");
        } catch (\Exception $e) {
            session()->flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }
    }

    public function submitKetBaik()
    {

        // Menyiapkan nama file rapor
        $nama_siswa = str_replace(" ", "-", Auth::user()->nama);
        $upload_time = now()->format('Y-m-d_H-i-s');
        
        // Ambil ekstensi file
        $extension = $this->inputKetBaik->getClientOriginalExtension();
        
        // Satukan semua string menjadi filename
        $fileName = "{$upload_time}-surat-berkelakuan-baik-" . Auth::user()->id . "-{$nama_siswa}.{$extension}";
        
        try {
            // Simpan file ke storage private folder
            $this->inputKetBaik->storeAs('surat-berkelakuan-baik', $fileName, 'local');
            
            //Update atau simpan data rapor
            $ketBaik = Auth::user()->keteranganBaik()->firstOrNew(['akun_id' => Auth::id()]);
            $ketBaik->file = $fileName; 
            $ketBaik->save();

            // reload model rapor agar data berubah
            Auth::user()->load('keteranganBaik'); 

            // reset atribut rapor
            $this->reset("fileKetBaik");          
            $this->initializeAttributes();

            // tutup form 
            $this->reset("openSemester");
            
            session()->flash('success', "keterangan berkelakuan baik berhasil disimpan");
        } catch (\Exception $e) {
            session()->flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }
    }
    
    public function render()
    {
        return view('livewire.berkas');
    }
}
