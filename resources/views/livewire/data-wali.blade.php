<form wire:submit.prevent="submit" id="data-wali" class="form-area">
    <div class="form-section-title">
        <h4>DATA WALI</h4>
    </div>

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

    <label for="">NAMA WALI</label>
    <input type="text" wire:model.defer="nama" required minlength="3" maxlength="60" placeholder="Nama Wali">
    @error('nama') <span class="error">{{ $message }}</span> @enderror

    <label for="">TEMPAT LAHIR</label>
    <input type="text" wire:model.defer="tempat_lahir" required minlength="3" maxlength="60" placeholder="Tempat Lahir">
    @error('tempat_lahir') <span class="error">{{ $message }}</span> @enderror

    <label for="">TANGGAL LAHIR</label>
    <div class="form-row">
        <div class="form-col">
            <select wire:model.defer="tanggal_lahir">
                @for ($i = 1; $i <= 31; $i++)
                    <option value="{{ $i }}" {{ $i == $tanggal_lahir ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="form-col">
            <select wire:model.defer="bulan_lahir">
                @foreach (['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'] as $bulan)
                    <option value="{{ $bulan }}" {{ $bulan == $bulan_lahir ? 'selected' : '' }}>{{ $bulan }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-col">
            <input type="number" wire:model.defer="tahun_lahir" placeholder="Tahun">
        </div>
    </div>
    @error('tanggal_lahir') 
        <div class="error">{{ $message }}</div>
    @enderror
    

    <label for="">ALAMAT</label>
    <input type="text" wire:model.defer="alamat" required minlength="3" maxlength="255" placeholder="Alamat Ibu">
    @error('alamat') 
        <span class="error">{{ $message }}
    </span> @enderror

    <div class="form-row radio">
        <div class="form-col">
            <input id="alamat-sama-peserta" type="checkbox" wire:click="copyAlamat">
            <label for="alamat-sama-peserta">*Alamat sama dengan peserta</label>
        </div>
    </div>

    <div class="form-row">
        <div class="form-col">
            <label for="">RT/RW</label>
            <input type="text" wire:model.defer="RT_RW" pattern="[0-9]{3}/[0-9]{3}" required placeholder="(contoh : 003/010)">
        </div>
    </div>
    @error('RT_RW') 
        <div class="error">{{ $message }}</div>
    @enderror

    <div class="form-col">
        <label for="">TELP. WALI</label>
        <input type="tel" wire:model.defer="telp" required minlength="10" maxlength="14" placeholder='diawali angka "08"'>
    </div>
    @error('telp') 
        <div class="error">{{ $message }}</div>
    @enderror

    <div class="form-row">
        <div class="form-col">
            <label for="">PENDIDIKAN WALI</label>
            <select wire:model.defer="pendidikan">
                @foreach (['SD/Sederajat', 'SMP/Sederajat', 'SMA/Sederajat', 'D1', 'D2', 'D3', 'D4/S1', 'S2', 'S3', 'Tidak Bersekolah'] as $edu)
                    <option value="{{ $edu }}">{{ $edu }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-col">
            <label for="">PEKERJAAN WALI</label>
            <select wire:model.defer="pekerjaan">
                @foreach (['Tidak Bekerja', 'Pensiunan', 'PNS', 'TNI/Polisi', 'Guru/Dosen', 'Pegawai Swasta', 'Wiraswasta', 'Dokter/Bidan/Perawat', 'Pedagang', 'Petani/Peternak', 'Nelayan', 'Buruh (Tani/Pabrik/Bangunan)', 'Sopir/Masinis/Kondektur', 'Politikus', 'Lainnya'] as $job)
                    <option value="{{ $job }}">{{ $job }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
        @error('pendidikan') 
            <div class="form-col">
                <div class="error">{{ $message }}</div>
            </div>
        @enderror
        @error('pekerjaan') 
            <div class="form-col">
                <div class="error">{{ $message }}</div>
            </div>
        @enderror
    </div>

    <label for="">PENGHASILAN RATA-RATA per BULAN (Rp.)</label>
    <select wire:model.defer="penghasilan">
        @foreach (['Tidak ada', 'Kurang dari 500.000', '500.000 - 1.000.000', '1.000.001 - 2.000.000', '2.000.001 - 3.000.000', '3.000.001 - 5.000.000', 'Lebih dari 5.000.000'] as $income)
            <option value="{{ $income }}">{{ $income }}</option>
        @endforeach
    </select>
    @error('penghasilan') 
        <div class="error">{{ $message }}</div>
    @enderror

    <br>
    <div class="form-row">
        <button type="submit" class="submit-box-form">SIMPAN</button>
    </div>
</form>
