<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MajorsModel extends Model
{
    use HasFactory;
    static function getMajor(){
        return DB::table('majors_models')->get();
    
    }
    static function getMajorID($manganh){
        return DB::table('majors_models')
        ->where('Ma_nganh',$manganh)
        ->first();
    
    }
    public  function major(){
        return $this->belongsToMany(SubjectModel::class,'Ma_nganh','Ma_nganh');
    }
    static function insertProcess($manganh,$tennganh){
        return DB::table('majors_models')->insert([
            'Ma_nganh'=>$manganh,
            'Ten_nganh'=>$tennganh,
        ]);
    }
    static function updateProcess($manganh,$tennganh){
        return DB::table('majors_models')
        ->where('Ma_nganh',$manganh)
        ->update([
            'Ten_nganh'=>$tennganh,
        ]);
    }
}
