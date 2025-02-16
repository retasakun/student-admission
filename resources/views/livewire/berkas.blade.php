<div id="page2">

    {{-- @if (Auth::user()->peminatan == "Undangan")
        @include('dashboard.raporratan.tab-berkas-undangan')
    @else
        @include('dashboard.raporratan.tab-berkas')
    @endif --}}

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

    <div id="tabel-rapor" > 
    <h2>Berkas Rapor </h2>
        
    <br>
    @if ($errors->any())
    <div class="text-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div id="scroll-rapor">
        <table id="data-rapor">
            @php
                $semesters = [1, 2, 3, 4, 5];
            @endphp
            
            @foreach ($semesters as $semester)
                <tr>
                    <th>Rapor Semester {{ $semester }}</th>
                    @php $nilai = "nilai_sem$semester"; $file = "file_sem$semester"; @endphp
                    @if ($rapor->$nilai)
                        <td>
                            <span>Nilai</span>
                            <div>
                                @foreach (json_decode($rapor->$nilai) as $mapel => $item)
                                    <ul>{{ "$mapel : $item" }}</ul>
                                @endforeach
                            </div>
                        </td>
                        {{-- <td>{{ $rapor->$file }}</td> --}}
                        <td><a target="_blank" href="{{ url("view-rapor/{$semester}") }}">Lihat Berkas</a></td>
                        <td>
                            @if (!isset(Auth::user()->submited))
                                <button wire:click="hapusRapor({{$semester}})" class="delete">
                                    <span wire:loading.remove>Hapus</span>
                                    <span wire:loading>Tunggu...</span>
                                </button>
                            @endif</td>
                    @else
                        <td></td>
                        <td id="rapor-belum-upload">Berkas Belum diupload</td>
                        <td>
                            @if (!isset(Auth::user()->submited))
                                <button class="upload" wire:click.prevent="openForm({{ $semester }})">Upload</button>
                            @endif
                        </td>
                    @endif
                </tr>
                <tr class="{{ $openSemester === $semester ? 'drop' : '' }}">
                    <td class="rapor-form" colspan="4">
                        <form class="tabel-rapor" wire:submit.prevent="submitRapor({{$semester}})">
    
    
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
                        
                            <div class="form-row">
                                <label for="nilai">Nilai IPA</label>
                                <input type="number"  required wire:model.defer="nilai_ipa" id="nilai" min="0" max="100">
                            </div>
                            @error('nilai_ipa') 
                                <div class="error">{{ $message }}</div>
                            @enderror
                        
                            <div class="form-row">
                                <label for="nilai">Nilai IPS</label>
                                <input type="number"  required wire:model.defer="nilai_ips" id="nilai" min="0" max="100">
                            </div>
                            @error('nilai_ips') 
                                <div class="error">{{ $message }}</div>
                            @enderror
                        
                            <div class="form-row">
                                <label for="nilai">Nilai Bahasa Inggris</label>
                                <input type="number"  required wire:model.defer="nilai_binggris" id="nilai" min="0" max="100">
                            </div>
                            @error('nilai_binggris') 
                                <div class="error">{{ $message }}</div>
                            @enderror
                        
                            <div class="form-row">
                                <label for="nilai">Nilai Matematika</label>
                                <input type="number"  required wire:model.defer="nilai_mtk" id="nilai" min="0" max="100">
                            </div>
                            @error('nilai_mtk') 
                                <div class="error">{{ $message }}</div>
                            @enderror
                        
                            <div class="form-row">
                                <label for="nilai">Nilai PAI</label>
                                <input type="number"  required wire:model.defer="nilai_pai" id="nilai" min="0" max="100">
                            </div>
                            @error('nilai_pai') 
                                <div class="error">{{ $message }}</div>
                            @enderror
                        
                            <p style="color:orange">Jika mata pelajaran agama lebih dari satu, yang diinputkan adalah rata-rata semua nilai pelajaran agama</p>
                        
                            <label for="file">UPLOAD RAPOR (gambar jpg, png, jpeg; max : 2 MB)</label>
                            <br>
                            <input type="file" id="file" wire:model.defer="file_rapor" accept="image/png, image/jpeg, application/pdf">
                            @error('file_rapor') 
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <div wire:loading wire:target="file_rapor" class="text-blue-500">
                                mengirim file... harap tunggu
                            </div>
                            <br>
                            <div class="form-row">
                                <!-- Disable button until file upload is complete -->
                                <button wire:loading.attr="disabled" class="submit-box-form" type="submit">
                                    <span wire:loading.remove>Submit</span>
                                    <span wire:loading>Tunggu...</span>
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            
            <tr>
                <th>Lembar Rekap Nilai</th>
                @if ($rapor->file_rekap)
                    <td></td>
                    <td><a target="_blank" href="{{ url("/view-rekap-nilai/") }}">Lihat Berkas</a></td>
                    <td>
                        @if (!isset(Auth::user()->submited))
                            <button wire:click="hapusRekap()" class="delete">
                                <span wire:loading.remove>Hapus</span>
                                <span wire:loading>Tunggu...</span>
                            </button>
                        @endif
                    </td>
                @else
                    <td></td>
                    <td id="rapor-belum-upload">Berkas Belum diupload</td>
                    <td>
                        @if (!isset(Auth::user()->submited))
                            <button class="upload" wire:click.prevent="openForm('rekap')">Upload</button>
                        @endif
                    </td>
                @endif
            </tr>
            <tr class="{{ $openSemester === "rekap" ? 'drop' : '' }}">
                <td class="rapor-form" colspan="4">
                    <form id="rekap-nilai" wire:submit.prevent="submitRekap" >
    
                        <ul style="color: orange">
                            <li>Pastikan berkas rekapitulasi nilai yang disertakan sesuai dengan format di bawah ini </li>
                            <li> Pastikan berkas rekapitulasi nilai harus bertanda tangan Kepala sekolah/mewakili dari sekolah asal</li>
                        </ul>
                        
                        <a href="{{url('/format/FORMAT%20REKAPITULASI%20NILAI%20RAPOR.docx')}}">Unduh Format Rekapitulasi Nilai Rapor</a>
                        <br>
                        <label for="">Berkas Rekapitulasi Nilai Rapor (gambar jpg, png, jpeg; max : 2MB)</label>
                        <br>
                        <input type="file" name="file" wire:model.defer="file_rekap" required  accept="image/png, image/jpeg">
                        
                        <div wire:loading wire:target="file" class="text-blue-500">
                            mengirim file... harap tunggu
                        </div>
                        <br>
                        <div class="form-row">
                            <!-- Disable button until file upload is complete -->
                            <button wire:loading.attr="disabled" class="submit-box-form" type="submit">
                                <span wire:loading.remove>Submit</span>
                                <span wire:loading>Tunggu...</span>
                            </button>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
    </div>

    @php
        $semesters = [1, 2, 3, 4, 5];
    @endphp

    @foreach ($semesters as $semester)
        <input type="hidden" wire:model.defer="semester" value="{{$semester}}">
    @endforeach
    
    </div>

    <div id="ket-berkelakuan-baik">
        <br><br>
        <h2>Surat Keterangan Berkelakuan Baik</h2>
        <br>
        <table>
            @if ($fileKetBaik)
            <tr>
                <td dir="rtl">
                    {{$fileKetBaik}}
                </td>
                <td id="rapor-belum-upload">
                    <a href="{{url('/view-surat-berkelakuan-baik/')}}">lihat berkas</a>
                </td>
                <td>
                    @if (!isset(Auth::user()->submited))
                     <button class="delete" wire:click.prevent="hapusKetBaik">
                        <span wire:loading.remove>Hapus</span>
                        <span wire:loading>Tunggu...</span>
                     </button> 
                    @endif
                </td>
            </tr>
            @else
                <tr>
                    <td dir="rtl">
                
                    </td>
                    <td id="rapor-belum-upload">
                        Belum Diupload!
                    </td>
                    <td>
                        @if (!isset(Auth::user()->submited))  
                            <button class="upload" wire:click.prevent="openForm('ketBaik')">Upload</button> 
                        @endif
                    </td>
                </tr>
            @endif
            <tr class="{{ $openSemester === "ketBaik" ? 'drop' : '' }}">
                <td class="rapor-form" colspan="3">
                    <form id="upload-kelakuan-baik" wire:submit.prevent="submitKetBaik">

                        <div class="form-section-title">
                            <h4>UPLOAD SURAT KETERANGAN BERKELAKUAN BAIK</h4>
                        </div>
                    
                        <br>
                        <label for="file">UPLOAD SURAT KETERANGAN BERKELAKUAN BAIK (gambar jpg, png, jpeg; max : 2 MB)</label>
                        <input  type="file" id="file" required wire:model.defer="inputKetBaik" accept="image/png, image/jpeg">
                        
                        <div wire:loading wire:target="file" class="text-blue-500">
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
                </td>
            </tr>
        </table>
    </div>

</div>