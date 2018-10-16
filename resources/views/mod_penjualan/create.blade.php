@extends ('layouts.admin_template')
  @section ('content')
@include('layouts.errors')
@include('sweet::alert')
<form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
{{ csrf_field() }}
<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">{{ $page_title }}</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">Kode</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="penjualan_code" id="penjualan_code" value="{{$newId}}" readonly="">
          </div>
        </div>
      </div>
        <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">Kustomer</label>
          <div class="col-sm-9">
                <select name="kustomer_id" class="form-control select2" id="kustomer_id" style="width: 100%">
                  <option value="">pilih</option>
                  @foreach($kustomers as $kustomer)
                  <option value="{{$kustomer->id}}">{{$kustomer->nama_kustomer}}</option>
                  @endforeach
                </select>
          </div>
        </div>
      </div>
<!--       <div class="col-xs-5">
        <button type="button" class="btn btn-info btn-flat btn-sm" id="add_customer"><i class="fa fa-plus"></i> Tambah Customer</button>
      </div> -->
    </div>
    <div class="row">
    <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">Tanggal</label>
          <div class="col-sm-9">
            <input type="text" class="form-control datepicker" name="tgl_penjualan" id="tgl_penjualan">
          </div>
        </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">Catatan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="deskripsi_penjualan" id="deskripsi_penjualan" style="width: 500px">
          </div>
        </div>
    </div>
    </div>

  </div>
</div>


<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">Tambah Item</h3>
  </div>
  <div class="box-body">
    <div class="row">
        <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">ITEM</label>
          <div class="col-sm-9">
                <select name="produk_id" class="form-control select2 produk_id"  style="width: 100%">
                <option value="">pilih</option>
               @foreach($items as $i)
                <option value="{{$i->id}}">{{$i->nama_item}}</option>
               @endforeach
             </select>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
    <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">QTY</label>
          <div class="col-sm-9">
            <input type="number" class="form-control number" name="jumlah" id="jumlah" min="0">
          </div>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">HARGA</label>
          <div class="col-sm-9">
            <input type="text" class="form-control number" name="harga_jual_temp" id="harga_jual_temp"  readonly>
          </div>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">TOTAL</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="amount" id="amount" readonly>
          </div>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="form-group">
         <div class="col-sm-9">
            <input type="hidden" class="form-control" name="stok_temp" id="stok_temp">
          </div>
          <button type="button" class="btn btn-success btn-flat" id="save_item"><i class="fa fa-plus"></i> Add Item</button>
        </div>

    </div>


    </div>

  </div>
</div>

  <div class="box box-default">
    <div class="box-body">
    <button type="button" class="btn btn-danger btn-flat btn-sm pull-left" id="remove_item"><i class="fa fa-trash"></i> Remove</button>
    <br>
    <table id="table"
           class="table table-striped"
           data-toolbar="#toolbar">
    <thead>
        <tr>
            <th data-field="delete" data-checkbox="true" class="col-sm-1"></th>
            <th data-field="produk_id" data-visible="false">ID PRODUK</th>
            <th data-field="nama_item">ITEM</th>
            <th data-field="jumlah" data-align="center">QTY</th>
            <th data-field="harga_jual_produk" data-formatter="moneyFormatter">PRICE</th>
            <th data-field="subtotal" data-formatter="moneyFormatter" data-align="right">SUBTOTAL</th>
        </tr>
    </thead>
</table>  

  <div class="row">
      <div class="col-md-12">
          <div class="col-md-8">
          </div>
          <div class="col-md-4 box-total" style="margin-top: 10px;">
              <span style="font-weight: bold;font-size: 18px;">Total:</span>
              <span class="pull-right" id="item_total_price" style="font-weight: bold;font-size: 18px;">0.00</span>
              <input type="hidden" name="total_pembelian" id="item_total_price_hidden">
          </div>
      </div>
  </div>
      </div>
    <div class="box-footer text-center">
      <div class="pull-right">
      <button type="button" class="btn btn-default" onclick="window.location.href='/penjualan-barang'"><i class="fa fa-refresh"></i> TUTUP NOTA</button>
      <button type="button" class="btn btn-info" id="simpan_penjualan"><i class="fa fa-save"></i> SIMPAN</button>
    </div>
  </div>
  </div>
</form> 


