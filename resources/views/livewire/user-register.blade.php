<form  id="daftar-form" wire:submit.prevent="submit">

            
    <div id="logo">
        <img src="{{url('assets/logokemenag.png')}}" alt="">
        <img src="{{url('assets/logoman1.png')}}" alt="">
    </div>
    <div id="caption">
        Silahkan membuat akun baru untuk login ke Aplikasi Student Admission - PPDB MA Negeri 1 Pekanbaru
        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="form-item">
        <input type="text" wire:model.defer="nama" value="{{ old('nama') }}" required maxlength="250" min="3" placeholder="Nama Lengkap">
        <span></span>
    </div>
    <div class="form-item">
        <input type="text" wire:model="kodeneg" wire:ignore required readonly value="+62" maxlength="4" min="3" placeholder="+62">
        <span></span>
    </div>
    <div class="form-item">
        <input type="tel" wire:model.defer="telepon"  required maxlength="15" min="10" placeholder="Nomor Telepon / Whatsapp" value="{{ old('telepon') }}">
        <span></span>
    </div>
    <div id="number-warning">
        <p>Pastikan kembali nomor yang anda masukkan adalah benar!</p>    
    </div> 
    <div class="form-item">
        <input type="email" wire:model.defer="email" required maxlength="250" min="4" placeholder="Email">
        <span></span>
    </div>
    <div class="form-item">
        <input type="password" wire:model.defer="password" required maxlength="250" min="4" placeholder="Kata Sandi">
        <span></span>
        <span class="eye material-symbols-outlined">visibility</span>
        <span class="eye eye_slash material-symbols-outlined">visibility_off</span>
        {{-- <input type="checkbox" onclick="showPass()"> --}}
        <p id="password-invalid" class="pass-error">Kata sandi harus mencakup 7-12 karakter, setidaknya mengandung huruf kapital (A-Z), huruf kecil (a-z) dan angka (0-9)</p>
        <p id="password-notmatch" class="pass-error">Kata sandi tidak cocok!</p>
    </div>
    <div class="form-item">
        <input type="password" wire:model.defer="password_confirmation" required  maxlength="250" min="4" placeholder="Ketik Ulang Kata Sandi">
        <span></span>
    </div>

    <button wire:loading.attr="disabled" id="submit">Buat Akun<span class="material-symbols-outlined">send</span></button>

    @csrf

    
    {{-- <script>
        
    
        
        $("#daftar-form").submit(function(event) {
            
    
            var pass = $("[name='password']").val();
            var repass = $("[name='password_confirmation']").val()
            var valid = true;
    
            if(pass !== repass){
                $("#password-notmatch").show()
                event.preventDefault()
            }
    
            if(!isPasswordValid(pass)){
                $("#password-invalid").show()
                event.preventDefault()
            }
            
    
        });
    
        function isPasswordValid(pass){
            if(pass.length < 7 || pass.length > 12){
                return false;
            }
            if(!(/[A-Z]/.test(pass) && /[a-z]/.test(pass))){
                return false;
            }
            if(!(/\d/.test(pass))){
                return false;
            }
            return true;
        }
    
        $('input[name="telepon"]').change(function(){
            if(!($(this).val()[0] == "8")){
                var mes = $('<h3 id="must8">Nomor telepon harus berawalan angka 8!</h3>').css({
                    "background-color" : "red",
                    "color" : "white",
                    "padding" : "5px",
                    "margin-top" : "10px"
                })
                $("#number-warning").append(mes)
            }else{
                $("#must8").remove()
            }
        })
    
    
    </script> --}}

</form>
