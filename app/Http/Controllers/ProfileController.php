<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.setting');
    }

    public function changePassword(Request $request){
        $id_user    = Auth::user()->id_user;
        $get_user   = User::where("id_user",$id_user)->first();

        $get_oldPassword = $request->oldPassword;
        $get_newPassword = $request->newPassword;

        if(!password_verify($get_oldPassword, $get_user->password)){
            return redirect()->route('profile')->with('Failed', 'Password lama salah dimasukan!');
        }

        if ($get_newPassword === $get_oldPassword) {
            return redirect()->route('profile')->with('Failed', 'Password baru tidak boleh sama dengan password lama!');
        }

        $hashed_newPassword = Hash::make($get_newPassword);
        $get_user->password = $hashed_newPassword;
        $get_user->save();

        return redirect()->route('profile')->with('Success', 'Password berhasil diubah!');


    }
}
