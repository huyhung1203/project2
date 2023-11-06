<?php

namespace App\Http\Controllers;

use App\Models\MajorsModel;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $majors=MajorsModel::getMajor();
        return view('majors.index',['majors'=>$majors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('majors.create');
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
            'manganh'=>'required',
            'tennganh'=>'required'
        ],[
            'manganh.required'=>'Mã khoá không được để trống!',
            'tennganh.required'=>'Tên khoá không được để trống!'
        ]);
        $manganh = $request->input('manganh');
        $tennganh= $request->input('tennganh');

        $rs=MajorsModel::insertProcess($manganh,$tennganh);
        if($rs==true){
            return redirect('admin/major');
        }
        else{
            return "Không thể thêm ngành";
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
    public function edit($manganh)
    {
        //

        $major = MajorsModel::getMajorID($manganh);
        return view('majors.edit',['major'=>$major]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $manganh)
    {
        //
        $request->validate([

            'tennganh'=>'required'
        ],[

            'tennganh.required'=>'Tên khoá không được để trống!'
        ]);
        $tennganh = $request->input('tennganh');
        $rs = MajorsModel::updateProcess($manganh,$tennganh);
        if($rs==0){
            return "Không thể cập nhật ngành";
        }
        else{
            return redirect('admin/major');
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
