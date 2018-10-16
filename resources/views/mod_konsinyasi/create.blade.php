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
          <label for="nama" class="col-sm-3 control-label">KODE</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="konsinyasi_code" id="konsinyasi_code" value="{{$newId}}" readonly="">
          </div>
        </div>
      </div>
        <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">SUPLIER</label>
          <div class="col-sm-9">
                <select name="konsinyasi_suplier_id" class="form-control select2" id="konsinyasi_suplier_id" style="width: 100%">
                  <option value="">pilih</option>
                  @foreach($supliers as $suplier)
                  <option value="{{$suplier->id}}">{{$suplier->nama_suplier}}</option>
                  @endforeach
                </select>
          </div>
        </div>
      </div>

        <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">TIPE</label>
          <div class="col-sm-9">
                <select name="konsinyasi_tipe" class="form-control select2" id="konsinyasi_tipe" style="width: 100%">
                  <option value="">pilih</option>
                  <option value="in">Konsinyasi Masuk</option>
                  <option value="out">Konsinyasi Keluar</option>
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
          <label for="nama" class="col-sm-3 control-label">TANGGAL</label>
          <div class="col-sm-9">
            <input type="text" class="form-control datepicker" name="konsinyasi_tanggal" id="konsinyasi_tanggal">
          </div>
        </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">CATATAN</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="konsinyasi_deskripsi" id="konsinyasi_deskripsi" style="width: 500px">
          </div>
        </div>
    </div>
    </div>

  </div>
</div>

<div id="btn_konsinyasi_in" style="display: none">
<div class="box-body">
<div class="row">
  <div class="col-sm-12">
    <button type="button" class="btn btn-success btn-flat pull-right" id="add_item_konsinyasi_in"><i class="fa fa-plus"></i> Add Item</button>
  </div>
</div>
</div>
</div>

<div class="box box-danger blok_konsinyasi_out" style="display: none;">
  <div class="box-header with-border">
    <h3 class="box-title">Tambah Item</h3>
  </div>
  <div class="box-body">
    <div class="row">
        <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">ITEM</label>
          <div class="col-sm-9">
                <select name="konsinyasi_item_id" class="form-control select2 konsinyasi_item_id"  style="width: 100%">
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
            <input type="text" class="form-control" name="harga_jual_temp" id="harga_jual_temp"  readonly>
            <input type="hidden" class="form-control" name="harga_beli_temp" id="harga_beli_temp"  readonly>
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
          <button type="button" class="btn btn-success btn-flat" id="save_item_konsinyasi_out"><i class="fa fa-plus"></i> Add Item</button>
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
            <th data-field="konsinyasi_item_id" data-visible="false">ID PRODUK</th>
            <th data-field="konsinyasi_item">ITEM</th>
            <th data-field="konsinyasi_item_qty" data-align="center">QTY</th>
            <th data-field="konsinyasi_item_harga_beli" data-visible="false">HARGA BELI</th>
            <th data-field="konsinyasi_item_harga_jual" data-formatter="moneyFormatter">HARGA SATUAN</th>
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
      <button type="button" class="btn btn-default" onclick="window.location.href='/konsinyasi-barang'"><i class="fa fa-refresh"></i> TUTUP NOTA</button>
      <button type="button" class="btn btn-info" id="simpan_konsinyasi"><i class="fa fa-save"></i> SIMPAN</button>
    </div>
  </div>
  </div>
</form> 

<div class="modal fade" id="modal_item" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <form method="post" action="#" enctype="multipart/form-data">
      {{ csrf_field() }}
    <div class="modal-content">
      <div class="modal-header">
          <center><h3 class="modal-title">Tambah Item Masuk</h3></center>
      </div>
      <div class="modal-body">
            <div class="form-group">
              <label>Nama Item <span class="required">*</span></label>
                <input type="text" class="form-control" name="item_name" id="nama_item" required="required">
            </div>
            <div class="form-group">
              <label>Qty</label>
                <input type="number" class="form-control number" name="item_qty" min="0" id="stok" required="required">
            </div>
            <div class="form-group">
              <label>Harga Pokok Pembelian</label>
                <input type="number" class="form-control number" name="item_price" min="0" id="harga_pembelian" required="required">
            </div>
            <div class="form-group">
              <label>Harga Jual</label>
                <input type="number" class="form-control number" name="item_price_sale" min="0" id="harga_jual" required="required">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info pull-right save_item_konsinyasi_in">Simpan</button>
      </div>
    </div>
  </form>
  </div>
