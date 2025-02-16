<?php

namespace App\Livewire;

use Livewire\Component;

class DataSiswa extends Component
{   
    public $activeDataSiswaTab = 'DataDiri'; 

    public function mount()
    {
        $this->activeDataSiswaTab = session()->get('activeDataSiswaTab', 'DataDiri');
    }

    public function setActiveTab($tab)
    {
        $this->activeDataSiswaTab = $tab;
        session()->put('activeDataSiswaTab', $tab); 
    }

    public function render()
    {   
        return view('livewire.data-siswa');
    }
}
