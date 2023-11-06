@extends('layouts.master')
@section('title','BKACAD|Thêm Mới Ngành Học')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm Chuyên Ngành</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{url('admin/major')}}">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Mã Ngành</label>
          <input type="text" class="form-control" name="manganh" placeholder="Mã ngành">
          <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('manganh')}}</span>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Tên Môn Học</label>
          <input type="text" class="form-control" name="tennganh" placeholder="Tên Ngành">
          <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('tennganh')}}</span>
        </div>

      <!-- /.card-body -->

      <div class="card-footer" style="clear:both">
        <button type="submit" class="btn btn-primary">Thêm</button>
      </div>
    </form>
  </div>
@endsection
