@extends('layouts.master')
@section('title','BKACAD|Cập Nhật Điểm Cho Sinh Viên')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm sinh viên</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{url('admin/score/'.$student->Ma_SV)}}"> 
      <!-- Sai ở đây nhé! khi bấm submit nó phải trỏ về route update thì mới update được
      còn hiện tại em đang trỏ lại về route edit (mà route này sử dụng method GET | HEAD) -->
        @method("PUT")
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
            <table class="text-center" style="padding: 10px">
                
                   
                    @forelse ($score as $item)
                    <tr>
                      <input type="hidden" name="scores[]" value="{{$item->id}}">
                        <th>{{$item->Ten_mon}}</th>
                        <td>
                            <input type="number" name="lythuyet[{{$item->id}}]" step="any" value="{{$item->Ly_thuyet}}" style="width:50px"> <!-- 7-2 -->
                        </td>
                        <td>
                            <input type="number" name="thuchanh[{{$item->id}}]" step="any" value="{{$item->Thuc_hanh}}" style="width:50px">
                        </td>
                        <th> Lần thi </th>
                           <td>
                               <input type="number" name="lanthi[{{$item->id}}]" value="{{$item->Lan_thi}}" style="width:50px"> </td>
                       
                    </tr>
                    @empty
                        
                    @endforelse
                   
               
            </table>
        </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection