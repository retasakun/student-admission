@extends('layouts.app')

@push('styles') 
    <link rel="stylesheet" href="{{url('css/register.css')}} ">
@endpush

@section('title')
    Pendaftaran Akun Calon Peserta Didik Baru - Student Admissions MAN 1 Pekanbaru
@endsection

@section('content')
    
    <div id="page">

        @livewire('UserRegister')

        <img id="maskot" src="{{url('assets/maskot.png')}}" alt="">

    </div>


@endsection

@section('js')
    <script>
        function showPass(){
            var check = document.querySelector('[name="password"]');
            var eye = document.querySelector(".eye_slash");
            if (check.type === "password") {
                check.type = "text";
                eye.style.display = "block";
            } else {
                check.type = "password";
                eye.style.display = "none";
            }
        }

        
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


    </script>
@endsection