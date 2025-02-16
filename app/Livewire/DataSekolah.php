<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\DataSekolahAsal;

class DataSekolah extends Component
{   
    public $nama_sekolah_asal, $npsn, $nsm, $alamat, $provinsi, $kabupaten;

    public function mount()
    {   

        // Load existing data from the database
        $data = Auth::user()->dataSekolahAsal;

        if ($data) {
            $this->nama_sekolah_asal = $data->nama_sekolah_asal;
            $this->npsn = $data->npsn; 
            $this->nsm = $data->nsm; 
            $this->alamat = $data->alamat; 
            $this->provinsi = $data->provinsi; 
            $this->kabupaten = $data->kabupaten; 
        }
    }

    public function copyAlamat()
    {
        $this->alamat = Auth::user()->dataDiri->alamat ?? '';
    }


    public function submit()
    {   

        // Validate other fields
        $this->validate([
            'nama_sekolah_asal' => 'required|string|min:3|max:255',
            'npsn' => 'required|digits_between:8,15',
            'nsm' => 'nullable|digits_between:8,15',
            'alamat' => 'required|min:3|max:255',
            'provinsi' => 'required|string|min:3|max:60',
            'kabupaten' => 'required|string|min:3|max:60',
        ]);
        
        // Save or update the data
        $saved = DataSekolahAsal::updateOrCreate([
            'akun_id' => Auth::user()->id,
        ], [
            'nama_sekolah_asal' => $this->nama_sekolah_asal,
            'npsn' => $this->npsn,
            'nsm' => $this->nsm,
            'alamat' => $this->alamat,
            'provinsi' => $this->provinsi,
            'kabupaten' => $this->kabupaten,
        ]);

        

        session()->flash('success', 'Data sekolah asal berhasil disimpan!');
    }

    public function render()
    {
        return view('livewire.data-sekolah');
    }
}
