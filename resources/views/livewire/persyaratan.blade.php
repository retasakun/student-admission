<div id="persyaratan">

    @include('livewire.persyaratan-tab-selector')

    <br><br>

    <?php 
        // $persya =   Auth::user()->persya;  
        // use App\Custom\Complete;  
    ?>

    <div class="box-loader short" wire:loading>
        <br>
        @include("misc.loading")
    </div>
    
    <div wire:loading.remove>
        @switch($activePersyaratanTab)
            @case('PilihanJurusan')
                @livewire('PilihanJurusan')
                @break
            @case('Berkas')
                @livewire('Berkas')
                @break
        @endswitch
    </div>

    {{-- additional script --}}
{{-- <script>
    $(document).ready(function(){

        // @if(Complete::pilihanKualifikasi() == 'rapor' || Complete::pilihanKualifikasi() == 'ranking')
        //     $("#pilihan-syarat-akademik").show()
        // @endif

        // @if(Complete::pilihanKualifikasi() == 'bakat minat')
        //     $("#sertifikat").show()
        // @endif

        $("#persyaratan").children().hide()
        $(".md-stepper-horizontal").show()
        
        //  @if (App\Custom\Complete::submitable() && Auth::user()->submited)
        //     $("#submit-form").show()
        //  @else
        //     $("#pilihan-jurusan").show()
        //  @endif
        
    });

    Object.values(data).forEach(errors => {
        alert(errors)
        errors.forEach(error => {
            alert("Gagal mengirim data. "+error);
            $("#pilihan-syarat").after('<li id="error-bag">'+error+'</li><br>')
        });
    });

</script> --}}

</div>


