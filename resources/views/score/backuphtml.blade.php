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
            <th rowspan="3">Lớp</th>
            <th rowspan="3">Khóa</th>
            {{-- <th rowspan="3">Học Kỳ</th> --}}
            <th colspan="{{$count*3}}">Điểm số</th>
            <th rowspan="3">Thao tác</th>
            </tr>
            <tr>
              @foreach ($subjectsList as $item)
                  <th colspan="3">{{$item->Ten_mon}}</th>
              @endforeach

           </tr>
           <tr>
                @for ($i = 0; $i < $count; $i++)
                    <th>Lần thi</th>
                    <th>Lý thuyết</th>
                    <th>Thực Hành</th>
                @endfor
           </tr>
        </thead>
        <tbody>
          <tr>
            @forelse ($studentsList as $student)
               <td><a href="{{url('admin/score/create?Ma_SV='.$student->Ma_SV.'&Ma_nganh='.$student->class->Ma_nganh)}}">
                 {{$student->Ma_SV}}</a>
                </td>
               <td>{{$student->Ho_va_ten}}</td>
               <td>{{$student->Ma_lop}}</td>
               <td>{{$student->class->course->Ma_khoa}}</td>
               {{-- <td>{{$student->Hoc_ky}}</td> --}}
              @foreach ($student->subjects as $sub)

                <td style="text-align: right;color: blue">{{$sub['pivot']['Lan_thi']}}</td>
                    @if ($sub->Hinh_thuc_thi==0)
                    <td>-</td>
                    <td style="text-align: right">{{$sub['pivot']['Thuc_hanh']}}</td>
                    @elseif($sub->Hinh_thuc_thi==1)
                    <td style="text-align: right">{{$sub['pivot']['Ly_thuyet']}}</td>
                    <td>-</td>
                    @else
                    <td style="text-align: right">{{$sub['pivot']['Ly_thuyet']}}</td>
                    <td style="text-align: right">{{$sub['pivot']['Thuc_hanh']}}</td>
                    @endif
              @endforeach

               <td>
                 <a href="{{url('admin/score/'.$student->Ma_SV.'/edit')}}"><i class="far fa-edit">Sửa</i></a>
               </td>
          </tr>
           @empty

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
