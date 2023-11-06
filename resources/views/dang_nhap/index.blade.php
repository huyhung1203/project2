@extends('layouts.student')
@section('content')
@section('css')
 @parent
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
<div class="card">
    <div class="card-header">
      <h3 class="card-title"></h3>


    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Môn học</th>
          <th>Điểm lý thuyết</th>
          <th>Điểm thực hành</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($DBshow as $item)
                    <tr>
                        <td>
                        {{$item->Ma_monhoc}}
                        </td>
                        <td>{{$item->Ly_thuyet}}</td>
                        <td>{{$item->Thuc_hanh}}</td>
                    </tr>
         @empty
                     <tr><td colspan="8" style="text-align: center">Danh Sách Rỗng</td></tr>
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
          "buttons": ["excel", "pdf"]
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
