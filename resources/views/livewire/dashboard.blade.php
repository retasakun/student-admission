<div id="page">

    <img id="bg-horizontal" src="{{url("assets/horizontal-banner.jpg")}}" alt="">
    
    <div id="headbar">
        <img src="{{url('assets/logoman1.png')}}" alt="">
        <h5>STUDENT ADMISSION</h5>
        <select name="" id="language">
            <option value="ID"><img src="{{url('assets/id.svg')}}" alt=""> INDONESIA</option>
            <option value="EN"><img src="{{url('assets/us.svg')}}" alt=""> ENGLISH</option>
        </select>
    </div>
    
    <div id="sidebar">
        <span id="toggle-sidebar">
            <span class="material-symbols-outlined">
                keyboard_double_arrow_left
            </span><br>
            <span class="material-symbols-outlined">
                keyboard_double_arrow_left
            </span>
        </span>
        <div id="profile">
            <span>
                @if ( Auth::user()->dataDiri->foto)
                    <img src="{{ url('view-foto-profile/')}}" alt=""> 
                @else
                    <img src="{{ url('assets/profil.png') }}" alt=""> 
                @endif    
            </span>        
            <h6>Calon Peserta Didik Baru</h6>         
        </div>
        <div id="peserta">
            <div id="peserta">
                <h3>
                    {{Auth::user()->nama}}
                    <i class="fa-solid fa-chevron-down"></i>
                </h3>
                <div>
                    <button wire:click="setActiveTab('GantiPassword')" id="btn-change-password"><i class="fa-solid fa-lock"></i> Ganti Kata Sandi</button>
                    <a id="btn-logout" href="{{url('/auth/logout')}}"> <i class="fa-solid fa-power-off"></i> Logout</a>
                </div>
                <h6>
                    {{Auth::user()->email}}
                </h6>
            </div>
        </div>
        <div id="submit-status">
            @if(App\Services\Complete::isSubmitable() && Auth::user()->submited)
                <span style="background-color: #09ff00"><a>Sudah Tersimpan Permanen</a></span>
            @elseif(App\Services\Complete::isSubmitable())
                <span style="background-color: orange"><a>Belum Simpan Permanen!</a></span>
            @else
                <span style="background-color: red"><a>Data Belum Lengkap!</a></span>
    @endif
        </div>
        <div id="menu-title">
            <h5>Menu</h5>
        </div>
        <div id="sidebar-option">
            <div>
                <button wire:click="setActiveTab('Beranda')" class="{{ $activeTab === 'Beranda' ? 'active' : '' }}">
                    <span class="material-symbols-outlined">home</span><span>Beranda</span>
                </button>
                <button wire:click="setActiveTab('DataSiswa')" class="{{ $activeTab === 'DataSiswa' ? 'active' : '' }}">
                    <span class="material-symbols-outlined">person</span><span>Data Siswa</span>
                </button>
                <button wire:click="setActiveTab('Persyaratan')" class="{{ $activeTab === 'Persyaratan' ? 'active' : '' }}">
                    <span class="material-symbols-outlined">file_present</span><span>Persyaratan</span>
                </button>
                <button wire:click="setActiveTab('SimpanPermanen')" class="{{ $activeTab === 'SimpanPermanen' ? 'active' : '' }}">
                    <span class="material-symbols-outlined">flag_check</span><span>Simpan Permanen</span>
                </button>
                <button wire:click="setActiveTab('Pengumuman')" class="{{ $activeTab === 'Pengumuman' ? 'active' : '' }}">
                    <span class="material-symbols-outlined">fact_check</span><span>Status Kelulusan</span>
                </button>
                <br><br><b></b>
            </div>
        </div>
    </div>

    <div id="content">
        {{-- Tab contents --}}
    
        <div class="box-loader" wire:loading>
            @include("misc.loading")
        </div>
    
        <div wire:loading.remove style="width:100%;">
            @switch($activeTab)
                @case('GantiPassword')
                    @livewire('GantiPassword')
                    @break
                @case('Beranda')
                    @livewire('Beranda')
                    @break
                @case('DataSiswa')
                    @livewire('DataSiswa')
                    @break
                @case('Persyaratan')
                    @livewire('Persyaratan')
                    @break
                @case('SimpanPermanen')
                    @livewire('SimpanPermanen')
                    @break
                @case('Pengumuman')
                    @livewire('Pengumuman')
                    @break
            @endswitch
            
        </div>
    </div>
</div>
<script>
    Livewire.on('updateBrowserUrl', newUrl => {
        window.history.pushState({}, '', newUrl);
    });
</script>

<script>


    rotate = 180;
    $("#toggle-sidebar").click(function(){
        $("#sidebar").toggleClass("mini-sidebar");
        $("#content").toggleClass("wider-content")
        $("#toggle-sidebar .material-symbols-outlined").css("transform", "rotateZ("+rotate+"deg)");
        rotate+= 180;
    });

    if(window.screen.width <= 500){
        $("html").click(function(){
            if(!$("#sidebar").hasClass("mini-sidebar")) $("#toggle-sidebar").click()
        })
        
        $("#sidebar").click(function(e){
            e.stopPropagation()
        })
    }

    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) { // Change 50 to the desired scroll distance
                $("#sidebar").css("top", "0");
            } else {
                $("#sidebar").css("top", "5rem");
            }
        });
    });

</script>