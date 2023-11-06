@extends('layouts.master')
@section('title','BKACAD|Danh Sách Chuyên Ngành Học')
@section('content')
@section('css')
@parent
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
<div class="card">
<div class="card-header">
  <h3 class="card-title">Danh sách các chuyên ngành</h3>
  {{-- <h4 style="float: right"><a href="{{url('admin/major/create')}}">+ Thêm Chuyên Ngành</a></h4> --}}
</div>
<!-- /.card-header -->
<div class="card-body">
  <table id="example1" class="table table-bordered text-center">
    <thead>
        <tr>
            <th>Mã Ngành</th>
            <th>Tên Ngành</th>
            <th>Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        <tr>
         
            @forelse ($majors as $major)
                <td>{{$major->Ma_nganh}}</td>
                <td>{{$major->Ten_nganh}}</td>
                <td>
                    <a href="{{url('admin/major/'.$major->Ma_nganh.'/edit')}}"><i class="far fa-edit">Sửa</i></a>
                </td>
         </tr>   
            @empty
                <tr><td colspan="3" class="text-center">Danh sách rỗng</td></tr>
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
    </script>
    @endsection
@endsection