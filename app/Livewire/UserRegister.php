<?php

namespace App\Livewire;

use Livewire\Component;
use App\Custom\Complete;
use App\Models\Akun;
use App\Models\Baik;
use App\Models\DataOrangTua;
use App\Models\DataSekolahAsal;
use App\Models\DataDiri;
use App\Models\KeteranganBaik;
use App\Models\Ranking;
use App\Models\Rapor; 
use App\Models\Sertifikat;
use App\Models\Undangan;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserRegister extends Component
{   
    public $nama, $kodeneg = "+62", $telepon, $email, $password, $password_confirmation;

    protected function rules()
    {
        return [
            'nama' => 'required|max:30|min:5',
            'kodeneg' => 'required',
            'telepon' => 'required|string|min:8|max:15|unique:akun,telepon',
            'email' => 'required|email|unique:akun,email',
            'password' => ['required', 'confirmed', Password::min(4)->letters()->mixedCase()->numbers()]
        ];
    }

    public function submit()
    {
        // Validasi data
        $validated = $this->validate();

        // Membersihkan dan menggabungkan kode negara dengan telepon
        $validated['kodeneg'] = isset($validated['kodeneg']) ? str_replace('+', '', $validated['kodeneg']) : '';
        $validated['telepon'] = $validated['kodeneg'] . $validated['telepon'];

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Tambahan field
        $validated['submited'] = null;
        $validated['nama'] = ucwords(strtolower($validated['nama']));

        // Buat akun baru
        $akun = Akun::create($validated);

        // Gunakan $akun->id langsung tanpa query ulang
        DataDiri::create(["akun_id" => $akun->id, "nama_lengkap" => $validated['nama']]);
        
        // Reset form setelah submit
        $this->reset(['nama', 'kodeneg', 'telepon', 'email', 'password', 'password_confirmation']);
        
        // Flash message
        session()->flash('success', 'Akun pendaftaran berhasil dibuat, silakan login');

        //return to login page
        return redirect()->to('auth/login');
    }

    public function render()
    {
        return view('livewire.user-register');
    }
}
