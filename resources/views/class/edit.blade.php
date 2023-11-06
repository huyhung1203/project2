@extends('layouts.master')
@section('title','BKACAD|Cập Nhật Lớp')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Sửa lớp</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{Route('class.update',['class'=>$class->Ma_lop])}}">
        @method('PUT')
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Mã Lớp</label>
          <input type="text" class="form-control" name="malop" value="{{$class->Ma_lop}}" placeholder="Mã Lớp">
          <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('malop')}}</span>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Tên Lớp</label>
          <input type="text" class="form-control" name="tenlop" value="{{$class->Ten_lop}}" placeholder="Tên Lớp">
          <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('tenlop')}}</span>
        </div>
        <div class="form-group float-left" style="margin-left:10px">
                <label for="">Ngành</label>
            <select name="nganh" id="nganh">
                <option value="#">-----chọn-----</option>
                @forelse ($major as $item)
                    <option
                    @if ($item->Ma_nganh==$class->Ma_nganh)
                        selected
                    @endif
                    value="{{$item->Ma_nganh}}">{{$item->Ten_nganh}}</option>
                @empty
                @endforelse
            </select>
        </div>
      <div class="form-group float-left" style="margin-left:10px">
          <label for="">Khóa</label>
          <select name="khoa" id="khoa">
          <option value="#">-----chọn-----</option>
          @forelse ($course as $item)
              <option
                @if ($item->Ma_khoa==$class->Ma_khoa)
                 selected
                @endif
              value="{{$item->Ma_khoa}}">{{$item->Ten_khoa}}</option>
          @empty
          @endforelse
        </select>
      </div>
      <!-- /.card-body -->

      <div class="card-footer" style="clear:both">
        <button type="submit" class="btn btn-primary">Sửa</button>
      </div>
    </form>
  </div>
@endsection
