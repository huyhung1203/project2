<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreModel extends Model
{
    use HasFactory;
    static function getALL(Request $request){
        return DB::table('score_models')
        ->join('student_models','score_models.Ma_SV','=','student_models.Ma_SV')
        ->join('subject_models','score_models.Ma_monhoc','=','subject_models.Ma_monhoc')
        ->join('class_models','student_models.Ma_lop','=','class_models.Ma_lop')
        ->join('course_models','class_models.Ma_khoa','=','course_models.Ma_khoa')
        ->join('majors_models','class_models.Ma_nganh','=','majors_models.Ma_nganh')
        ->select('score_models.*','student_models.*','subject_models.*','class_models.Ma_lop'
        ,'course_models.Ma_khoa','majors_models.Ma_nganh')
        ->where('majors_models.Ma_nganh',$request->searchNganh)
        ->get();
    }
    static function showAll($masv){
        return DB::table('score_models')
        ->join('student_models','student_models.Ma_SV','=','score_models.Ma_SV')
        ->join('subject_models','subject_models.Ma_monhoc','=','score_models.Ma_monhoc')
        ->select('student_models.*','subject_models.*','score_models.*')
        ->where('student_models.Ma_SV',$masv)
        ->get();
        
    }
    static function getScore(){
        return DB::table('score_models')
        ->get();
    }
    public function subject(){
        return $this->belongsToMany(SubjectModel::class,'Ma_monhoc','Ma_monhoc');
    }
    static function getScoreS($msv){
        return DB::table('score_models')
        ->join('subject_models','score_models.Ma_monhoc','=','subject_models.Ma_monhoc')
        ->select('score_models.*','subject_models.Ten_mon')
        ->where('Ma_SV',$msv)
        ->get();
    }

    static function insertProcess($mon,$msv,$lanthi,$lythuyet,$thuchanh){
        return DB::table('score_models')->insert([
            'Ma_monhoc'=>$mon,
            'Ma_SV'=>$msv,
            'Lan_thi'=>$lanthi,
            'Ly_thuyet'=>$lythuyet,
            'Thuc_hanh'=>$thuchanh,
        ]);
    }
    static function updateProcess($id,$lanthi,$lythuyet,$thuchanh){
        // dd($id);
        return DB::table('score_models')
        ->where('id',$id)
        ->update([
            'Lan_thi'=>$lanthi,
            'Ly_thuyet'=>$lythuyet,
            'Thuc_hanh'=>$thuchanh,
        ]);
    }
}
