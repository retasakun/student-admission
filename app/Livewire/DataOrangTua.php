<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DataOrangTua extends Component
{   
    public $user, $ayah, $ibu, $wali;

    public function mount()
{
    // Create default data as an object
    $dataKosong = (object) [
        'status' => "aktif",
        'nama' => "belum diisi",
        'tempat_lahir' => "belum diisi",
        'tanggal_lahir' => "belum diisi",
        'alamat' => "belum diisi",
        'telp' => "belum diisi",
        'RT_RW' => "belum diisi",
        'pendidikan' => "belum diisi",
        'pekerjaan' => "belum diisi",
        'penghasilan' => "belum diisi"
    ];

    // Retrieve authenticated user
    $this->user = Auth::guard('akun')->user();

    // Use firstWhere() to get a single object or fallback to default object
    $this->ayah = $this->user->dataOrangTua->firstWhere('jenis', 'Ayah') ?? $dataKosong;
    $this->ibu = $this->user->dataOrangTua->firstWhere('jenis', 'Ibu') ?? $dataKosong;
    $this->wali = $this->user->dataOrangTua->firstWhere('jenis', 'Wali') ?? $dataKosong;

}


    public function render()
    {   
        return view('livewire.data-orang-tua');
    }
}
