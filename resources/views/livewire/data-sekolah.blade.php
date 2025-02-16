

<div id="data-diri">


    <div id="biodata">


      <form wire:submit.prevent="submit" id="data-sekolah-asal" class="form-area" >

        <div class="form-section-title">
            <h4>DATA SEKOLAH ASAL</h4>
        </div>

        @if (session()->has('success'))
        <div 
            class="alert-success" 
            x-data="{ show: true }" 
            x-init="setTimeout(() => { show = false; $el.remove() }, 4000)" 
            x-show="show"
            x-transition
        >
            {{ session('success') }}
        </div>
        @endif

        <label for="">NAMA SEKOLAH ASAL</label>
        <input wire:model.defer="nama_sekolah_asal" required minlength="3" max="60" placeholder="(contoh : MTsN 3 Pekanbaru)">
        @error('nama_sekolah_asal') 
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="">NPSN</label>
        <input wire:model.defer="npsn" required minlength="8" maxlength="15" placeholder="Nomor Pokok Sekolah Nasional (NPSN)">
        @error('npsn') 
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="">NSM (jika ada)</label>
        <input wire:model.defer="nsm" required minlength="8" maxlength="15" placeholder="Nomor Statistik Madrasah (NSM)">
        @error('nsm') 
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="">ALAMAT SEKOLAH ASAL</label>
        <input wire:model.defer="alamat" required minlength="3" max="255" placeholder="alamat sekolah asal calon siswa">
        @error('alamat') 
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="">PROVINSI SEKOLAH ASAL</label>
        <input wire:model.defer="provinsi" required minlength="3" max="8" placeholder="provinsi sekolah asal">
        @error('provinsi') 
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="">KABUPATEN/KOTA</label>
        <input wire:model.defer="kabupaten" required max="14" placeholder="kabupaten atau kota"> 
        @error('kabupaten') 
            <div class="error">{{ $message }}</div>
        @enderror

        <br><br><br>
        
        <div class="form-row">
            <button role="submit" class="submit-box-form">
                SIMPAN
            </button>
        </div>
    </form>
  



      
    </div>

</div>

<script>
  
  
  Object.values(data).forEach(errors => {
    errors.forEach(error => {
      $(".div-edit").after('<li id="error-bag">'+error+'</li><br>')
    });
  });
  data = null;


</script>
