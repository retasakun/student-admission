<?php

namespace App\Livewire; 

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Akun;

class PilihanJurusan extends Component
{   
    public $peminatan;

    protected $rules = [
        'peminatan' => 'required|in:Kelas Timur Tengah,Kelas Umum,Tahfidz',
    ];

    public function mount(){
        $this->peminatan = Auth::user()->peminatan;
    }

    public function submit()
    {
        // validasi data
        $this->validate();

        
        //update Akun model
        Auth::user()->peminatan = $this->peminatan;
        Auth::user()->save();
        
        session()->flash('success', 'Peminatan berhasil diperbarui: ' . $this->peminatan);
    }
    public function render()
    {
        return view('livewire.pilihan-jurusan');
    }
}
