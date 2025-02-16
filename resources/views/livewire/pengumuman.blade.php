<div id="pengumuman">
    <small>Waktu : {{date("Y-m-d H:i:s")}}</small>
    <br>
    <section id="administrasi">
        <h1>Seleksi Administrasi</h1>
        @if (date("Y-m-d") >= "2025-02-26")
            @if (Auth::user()->is_lolos_berkas === true)
            
                <br>
                <p>Panitia PPDB MAN 1 Kota Pekanbaru menyatakan anda</p>
                <h1 id="lolos-adm">LOLOS SELEKSI ADMINISTRASI</h1>
                <br>
                <p>Silahkan unduh dan cetak kartu tes/ujian anda dibawah ini untuk mengikuti seleksi tes akademik</p>
                <a style="font-size: larger;" href="{{url('berkas/kartu_ujian/'.Auth::user()->kartu_ujian)}}">UNDUH KARTU UJIAN</a> --}}
            @else
                <br>
                <p>Panitia PPDB MAN 1 Kota Pekanbaru menyatakan anda</p>
                <h1 id="tidak-lolos-adm">TIDAK LOLOS SELEKSI ADMINISTRASI</h1>
                <br>
                @if(Auth::user()->pesan_status_berkas)
                    <p>Alasan : {{Auth::user()->pesan_status_berkas}}</p>
                    <br>
                @endif
                <br>
                <p>Terima kasih dan Tetap Semangat!</p>
            @endif
        @else
        <h3>Belum ada pengumuman</h3>
        <br>
        <p>{{(new DateTime())->diff(new DateTime('2025-02-26 00:00:00'))->format('%a hari, %h jam, %i menit')}}</p>
        @endif

    </section>

    <br><br>

    <section>
        <h1>Hasil Seleksi Akademik / Hasil Ujian</h1>
        <h3>Belum ada pengumuman</h3>
    </section>



    @if(date("Y-m-d") >= "2025-03-07")
        
    
        @if( Auth::user()->is_lolos_ujian === true)
            <div id="lulus">
                <h4>SELAMAT ! ANDA DINYATAKAN </h4>
                <h1>LULUS</h1>
                <h4>SELEKSI PPDB REGULER MAN 1 KOTA PEKANBARU T.P. 2023/2024</h4>
                <br>
                <h4>Silahkan bergabung ke grup Whatsapp melalui tautan berikut</h4>
                <a href="https://chat.whatsapp.com/IxCDP7r2GsD4TSZ5dMnnvu"><h4>Tautan Grup Whatsapp</h4></a>
                
                <br>
                <br>
                <br>
                <table>
                    <tr>
                        <th>Nomor Registrasi</th>
                    </tr>
                    <tr>
                        <td>{{Auth::user()->id}}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                    </tr>
                    <tr>
                        <td>{{Auth::user()->dataDiri->nama_lengkap}}</td>
                    </tr>
                    <tr>
                        <th>NISN</th>
                    </tr>
                    <tr>
                        <td>{{Auth::user()->dataDiri->nisn}}</td>
                    </tr>
                    <tr>
                        <th>Asal Sekolah</th>
                    </tr>
                    <tr>
                        <td>{{Auth::user()->dataSekolahAsal->nama_sekolah_asal}}</td>
                    </tr>
                </table>
                <br>
                <h2>INFORMASI PENDAFTARAN ULANG</h2>
                <br>
                {{-- <ol style="text-align:left;" >
                    <li>Bagi Calon Peserta Didik Baru yang dinyatakan Lulus , diharapkan kehadiran Orang tua / Wali di MAN 1 Pekanbaru pada hari Selasa Tanggal 04 April 2023 Pukul 08.30 wib s/d selesai untuk mengikuti Pertemuan dengan Komite Madrasah.</li>
                    <br>
                    <li>Bagi Orang tua siswa / wali murid yang tidak hadir pada saat Pertemuan Orang tua / wali dengan pihak Komite dianggap menyetujui Hasil Pertemuan.</li>
                    <br>
                    <li>Pendaftaran Ulang bagi Peserta Didik Baru yang dinyatakan Lulus dilaksanakan pada :
                    <br>
                    <ol type="a" style="margin-left:1rem;">
                        <li>Selasa , Tanggal 04 April 2023 Pukul 10.00 Wib s/d Pukul 15.00 Wib</li>
                        <li>Rabu, Tanggal 05 April 2023 Pukul 07.30 Wib s/d Pukul 15.00 Wib</li>
                        <li>Kamis,  Tanggal 06 April 2023 Pukul 07.30 Wib s/d  Pukul 15.00 Wib</li>
                    </ol>
                    <br>
                    </li>
                    <br>
                    <li>Bagi Calon Peserta Didik Baru yang tidak melakukan Pendaftaran Ulang sesuai dengan Jadwal yang ditentukan dianggap mengundurkan diri dan dinyatakan gugur haknya sebagai calon siswa MAN 1 Pekanbaru Tahun Pelajaran 2023/2024.</li>
                    <br>
                    <li>Bagi Calon Peserta Didik baru yang dinyatakan Lulus dan telah melakukan pendaftaran Ulang diharuskan untuk mengikuti Psikotes pada hari sabtu tanggal 08 April 2023 Pukul 07.30 Wib.</li>
                    <br>
                    <li><b>Keputusan Panitia tidak dapat diganggu gugat.</b></li>
                </ol> --}}
                <br>
                <span style="text-align:right;">Kepala Madrasah <br><br>NORERLINDA, M.Pd</span>
            </div>
            
            
        @else
        
            <div id="tidak-lulus">
                <h4>MAAF ! ANDA DINYATAKAN </h4>
                <h1>TIDAK LULUS</h1>
                <h4>SELEKSI PPDB REGULER MAN 1 KOTA PEKANBARU </h4>
                <h4>Tetap semangat, ya!</h4>
                <br>
                <br>
                <table>
                    <tr>
                        <th>Nomor Registrasi</th>
                    </tr>
                    <tr>
                        <td>{{Auth::user()->id}}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                    </tr>
                    <tr>
                        <td>{{Auth::user()->dataDiri->nama_lengkap}}</td>
                    </tr>
                    <tr>
                        <th>NISN</th>
                    </tr>
                    <tr>
                        <td>{{Auth::user()->dataDiri->nisn}}</td>
                    </tr>
                    <tr>
                        <th>Asal Sekolah</th>
                    </tr>
                    <tr>
                        <td>{{Auth::user()->dataSekolahAsal->nama_sekolah_asal}}</td>
                    </tr>
                </table>
            </div>
        
        @endif
    
    @else
        <br>
        <h2>Pengumuman Kelulusan</h2><br><br>
        <div>
            <h4>Hitung mundur pengumuman seleksi reguler </h4> 
            <br>
            <h1 id="countdown"></h1>
        </div>
    @endif 
</div>

<script>
    var end = new Date('03/04/2025 00:0 AM');

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            document.getElementById('countdown').innerHTML = 'EXPIRED!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        document.getElementById('countdown').innerHTML = days + ' Hari: ';
        document.getElementById('countdown').innerHTML += hours + ' Jam: ';
        document.getElementById('countdown').innerHTML += minutes + ' Menit: ';
        document.getElementById('countdown').innerHTML += seconds + ' Detik ';
    }

    timer = setInterval(showRemaining, 1000);
    
</script>