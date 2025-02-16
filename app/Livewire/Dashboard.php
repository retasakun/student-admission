<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $activeTab = 'Beranda'; 

    public function mount()
    {   
        $this->activeTab = session()->get('activeTab', 'Beranda');

    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        session()->put('activeTab', $tab); 

        // $this->updateUrl($tab);
    }

    // public function updateUrl($newFirst)
    // {
    //     $currentUrl = request()->path(); // Example: 'unknown-url/url-first/url-second'

    //     // Explode URL into parts
    //     $segments = explode('/', $currentUrl);

    //     // Ensure we have at least 3 segments
    //     if (count($segments) >= 3) {
    //         $segments[1] = $newFirst;  // Change 'url-first'
    //         $segments[2] = $newSecond; // Change 'url-second'
    //     }

    //     // Reconstruct URL
    //     $newUrl = '/' . implode('/', $segments);

    //     // Dispatch event for JavaScript
    //     $this->dispatch('updateBrowserUrl', newUrl: $newUrl);
    // }




    public function render()
    {
        return view('livewire.dashboard'); 
    }
}
