<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Login extends Controller
{
    function viewLogin(){
        
        return view('login_view');
    }

    function action_login(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->with('captcha','capthca harus di isi');
        }
        $credentials = $request->validate([
            'id_anggota' => ['required'],
            'password' => ['required'],
        ]);

        $data2 = user::where('id_anggota', $request->input('id_anggota'))->count();


        if($data2 != 0){

            $data = user::where('id_anggota', $request->input('id_anggota'))->first();
     
    
                if($data->is_active == '1'){
                    if (Auth::attempt($credentials)) {
                        $request->session()->regenerate();
            
                        return redirect()->intended('/dashboard');
                    }
                }
            }
            return back()  ->with('captcha','ID Anggota atau password salah!');
    }

    function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
