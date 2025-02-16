
@extends('layouts.app')

@push('styles')  
    <link rel="stylesheet" href="{{url('css/login.css')}}">
@endpush

@section('content')
    
    <div id="page">

        <div id="banner">
            <img id="bg" src="{{url('assets/MAN1.jpg')}}" alt="">

            <div id="banner-content">
                <h3>SELAMAT DATANG DI</h3>
                <h1>APLIKASI <i>STUDENT ADMISSION</i></h1>
                <h2>Penerimaan Peserta Didik Baru (PPDB) MAN 1 Kota Pekanbaru</h2>
                <img src="{{url('assets/maskot.png')}}" alt="">
            </div>

        </div>
        <div id="login">
            @livewire('userLogin')
        </div>
    </div>


@endsection