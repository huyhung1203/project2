@extends('layouts.master')
@section('title','BKACAD|Thông Kê')
@section('content')
@section('css')
@parent
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
<div class="card">
<div class="card-header">
  <h3 class="card-title"></h3><br>
  <h4 style="color: red;width:600px;margin:auto">* Vui lòng chọn chuyên ngành học để hiện thị bảng thống kê</h4>
  <form action="{{route('score.show',['score'=>1])}}" method="GET" style="width:250px;margin:auto;text-align:center">
    <select class="custom-select" style="border-radius: 20px;" name="searchNganh" id="searchNganh" >
      <option value="#">-----Chọn Ngành Cần Xem-----</option>
      @forelse ($major as $item)
          <option
          value="{{$item->Ma_nganh}}">{{$item->Ten_nganh}}</option>
      @empty
      @endforelse
    </select>
    <select class="custom-select" style="border-radius: 20px;" name="searchMon" id="searchMon" >
        <option value="#">---Môn---</option>
        @forelse ($sub as $s)
        <option value="{{$s->Ma_monhoc}}">{{$s->Ten_mon}}</option>
        @empty
        @endforelse
    </select>
    <select class="custom-select" style="border-radius: 20px;" name="searchLop" id="searchLop" >
        <option value="#">---Lớp---</option>
        @forelse ($class as $c)
        <option value="{{$c->Ma_lop}}">{{$c->Ma_lop}}</option>
        @empty
        @endforelse
    </select>
      <br><br>
      <button type="submit" class="btn btn-info">Xem</button>
   </form>
</div>
<!-- /.card-header -->
<div class="card-body">

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
      $(document).ready(function(){
        $('#searchNganh').change(function(){
            var searchNganh = $(this).val();
            $.ajax({
                type: 'GET',
                url:'/getSubjectByMajor/'+searchNganh,
                data:'',
                dateType:'json',
                success: function(data){
                    var dataObj = data;
                    var html = '<option value="" selected disabled>Chọn Môn</option>';

                    for(let i=0;i<dataObj.length;i++){
                        html += '<option'
                        htmlt += 'value=' + dataObj[i].Ma_monhoc
                        html += '>'
                        html += dataObj[i].Ten_mon
                        html += '</option>'
                    }
                    $('#searchMon').html('');
                    $('#searchMon').append(html);
                },
                error: function(data){}
            });
        });
      });
    </script>
@endsection
@endsection
