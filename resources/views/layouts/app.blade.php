<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    @if (!isset(Auth::user()->submited)) 
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
    @endif

    {{-- fontawessome --}}
    <script src="https://kit.fontawesome.com/a1f4cf83a4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
   
    {{-- google fonts icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('bootstrap')
    
    <title> @yield('title') </title>
    
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
    @stack('styles')

    @livewireStyles
    <!-- Chart JS  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    
    {{-- AJAX --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  --}}
    <script src="{{url('js/jquery.min.js')}}"></script> 

    {{-- CSS --}}
    
</head>
<body>
    
    
        

    @yield('content')
    
    @livewireScripts
    @stack('js')
</body>
</html>