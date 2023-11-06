@extends('layouts.master')
@section('title','BKACAD|Danh Sách Sinh Viên')
@section('content')
@section('css')
    @parent
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Danh sách sinh viên</h3><br>
      
     <form action="{{route('student.index')}}" style="width:120px">
      <span>Bộ Lọc:</span>
      <select class="custom-select" style="border-radius: 20px" name="searchLop" id="searchLop" onchange="this.form.submit()">
        <option value="">-----Lớp----</option>
        @forelse ($class as $item)
            <option
            @if ($item->Ma_lop==$searchLop)
                selected
            @endif
            value="{{$item->Ma_lop}}">{{$item->Ma_lop}}</option>
        @empty
        @endforelse
      </select>
     </form>
      {{-- <h4 style="float: right"><a href="{{url('admin/student/create')}}">+ Thêm Sinh viên</a></h4> --}}
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered text-center table-hover">
        <thead>
            <tr>
            <th>Mã SV</th>
            <th>Họ & Tên</th>
            <th>Ngày sinh</th>
            <th>Lớp</th>
            <th>Khóa</th>
            <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @forelse ($students as $student)
              
                    <td><a href="{{route('student.show',$student->Ma_SV)}}">{{$student->Ma_SV}}</a></td> 
                    <td>{{$student->Ho_va_ten}}</td>
                    <td>{{$student->Ngay_sinh}}</td>
                    <td>{{$student->Ma_lop}}</td>
                    <td>{{$student->Ma_khoa}}</td>
                 
                    <td>
                      <form action="{{url('admin/student/'.$student->Ma_SV)}}" method="POST">
                        <a href="{{url('admin/student/'.$student->Ma_SV.'/edit')}}"><i class="far fa-edit">Sửa</i></a>
                        ||
                        @method("DELETE")
                        @csrf
                        <button type="submit" style="border: none" onclick=" return ConfirmDelete()">
                          <a href="" style="color: red"><i class="far fa-trash-alt">xóa</i></a>
                        </button>
                        </form>
                        
                    </td>
            </tr>    
                @empty
                    <tr><td colspan="6" class="text-center">Danh sánh rỗng</td></tr>
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
              "responsive": true, "lengthChange": false, "autoWidth": false,"pageLength": 4,
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