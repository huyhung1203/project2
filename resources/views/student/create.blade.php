@extends('layouts.master')
@section('title','BKACAD|Thêm Sinh Viên')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm sinh viên</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{url('admin/student')}}">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Mã Sinh Viên</label>
          <input type="text" class="form-control"  placeholder="MSV" name="msv">
          <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('msv')}}</span>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Họ và Tên</label>
          <input type="text" class="form-control"  placeholder="Họ Tên SV" name="name">
          <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Giới Tính</label>
            <input type="radio" name="gender" value="1">Nam
            <input type="radio" name="gender" value="0">Nữ
          </div>
          <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('gender')}}</span>
          <div class="form-group">
            <label for="exampleInputPassword1">Ngày Sinh</label>
            <input type="date" class="form-control"  placeholder="Ngày tháng năm sinh" name="dob">
            <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('dob')}}</span>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input type="email" class="form-control"  placeholder="Email" name="email">
            <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('email')}}</span>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="text" class="form-control"  placeholder="password" name="password">
            <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('password')}}</span>
          </div>
          <div class="form-group">
            <label for="">Lớp</label>
            <select name="class" id="class">
                <option value="#">-----chọn-----</option>
                @forelse ($class as $item)
                    <option value="{{$item->Ma_lop}}">{{$item->Ma_lop}}</option>
                @empty
                @endforelse
            </select>
            <span class="alert text-danger font-weight-bolder font-italic">{{$errors->first('class')}}</span>
          </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection
