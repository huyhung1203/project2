<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkStudentLogin
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
        
        if(Auth::guard('student')->check()){ // kiểm tra người dùng đã đăng nhập hay chưa? Nếu đã đăng nhập thì bằng true, ngược lại là false
            return $next($request); 
        }
        return redirect(route('sinhvien.login')); // Nếu chưa đăng nhập thì quay trở lại trang login
    }
}
