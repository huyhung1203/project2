@extends('layouts.master')
@section('title','BKACAD|Cập Nhật Môn Học')
@section('content')
<div class="card-header">
    <h3 class="card-title">Chỉnh Sửa Môn</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form method="POST" action="{{Route('subject.update',['subject'=>$subject->Ma_monhoc])}}">
    @method("PUT")
      @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Mã Môn Học</label>
        <input type="text" class="form-control" name="mamh" placeholder="Mã môn" value="{{$subject->Ma_monhoc}}" readonly>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Tên Môn Học</label>
        <input type="text" class="form-control" name="tenmh" placeholder="Tên Môn" value="{{$subject->Ten_mon}}">
      </div>
      <div class="form-group">
          <label for="exampleInputPassword1">Số Tín Chỉ</label>
          <input type="number" class="form-control" name="tinchi" placeholder="Tín Chỉ" value="{{$subject->So_tin_chi}}">
      </div>
     <div class="form-group float-left">
          <label for="">Hình Thức Thi</label>
          <select name="hinhthuc" id="hinhthuc">
              <option value="#">----chọn----</option>
              <option value="0">Thi Thực Hành</option>
              <option value="1">Thi Lý Thuyết</option>
              <option value="2">Lý Thuyết+Thực Hành </option>
          </select>
     </div>
     <div class="form-group float-left" style=" margin-left:10px">
      <label for="">Ngành</label>
      <select name="nganh" id="nganh">
      <option value="#">-----chọn-----</option>
      @forelse ($major as $item)
          <option
            @if ($item->Ma_nganh == $subject->Ma_nganh)
                selected
            @endif
          value="{{$item->Ma_nganh}}">{{$item->Ten_nganh}}</option>
      @empty  
      @endforelse
    </select>
  </div>
    <!-- /.card-body -->

    <div class="card-footer" style="clear: both">
      <button type="submit" class="btn btn-primary">Sửa</button>
    </div>
  </form>
</div>
    
@endsection