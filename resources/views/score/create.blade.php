@extends('layouts.master')
@section('title','BKACAD|Thêm Điểm Cho Sinh Viên')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm sinh viên</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{Route('score.store')}}">
        {{-- @method("PUT") --}}
        @csrf
      <div class="card-body" style="font-size: larger">
        <div class="form-group "  >
          <label for="exampleInputEmail1">Mã Sinh Viên: </label>
          <input type="text" readonly name="msv" value="{{$student->Ma_SV}}">
        </div>
        <div class="form-group ">
          <label for="exampleInputPassword1">Họ và Tên: </label>
            <span>{{$student->Ho_va_ten}}</span>
        </div>
        <div class="form-group float-left" >
            <label for="exampleInputPassword1">Giới Tính: </label>
            <span> {{$student->Gioi_tinh==1?'Nam':'Nữ'}}</span>
          </div>
          <div class="form-group float-left" style="margin-left: 20px" >
            <label for="exampleInputPassword1">Ngày Sinh: </label>
            <span>{{$student->Ngay_sinh}}</span>
          </div>
          <div class="form-group" style="clear: both">
            <label for="exampleInputPassword1">Email: </label>
            <span>{{$student->Email}}</span>
          </div>
          <div class="form-group ">
            <label for="">Lớp: </label>
                <span>{{$student->Ma_lop}}</span>

          </div>
      </div>
        <div>
            <table class="text-center" style="padding: 10px;width: 355px">
                <tr >
                    <td colspan="3">
                        <label for="exampleInputEmail1">Môn</label>
                        <select name="mon" id="mon" class="custom-select" style="border-radius: 20px;width: 300px">
                            <option value="#">--Chọn Môn Cần Nhập Điểm--</option>
                            @foreach ($subject as $item)
                               <option value="{{$item->Ma_monhoc}}">
                                {{$item->Ten_mon}}
                                 </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr style="padding: 20px">
                  <td>
                    <label for="">Lần thi</label>
                    {{-- <input type="number" name="lanthi"style="width:50px"> --}}
                    <select name="lanthi" style="width:50px">
                        <option value="#">--</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </td>
                   <td>
                       <label for="">Lý thuyết</label>
                       <input type="number" step="any" name="lythuyet" style="width:50px">
                   </td>

                   <td>
                       <label for="">Thực hành</label>
                       <input type="number" step="any" name="thuchanh"  style="width:50px">
                   </td>
                </tr>
            </table>
        </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection
