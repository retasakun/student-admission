<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\DataOrangTua;


Route::get('/view-rapor/{semester}', function ($semester) {
    $user = Auth::user();

    if (!$user) {
        abort(403, 'Unauthorized');
    }

    // Cek apakah file ada di storage private
    $semesterKey = "file_sem" . $semester; // Contoh: file_sem1, file_sem2, dst.
    $path = "private/rapor/{$user->rapor->$semesterKey}"; 
 
    $fullPath = storage_path("app/{$path}"); // Pastikan menuju ke storage/app/private/rapor

    if (!file_exists($fullPath)) {
        abort(404, 'File tidak ditemukan');
    }

    return response()->file($fullPath, [
        'Content-Type' => mime_content_type($fullPath), // Ambil mime type dari PHP bawaan
        'Content-Disposition' => 'inline', // Agar tampil di tab baru
    ]);
});
Route::get('/view-rekap-nilai', function () {
    $user = Auth::user();

    if (!$user) {
        abort(403, 'Unauthorized');
    }

    // Cek apakah file ada di storage private
    $path = "private/rekap-nilai/{$user->rapor->file_rekap}"; 
 
    $fullPath = storage_path("app/{$path}"); // Pastikan menuju ke storage/app/private/rapor

    if (!file_exists($fullPath)) {
        abort(404, 'File tidak ditemukan');
    }

    return response()->file($fullPath, [
        'Content-Type' => mime_content_type($fullPath), // Ambil mime type dari PHP bawaan
        'Content-Disposition' => 'inline', // Agar tampil di tab baru
    ]);
});
Route::get('/view-foto-profile', function () {
    $user = Auth::user();

    if (!$user) {
        abort(403, 'Unauthorized');
    }

    // Cek apakah file ada di storage private
    $path = "private/foto-profile/{$user->dataDiri->foto}"; 
 
    $fullPath = storage_path("app/{$path}"); // Pastikan menuju ke storage/app/private/rapor

    if (!file_exists($fullPath)) {
        abort(404, 'File tidak ditemukan');
    }

    return response()->file($fullPath, [
        'Content-Type' => mime_content_type($fullPath), // Ambil mime type dari PHP bawaan
        'Content-Disposition' => 'inline', // Agar tampil di tab baru
    ]);
});
Route::get('/view-surat-berkelakuan-baik', function () {
    $user = Auth::user();

    if (!$user) {
        abort(403, 'Unauthorized');
    }

    // Cek apakah file ada di storage private
    $path = "private/surat-berkelakuan-baik/{$user->keteranganBaik->file}"; 
 
    $fullPath = storage_path("app/{$path}"); // Pastikan menuju ke storage/app/private/rapor

    if (!file_exists($fullPath)) {
        abort(404, 'File tidak ditemukan');
    }

    return response()->file($fullPath, [
        'Content-Type' => mime_content_type($fullPath), // Ambil mime type dari PHP bawaan
        'Content-Disposition' => 'inline', // Agar tampil di tab baru
    ]);
});
Route::get('/view-ss-nisn', function () {
    $user = Auth::user();

    if (!$user) {
        abort(403, 'Unauthorized');
    }

    // Cek apakah file ada di storage private
    $path = "private/screenshoot-nisn/{$user->dataDiri->ss_nisn}"; 
 
    $fullPath = storage_path("app/{$path}"); // Pastikan menuju ke storage/app/private/rapor

    if (!file_exists($fullPath)) {
        abort(404, 'File tidak ditemukan');
    }

    return response()->file($fullPath, [
        'Content-Type' => mime_content_type($fullPath), // Ambil mime type dari PHP bawaan
        'Content-Disposition' => 'inline', // Agar tampil di tab baru
    ]);
});
Route::get('/view-formulir', function () {
    $user = Auth::user();

    if (!$user) {
        abort(403, 'Unauthorized');
    }

    // Cek apakah file ada di storage private
    $path = "private/formulir-pendaftaran/{$user->formulir}"; 
 
    $fullPath = storage_path("app/{$path}"); // Pastikan menuju ke storage/app/private/rapor

    if (!file_exists($fullPath)) {
        abort(404, 'File tidak ditemukan');
    }

    return response()->file($fullPath, [
        'Content-Type' => mime_content_type($fullPath), // Ambil mime type dari PHP bawaan
        'Content-Disposition' => 'inline', // Agar tampil di tab baru
    ]);
});
Route::get('/view-bukti-pendaftaran', function () {
    $user = Auth::user();

    if (!$user) {
        abort(403, 'Unauthorized');
    }

    // Cek apakah file ada di storage private
    $path = "private/bukti-pendaftaran/{$user->bukti}"; 
 
    $fullPath = storage_path("app/{$path}"); // Pastikan menuju ke storage/app/private/rapor

    if (!file_exists($fullPath)) {
        abort(404, 'File tidak ditemukan');
    }

    return response()->file($fullPath, [
        'Content-Type' => mime_content_type($fullPath), // Ambil mime type dari PHP bawaan
        'Content-Disposition' => 'inline', // Agar tampil di tab baru
    ]);
});

Route::get('/', function () {
    return view('informasi');
});

Route::get('/auth/login', function () {
    return view('auth.user-login');
})->name('login');

Route::get('/auth/register', function () {
    
    return view('auth.user-register');
});

Route::get('/dashboard', function(){

    return view('dashboard.dashboard');
})->name('dashboard');

Route::get('/tes', function(){
    dd(App\Services\Complete::isSubmitable());
})->name('tes');



        
 


    
