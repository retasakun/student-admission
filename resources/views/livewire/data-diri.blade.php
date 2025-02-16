<div id="data-diri">

  @if (session()->has('success'))
    <div 
        class="alert-success" 
        x-data="{ show: true }" 
        x-init="setTimeout(() => { show = false; $el.remove() }, 4000)" 
        x-show="show"
        x-transition
    >
        {{ "Berhasil! " . session('success') }}
    </div>
  @endif

    <div id="biodata">
      @if ( $foto)
        <img name="image" src="{{ url('view-foto-profile') }}" alt=""> 
      @else
        <img name="image" src="{{ url('assets/profil.png') }}" alt=""> 
      @endif
    
      @if (!isset($user->submited)) 
        <button id="edit-photo" wire:click="openFoto" class="btn-edit">Edit Foto</button> 
      @endif

      @if (\Session::has('success'))
          <div style="color: rgb(0, 228, 0);padding: 1rem;">
              <span>{!! \Session::get('success') !!}</span>   
          </div>
      @endif
    </div>
  
    <form id="foto-profil" class="form-area {{($openFotoForm) ? 'show' : ''}}" wire:submit.prevent="submitFotoProfil">
      <ul>
          <li>Pasfoto harus berwarna dengan latar belakang polos <br> berwarna MERAH atau BIRU.</li>
          <li>File pasfoto bertipe JPG/JPEG.</li>
          <li>Ukuran maksimal file pasfoto adalah 1024 KB.</li>
          <li>Orientasi pasfoto adalah vertikal/potrait.</li>
          <li>Posisi badan dan kepala tegak sejajar menghadap kamera.</li>
          <li>Kualitas foto harus tajam dan fokus.</li>
          <li>Tidak ada bagian kepala yang terpotong dan wajah tidak boleh tertutupi ornamen.</li>
      </ul>

      <label for="image">UPLOAD PAS PHOTO (3x4) </label>
      <input wire:model.defer="foto" type="file" name="image" id="image" required accept="image/x-png,image/jpeg">
    
      <div wire:loading wire:target="foto" class="text-blue-500">
        mengirim file... harap tunggu
        </div>
        <br>
        <div class="form-row">
            <!-- Disable button until file upload is complete -->
            <br>
            <button wire:loading.attr="disabled" class="submit-box-form" type="submit">
                <span wire:loading.remove>Submit</span>
                <span wire:loading>Tunggu...</span>
            </button>
        </div>
    </form>
    <br>
    <form  class="form-area" wire:submit.prevent="submit">

      <div class="form-section-title">
          <h4>DATA DIRI</h4>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label for="nama">NAMA LENGKAP</label>
          <input id="nama" value="{{$nama}}" type="text" readonly required minlength="3" max="60" placeholder="nama lengkap">
          <span></span>
        </div>
        <span>@error('nama') <span class="error">{{ $message }}</span>@enderror</span>
        <div class="form-col">
          <label for="nisn">NISN</label>
          <input id="nisn" type="text" wire:model.defer="nisn" required minlength="7" max="13" placeholder="nomor induk siswa nasional">
          <span></span>
        </div>
        <span>@error('nisn') <span class="error">{{ $message }}</span>@enderror</span>
      </div>

      <label for="ss-nisn">TANGKAPANG LAYAR BUKTI NISN AKTIF</label>
      <input id="ss-nisn" type="file" wire:model.defer="ss_nisn" required>
      <span>@error('ss_nisn') <span class="error">{{ $message }}</span>@enderror</span>
      <img src="{{url('view-ss-nisn/')}}" alt="">

      <div class="form-row">
        <div class="form-col">
          <label for="tempat-lahir">TEMPAT LAHIR</label>
          <input id="tempat-lahir" type="text" wire:model.defer="tempat_lahir" required minlength="3" max="60" placeholder="tempat lahir">
          <span><span>@error('tempat_lahir') <span class="error">{{ $message }}</span>@enderror</span></span>
        </div>
        <div class="form-col">
          <label for="kewarganegaraan">KEWARGANEGARAAN</label>
          <input id="kewarganegaraan"  type="text" wire:model.defer="kewarganegaraan" required minlength="3" max="60" placeholder="kewarganegaraan">
          <span><span>@error('kewarganegaraan') <span class="error">{{ $message }}</span>@enderror</span></span>
        </div>  
      </div>  
      


      <label for="tanggal-lahir">TANGGAL LAHIR</label>
      <label for="tanggal-lahir">TANGGAL LAHIR</label>
      <div id="tanggal-lahir" class="form-row">
          <div class="form-col">
            <select wire:model.defer="tanggal_lahir">
                @for ($i = 1; $i <= 31; $i++)
                    <option value="{{ $i }}" {{ $i == $tanggal_lahir ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            <span>@error('tanggal_lahir') <span class="error">{{ $message }}</span>@enderror</span>
          </div>
          <div class="form-col">
              <select wire:model.defer="bulan_lahir">
                  @foreach (['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'] as $bulan)
                      <option value="{{ $bulan }}" {{ $bulan == $bulan_lahir ? 'selected' : '' }}>{{ $bulan }}</option>
                  @endforeach
              </select>
              <span>@error('bulan_lahir') <span class="error">{{ $message }}</span>@enderror</span>
          </div>
          <div class="form-col">
              <input type="number" wire:model.defer="tahun_lahir" placeholder="Tahun">
              <span>@error('tahun_lahir') <span class="error">{{ $message }}</span>@enderror</span>
          </div>
      </div>

      <label for="jenis-kelamin">JENIS KELAMIN</label>
      <div id="jenis-kelamin" class="form-row radio">
          <div class="form-col">
            <input id="laki-laki" wire:model.defer="jenis_kelamin" type="radio" value="Laki-laki"
                <?= $jenis_kelamin === "Laki-laki" ? 'checked' : '' ?>>
              <label for="laki-laki">LAKI-LAKI</label>
          </div>
          <div class="form-col">
            <input id="perempuan" wire:model.defer="jenis_kelamin" type="radio" value="Perempuan"
                <?= $jenis_kelamin === "Perempuan" ? 'checked' : '' ?>>
              <label for="perempuan">PEREMPUAN</label>
          </div>
      </div>
      @error('jenis_kelamin') <span class="error">{{ $message }}</span>@enderror
    

      <label for="agama">AGAMA</label>
      <input id="agama" type="text"  wire:model.defer="agama" required minlength="3" max="60" placeholder="agama">
      <span>@error('agama') <span class="error">{{ $message }}</span>@enderror</span>

      <label for="jumlah-saudara">JUMLAH SAUDARA</label>
      <input id="jumlah-saudara" type="number" wire:model.defer="jumlah_saudara" placeholder="jumlah saudara">
      <span>@error('jumlah_saudara') <span class="error">{{ $message }}</span>@enderror</span>

      <label for="anak-ke">ANAK KE-</label>
      <input id="anak-ke" type="number" wire:model.defer="anak_ke" placeholder="anak ke-">
      <span></span>

      <label for="cita-cita">CITA-CITA</label>
      <input id="cita-cita" type="text" wire:model.defer="cita_cita" required minlength="3" max="60" placeholder="cita-cita">
      <span>@error('cita_cita') <span class="error">{{ $message }}</span>@enderror</span>

      <br><br>
      <div class="form-section-title">
          <h4>DATA FISIK</h4>
      </div>
   
      <label for="buta-warna">APAKAH SISWA BUTA WARNA?</label>
      <div id="buta-warna" class="form-row radio">
          <div class="form-col">
            <input id="YA_BUTAWARNA" type="radio" wire:model.defer="buta_warna" value="YA"
                <?= ($buta_warna == "YA")? 'checked' : '' ?>>
              <label for="YA_BUTAWARNA">YA</label>
          </div>
          <div class="form-col">
            <input id="TIDAK_BUTAWARNA" type="radio" wire:model.defer="buta_warna" value="TIDAK"
            <?= ($buta_warna == "TIDAK")? 'checked' : '' ?>>
              <label for="TIDAK_BUTAWARNA">TIDAK</label>
          </div>
      </div>
      @error('buta_warna') <span class="error">{{ $message }}</span>@enderror

      <label for="berkebutuhan-khusus">APAKAH SISWA BERKEBUTUHAN KHUSUS? </label>
      <div id="berkebutuhan-khusus" class="form-row radio">
          <div class="form-col">
            <input id="YA_BERKEBUTUHAN_KHUSUS" type="radio" wire:model.defer="berkebutuhan_khusus" value="YA"
                <?= ($berkebutuhan_khusus == "YA") ? 'checked' : '' ?>>
              <label for="YA_BERKEBUTUHAN_KHUSUS">YA</label>
          </div>
          <div class="form-col">
            <input id="TIDAK_BERKEBUTUHAN_KHUSUS" type="radio" wire:model.defer="berkebutuhan_khusus" value="TIDAK"
                <?= ($berkebutuhan_khusus == "TIDAK") ? 'checked' : '' ?>>
              <label for="TIDAK_BERKEBUTUHAN_KHUSUS">TIDAK</label>
          </div>
      </div>
      @error('berkebutuhan_khusus') <span class="error">{{ $message }}</span>@enderror
    
      <br><br>
      <div class="form-section-title">
          <h4>DATA KONTAK</h4>
      </div>

      <label for="alamat">ALAMAT</label>
      <input id="alamat" type="text" wire:model.defer="alamat" required minlength="6"  placeholder="alamat tempat tinggal siswa">
      <span>@error('alamat') <span class="error">{{ $message }}</span>@enderror</span>

      <label for="kode-pos">KODE POS</label>
      <input id="kode-pos" type="number" wire:model.defer="kode_pos" required  placeholder="kode pos">
      <span>@error('kode_pos') <span class="error">{{ $message }}</span>@enderror</span>

      <label for="rtrw">RT/RW</label>
      <input id="rtrw" type="tel" pattern="[0-9]{3}/[0-9]{3}" wire:model.defer="RT_RW" required max="8" placeholder="(contoh : 003/010)">
      <span>@error('RT_RW') <span class="error">{{ $message }}</span>@enderror</span>

      <label for="kabupaten">KABUPATEN/KOTA</label>
      <input id="kabupaten" type="text" wire:model.defer="kabupaten" required minlength="3" max="60" placeholder="kabupaten atau kota">
      <span>@error('kabupaten') <span class="error">{{ $message }}</span>@enderror</span>

      <label for="telp">TELP.</label>
      <input id="telp" type="tel" wire:model.defer="telp" required minlength="3" max="60" placeholder='diawali nomor "08"'>
      <span>@error('telp') <span class="error">{{ $message }}</span>@enderror</span>

      <label for="email">EMAIL</label>
      <input id="email" type="email" wire:model.defer="email" required minlength="3" max="60" placeholder="@gmail.com">
      <span>@error('email') <span class="error">{{ $message }}</span>@enderror</span>

      <br>
      
      <div wire:loading wire:target="" class="text-blue-500">
        mengirim file... harap tunggu
        </div>
        <br>
        <div class="form-row">
            <!-- Disable button until file upload is complete -->
            <br>
            <button wire:loading.attr="disabled" class="submit-box-form" type="submit">
                <span wire:loading.remove>Submit</span>
                <span wire:loading>Tunggu...</span>
            </button>
        </div>

      <br><br>
    </form>
              
</div>

<script>

  
        $("#edit-photo").click(function () {
            $("#foto-profil").css("display", "flex !important");
        });
    

  var fieldId = ["image","nama_lengkap", "nisn", "ss_nisn", "tempat_lahir", 'kewarganegaraan',"tanggal_lahir", "bulanLahir", "tahunLahir", "jenis_kelamin", "agama", "jumlah_saudara", "anak_ke", "cita_cita", "buta_warna", "berkebutuhan_khusus", "alamat", "kode_pos", "RT_RW", "kabupaten", "telp", "email"] 

  fieldId.forEach(function(id){
    errors = data[id]
    
    if(errors !== undefined){
      errors.forEach(function(error){
        $('#data-diri [name="'+id+'"]').after('<li id="error-bag">'+error+'</li><br>')
      })
    }
  });
  data = null;



</script>

