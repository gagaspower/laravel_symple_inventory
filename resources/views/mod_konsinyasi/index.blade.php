 @extends ('layouts.admin_template')
  @section ('content')
@include('layouts.errors')
@include('sweet::alert')    
<fieldset><h3 class="box-title">{{ $page_title }}</h3></fieldset> 
<div class="box">
  <div class="box-body">
    <button type="button" class="btn btn-info btn-flat" onclick="window.location.href='/tambah-konsinyasi'">
        <i class="fa fa-plus-square"></i> BUAT KONSINYASI
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
            <th>TANGGAL</th>
            <th>DESKRIPSI</th>
            <th>SUPLIER</th>
            <th>TIPE</th>
            <th>TOTAL</th>
            <th></th>
      </tr>
      </thead>
      <tbody>
    @foreach($konsinyasis as $konsinyasi)
      <tr>
      <td>{{$konsinyasi->konsinyasi_code}}</td>
      <td>{{$konsinyasi->konsinyasi_tanggal}}</td>
      <td>{{$konsinyasi->konsinyasi_deskripsi}}</td>
      <td>{{$konsinyasi->nama_suplier}}</td>
      <td>
        @if($konsinyasi->konsinyasi_tipe == 'in')
        <span class="label label-info">KONSINYASI MASUK</span>
        @elseif($konsinyasi->konsinyasi_tipe == 'out')
        <span class="label label-danger">KONSINYASI KELUAR</span>
        @endif
      </td>
      <td>{{ number_format($konsinyasi->konsinyasi_total,2) }}</td>
        <td>

          @if($konsinyasi->konsinyasi_status == '00')
          @if($konsinyasi->konsinyasi_tipe == 'in' and $konsinyasi->generate_status == '00')
          <button type="button" class="btn btn-xs btn-flat btn-success" onclick="window.location.href='/generate-item/{{$konsinyasi->id}}'"><i class="fa fa-archive"></i> Generate Item</button>
          @elseif($konsinyasi->konsinyasi_tipe == 'out')
          
          @else
          <span class="btn btn-success btn-xs btn-flat"><i class="fa fa-check-square-o"></i> Generate Item Success</span>
          @endif
          <button type="button" class="btn btn-xs btn-flat btn-info"  onclick="window.open('/cetak/{{$konsinyasi->id}}')"><i class="fa fa-eye"></i> DETAIL</button>
          <button type="button" class="btn btn-xs btn-flat btn-danger"  onclick="window.location.href='/void-konsinyasi/{{$konsinyasi->id}}'"><i class="fa fa-sign-out"></i> VOID</button>
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