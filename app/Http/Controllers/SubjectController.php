<?php

namespace App\Http\Controllers;

use App\Models\MajorsModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
        $subjects = SubjectModel::getAll();
        return view('subject.index',['subjects'=>$subjects]);
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
        return view('subject.create',['major'=>$major]);
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
        $mamh = $request->input('mamh');
        $tenmh = $request->input('tenmh');
        $tinchi = $request->input('tinchi');
        $hinhthuc = $request->input('hinhthuc');
        $nganh = $request->input('nganh');
        $rs = SubjectModel::insertProcess($mamh,$tenmh,$tinchi,$hinhthuc,$nganh);
        if($rs==true){
            return redirect('admin/subject');
        }
        else{
            return "Thêm Môn thất bại";
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
    public function edit($mamh)
    {
        //
        // dd($id);
        $major= MajorsModel::getMajor();
        $subject = SubjectModel::getdetail($mamh);
        // dd($subject);
        if($subject==NULL){
            return "Không có bản ghi có Mã " .$mamh;
        }
        else return view('subject.edit',['subject'=>$subject,'major'=>$major]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $mamh)
    {
        //
        $tenmh = $request->input('tenmh');
        $tinchi = $request->input('tinchi');
        $hinhthuc = $request->input('hinhthuc');
        $nganh = $request->input('nganh');
        $rs = SubjectModel::updateProcess($tenmh,$tinchi,$hinhthuc,$nganh,$mamh);
        if($rs==0){
            return "Lỗi Cập nhật!";
        }
        else{
            return redirect('admin/subject');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($mamh)
    {
        //
        $rs = SubjectModel::destroy($mamh);
        if($rs==0){
            return "Không thể xóa Môn!";
        }
        else{
            return redirect('admin/subject');
        }
    }
}
