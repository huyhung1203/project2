<?php

namespace App\Http\Controllers;

use App\Models\CourseModel;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $courses = CourseModel::getCourse();
        return view('course.index',['courses'=>$courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('course.create');
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
            'makhoa'=>'required',
            'tenkhoa'=>'required'
        ],[
            'makhoa.required'=>'Mã khoá không được để trống!',
            'tenkhoa.required'=>'Tên khoá không được để trống!'
        ]);
        $makhoa=$request->input('makhoa');
        $tenkhoa=$request->input('tenkhoa');
        $rs=CourseModel::inserProcess($makhoa,$tenkhoa);
        if($rs==True){
            return redirect('admin/course');
        }
        else{
            return "Không thế thêm khóa!";
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
    public function edit($makhoa)
    {
        //
        $course=CourseModel::getCourseID($makhoa);
        return view('course.edit',['course'=>$course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $makhoa)
    {
        //
        $request->validate([
            'tenkhoa'=>'required'
        ],[
            'tenkhoa.required'=>'Tên khoá không được để trống!'
        ]);
        $tenkhoa=$request->input('tenkhoa');
        $rs=CourseModel::updateProcess($makhoa,$tenkhoa);
        if($rs==0){
            return "không thể cập nhật khóa!";
        }
        else{
            return redirect('admin/course');
        }
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
