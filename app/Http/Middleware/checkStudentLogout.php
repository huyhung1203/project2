<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkStudentLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('student')->check()){ // Kiểm tra người dùng còn đăng nhập hay không?
            return redirect(route('sinhvien.index')); // Nếu còn đăng nhập thì ngăn chặn trở về trang login bằng cách điều hướng sang trang chủ của sinhvien
            
        }
        return $next($request);
    }
}
