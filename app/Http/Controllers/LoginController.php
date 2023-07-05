<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(){
            // dd(Auth::check());
            return view('login.index');
    }

    //LOGIN
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)){
            // Auth::user()->id;
            $request->session()->regenerate();
            // dd(Auth::user());
            return view('login.index', ['loginSuccess' => 'Login berhasil!']);

            // $data = DB::table('users')->get();
            // dd($data);

            // if (session()->has('username')) {
            //     $userId = session('username');
            //     // Sesuai dengan tindakan yang diperlukan
            //     echo "Sesi username ada. Nilainya adalah: " . $userId;
            // } else {
            //     // Sesuai dengan tindakan yang diperlukan jika sesi tidak ada
            //     echo "Sesi username tidak ada.";
            // }

        }else{
            return back()->with('loginError', 'Username/Password salah!');
        }
    }


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('logoutSuccess', 'Berhasil Logout');
    }
}
