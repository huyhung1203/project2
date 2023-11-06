@extends('layouts.master')
@section('title','BKACAD|Cập nhật Khóa')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm Khóa học</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{Route('course.update',['course'=>$course->Ma_khoa])}}">
        @method('PUT')
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Mã Khóa</label>
          <input type="text" class="form-control" name="makhoa" placeholder="Mã Khóa" readonly value="{{$course->Ma_khoa}}">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Tên Môn Học</label>
          <input type="text" class="form-control" name="tenkhoa" placeholder="Tên Khóa" value="{{$course->Ten_khoa}}">
        </div>
       
      <!-- /.card-body -->

      <div class="card-footer" style="clear:both">
        <button type="submit" class="btn btn-primary">Sửa</button>
      </div>
    </form>
  </div>
@endsection