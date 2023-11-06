<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\CourseModel;
use App\Models\MajorsModel;
use App\Models\ScoreModel;
use App\Models\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $class=ClassModel::getClass();

        if($request->searchLop==""){
            $students = StudentModel::getAll();

        }
        else{
            $students=StudentModel::getSearch($request);
        }

        return view('student.index',['students'=>$students,'class'=>$class,'searchLop'=>$request->searchLop]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       $class= ClassModel::getClass();

        return view('student.create',['class'=>$class]);
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
            'msv'=>'required',
            'name'=>'required',
            'gender'=>'required',
            'dob'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'class'=>'required'
        ],[
            'msv.required'=>'Mã sinh viên không được để trống!',
            'name.required'=>'Tên sinh viên không được để trống!',
            'gender.required'=>'Giới tính sinh viên không được để trống!',
            'dob.required'=>'Ngày sinh sinh viên không được để trống!',
            'email.required'=>'Email sinh viên không được để trống!',
            'password.required'=>'Password sinh viên không được để trống!',
            'class.required'=>'Lớp sinh viên không được để trống!',
        ]);
        $name=$request->input('name');
        $gender=$request->input('gender');
        $dob=$request->input('dob');
        $email=$request->input('email');
        $msv = $request->input('msv');
        $password=Hash::make($request->input('password'));
        $class=$request->input('class');
        $rs=StudentModel::insertProcess($msv,$name,$gender,$dob,$email,$password,$class);
        if($rs==true){
            return redirect('admin/student');
        }
        else{
            return "Không thế thêm SV";
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$msv)
    {
        //
        $class=ClassModel::getClass();

        if($request->searchLop==""){
            $students = StudentModel::getAll();

        }
        else{
            $students=StudentModel::getSearch($request);
        }
        $details=StudentModel::details($msv);
        $score=ScoreModel::getScoreS($msv);

        $data=[
            'details'=>$details,
           'score'=>$score,
           'students'=>$students,
           'class'=>$class,
           'searchLop'=>$request->searchLop
        ];
        // dd($data);
        return view('student.detail',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($msv)
    {
        //
        $student=StudentModel::getStudent($msv);
        $class = ClassModel::getClass();
        $data=['student'=>$student,'class'=>$class];
        if($student==NULL){
            return "Không có học sinh có mã sv ".$msv;
        }
        else return view('student.edit',$data);
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
        $request->validate([

            'name'=>'required',
            'gender'=>'required',
            'dob'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'class'=>'required'
        ],[

            'name.required'=>'Tên sinh viên không được để trống!',
            'gender.required'=>'Giới tính sinh viên không được để trống!',
            'dob.required'=>'Ngày sinh sinh viên không được để trống!',
            'email.required'=>'Email sinh viên không được để trống!',
            'password.required'=>'Password sinh viên không được để trống!',
            'class.required'=>'Lớp sinh viên không được để trống!',
        ]);
        $name=$request->input('name');
        $gender=$request->input('gender');
        $dob=$request->input('dob');
        $email=$request->input('email');
        $class=$request->input('class');
        $rs=StudentModel::updateProcess($msv,$name,$gender,$dob,$email,$class);
        // dd($rs);
        if($rs==true){
            return redirect('admin/student');
        }
        else{
            return "Không thế sửa sinh viên";
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($msv)
    {
        //
        $rs = StudentModel::destroy($msv);
        if($rs==true){
            return redirect('admin/student');
        }
        else{
            "Không thế xóa SV";
        }
    }
}
