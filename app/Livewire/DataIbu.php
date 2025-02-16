<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\DataOrangTua;
use Illuminate\Validation\ValidationException;
use App\Rules\customDateRule;
use Illuminate\Support\Facades\DB;


class DataIbu extends Component
{   
    public $status, $nama, $tempat_lahir, $tanggal_lahir, $bulan_lahir, $tahun_lahir;
    public $alamat, $RT_RW, $telp, $pendidikan, $pekerjaan, $penghasilan;

    public function mount()
    {   
        $this->initializeAttributes();
    }

    private function initializeAttributes(){

        $this->resetExcept([]);

        Auth::user()->load('dataOrangTua');
        $data = Auth::user()->dataOrangTua->firstWhere('jenis', 'Ibu'); // Change this query as needed
        
        // dd($data);
        if ($data) {
            if($data->status == 'aktif') $this->status = false;
            else if($data->status == 'nonaktif') $this->status = true;

            $this->nama = $data->nama;
            $this->tempat_lahir = $data->tempat_lahir;

            // Extract date if exists in proper format
            if (isset($data->tanggal_lahir) && preg_match('/^(\d{1,2}) (\w+) (\d{4})$/', $data->tanggal_lahir, $matches)) {
                $this->tanggal_lahir = $matches[1];
                $this->bulan_lahir = strtoupper($matches[2]); 
                $this->tahun_lahir = $matches[3]; 
            }

            $this->alamat = $data->alamat;
            $this->telp = $data->telp;
            $this->RT_RW = $data->RT_RW;
            $this->pendidikan = $data->pendidikan;
            $this->pekerjaan = $data->pekerjaan;
            $this->penghasilan = $data->penghasilan;
        }
    }

    public function copyAlamat()
    {
        $this->alamat = Auth::user()->dataDiri->alamat ?? '';
    }


    public function submit()
    {   
        // Combine date parts
        $this->tanggal_lahir = $this->tanggal_lahir." ".$this->bulan_lahir." ".$this->tahun_lahir;
        $tanggal_lahir = $this->tanggal_lahir;
        
        // Set status
        $this->status = (!$this->status) ? "aktif" : "nonaktif";
        
        if($this->status == "nonaktif"){
            // Save or update the data
            DataOrangTua::updateOrInsert(
                ['akun_id' => Auth::user()->id, 'jenis' => 'Ibu'], // Kondisi pencarian
                [
                    'status' => $this->status,
                    'nama' => "-",
                    'tempat_lahir' => "-",
                    'tanggal_lahir' => "-",
                    'alamat' => "-",
                    'RT_RW' => "-",
                    'telp' => "-",
                    'pendidikan' => "-",
                    'pekerjaan' => "-",
                    'penghasilan' => "-",
                ]
            );
        }else{
            // Validate other fields
            $this->validate([
                'nama' => 'required|min:3|max:60',
                'tempat_lahir' => 'required|min:3|max:60',
                'tanggal_lahir' => ['required', new customDateRule],
                'alamat' => 'required|min:3|max:255',
                'RT_RW' => 'required|regex:/^\d{3}\/\d{3}$/',
                'telp' => 'required|digits_between:10,14',
                'pendidikan' => 'required|string',
                'pekerjaan' => 'required|string',
                'penghasilan' => 'required|string',
            ]);
            // Save or update the data
            DataOrangTua::updateOrInsert(
                ['akun_id' => Auth::user()->id, 'jenis' => 'Ibu'], // Kondisi pencarian
                [
                    'status' => $this->status,
                    'nama' => $this->nama,
                    'tempat_lahir' => $this->tempat_lahir,
                    'tanggal_lahir' => $this->tanggal_lahir,
                    'alamat' => $this->alamat,
                    'RT_RW' => $this->RT_RW,
                    'telp' => $this->telp,
                    'pendidikan' => $this->pendidikan,
                    'pekerjaan' => $this->pekerjaan,
                    'penghasilan' => $this->penghasilan,
                ]
            );
        }
        


        $this->initializeAttributes();

        session()->flash('success', 'Data Ibu berhasil disimpan!');
    }

    public function render()
    {
        return view('livewire.data-ibu');
    }
}
