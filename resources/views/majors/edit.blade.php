@extends('layouts.master')
@section('title','BKACAD|Cập Nhật Chuyên Ngành')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Sửa Chuyên Ngành</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{Route('major.update',['major'=>$major->Ma_nganh])}}">
        @method('PUt')
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Mã Ngành</label>
          <input type="text" class="form-control" name="manganh" placeholder="Mã ngành"  readonly value="{{$major->Ma_nganh}}">
          <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('manganh')}}</span>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Tên Môn Học</label>
          <input type="text" class="form-control" name="tennganh" placeholder="Tên Ngành" value="{{$major->Ten_nganh}}">
          <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('tennganh')}}</span>
        </div>

      <!-- /.card-body -->

      <div class="card-footer" style="clear:both">
        <button type="submit" class="btn btn-primary">Sửa</button>
      </div>
    </form>
  </div>
@endsection
