@extends('layouts.master')
@section('title','BKACAD|Thêm Môn Học')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm Môn</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{url('admin/subject')}}">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Mã Môn Học</label>
          <input type="text" class="form-control" name="mamh" placeholder="Mã môn">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Tên Môn Học</label>
          <input type="text" class="form-control" name="tenmh" placeholder="Tên Môn">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Số Tín Chỉ</label>
            <input type="number" class="form-control" name="tinchi" placeholder="Tín Chỉ">
        </div>
       <div class="form-group float-left" >
            <label for="">Hình Thức Thi</label>
            <select name="hinhthuc" id="hinhthuc">
                <option value="#">----chọn----</option>
                <option value="0">Thi Thực Hành</option>
                <option value="1">Thi Lý Thuyết</option>
                <option value="2">Lý Thuyết+Thực Hành </option>
            </select>
       </div>
      <div class="form-group float-left" style="margin-left:10px">
          <label for="">Ngành</label>
          <select name="nganh" id="nganh">
          <option value="#">-----chọn-----</option>
          @forelse ($major as $item)
              <option value="{{$item->Ma_nganh}}">{{$item->Ten_nganh}}</option>
          @empty  
          @endforelse
        </select>
      </div>
      <!-- /.card-body -->

      <div class="card-footer" style="clear:both">
        <button type="submit" class="btn btn-primary">Thêm</button>
      </div>
    </form>
  </div>
@endsection