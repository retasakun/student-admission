<div id="login-box">
    <div id="logo">
        <img src="{{url('assets/logokemenag.png')}}" alt="">
        <img src="{{url('assets/logoman1.png')}}" alt="">
    </div><br>
    <h3>PPDB MAN 1 PEKANBARU</h3>
    @if (\Session::has('success'))
        <div style="color: rgb(0, 228, 0);padding: 1rem;">
            <span>{!! \Session::get('success') !!}</span>   
        </div>
    @endif
    @if (\Session::has('fail'))
        <div style="color: rgb(255, 5, 5);padding: 1rem;">
            <span>{!! \Session::get('fail') !!}</span>   
        </div>
    @endif
    
    @if(date("Y-m-d") >= "2023-03-27")
    
    <form wire:submit.prevent="submit">
        @csrf
    
        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <input wire:model.defer="email" type="text" placeholder="Email atau Username">
        <input wire:model.defer="password" type="password" placeholder="Password">
        <button wire:loading.attr="disabled" role="submit">Login</button>
        <br>
    
        {{-- <a href="">Lupa Password ?</a> --}}
    
        <br>
        <span>Belum Punya Akun? <a href="{{url('/auth/register')}}">Daftar Di Sini</a></span>
    </form>
    
    @else
    <div style="background-color:red;color:white;padding: 1rem;">
        <h4>Pendaftaran reguler akan dibuka pada tanggal 17 Februari 2025</h4>
    </div>
    @endif
</div>