 @extends ('layouts.admin_template')
  @section ('content')
@include('layouts.errors')
@include('sweet::alert')    
<!-- <fieldset><h3 class="box-title">{{ $page_title }}</h3></fieldset>  -->
<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">{{ $page_title }}</h3>
  </div>
  <form action="#" method="post">
  <div class="box-body">
    <div class="row">
      <div class="col-xs-3">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right datepicker" id="tanggal_awal" name="tanggal_awal" placeholder="Tanggal awal">
          </div>
      </div>
      <div class="col-xs-3">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right datepicker" id="tanggal_akhir" name="tanggal_akhir" placeholder="Tanggal akhir">
          </div>
      </div>
      <div class="col-xs-5">
        <button type="button" class="btn btn-info" id="submit_query">SEARCH</button>
      </div>
    </div>
  </div>
</form>
</div>
<div class="box">
  <div class="box-body">
    <table id="table"
           class="table table-striped"
           data-pagination="true" 
           data-toggle="table" 
           data-search="true"  
           data-page-size="20"
           data-show-export="true"
           data-export-types="['excel', 'pdf', 'csv', 'xml']"
         data-detail-view="true"
         data-detail-formatter= "tableDetailFormatter"
           data-toolbar="#toolbar">
      <thead>
      <tr>
            <th data-field="penjualan_code">KODE</th>
            <th data-field="deskripsi_penjualan">DESKRIPSI</th>
            <th data-field="nama_kustomer">KUSTOMER</th>
            <th data-field="tgl_penjualan">TGL PENJUALAN</th>
            <th data-field="total_penjualan" data-formatter="moneyFormatter">TOTAL PENJUALAN</th>
      </tr>
      </thead>
    </table>
  </div>
</div>

@endsection
@section('pagescript')
<script type="text/javascript">
    $('#table').bootstrapTable();


         $("#submit_query").click(function () {
                $('#table').bootstrapTable('removeAll');
                run_waitMe($('#table'), 1, 'facebook');
                var tanggal_awal = $('#tanggal_awal').val();
                var tanggal_akhir = $('#tanggal_akhir').val();
                $.ajax({
                    type: "POST",
                    url: "{{url('/get-report-penjualan')}}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        tanggal_awal : tanggal_awal,
                        tanggal_akhir : tanggal_akhir
                    },
                    success: function (data) {
                            console.log(data);
                            $('#table').bootstrapTable('load', data);
                            $('#table').waitMe('hide');
                        },
                    error: function(data){
                        console.log(data);
                    }
                }); 
      });

         var $table = $('#table');

            function tableDetailFormatter(value, row) {

                $table.on('expand-row.bs.table', function (e, index, row, $detail) {
                    $detail.html('Loading...');
                    $.get( "{{url('/get-detail-penjualan')}}/" + row.id, function (res) {
                        console.log(res);
                        $detail.html('<table></table>').find('table').bootstrapTable({
                            columns: [
                                {
                                    field: 'nama_item',
                                    title: 'ITEM'
                                },{
                                    field: 'jumlah',
                                    title: 'QTY'
                                },{
                                    field: 'harga_jual_produk',
                                    title: 'HARGA',
                                    formatter: 'moneyFormatter'
                                }
                            ],
                            data: res
                        });
                    });
                });
            };

    function run_waitMe(el, num, effect){
        text = 'Please wait...';
        fontSize = '';
        maxSize = '50';
        textPos = 'vertical';
        el.waitMe({
            effect: effect,
            text: text,
            bg: 'rgba(255,255,255,0.7)',
            color: '#B71C1C',
            maxSize: maxSize,
            waitTime: -1,
            source: 'img.svg',
            textPos: textPos,
            fontSize: fontSize,
            onClose: function(el) {}
        });
    }


</script>
@endsection