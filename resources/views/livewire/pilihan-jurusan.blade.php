<div id="pilihan-jurusan">

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

    <h2>Pilih Peminatan</h2>
    <br>
    <form wire:submit.prevent="submit">
            <label for="radio-timteng" class="pilihan">
                <input wire:model="peminatan" type="radio" 
                @if($peminatan === "Kelas Timur Tengah") checked @endif required name="peminatan" value="Kelas Timur Tengah" id="radio-timteng">
                Kelas Persiapan Timur Tengah
            </label>
            <label for="radio-umum" class="pilihan">
                <input wire:model="peminatan" type="radio" 
                @if($peminatan === "Kelas Umum") checked @endif required name="peminatan" value="Kelas Umum" id="radio-umum">
                Kelas Umum
            </label>
            <label for="radio-tahfidz" class="pilihan">
                <input wire:model="peminatan" type="radio" 
                @if($peminatan === "Tahfidz") checked @endif required name="peminatan" value="Tahfidz" id="radio-tahfidz">
                Kelas Tahfidz
            </label>
        <br>
        <button type="Submit">
            @if($peminatan) 
                Ganti Peminatan 
            @else 
                Pilih Peminatan 
            @endif 
        </button> 
    </form>
    
</div>