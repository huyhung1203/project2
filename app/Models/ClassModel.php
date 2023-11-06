<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassModel extends Model
{
    use HasFactory;
    static function getClass(){
        return DB::table('class_models')
        ->join('majors_models','class_models.Ma_nganh','=','majors_models.Ma_nganh')
        ->join('course_models','class_models.Ma_khoa','=','course_models.Ma_khoa')
        ->select('class_models.*','majors_models.*','course_models.*')
        ->get();
    }
    static function getClassSearch1(Request $request){
        return DB::table('class_models')
        ->join('majors_models','class_models.Ma_nganh','=','majors_models.Ma_nganh')
        ->join('course_models','class_models.Ma_khoa','=','course_models.Ma_khoa')
        ->select('class_models.*','majors_models.*','course_models.*')
        ->where('majors_models.Ma_nganh',$request->searchNganh)
        ->get();
    }
    static function getClassSearch2(Request $request){
        return DB::table('class_models')
        ->join('majors_models','class_models.Ma_nganh','=','majors_models.Ma_nganh')
        ->join('course_models','class_models.Ma_khoa','=','course_models.Ma_khoa')
        ->select('class_models.*','majors_models.*','course_models.*')
        ->where('course_models.Ma_khoa',$request->searchKhoa)
        ->get();
    }
    static function getClassSearch3(Request $request){
        return DB::table('class_models')
        ->join('majors_models','class_models.Ma_nganh','=','majors_models.Ma_nganh')
        ->join('course_models','class_models.Ma_khoa','=','course_models.Ma_khoa')
        ->select('class_models.*','majors_models.*','course_models.*')
        ->where('majors_models.Ma_nganh',$request->searchNganh)
        ->where('course_models.Ma_khoa',$request->searchKhoa)
        ->get();
    }
    static function getClassID($malop){
        return DB::table('class_models')
        ->join('majors_models','class_models.Ma_nganh','=','majors_models.Ma_nganh')
        ->join('course_models','class_models.Ma_khoa','=','course_models.Ma_khoa')
        ->where('Ma_lop','=',$malop)
        ->select('class_models.*','majors_models.*','course_models.*')
        ->first();
    }
    public function major()
    {
        return $this->belongsTo(MajorsModel::class, 'Ma_nganh', 'Ma_nganh');
    }
    public function course()
    {
        return $this->belongsTo(CourseModel::class, 'Ma_khoa', 'Ma_khoa');
    }
    static function insertProcess($malop,$tenlop,$nganh,$khoa){
        return DB::table('class_models')->insert([
            'Ma_lop'=>$malop,
            'Ten_lop'=>$tenlop,
            'Ma_khoa'=>$khoa,
            'Ma_nganh'=>$nganh
        ]);
    }
    static function updateProcess($malop,$tenlop,$nganh,$khoa){
        return DB::table('class_models')
        ->where('Ma_lop',$malop)
        ->update([
            'Ten_lop'=>$tenlop,
            'Ma_khoa'=>$khoa,
            'Ma_nganh'=>$nganh
        ]);
    }
    static function destroy($malop){
        return DB::table('class_models')
        ->where('Ma_lop',$malop)
        ->delete();
    }
}
