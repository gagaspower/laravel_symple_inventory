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
      <div class="col-xs-5">
        <div class="form-group">
          <label for="nama" class="col-sm-5 control-label">KODE</label>
          <div class="col-sm-7">
            <input type="text" class="form-control" name="mutasi_code" id="mutasi_code" value="{{$newId}}" readonly="">
          </div>
        </div>
      </div>
      <div class="col-xs-5">
        <div class="form-group">
          <label for="nama" class="col-sm-5 control-label">TANGGAL</label>
          <div class="col-sm-7">
            <input type="text" class="form-control datepicker" name="mutasi_tanggal" id="mutasi_tanggal">
          </div>
        </div>
    </div>

<!--       <div class="col-xs-5">
        <button type="button" class="btn btn-info btn-flat btn-sm" id="add_customer"><i class="fa fa-plus"></i> Tambah Customer</button>
      </div> -->
    </div>
    <div class="row">
        <div class="col-xs-5">
        <div class="form-group">
          <label for="nama" class="col-sm-5 control-label">WAREHOUSE ASAL</label>
          <div class="col-sm-7">
                <select name="mutasi_warehouse_out" class="form-control select2" id="mutasi_warehouse_out" style="width: 100%">
                  <option value="">pilih</option>
                  @foreach($warehouses as $warehouse)
                  <option value="{{$warehouse->id}}">{{$warehouse->warehouse_nama}}</option>
                  @endforeach
                </select>
          </div>
        </div>
      </div>

    <div class="col-xs-5">
        <div class="form-group">
          <label for="nama" class="col-sm-5 control-label">WAREHOUSE TUJUAN</label>
          <div class="col-sm-7">
                <select name="mutasi_warehouse_in" class="form-control select2" id="mutasi_warehouse_in" style="width: 100%">
                  <option value="">pilih</option>
                  @foreach($warehouses as $warehouse)
                  <option value="{{$warehouse->id}}">{{$warehouse->warehouse_nama}}</option>
                  @endforeach
                </select>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
    <div class="col-xs-5">
        <div class="form-group">
          <label for="nama" class="col-sm-5 control-label">Catatan</label>
          <div class="col-sm-7">
            <input type="text" class="form-control" name="mutasi_deskripsi" id="mutasi_deskripsi" style="width: 290%">
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
            <input type="text" class="form-control" name="harga_jual_temp" id="harga_jual_temp"  readonly>
            <input type="hidden" name="harga_beli_temp" id="harga_beli_temp">
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
            <th data-field="mutasi_item_id" data-visible="false">ID PRODUK</th>
            <th data-field="mutasi_nama_item">ITEM</th>
            <th data-field="mutasi_item_qty" data-align="center">QTY</th>
            <th data-field="mutasi_item_harga_jual" data-formatter="moneyFormatter">PRICE</th>
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
      <button type="button" class="btn btn-default" onclick="window.location.href='/mutasi-stok'"><i class="fa fa-refresh"></i> TUTUP NOTA</button>
      <button type="button" class="btn btn-info" id="simpan_mutasi"><i class="fa fa-save"></i> SIMPAN</button>
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


    // fungsi jika gudang sudah dipilih di warehouse asal, maka gudang tersebut non aktif pada pilih warehouse tujuan
    $("#mutasi_warehouse_out").change( function(){
        var pilih = $('#mutasi_warehouse_out').find(":selected").val();
        $("#mutasi_warehouse_in option").each(function()
        {
            if (pilih == this.value) {
                this.disabled = true;
            } else {
                this.disabled = false;
            }
        });
    });



    // insert item ke bootstrap table
  $('#save_item').click(function(){  
        var mutasi_item_id = parseInt($('.produk_id').val());
        var mutasi_item_qty  = parseInt($('#jumlah').val());
        var mutasi_item_harga_jual = $('#harga_jual_temp').val();
        var mutasi_item_harga_beli = $('#harga_beli_temp').val();
        var stok_temp = parseInt($('#stok_temp').val());
        var subtotal = parseInt($('#amount').val());
        var item = $('.produk_id');
        var $tableData = $('#table').bootstrapTable('getData');
  
        // validasi jika stok melebihi jumlah yang ada
        if(parseInt($('#jumlah').val()) > parseInt($('#stok_temp').val())){
                    swal({
                        title: "error!",
                        text: "Jumlah melebihi stok yang ada: " + stok_temp + " Unit",
                        type: "error",
                        showConfirmButton: true
                    });
                return false;
        }

        // insert ke bootstrap table
         $('#table').bootstrapTable('insertRow', {
          index : 0,
          row : {
              mutasi_item_id : mutasi_item_id,
              mutasi_nama_item : $(".produk_id option:selected").text(),
              mutasi_item_qty : mutasi_item_qty,
              mutasi_item_harga_beli : mutasi_item_harga_beli,
              mutasi_item_harga_jual : mutasi_item_harga_jual,
              subtotal : subtotal
          }
      }); 
      // hitung subtotal untuk menentukan total akhir
      recount_data( $tableData ); 
  });

    // hapus item
    $("#remove_item").click( function(){
        var ids = $.map($('#table').bootstrapTable("getSelections"), function (row) {
            return row.mutasi_item_id;
        });

        $('#table').bootstrapTable("remove", {
            field: "mutasi_item_id",
            values: ids
        });
    });


    // mulai simpan penjualan ke database
    $("#simpan_mutasi").click(function(){
    var mutasi_code = $("#mutasi_code").val();
    var mutasi_tanggal = $("#mutasi_tanggal").val();
    var mutasi_warehouse_out = $("#mutasi_warehouse_out").val();
    var mutasi_warehouse_in = $("#mutasi_warehouse_in").val();
    var mutasi_deskripsi = $("#mutasi_deskripsi").val();
    var mutasi_total = $('#item_total_price_hidden').val();
    var table = [];
    var table = $('#table').bootstrapTable('getData');
    console.log(table);
    if ( "" == $("#mutasi_warehouse_out").val() ){
        swal({
            title: "Error!",
            text: "Anda belum memilih warehouse asal",
            type: "error",
            confirmButtonText: 'OK'
        });
        return "";
    }

    if ( "" == $("#mutasi_warehouse_in").val() ){
        swal({
            title: "Error!",
            text: "Anda belum memilih warehouse tujuan",
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
        url:"{{ url('/tambah-mutasi') }}",
        dataType : "text",
        data: {
               _token: "{{ csrf_token() }}",
               mutasi_code:mutasi_code,
               mutasi_tanggal: mutasi_tanggal,
               mutasi_warehouse_out : mutasi_warehouse_out,
               mutasi_warehouse_in:mutasi_warehouse_in,
               mutasi_deskripsi:mutasi_deskripsi,
               mutasi_total:mutasi_total,
               table:table
        },
        contenType : "application/json",
        success: function (data) {
            console.log(data);
            swal({
            title: "success!",
            text: "Mutasi stok Berhasil dibuat dengan nomor: " + mutasi_code ,
            type: "success",
            confirmButtonText: 'OK'
            });
          window.location.href='{{url("/mutasi-stok")}}' ;
           //  disable_all();
           // window.after_save = true;
        },
        error: function(data){
            console.log(data);
            swal({
            title: "error!",
            text: "Tidak bisa membuat mutasi stok",
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
                $('#harga_beli_temp').val(data.harga_pembelian);
                $('#stok_temp').val(data.stok);
                $('#amount').val( parseInt($("#jumlah").val() * $("#harga_jual_temp").val()) );
            },
            error: function(data){
                console.log(data);
            }
        });
    }); 


   // menghitung otomatis jika jumlah diubah
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