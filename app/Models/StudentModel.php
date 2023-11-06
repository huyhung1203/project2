<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentModel extends Model
{

    use HasFactory;
    protected $table="student_models";
    protected $primaryKey = "Ma_SV";
    public $incrementing = false;
    protected $keyType = 'string';

    public function getAuthPassword() {
        return $this->password;
    }

    public function subjects() {
        return $this->belongsToMany(SubjectModel::class, 'score_models', 'Ma_SV', 'Ma_monhoc')
                    ->withPivot('Hoc_ky','Lan_thi','Ly_thuyet','Thuc_hanh');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'Ma_lop', 'Ma_lop');
    }

    static function getSearch(Request $request){
        return DB::table('student_models')
        ->join('class_models','student_models.Ma_lop','=','class_models.Ma_lop')
        ->join('course_models','class_models.Ma_khoa','=','course_models.Ma_khoa')
        ->select('student_models.*','class_models.Ma_khoa')
        ->where('student_models.Ma_lop', $request->searchLop)
        ->get();
    }
    static function getAll(){
        return DB::table('student_models')
        ->join('class_models','student_models.Ma_lop','=','class_models.Ma_lop')
        ->join('course_models','class_models.Ma_khoa','=','course_models.Ma_khoa')
        ->join('majors_models','class_models.Ma_nganh','=','majors_models.Ma_nganh')
        ->select('student_models.*','class_models.Ma_khoa','majors_models.Ten_nganh')
        ->get();
    }
    static function getSetudentMajor(Request $request){
        return DB::table('student_models')
        ->join('class_models','student_models.Ma_lop','=','class_models.Ma_lop')
        ->join('course_models','class_models.Ma_khoa','=','course_models.Ma_khoa')
        ->join('majors_models','class_models.Ma_nganh','=','majors_models.Ma_nganh')
        ->join('score_models','student_models.Ma_SV','=','score_models.Ma_SV')
         ->select('student_models.*','class_models.Ma_lop','course_models.Ma_khoa','majors_models.Ma_nganh')
        ->where('majors_models.Ma_nganh',$request->searchNganh)
        ->get();

    }
    static function getStudent($msv){
        $rs= Db::table('student_models')
        ->join('class_models','student_models.Ma_lop','=','class_models.Ma_lop')
        ->select('student_models.*','class_models.Ma_nganh')
        ->where('Ma_SV','=',$msv)->first();
        return $rs;
    }
    static function details($msv){
        $rs= Db::table('student_models')
        ->join('class_models','student_models.Ma_lop','=','class_models.Ma_lop')
        ->join('majors_models','class_models.Ma_nganh','=','majors_models.Ma_nganh')
        // ->join('score_models','student_models.Ma_SV','=','score_models.Ma_SV')
        ->select('student_models.*','class_models.*','majors_models.*')
        ->where('Ma_SV','=',$msv)
        ->first();
        return $rs;
    }
    static function insertProcess($msv,$name,$gender,$dob,$email,$password,$class){
        return DB::table('student_models')->insert([
            'Ma_SV'=>$msv,
            'Ho_va_ten'=>$name,
            'Gioi_tinh'=>$gender,
            'Ngay_sinh'=>$dob,
            'Email'=>$email,
            'password'=>$password,
            'Ma_lop'=>$class,
        ]);
    }
    static function updateProcess($msv,$name,$gender,$dob,$email,$class){
        return DB::table('student_models')
        ->where('Ma_SV','=',$msv)
        ->update([
            'Ho_va_ten'=>$name,
            'Gioi_tinh'=>$gender,
            'Ngay_sinh'=>$dob,
            'Email'=>$email,
            'Ma_lop'=>$class,
        ]);
    }
    static function destroy($msv)
    {
        return DB::table('student_models')->where('Ma_SV',$msv)->delete();
    }
    static function stdMon($search,$searchLop,$searchMon){
        return DB::table('student_models')
        ->join('class_models','student_models.Ma_lop','=','class_models.Ma_lop')
        ->join('majors_models','class_models.Ma_nganh','=','majors_models.Ma_nganh')
        ->join('subject_models','majors_models.Ma_nganh','=','subject_models.Ma_nganh')
        ->join('score_models','subject_models.Ma_monhoc','=','score_models.Ma_monhoc')
        ->select('student_models.*','class_models.Ma_lop','majors_models.Ma_nganh','subject_models.Ma_monhoc')
        // ->select('student_models.*','class_models.Ma_lop','majors_models.Ma_nganh','subject_models.Ma_monhoc','score_models.*')
        ->where('class_models.Ma_lop','=',$searchLop)
        ->where('majors_models.Ma_nganh','=',$search)
        ->where('subject_models.Ma_monhoc','=',$searchMon)
        ->get();
    }

}
