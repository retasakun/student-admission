

@extends('..layouts.app')


@push('styles')
    <link rel="stylesheet" href="{{url('css/dashboard/dashboard.css')}}">
    <link rel="stylesheet" href="{{url('css/dashboard/kelulusan.css')}}">
    <link rel="stylesheet" href="{{url('css/dashboard/dashboard_2.css')}}">
    <link rel="stylesheet" href="{{url('css/dashboard/rapor.css')}}">
    <link rel="stylesheet" href="{{url('css/dashboard/dashboard-responsive.css')}}">
    <link rel="stylesheet" href="{{url('css/dashboard/loading_animation.css')}}">
@endpush

@section('title')  @endsection

@section('content')

    @livewire('dashboard')
    
@endsection


<script>

    
    @if (count($errors))
        var data = <?php echo json_encode($errors->toArray()); ?>
    @endif



</script>


@section('js')
    <script src="{{url("js/dashboard-page.js")}}"></script>
    <script src="{{url("js/dashboard-send.js")}}"></script>
@endsection


