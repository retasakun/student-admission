<div id="submit-form">

    <br><br><h2>SIMPAN PERMANEN PENDAFTARAN</h2><br>
    
    
    @if (App\Services\Complete::isSubmitable() && Auth::user()->submited)
                
        <p style="color: #07d100">Data berhasil disimpan permanen. Silahkan mengunduh dan mencetak <b>bukti pendaftaran</b> dan <b>formulir pendafataran</b> dibawah ini. </p>
        <br>
        <a style="font-size: larger;" href="{{url('view-bukti-pendaftaran')}}">UNDUH BUKTI PENDAFTARAN</a>
        <br>
        <br>
        <a style="font-size: larger;" href="{{url('view-formulir')}}">UNDUH FORMULIR PENDAFTARAN</a>
        
    @elseif(date("Y-m-d H:m:s") > "2025-02-23 23:59:59")
        
        <h2 style="color: red;background-color:#e7a0a0;">PENDAFTARAN SUDAH DITUTUP</h2>
        <p style="color: red">Anda belum menyelesaikan pendaftaran. </p>
    
    @elseif(App\Services\Complete::isSubmitable())
        
        <p>Data dan berkas pendaftaran kamu sudah lengkap. Simpan permanen pendaftaran kamu. Data yang sudah disimpan permanen tidak dapat diubah. Pastikan semua data sudah terisi dengan benar. 
        </p>
        <br>
        <br>
        <form wire:submit.prevent="simpanPermanen">

            @if(true)
            <div id="confirm">
                <input id="agree" wire:model="agree" type="checkbox">
                <p>Dengan ini, Saya menyatakan bahwa semua 
                    data yang Saya cantumkan dalam aplikasi pendaftaran ini adalah BENAR. 
                    Saya bersedia menerima segala SANKSI termaksuk pembatalan status
                     kelulusan siswa jika dikemudian hari saya diketahui melakukan 
                     pemalsuan data
                </p>
            </div>
            
            <br>
            
            <button role="submit">
                <span wire:loading.remove>SIMPAN PERMANEN</span>
                <span wire:loading>Menyimpan.. harap tunggu</span>
            </button>
            @else
                <p style="background-color:red; color:white ;padding:10px;">Simpan permanen baru dapat dilakukan pada tanggal <br> 20 Januari 2025</p>
            @endif
        </form>
        
    @else    
        <p class="red">Data Kamu belum lengkap! Pendaftaranmu tidak akan diproses sebelum kamu melengkapi semua data dan berkas persyaratan.</p><br>
        <p class="red">Data yang belum lengkap : </p>
        <ul class="red">
            @foreach(App\Services\Complete::getAllMissingFields() as $miss)
                <li>{{$miss}}</li>
            @endforeach
        </ul>
    
    @endif

    

</div>