@extends('layouts.master')
@section('title','BKACAD|Danh Sách Lớp Học')
@section('content')
@section('css')
@parent
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
<div class="card">
<div class="card-header">
  <h3 class="card-title">Danh sách Lớp</h3><br>
<span>Bộ lọc:</span><br>
  <form action="{{route('class.index')}}">
    <select class="custom-select" style="width:150px;border-radius: 20px" name="searchNganh" id="searchNganh">
      <option value="">-----Ngành-----</option>
      @foreach ($major as $item)
         <option 
         @if ($item->Ma_nganh==$searchNganh)
             selected
         @endif
         value="{{$item->Ma_nganh}}">{{$item->Ten_nganh}}</option>
      @endforeach
    </select>
    <select class="custom-select" style="width:150px;float:left;border-radius: 20px" name="searchKhoa" id="searchKhoa">
      <option value="">-----Khóa-----</option>
      @foreach ($course as $item)
         <option 
         @if ($item->Ma_khoa==$searchKhoa)
             selected
         @endif
         value="{{$item->Ma_khoa}}">{{$item->Ten_khoa}}</option>
      @endforeach
    </select>
    <button type="submit" style="border-radius: 50px" class="btn btn-primary">Lọc</button>
  </form>
  
  {{-- <h4 style="float: right"><a href="{{url('admin/class/create')}}">+ Thêm Lớp</a></h4> --}}
</div>
<!-- /.card-header -->
<div class="card-body">
  
  <table id="example1" class="table table-bordered text-center">
    <thead>
        <tr>
            <th>Mã lớp</th>
            <th>Tên lớp</th>
            <th>Tên ngành</th>
            <th>Tên khóa</th>
            <th>Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        <tr>
         
            @forelse ($class as $item)
                <td>{{$item->Ma_lop}}</td>
                <td>{{$item->Ten_lop}}</td>
                <td>{{$item->Ten_nganh}}</td>
                <td>{{$item->Ten_khoa}}</td>
                <td>
                  <form action="{{url('admin/class/'.$item->Ma_lop)}}" method="POST">
                    <a href="{{url('admin/class/'.$item->Ma_lop.'/edit')}}"><i class="far fa-edit">Sửa</i></a>
                      ||
                      @method("DELETE")
                      @csrf
                      <button type="submit" style="border: none" onclick=" return ConfirmDelete()">
                        <a href="{{}}" style="color: red"><i class="far fa-trash-alt">xóa</i></a>
                      </button>
                    </form>
                </td>
         </tr>   
            @empty
                <tr><td colspan="5" class="text-center">Danh sách rỗng</td></tr>
            @endforelse
    </tbody>
  </table>
</div>
<!-- /.card-body -->
</div>
@section('scripts')
  @parent
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": [ "excel", "pdf"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
      function ConfirmDelete()
    {
      var x = confirm("Bạn có chắc chắn muốn xóa không?");
      if (x)
          return true;
      else
        return false;
    }
    </script>

@endsection
@endsection