@endsection
@section('pagescript')
<script type="text/javascript">

  function recount_data( arrayTable ){
      //counting summary
      var total_cost = 0;

      for (i=0; i<=arrayTable.length-1; i++){
          var temp_table = arrayTable[i];
          console.log(arrayTable[i]);
          total_cost += temp_table.subtotal;
      }
      $("#item_total_price").text(numeral(total_cost).format('0,0.00'));
      $("#item_total_price_hidden").val(total_cost);
  }

  $(document).ready(function () {

    $('#table').bootstrapTable();

    $('#add_customer').click(function(){
        $('#modal_kustomer').modal('show');
    });

    // insert item ke bootstrap table
  $('#save_item').click(function(){  
        var idproduk = parseInt($('.produk_id').val());
        var jumlah  = parseInt($('#jumlah').val());
        var harga_jual_produk = $('#harga_jual_temp').val();
        var stok_temp = parseInt($('#stok_temp').val());
        var subtotal = parseInt($('#amount').val());
        if(parseInt($('#jumlah').val()) > parseInt($('#stok_temp').val())){
                    swal({
                        title: "error!",
                        text: "Jumlah melebihi stok yang ada: " + stok_temp + " Unit",
                        type: "error",
                        showConfirmButton: true
                    });
                return false;
        }

        // console.log(idproduk);
      var $tableData = $('#table').bootstrapTable('getData');
     $('#table').bootstrapTable('insertRow', {
          index : 0,
          row : {
              produk_id : $('.produk_id').val(),
              nama_item : $(".produk_id option:selected").text(),
              jumlah : $('#jumlah').val(),
              harga_jual_produk : harga_jual_produk,
              subtotal : subtotal

          }
      }); 
      recount_data( $tableData );
      // clear_item();
  });

    // hapus item
    $("#remove_item").click( function(){
        var ids = $.map($('#table').bootstrapTable("getSelections"), function (row) {
            return row.produk_id;
        });

        $('#table').bootstrapTable("remove", {
            field: "produk_id",
            values: ids
        });
    });


    // mulai simpan penjualan ke database
    $("#simpan_penjualan").click(function(){
    var penjualan_code = $("#penjualan_code").val();
    var kustomer_id = $("#kustomer_id").val();
    var tgl_penjualan = $("#tgl_penjualan").val();
    var deskripsi_penjualan = $("#deskripsi_penjualan").val();
    var total_penjualan = $('#item_total_price_hidden').val();
    var table = [];
    var table = $('#table').bootstrapTable('getData');
    console.log(table);
    if ( "" == $("#kustomer_id").val() ){
        swal({
            title: "Error!",
            text: "Anda belum memilih kustomer",
            type: "error",
            confirmButtonText: 'OK'
        });
        return "";
    }

    var item = $('#table').bootstrapTable('getData');
    if ( 0 == item.length )
    {
        swal({
            title: "Error!",
            text: "Anda belum memasukan item",
            type: "error",
            confirmButtonText: 'OK'
        });
        return "";
    }
     $.ajax({
        type: "POST",
        url:"{{ url('/tambah-penjualan') }}",
        dataType : "text",
        data: {
               _token: "{{ csrf_token() }}",
               penjualan_code:penjualan_code,
               kustomer_id: kustomer_id,
               tgl_penjualan : tgl_penjualan,
               deskripsi_penjualan:deskripsi_penjualan,
               total_penjualan:total_penjualan,
               table:table
        },
        contenType : "application/json",
        success: function (data) {
            console.log(data);
            swal({
            title: "success!",
            text: "Penjualan Berhasil dibuat dengan nomor: " + penjualan_code ,
            type: "success",
            confirmButtonText: 'OK'
            });
          window.location.href='{{url("/penjualan-barang")}}' ;
           //  disable_all();
           // window.after_save = true;
        },
        error: function(data){
            console.log(data);
            swal({
            title: "error!",
            text: "Tidak bisa membuat nota penjualan",
            type: "error",
            confirmButtonText: 'OK'
            })
        }
    });
});

    // pilihan item 
   $('.produk_id').change( function(){
        var id =  $(this).val();
        // alert(id);
        console.log(id);
        $.ajax({
            method: "POST",
            url: "{{url('/get-item')}}",
            dataType: "json",
            cache:false,
            data:{
                    _token: "{{ csrf_token() }}",
                    id : id
            },
            success: function (data) {
                console.log(data);
                // alert(data.nama_item);
                $('#jumlah').val('1');
                $('#harga_jual_temp').val(data.harga_jual);
                $('#stok_temp').val(data.stok);
                $('#amount').val( parseInt($("#jumlah").val() * $("#harga_jual_temp").val()) );
            },
            error: function(data){
                console.log(data);
            }
        });
    }); 


  $("#jumlah").change(function () {
    var stok_temp = parseInt($('#stok_temp').val());
    if(parseInt($('#jumlah').val()) > parseInt($('#stok_temp').val())){
                swal({
                    title: "error!",
                    text: "Jumlah melebihi stok yang ada: " + stok_temp + " Unit",
                    type: "error",
                    showConfirmButton: true
                });
            return false;
    }
    $('#amount').val( parseInt($("#jumlah").val() * $("#harga_jual_temp").val()) );

  });

});

</script>

@endsection