</div>
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


  function clear_item_konsinyasi_in(){
      //Olds ways 
      $('#nama_item').val(null);
      $('#stok').val(null);
      $('#harga_pembelian').val(null);
      $('#harga_jual').val(null);
  }


  function clear_item_konsinyasi_out(){
      //Olds ways 
      // $('.konsinyasi_item_id').val();
      // $('.select2-konsinyasi_item_id-container').text("pilih");
      $('#jumlah').val(null);
      $('#harga_beli_temp').val(null);
      $('#harga_jual_temp').val(null);
      $('#stok_temp').val(null);
      $('#amount').val(null);
  }


  $(document).ready(function () {

    // chose konsinyasi tipe
      $('#btn_konsinyasi_in').hide();
      $('.blok_konsinyasi_out').hide();

      $('#konsinyasi_tipe').change(function(){
          if($('#konsinyasi_tipe').val() == 'in'){
            $('#btn_konsinyasi_in').show();
            $('.blok_konsinyasi_out').hide();
          }
          else{
            $('#btn_konsinyasi_in').hide();
            $('.blok_konsinyasi_out').show();
          }
      });



    $('#table').bootstrapTable();

    $('#add_item_konsinyasi_in').click(function(){
        $('#modal_item').modal('show');
    });

    // insert item ke bootstrap table jika konsinyasi tipe keluar
  $('#save_item_konsinyasi_out').click(function(){  
        var idproduk = parseInt($('.konsinyasi_item_id').val());
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
              konsinyasi_item_id : $('.konsinyasi_item_id').val(),
              konsinyasi_item : $(".konsinyasi_item_id option:selected").text(),
              konsinyasi_item_qty : $('#jumlah').val(),
              konsinyasi_item_harga_beli : $('#harga_beli_temp').val(),
              konsinyasi_item_harga_jual: harga_jual_produk,
              subtotal : subtotal

          }
      }); 

      recount_data( $tableData );
       clear_item_konsinyasi_out();     
  });



  // jika konsinyasi tipe in
  $('.save_item_konsinyasi_in').click(function(){ 
        var namaitem = $('#nama_item').val(); 
        var stok  = parseInt($('#stok').val());
        var harga_beli = $('#harga_pembelian').val();
        var harga_jual = parseInt($('#harga_jual').val());
        if("" == namaitem){
                    swal({
                        title: "error!",
                        text: "Anda belum memasukan nama item",
                        type: "error",
                        showConfirmButton: true
                    });
                return false;
        }

        if("" == stok){
              swal({
                  title: "error!",
                  text: "Anda harus memasukan jumlah item. Minimal 1 unit",
                  type: "error",
                  showConfirmButton: true
              });
          return false;          
        }

        if("" == harga_beli){
              swal({
                  title: "error!",
                  text: "Anda belum memasukan harga pembelian",
                  type: "error",
                  showConfirmButton: true
              });
          return false;          
        }

        if("" == harga_jual){
              swal({
                  title: "error!",
                  text: "Anda belum memasukan harga jual",
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
              konsinyasi_item_id : 0,
              konsinyasi_item : namaitem,
              konsinyasi_item_qty : stok,
              konsinyasi_item_harga_beli :harga_beli,
              konsinyasi_item_harga_jual: harga_jual,
              subtotal : stok*harga_jual

          }
      }); 
      recount_data( $tableData );
      $('#modal_item').modal('hide');     
      clear_item_konsinyasi_in(); 
  });

    // hapus item
    $("#remove_item").click( function(){
        var $tableData = $('#table').bootstrapTable('getData');
        var ids = $.map($('#table').bootstrapTable("getSelections"), function (row) {
            return row.konsinyasi_item;
        });

        $('#table').bootstrapTable("remove", {
            field: "konsinyasi_item",
            values: ids
        });
        recount_data( $tableData );
    });


    // mulai simpan penjualan ke database
    $("#simpan_konsinyasi").click(function(){
    var konsinyasi_code = $("#konsinyasi_code").val();
    var konsinyasi_suplier_id = $("#konsinyasi_suplier_id").val();
    var konsinyasi_tanggal = $("#konsinyasi_tanggal").val();
    var konsinyasi_deskripsi = $("#konsinyasi_deskripsi").val();
    var konsinyasi_tipe = $("#konsinyasi_tipe").val();
    var konsinyasi_total = $('#item_total_price_hidden').val();
    var table = [];
    var table = $('#table').bootstrapTable('getData');
    console.log(table);

    if ( "" == $("#konsinyasi_suplier_id").val() ){
        swal({
            title: "Error!",
            text: "Anda belum memilih Suplier",
            type: "error",
            confirmButtonText: 'OK'
        });
        return "";
    }

    if ( "" == $("#konsinyasi_tipe").val() ){
        swal({
            title: "Error!",
            text: "Anda belum memilih tipe konsinyasi",
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
        url:"{{ url('/tambah-konsinyasi') }}",
        dataType : "text",
        data: {
               _token: "{{ csrf_token() }}",
               konsinyasi_code:konsinyasi_code,
               konsinyasi_suplier_id: konsinyasi_suplier_id,
               konsinyasi_tanggal : konsinyasi_tanggal,
               konsinyasi_deskripsi:konsinyasi_deskripsi,
               konsinyasi_tipe:konsinyasi_tipe,
               konsinyasi_total:konsinyasi_total,
               table:table
        },
        contenType : "application/json",
        success: function (data) {
            console.log(data);
            swal({
            title: "success!",
            text: "Konsinyasi Berhasil dibuat dengan nomor: " + konsinyasi_code ,
            type: "success",
            confirmButtonText: 'OK'
            });
          window.location.href='{{url("/konsinyasi-barang")}}' ;
        },
        error: function(data){
            console.log(data);
            swal({
            title: "error!",
            text: "Tidak bisa membuat nota konsinyasi",
            type: "error",
            confirmButtonText: 'OK'
            })
        }
    });
});

    // pilihan item 
   $('.konsinyasi_item_id').change( function(){
        var id =  $(this).val();
        // alert(id);
        console.log(id);
        $.ajax({
            method: "POST",
            url: "{{url('/get-item-konsinyasi')}}",
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
                $('#harga_beli_temp').val(data.harga_pembelian);
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