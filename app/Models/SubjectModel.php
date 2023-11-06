<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SubjectModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'Ma_monhoc';
    public $incrementing = false;

    static function getAll(){
        return DB::table('subject_models')->get();
    }
    public function major(){
        return $this->BelongsTo(MajorsModel::class,'Ma_nganh','Ma_nganh');
    }
    static function getSubject($Ma_nganh){
        return DB::table('subject_models')
        -> join('majors_models','subject_models.Ma_nganh','=','majors_models.Ma_nganh')
        ->select('subject_models.*','majors_models.Ma_nganh')
        ->where('subject_models.Ma_nganh',$Ma_nganh)
        -> get();
    }
    static function getSb($searchMon){
        return DB::table('subject_models')
        -> join('majors_models','subject_models.Ma_nganh','=','majors_models.Ma_nganh')
        ->select('subject_models.*')
        // ->where('subject_models.Ma_nganh',$search)
        ->where('subject_models.Ma_monhoc',$searchMon)
        -> get();
    }
    static function getdetail($mamh){
        $rs= DB::table('subject_models')->where('Ma_monhoc','=',$mamh)->first();
         return $rs;

    }
    static function counSub(Request $request){
        return DB::table('subject_models')
        ->join('majors_models','subject_models.Ma_nganh','=','majors_models.Ma_nganh')
        ->select('subject_models.Ten_mon','subject_models.Hoc_ky')
        ->where('subject_models.Hoc_ky',$request->searchKy)
        ->where('majors_models.Ma_nganh',$request->searchNganh)
        ->get();
    }
    static function insertProcess($mamh,$tenmh,$tinchi,$hinhthuc,$nganh){
        return DB::table('subject_models')->insert([
            'Ma_monhoc' => $mamh,
            'Ten_mon' => $tenmh,
            'So_tin_chi' =>$tinchi,
            'Hinh_thuc_thi'=>$hinhthuc,
            'Ma_nganh'=>$nganh,
        ]);
    }

    static function updateProcess($tenmh,$tinchi,$hinhthuc,$nganh,$mamh){
        return DB::table('subject_models')
        ->where('Ma_monhoc','=',$mamh)
        ->update([
            'Ten_mon' => $tenmh,
            'So_tin_chi' =>$tinchi,
            'Hinh_thuc_thi'=>$hinhthuc,
            'Ma_nganh'=>$nganh,
        ]);
    }
    static function destroy($mamh)
    {

        return DB::table('subject_models')->where('Ma_monhoc',$mamh)->delete();
    }
    static function Std($search,$searchMon,$searchLop){
        // $rs= DB::select("SELECT student_models.Ma_SV,student_models.Ho_va_ten,class_models.Ma_lop,subject_models.Ma_monhoc,subject_models.Ten_mon,score_models.Lan_thi,score_models.Ly_thuyet,score_models.Thuc_hanh FROM subject_models AS S INNER JOIN  class_models AS C ON S.Ma_nganh =C.Ma_nganh INNER JOIN majors_models AS M ON S.Ma_nganh =M.Ma_nganh INNER JOIN student_models AS ST ON ST.Ma_SV = score_models.Ma_SV WHERE score_models.Ma_monhoc ='LMTL' AND C.Ma_lop='BKD01' ");
        $rs=DB::select("SELECT ST.Ma_SV, ST.Ho_va_ten, M.Ten_nganh, C.Ma_lop,S.Ma_monhoc, S.Ten_mon,  D.Hoc_ky, D.Lan_thi, D.Ly_thuyet, D.Thuc_hanh
        FROM subject_models AS S
        INNER JOIN class_models AS C ON S.Ma_nganh = C.Ma_nganh
        INNER JOIN majors_models AS M ON S.Ma_nganh = M.Ma_nganh
        INNER JOIN score_models AS D ON D.Ma_monhoc = S.Ma_monhoc
        INNER JOIN student_models AS ST ON ST.Ma_SV = D.Ma_SV
        WHERE D.Ma_monhoc = '$searchMon'
        AND C.Ma_lop = '$searchLop'
        AND M.Ma_nganh ='$search'
        ");
        return $rs;
    }

}
