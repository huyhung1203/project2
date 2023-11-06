<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CourseModel extends Model
{
    use HasFactory;
    static function getCourse(){
        return DB::table('course_models')->get();
    }

    static function getCourseID($makhoa){
        return DB::table('course_models')
        ->where('Ma_khoa',$makhoa)
        ->first();
    }

    static function inserProcess($makhoa,$tenkhoa){
        return DB::table('course_models')->insert([
            'Ma_khoa' => $makhoa,
            'Ten_khoa'=>$tenkhoa,
        ]);
    }
    static function updateProcess($makhoa,$tenkhoa){
        return DB::table('course_models')
        ->where('Ma_khoa',$makhoa)
        ->update([
           
            'Ten_khoa'=>$tenkhoa,
        ]);
    }
}
