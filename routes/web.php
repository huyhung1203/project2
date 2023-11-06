<?php


use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginStudentController;
use App\Http\Controllers\MajorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('student_show/', function () {
    return view('student_show.index');
});
Route::get('student_show/checkpoint', function () {
    return view('student_show.checkpoint');
});
Route::get('student_show/profile', function () {
    return view('student_show.profile');
});
Route::get('student_show/login', function () {
    return view('student_show.login');
});


Route::group(['prefix'=>'admin','name'=>'admin'],function(){
    Route::middleware(['guest:admin','CheckLogout'])->group(function(){
        Route::get('/login', function () {
            return view('admin.login');
        })->name('admin.login');
        Route::post('/check',[LoginController::class,'dangnhap'])->name('checklogin');

    });

    Route::middleware(['auth:admin','CheckLogout'])->group(function(){

        // Route::get('admin/', function () {
        //     return view('admin.index');
        // })->name('adminL');
        // Route::view('/home','admin.home')->name('home');

        Route::get('/profile', function () {
            return view('admin.profile');
        });

         Route::post('/logout',[LoginController::class,'dangxuat'])->name('checklogout');


         Route::resource('subject',SubjectController::class);
         Route::resource('student',StudentController::class);
         Route::resource('score',ScoreController::class);
         Route::resource('major',MajorController::class);
         Route::resource('course',CourseController::class);
         Route::resource('class',ClassController::class);
    });
});
Route::group(['prefix'=>'sinh-vien'], function(){
    Route::get('dang-nhap', [LoginStudentController::class, 'showLoginForm'])->middleware('checkStudentLogout')->name('sinhvien.login');
    Route::post('dang-nhap', [LoginStudentController::class, 'login'])->name('sinhvien.login');

    Route::group(['prefix'=>'/', 'middleware'=>'checkStudentLogin'], function(){
        Route::get('/',function(){
            return view('dang_nhap/index');
        })->name('sinhvien.index');
        Route::post('/logout',[LoginStudentController::class,'dangxuat'])->name('checkstlogout');
    });
});
