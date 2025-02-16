@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{url('css/informasi.css')}}">
    <link rel="stylesheet" href="{{url('css/informasi-responsive.css')}}">
@endpush

@section('content')

<nav>
    <div id="nav-brand">
        <img id="logo-kemenag" src="{{url('assets/logokemenag.png')}}" alt="">
        <img id="logo-cambridge" src="{{url('assets/logocambridge.png')}}" alt="">
        <img id="logo-man" src="{{url('assets/logoman1.png')}}" alt="">
        <h1>PPDB MAN 1 PEKANBARU</h1>
    </div>
    <div id="nav-options">
        <a href="#umum">PERSYARATAN</a>
        <a href="#prosedur">PROSEDUR</a>
        <a href="#jadwal">ALUR</a>
        <a href="#kontak">KONTAK</a>
    </div>
</nav>

<div id="welcome">
    <div>
        <img src="{{url('assets/logoman1.png')}}" alt="">
        <h1>SELAMAT DATANG DI APLIKASI PPDB <br> <span>MAN 1 KOTA PEKANBARU</span> <br> TAHUN AJARAN 2025/2026</h1>
        
        @if(date("Y-m-d") >= "2025-01-20")
            <a id="masuk" href="{{url("auth/login")}}">MASUK KE PENDAFTARAN</a>
        @else
            <a id="masuk-belum">PENDAFTARAN BELUM DIBUKA</a>
        @endif
    </div>
</div>

<div id="info-penting">
    <div class="sec-content">
        <h1 class="sec-title dark-blue">INFO PENTING</h1>
        <p>Belum ada informasi penting</p>
    </div>
</div>

<div id="umum" class="persyaratan">
    <div class="sec-content">
        <h1 class="sec-title light-blue">PERSYARATAN UMUM</h1>
        <ol>
            <li>Warga Negara Indonesia</li>
            <li>Beragama Islam</li>
            <li>Mampu Membaca Al-Qur'an</li>
            <li>Berstatus aktif di sistem  EMIS / Dapodik (scan Nomor Induk Siswa Nasional (NISN) asli yang terverifikasi secara online).</li>
            <li>Merupakan siswa-siswi yang berada di kelas 9 MTs/SMP atau maksimal berusia 18 Tahun pada tanggal 1 Juli 2025</li>
            <li>Berkelakuan baik, dibuktikan dengan surat kelakuan baik dari Sekolah asal</li>
            <li>Memiliki Foto Copy rapor  yang telah dilegalisir dari semester 1 sd 5 </li>
            <li>Pas foto ukuran 3x4 sebanyak  4 lembar</li>
        </ol>
    </div>
</div>

