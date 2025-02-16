<div class="md-stepper-horizontal orange">
    <div wire:click="setActiveTab('DataDiri')" 
    class="md-step active data-siswa 
    {{ $activeDataSiswaTab === 'DataDiri' ? 'open' : '' }} 
    @if(App\Services\Complete::dataDiri()) not-complete @endif">
      <div class="md-step-circle"><span>1</span></div>
      <div class="md-step-title">Data Siswa</div>
      <div class="md-step-status">Belum Dilengkapi X</div>
      <div class="md-step-bar-left"></div>
      <div class="md-step-bar-right"></div>
    </div>
    <div wire:click="setActiveTab('DataOrangTua')" 
    class="md-step active wali {{ $activeDataSiswaTab === 'DataOrangTua' ? 'open' : '' }}
    @if(!App\Services\Complete::statusDataOrangTua()) not-complete @endif">
      <div class="md-step-circle"><span></span></div>
      <div class="md-step-title">Data Orang Tua/Wali</div>
      <div class="md-step-status">Belum Dilengkapi X</div>
      <div class="md-step-bar-left"></div>
      <div class="md-step-bar-right"></div>
    </div>
    <div wire:click="setActiveTab('DataSekolah')" 
    class="md-step active sekolah {{ $activeDataSiswaTab === 'DataSekolah' ? 'open' : '' }}
    @if(App\Services\Complete::dataSekolahAsal()) not-complete @endif">
      <div class="md-step-circle"><span>3</span></div>
      <div class="md-step-title">Data Sekolah Asal</div>
      <div class="md-step-status">Belum Dilengkapi X</div>
      <div class="md-step-bar-left"></div>
      <div class="md-step-bar-right"></div>
    </div>
</div>