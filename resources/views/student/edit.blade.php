@extends('layouts.master')
@section('title','BKACAD|Cập Nhật Sinh Viên')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm sinh viên</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{Route('student.update',['student'=>$student->Ma_SV])}}">
        @method("PUT")
        @csrf
      <div class="card-body">
          <input value="{{$student->id}}" type="hidden" name="id"/>
        <div class="form-group">
          <label for="exampleInputEmail1">Mã Sinh Viên</label>
          <input type="text" class="form-control"  placeholder="MSV" name="msv" value="{{$student->Ma_SV}}" readonly>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Họ và Tên</label>
          <input type="text" class="form-control"  placeholder="Họ Tên SV" name="name" value="{{$student->Ho_va_ten}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Giới Tính</label>
            <input type="radio" name="gender" value="1">Nam
            <input type="radio" name="gender" value="0">Nữ
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Ngày Sinh</label>
            <input type="date" class="form-control"  placeholder="Ngày tháng năm sinh" name="dob" value="{{$student->Ngay_sinh}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input type="email" class="form-control"  placeholder="Email" name="email" value="{{$student->Email}}">
          </div>
          <div class="form-group">
            <label for="">Lớp</label>
            <select name="class" id="class">
                <option value="#">-----chọn-----</option>
                @forelse ($class as $item)
                    <option
                    @if ($item->Ma_lop==$student->Ma_lop)
                        selected
                    @endif
                     value="{{$item->Ma_lop}}">
                    {{$item->Ma_lop}}
                    </option>
                @empty
                @endforelse
            </select>
          </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection
