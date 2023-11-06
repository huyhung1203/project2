<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\CourseModel;
use App\Models\MajorsModel;
use Illuminate\Http\Request;

class ClassController extends Controller
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
        $course=CourseModel::getCourse();
       if($request->searchNganh==""&&$request->searchKhoa==""){
        $class= ClassModel::getClass();
       }

       elseif($request->searchNganh!=""&&$request->searchKhoa==""){
           $class=ClassModel::getClassSearch1($request);
       }
       elseif($request->searchNganh==""&&$request->searchKhoa!=""){
        $class=ClassModel::getClassSearch2($request);
        // dd($class);
    }
    else{
        $class=ClassModel::getClassSearch3($request);
    }
        $data=[
            'class'=>$class,
            'major'=>$major,
            'course'=>$course,
            'searchNganh'=>$request->searchNganh,
            'searchKhoa'=>$request->searchKhoa
        ];
        // dd($data);
        return view('class.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $major=MajorsModel::getMajor();
        $course=CourseModel::getCourse();
        $data=[
            'major'=>$major,
            'course'=>$course
        ];
        return view('class.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'malop'=>'required',
            'tenlop'=>'required',
            'nganh'=>'required',
            'khoa'=>'required',

        ],[
            'malop.required'=>'Mã lớp không được để trống!',
            'tenlop.required'=>'Tên lớp không được để trống!',
            'nganh.required'=>'Ngành không được để trống!',
            'khoa.required'=>'Khoá không được để trống!'
        ]);
        //
        $malop=$request->input('malop');
        $tenlop=$request->input('tenlop');
        $nganh=$request->input('nganh');
        $khoa=$request->input('khoa');
        $rs = ClassModel::insertProcess($malop,$tenlop,$nganh,$khoa);
        if($rs==true){
            return redirect('admin/class');
        }
        else{
            return "Không thể thêm lớp!";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($malop)
    {
        //
        $major=MajorsModel::getMajor();
        $course=CourseModel::getCourse();
        $class=ClassModel::getClassID($malop);
        $data=[
            'class'=>$class,
            'major'=>$major,
            'course'=>$course
        ];
        return view('class.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $malop)
    {
        //
        $request->validate([

            'tenlop'=>'required',
            'nganh'=>'required',
            'khoa'=>'required',

        ],[

            'tenlop.required'=>'Tên lớp không được để trống!',
            'nganh.required'=>'Ngành không được để trống!',
            'khoa.required'=>'Khoá không được để trống!'
        ]);
        $tenlop=$request->input('tenlop');
        $nganh=$request->input('nganh');
        $khoa=$request->input('khoa');
        $rs = ClassModel::updateProcess($malop,$tenlop,$nganh,$khoa);
        if($rs==0){
            return "Không cập nhật lớp!";
        }
        else{
            return redirect('admin/class');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($malop)
    {
        //
        $rs = ClassModel::destroy($malop);
        if($rs==0){
            return "Không thể xóa Môn!";
        }
        else{
            return redirect('admin/class');
        }

    }
}
