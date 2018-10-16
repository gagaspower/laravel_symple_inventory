 @extends ('layouts.admin_template')
  @section ('content')
@include('layouts.errors')
@include('sweet::alert')    
<fieldset><h3 class="box-title">{{ $page_title }}</h3></fieldset> 
<div class="box">
  <div class="box-body">
    <button type="button" class="btn btn-info" onclick="window.location.href='/tambah-pembelian'">
        <i class="fa fa-plus-square"></i> Tambah
    </button>
    <table id="table"
           class="table table-striped"
           data-pagination="true" 
           data-toggle="table" 
           data-search="true"  
           data-page-size="20"
           data-export-types="['excel', 'pdf', 'csv', 'xml']"
           data-show-export="true"
           data-toolbar="#toolbar">
      <thead>
      <tr>
            <th>KODE</th>
            <th>SUPLIER</th>
            <th>TGL PEMBELIAN</th>
            <th>TOTAL PEMBELIAN</th>
            <th></th>
      </tr>
      </thead>
      <tbody>
    @foreach($pembelians as $pembelian)
      <tr>
      <td>{{$pembelian->pembelian_code}}</td>
      <td>{{$pembelian->nama_suplier}}</td>
      <td>{{$pembelian->tgl_pembelian}}</td>
      <td>{{ number_format($pembelian->total_harga) }}</td>
        <td>
          @if($pembelian->status == '00')
          <button type="button" class="btn btn-xs btn-info" title="Detail {{$pembelian->pembelian_code}}" onclick="window.open('/show-detail-pembelian/{{$pembelian->id}}')"><i class="fa fa-eye"></i> DETAIL</button>
          <button type="button" class="btn btn-xs btn-danger" title="Void {{$pembelian->pembelian_code}}" onclick="window.location.href='/void-pembelian/{{$pembelian->id}}'"><i class="fa fa-sign-out"></i> VOID</button>
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

<!-- modal detail -->
<div class="modal fade" id="modal_detail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <center><h3 class="modal-title">Detail Pembelian</h3></center>
      </div>
      <div class="modal-body">
        <div id="modalcontent"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('pagescript')
<script type="text/javascript">
    $('#table').bootstrapTable();

    $(document).ready(function(){
      $(".show").click( function(){
          // $("#item_show").slideDown();
          $(".det").slideDown();
      });

    });
</script>
@endsection