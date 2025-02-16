<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserLogin extends Component
{
    public $email, $password;

    protected function rules()
    {   
        return [
           'email' => 'required',
           'password' => 'required'
        ];
    }

    public function submit(){
        $validator = $this->validate();
        
        if(Auth::guard('akun')->attempt($validator)){
            session()->regenerate(); // prevents session fixation attack

            Auth::user()->update([
                "last_login_at" => date("Y-m-d H:m:s")
            ]);


            // if(!(Auth::user()->submited && Complete::submitable())){
            //     Auth::user()->update([
            //         "submited" => null,
            //         "last_login_at" => date("Y-m-d H:m:s")
            //     ]);
            // }

            // return $this->redirectRoute('dashboard');
            return redirect()->to('dashboard');
        }else{
            session()->flash('fail', 'email atau password salah!');
        }

        
    }

    public function render()
    {   
        return view('livewire.user-login');
    }
}
