 @extends ('layouts.admin_template')
  @section ('content')
@include('layouts.errors')
@include('sweet::alert')    
<fieldset><h3 class="box-title">{{ $page_title }}</h3></fieldset> 
<div class="box">
  <div class="box-body">
    <button type="button" class="btn btn-info btn-flat" onclick="window.location.href='/tambah-mutasi'">
        <i class="fa fa-plus-square"></i> BUAT NOTA
    </button>
    <table id="table"
           class="table table-striped"
           data-pagination="true" 
           data-toggle="table" 
           data-search="true"  
           data-page-size="20"
           data-show-export="true"
           data-export-types="['excel', 'pdf', 'csv', 'xml']"
           data-toolbar="#toolbar">
      <thead>
      <tr>
            <th>KODE</th>
            <th>DESKRIPSI</th>
            <th>TANGGAL</th>
            <th>WAREHOUSE ASAL</th>
            <th>WAREHOUSE TUJUAN</th>
            <th>TOTAL</th>
            <th></th>
      </tr>
      </thead>
      <tbody>
    @foreach($mutasis as $mutasi)
      <tr>
      <td>{{$mutasi->mutasi_code}}</td>
      <td>{{$mutasi->mutasi_deskripsi}}</td>
      <td>{{$mutasi->mutasi_tanggal}}</td>
      <td>{{$mutasi->warehouse_out}}</td>
      <td>{{$mutasi->warehouse_in}}</td>
      <td>{{ number_format($mutasi->mutasi_total) }}</td>
        <td>
          @if($mutasi->mutasi_status == '00')
          <button type="button" class="btn btn-xs btn-flat btn-info" onclick="window.open('/cetak-mutasi/{{$mutasi->id}}')"><i class="fa fa-eye"></i> DETAIL</button>
          <button type="button" class="btn btn-xs btn-flat btn-danger" onclick="window.location.href='/void-mutasi-stok/{{$mutasi->id}}'"><i class="fa fa-sign-out"></i> VOID</button>
          @else
             <p style="text-transform: uppercase;font-size: 18px; letter-spacing: 10px;color: #dd4b39 ;"><strong>VOID !</strong></p>
          @endif
        </td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection
@section('pagescript')
<script type="text/javascript">
    $('#table').bootstrapTable();
</script>
@endsection