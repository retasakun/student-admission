<?php

namespace App\Livewire;

use Livewire\Component;

class Persyaratan extends Component
{
    public $activePersyaratanTab = 'PilihanJurusan'; 

    public function mount()
    {
        $this->activePersyaratanTab = session()->get('activePersyaratanTab', 'PilihanJurusan');
    }

    public function setActiveTab($tab)
    {
        $this->activePersyaratanTab = $tab;
        session()->put('activePersyaratanTab', $tab); 
    }

    public function render()
    {
        return view('livewire.persyaratan');
    }
}
