<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //

    function dangnhap(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password'=>'required'
        ],[
            'email.required'=> 'Email không được để trống!',
            'password.required'=> 'Password không được để trống!',

        ]
    );
        $user = [
            'email' => $request->email,
            'password' => $request->password
        ];


        // dd($user);
        if(Auth::guard('admin')->attempt($user)){
            // $name = Auth::guard('admin')->user()->name;
            // dd($name);
                return redirect()->intended('admin/student');
            // return "Thafnh cong";
        }
        else{
            return redirect()->route('admin.login')->with('fail','Sai thông tin đăng nhập');
        }
    }
    public function redirectTo(){
        Redirect::route('admin.home');
    }
    function dangxuat(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
