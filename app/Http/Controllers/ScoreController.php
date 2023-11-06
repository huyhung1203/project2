<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\MajorsModel;
use App\Models\ScoreModel;
use App\Models\StudentModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $major=MajorsModel::getMajor();
        $sub=SubjectModel::getAll();
        $class=ClassModel::getClass();
        $data=[
            'major'=>$major,
            'sub'=>$sub,
            'class'=>$class
    ];
        return view('score.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $msv = $request->Ma_SV;
        $score = ScoreModel::getScore();
        $student =StudentModel::getStudent($msv);
        $class = ClassModel::getClass();
        $subject = SubjectModel::getSubject($request->Ma_nganh);
        // dd($subject->toArray());
        $data = ['score'=>$score,'student'=>$student,'class'=>$class,'subject'=>$subject];

        return view('score.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'mon'=>'required',
            'msv'=>'required',
            'lanthi'=>'required',
            'lythuyet'=>'required',
            'thuchanh'=>'required'
        ],[
            'mon.required'=>'Môn không được để chống!',
            'msv.required'=>'MSV không được để chống!',
            'lanthi.required'=>'Lần thi không được để chống!',
            'lythuyet.required'=>'Lý Thuyết không được để chống!',
            'thuchanh.required'=>'Thực Hành không được để chống!',
        ]);
        $mon=$request->input('mon');
        $msv=$request->input('msv');

        $lanthi=$request->input('lanthi');
        $lythuyet=$request->input('lythuyet');
        $thuchanh=$request->input('thuchanh');

        $rs = ScoreModel::insertProcess($mon,$msv,$lanthi,$lythuyet,$thuchanh);
        if($rs==true){
            return redirect('admin/score');
        }
        else{
            return "Lỗi Thêm điểm!";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $search = $request->searchNganh;
        $searchMon = $request->searchMon;
        $searchLop = $request->searchLop;
        $subject=SubjectModel::getSb($searchMon);
        $std=SubjectModel::Std($search,$searchMon,$searchLop);

        $data=[
            'subject'=>$subject,
            'std'=>$std
        ];
        // dd($data);
        return view('score.details',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,$msv)
    {
        //

       $score = ScoreModel::getScoreS($msv);
       $student =StudentModel::getStudent($msv);
    //    dd($student);
       $subject = SubjectModel::getSubject($request->Ma_nganh);
       $data = ['score'=>$score,'student'=>$student,'subject'=>$subject];
    //    if($student==0){
    //        return "không có sinh viên có MÃ SV: ".$msv;

    //    }
    //    else{
        // dd($data);
        return view('score.edit',$data);
    //    }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $msv)
    {
        //
        $scores= $request->input('scores');
        // dd($scores);

        $lanthi = $request->input('lanthi'); // 7-2
        $lythuyet=$request->input('lythuyet');
        $thuchanh=$request->input('thuchanh');
        // dd($lythuyet);
        foreach ($scores as $score){
            $lanthiItem = $lanthi[$score];
            $lythuyetItem = $lythuyet[$score];
            $thuchanhItem = $thuchanh[$score];
            ScoreModel::updateProcess($score,$lanthiItem,$lythuyetItem,$thuchanhItem);
        }
        return redirect('admin/score');
        // $rs = ScoreModel::updateProcess($msv,$lanthi,$lythuyet,$thuchanh);
        // dd($score);
        // if($rs==true){
        //     // return redirect()->route('score.show',['score'=>1,'Ma_nganh'=>$search]);
        //     return redirect('admin/score');
        // }
        // else{
        //     return "Không thế cập nhật điểm!";
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
