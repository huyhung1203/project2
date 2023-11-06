<?php

namespace App\Http\Controllers;

use App\Models\ScoreModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginStudentController extends Controller
{
    //
    public function showLoginForm() {
        return view('dang_nhap.login');
    }

    public function login(Request $request) {
        $students = [
            $this->username() => $request->ma_sinhvien,
            'password' =>  $request->mat_khau
        ];

        $masv = $request->ma_sinhvien;
        // dd(Auth::guard('student')->attempt($students));
        if(Auth::guard('student')->attempt($students)) {
            //  return redirect()->route('sinhvien.index');
            $show = ScoreModel::showAll($masv);
            // dd($show);
            return view('dang_nhap.index',['DBshow'=>$show]);
        }else{
            return redirect()->back()->with('fail','Đăng nhập thất bại');
        }
    }

    // mặc định trong laravel sẽ sử dụng email và password để đăng nhập, nếu e thay đổi bất kỳ tên một cột nào thì phải định nghĩa lại nó
    public function username() {
        return 'Ma_SV';
    }
    function dangxuat(){
        Auth::guard('student')->logout();
        return redirect()->route('sinhvien.login');
    }
}
