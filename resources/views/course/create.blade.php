@extends('layouts.master')
@section('title','BKACAD|Thêm Khóa')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm Khóa học</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{url('admin/course')}}">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Mã Khóa</label>
          <input type="text" class="form-control" name="makhoa" placeholder="Mã Khóa">
          <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('makhoa')}}</span>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Tên Môn Học</label>
          <input type="text" class="form-control" name="tenkhoa" placeholder="Tên Khóa">
          <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('tenkhoa')}}</span>
        </div>

      <!-- /.card-body -->

      <div class="card-footer" style="clear:both">
        <button type="submit" class="btn btn-primary">Thêm</button>
      </div>
    </form>
  </div>
@endsection