<div id="khusus" class="persyaratan">
    <div class="sec-content">
        <h1 class="sec-title dark-blue">PERSYARATAN KHUSUS</h1>
        <h2>Jalur Undangan</h2>
        <ol>
            <li>Memenuhi persyaratan umum</li>
            <li>Merupakan siswa berprestasi (Juara  KSN , KSM ,  lomba yang diselengggarakan oleh Kemendikbud / Pusprenas, Kemenag, Kemenpora ) yang terpilih atas <b>undangan khusus</b> dari MAN 1 Pekanbaru</li>
            <li>Tanpa Tes</li>
            <li>Bersedia mengikuti Psikotest dengan biaya sendiri</li>
        </ol>
        <h2>Jalur PSU Kualifikasi Prestasi Akademik</h2>
        <ol>
            <li>Memenuhi persyaratan umum</li>
            <li>Termasuk  Rangking  1 – 5 besar yang sudah ditanda tangani oleh kepala madrasah / sekolah</li>
            <li>Bagi yang tidak termasuk 5 besar harus memiliki  rata rata nilai pengetahuan  90  (5 semester)  untuk setiap mata pelajaran (IPA, IPS, MATEMATIKA, B.INDONESIA,  B. INGGRIS dan PAI (bagi SMP) Al quran hadist, Fiqih, Akidah Akhlak, SKI ( bagi MTs)  Ditandatangani oleh kepala Madrasah/Sekolah)</li>
            <li>Bersedia Mengikuti Tes</li>
            <li>Jika Dinyatakan Lulus, Bersedia mengikuti Psikotest dengan biaya sendiri</li>
        </ol>
        <h2>Jalur PSU Kualifikasi Prestasi Bakat Minat</h2>
        <ol>
            <li>Memenuhi persyaratan umum</li>
            <li>Sertifikat juara 1,2, 3 terbaik / medali  ( KSN,KSM ,Olimpiade Mata Pelajaran, Karya Ilmiah, Robotik)  atau non akademik  (olahraga, seni, MTQ) minimal juara  tingkat  Provinsi  (lomba yang diselenggarakan oleh lembaga Resmi seperti Kemenag, Kemendikbud/ Pusprenas, Kemenpora)</li>
            <li>Sertifikat Hafidz Quran minimal 15 Juz (Mutqin 3 Juz)</li>
            <li>Bersedia Mengikuti Tes</li>
            <li>Jika Dinyatakan Lulus, Bersedia mengikuti Psikotest dengan biaya sendiri</li>
        </ol>
        <h2>Jalur PSU Kualifikasi Prestasi Bakat Minat</h2>
        <ol>
            <li>Memenuhi persyaratan umum</li>
            <li>Bersedia Mengikuti Tes</li>
            <li>Jika Dinyatakan Lulus, Bersedia mengikuti Psikotest dengan biaya sendiri</li>
        </ol>
    </div>
</div>

<div id="tata-cara-seleksi">
    <div class="sec-content">
        <h1 class="sec-title light-blue"> SELEKSI / TES</h1>
        <ol>
            <li>Dalam hal seleksi calon peserta didik baru dilaksanakan sebelum nilai hasil ujian MTs / SLTP keluar, seleksi didasarkan pada hasil Tes Akademik yang diselenggarakan oleh MAN 1 Pekanbaru </li>
            <li>Tes akademik yang diselenggarakan sesuai dengan Materi tes nya adalah sebagai berikut : 
                <ol type="a">
                    <li>Bahasa Inggris</li>
                    <li>Bahasa Indonesia</li>
                    <li>Matematika</li>
                    <li>IPA Terpadu</li>
                    <li>IPS</li>
                    <li>Pendidikan Agama Islam </li>
                </ol>
            </li>
            <li>Untuk peserta didik  yang memilih program  kelas Timur Tengah  akan ada tes wawancara Tahfidz dan B. Arab (Wajib tinggal di Asrama) </li>
            <li>Calon peserta didik  jalur tahfidz  akan mengikuti tes hafalan Al quran </li>
            <li>Seluruh peserta mengikuti tes baca  al quran</li>
        </ol>
    </div>
</div>

<div id="jadwal">
    <div class="sec-content">
        <h1 class="sec-title dark-blue">JADWAL PELAKSANAAN</h1>
        <table cellspacing="15">
            <tr>
                <th>NO</th>
                <th>JADWAL</th>
                <th>TANGGAL</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>SOSIALISASI</td>
                <td>14 Januari s.d. 20 Januari 2025</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>PENDAFTARAN ONLINE DAN UPLOAD BERKAS</td>
                <td>20 Januaru s.d. 26 Januari 2025</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>SELEKSI ADMINISTRASI</td>
                <td>27 Januari s.d. 28 Januari 2025</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>PENGUMUMAN SELEKSI ADMINISTRASI</td>
                <td>29 Januari 2025</td>
            </tr>
            <tr>
                <td>5.</td>
                <td>SIMULASI TES CBT</td>
                <td>30 Januari 2025</td>
            </tr>
            <tr>
                <td>6.</td>
                <td>TES AKADEMIK, TES  BACA AL QURAN, UJI HAFALAN TAHFIDZ</td>
                <td>1 Februari 2025</td>
            </tr>
            <tr>
                <td>7.</td>
                <td>PENGUMUMAN KELULUSAN</td>
                <td>2 Februari 2025</td>
            </tr>
            <tr>
                <td>8.</td>
                <td>PERTEMUAN WALI MURID</td>
                <td>7 Februari 2025</td>
            </tr>
            <tr>
                <td>9.</td>
                <td>DAFTAR ULANG</td>
                <td>7 Februari S.D 9 Februari 2025</td>
            </tr>
            <tr>
                <td>10.</td>
                <td>PSIKOTEST</td>
                <td>15 Februari 2025</td>
            </tr>
        </table>
    </div>
