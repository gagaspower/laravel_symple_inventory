 @extends ('layouts.admin_template')
  @section ('content')
@include('layouts.errors')
@include('sweet::alert')    
<fieldset><h3 class="box-title">{{ $page_title }}</h3></fieldset> 
<div class="box">
  <div class="box-body">
    <button type="button" class="btn btn-info" onclick="window.location.href='/tambah-penjualan'">
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
            <th>KUSTOMER</th>
            <th>TGL PENJUALAN</th>
            <th>TOTAL PENJUALAN</th>
            <th></th>
      </tr>
      </thead>
      <tbody>
    @foreach($data as $jual)
      <tr>
      <td>{{$jual->penjualan_code}}</td>
      <td>{{$jual->nama_kustomer}}</td>
      <td>{{$jual->tgl_penjualan}}</td>
      <td>{{ number_format($jual->total_penjualan) }}</td>
        <td>
          @if($jual->status == '00')
          <button type="button" class="btn btn-xs btn-flat btn-info" title="Detail {{$jual->penjualan_code}}" onclick="window.open('/print/{{$jual->id}}')"><i class="fa fa-eye"></i> DETAIL</button>
          <button type="button" class="btn btn-xs btn-flat btn-danger" title="Void {{$jual->penjualan_code}}" onclick="window.location.href='/void-penjualan/{{$jual->id}}'"><i class="fa fa-sign-out"></i> VOID</button>
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