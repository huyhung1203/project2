@extends('layouts.master')
@section('title','BKACAD|Bảng Thông Kê Điểm')
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
</div>
<!-- /.card-header -->
<div class="card-body">
    <table id="example1" class="table table-bordered text-center" style="width: 100%">
        <thead>
            <tr>
                <th rowspan="3">Mã SV</th>
                <th rowspan="3">Họ & Tên</th>
                <th rowspan="3">Ngành</th>
                <th rowspan="3">Lớp</th>
                <th rowspan="3">Mã Môn</th>
                {{-- <th rowspan="3">Học Kỳ</th> --}}
                <th colspan="3">Điểm số</th>
                <th rowspan="3">Thao tác</th>
            </tr>
            <tr>
                @foreach($subject as $s)
                  <th colspan="3">{{$s->Ten_mon}}</th>
                @endforeach

           </tr>
           <tr>
                    <th>Lần thi</th>
                    <th>Lý thuyết</th>
                    <th>Thực Hành</th>
           </tr>
        </thead>
        <tbody>
            @forelse ($std as $item)
            <tr>
                <td>{{$item->Ma_SV}}</td>
                <td>{{$item->Ho_va_ten}}</td>
                <td>{{$item->Ten_nganh}}</td>
                <td>{{$item->Ma_lop}}</td>
                <td>{{$item->Ma_monhoc}}</td>
                <td>{{$item->Lan_thi}}</td>
                <td>{{$item->Ly_thuyet}}</td>
                <td>{{$item->Thuc_hanh}}</td>
                <td>
                    <a href="{{url('admin/score/'.$item->Ma_SV.'/edit')}}"><i class="far fa-edit">Sửa</i></a>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="9">Danh sách Rỗng</td>
                </tr>
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
          "responsive":false,"scrollX": true, "lengthChange": true, "autoWidth": true,"pageLength": 4,
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
