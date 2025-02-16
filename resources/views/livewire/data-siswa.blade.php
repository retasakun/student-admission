<div id="data-diri">
    
@include('livewire.data-siswa-tab-selector') 

<div class="box-loader" wire:loading>
    <br>
    @include("misc.loading")
</div>

<div wire:loading.remove>
    @switch($activeDataSiswaTab)
        @case('DataDiri')
            @livewire('DataDiri')
            @break
        @case('DataOrangTua')
            @livewire('dataOrangTua')
            @break
        @case('DataSekolah')
            @livewire('DataSekolah')
            @break
    @endswitch
</div>

</div>