</div>


<div id="prosedur">
    <div class="sec-content">
        <h1 class="sec-title light-blue">PROSEDUR PENDAFTARAN</h1>
        <ol>
            <li>Calon peseta didik baru dapat melakukan registrasi dan mengisi data diri dengan lengkap dan benar di website  <a href="https://ppdb.man1kotapekanbaru.sch.id">ppdb.man1kotapekanbaru.sch.id</a></li>
            <li>Calon peserta didik baru mengupload persyaratan PPDB
                <ol type="a">
                    <li>Formulir pernyataan rangking  1 - 5 besar yang sudah ditanda tangani oleh kepala madrasah / kepala sekolah (blanko tersedia)</li>
                    <li>Bagi Siswa jalur undangan, mengupload surat asli undangan khusus dari MAN 1 Pekanbaru</li>
                    <li>Bagi yang tidak termasuk 5 besar harus memiliki  rata rata nilai 90 (5 semester)  untuk  setiap mata pelajaran : IPA, IPS, Matematika, B. Inggris, B. Indonesia, PAI (bagi SMP) Al quran hadist, Fiqih, Akidah Akhlak, SKI( bagi MTs)  Ditandatangani oleh kepala Madrasah/Sekolah </li>
                    <li>Peserta dengan kualifikasi prestasi Bakat Minat mengupload Sertifikat prestasi 3 terbaik  akademik ( KSN,KSM ,olimpiade Mata Pelajaran, Robotik, lomba karya ilmiah )  atau non akademik  (olahraga, seni, Tahfidz ) yang dimiliki  minimal tingkat Provinsi   (yang diselenggarakan oleh lembaga Resmi seperti Kemenag, Kemendikbud/ Pusprenas, Kemenpora) </li>
                    <li>Mengupload Foto copy rapor  yang telah dilegalisir</li>
                    <li>Mengupload Screen shoot  NISN</li>
                    <li>Mengupload Soft file pas  photo </li>
                </ol>
            </li>
            <li>Peserta yang dinyatakan lulus berkas administrasi  berhak mengikuti  Test Akademik </li>
            <li>Print Out Kartu Ujian dan Formulir Biodata  diserahkan kepada panitia sebelum pelaksanaan test akademik dimulai.</li>
            <li>Pelaksanaan test akademik  dilaksanakan di MAN 1 Pekanbaru (offline)  menggunakan sistim  CBT  maka peserta wajib membawa perangkat berupa HP Android/Laptop/Tablet, serta pastikan perangkat dalam keadaan baik dan terkoneksi internet.</li>
        </ol>
    </div>
</div>


<div id="peminatan">
    <div class="sec-content">
        <h1 class="sec-title">Pilihan Peminatan</h1>
        <br>
        <ol>
            <li>Pilihan Peminatan Kelas Timur Tengah</li>
            <br>
            <li>Pilihan Peminatan Umum</li>
            <br>
            <li>Pilihan Peminatan Tahfidz</li>
        </ol>
    </div>
</div>

<div id="kontak">
    <div class="sec-content">
        <h1>KONTAK KAMI</h1>
        <br>
        <h3>Perlu bantuan? Hubungi :</h3>
        <h3><i class="fa-solid fa-phone"></i> HUMAS : +628126817392</h3>
        <h3><i class="fa-solid fa-clock"></i>JAM LAYANAN HARI SENIN - JUMAT  08.00 s.d. 16.00 WIB</h3>
        <h3><i class="fa-solid fa-location-dot"></i>ALAMAT Jl. Bandeng No. 51A Kec. Marpoyan Damai Kota. Pekanbaru</h3>
    </div>
</div>

@include('misc.footer')

@endsection

