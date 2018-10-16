@extends ('layouts.admin_template')
  @section ('content')
@include('layouts.errors')
@include('sweet::alert')
<form action="{{url('/tambah-pembelian')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
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
            <input type="text" class="form-control" name="pembelian_code" id="pembelian_code" value="{{$newId}}" readonly="">
          </div>
        </div>
      </div>
    <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">Tanggal</label>
          <div class="col-sm-9">
            <input type="text" class="form-control pull-right datepicker" name="tgl_pembelian" id="tgl_pembelian" placeholder="Tanggal" required="required">
          </div>
        </div>
    </div>

    </div>
    <div class="row">
    <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">No.Ref</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="reference_kode" id="reference_kode" placeholder="No.nota suplier">
          </div>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="form-group">
          <label for="nama" class="col-sm-3 control-label">Suplier</label>
          <div class="col-sm-9">
                <select name="suplier_id" class="form-control select2" id="suplier_id"  style="width: 100%">
                  <option value="">pilih</option>
                  @foreach($supliers as $suplier)
                  <option value="{{$suplier->id}}">{{$suplier->nama_suplier}}</option>
                  @endforeach
                </select>
          </div>
        </div>
    </div>
<!--       <div class="col-xs-5">
        <button type="button" class="btn btn-info btn-flat btn-sm" id="add_suplier"><i class="fa fa-plus"></i> Tambah suplier</button>
      </div> -->
    </div>
    <!-- <span class="required">* Jika suplier belum ada, anda bisa langsung menambahkan</span> -->
  </div>
</div>

<div class="box-body">
<div class="row">
  <div class="col-sm-12">
    <button type="button" class="btn btn-success btn-flat pull-right" id="add_item_temp"><i class="fa fa-plus"></i> Add Item</button>
  </div>
</div>
</div>
<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title"><strong>ITEM</strong></h3>
  </div>
    <div class="box-body">
    <button type="button" class="btn btn-danger btn-flat btn-sm pull-left" id="remove_item"><i class="fa fa-trash"></i> Remove</button>
    <br>
    <table id="table"
           class="table table-striped"
           data-toggle="table" 
           data-toolbar="#toolbar">
      <thead>
      <tr>
            <th data-field="delete" data-checkbox="true" class="col-sm-1"></th>
            <th data-field="nama_item">ITEM</th>
            <th data-field="stok">QTY</th>
            <th data-field="harga_pembelian" data-formatter="moneyFormatter">HARGA BELI</th>
            <th data-field="harga_jual" data-formatter="moneyFormatter">HARGA JUAL</th>
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
                <span class="pull-right" id="item_total_cost" style="font-weight: bold;font-size: 18px;">0.00</span>
                <input type="hidden" name="total_pembelian" id="item_total_cost_hidden">
            </div>
        </div>
    </div> 
      </div>
    <div class="box-footer text-center">
      <div class="pull-right">
      <button type="button" class="btn btn-default" onclick="window.location.href='/pembelian-barang'"><i class="fa fa-refresh"></i> TUTUP NOTA</button>
      <button type="button" class="btn btn-info" id="save_pembelian"><i class="fa fa-save"></i> SIMPAN</button>
    </div>
  </div>
  </div>
</form> 


<div class="modal fade" id="modal_item">
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
        <button type="button" class="btn btn-info pull-right save_item">Simpan</button>
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
      $("#item_total_cost").text(numeral(total_cost).format('0,0.00'));
      $("#item_total_cost_hidden").val(total_cost);
  }

  $(document).ready(function () {


    $("#save_pembelian").click(function(){
    var pembelian_code = $("#pembelian_code").val();
    var tgl_pembelian = $("#tgl_pembelian").val();
    var reference_kode = $("#reference_kode").val();
    var suplier_id = $("#suplier_id").val();
    var total_harga = $('#item_total_cost_hidden').val();
    var table = [];
    var table = $('#table').bootstrapTable('getData');
    console.log(table);
    if ( "" == $("#suplier_id").val() ){
        swal({
            title: "Error!",
            text: "Anda belum memilih suplier",
            type: "error",
            confirmButtonText: 'OK'
        });
        return "";
    }
    if ( "" == $("#reference_kode").val() ){
        swal({
            title: "Error!",
            text: "Anda belum memasukan kode referensi atau nota pembelian barang dari suplier",
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
        url:"{{ url('/tambah-pembelian') }}",
        dataType : "text",
        data: {
               _token: "{{ csrf_token() }}",
               pembelian_code:pembelian_code,
               tgl_pembelian: tgl_pembelian,
               reference_kode : reference_kode,
               suplier_id:suplier_id,
               total_harga:total_harga,
               table:table
        },
        contenType : "application/json",
        success: function (data) {
            console.log(data);
            swal({
              title: "success!",
              text: "Nota pembelian berhasil dibuat dengan nomor: " + pembelian_code,
              type: "success",
              confirmButtonText: "OK"
            });
          window.location.href='{{url("/pembelian-barang")}}' ;
           //  disable_all();
           // window.after_save = true;
        },
        error: function(data){
            console.log(data);
            swal({
              title: "error!",
              text: "Nota pembelian tidak dapat dibuat",
              type: "error",
              confirmButtonText: "OK"
            })
        }
    });
});

  
    $('#add_suplier').click(function(){
        $('#modal_suplier').modal('show');
    });

    $('#add_item_temp').click(function(){
        $('#modal_item').modal('show');
    });


    $(".save_item").click( function() {
        var nama_item = $("#nama_item").val();
        var stok      = $('#stok').val();
        var harga_pembelian = $('#harga_pembelian').val();
        var harga_jual = $('#harga_jual').val();
        var $tableData = $('#table').bootstrapTable('getData');
        if("" == nama_item){
          swal({
              title: "Error!",
              text: "Anda belum memasukan nama item",
              type: "error",
              confirmButtonText: 'OK'
          });
          return false;          
        }
        if("" == stok){
          swal({
              title: "error!",
              text: "Mohon masukan jumlah item minimal 1",
              type: "error",
              confirmButtonText: "OK"
          });
          return false;
        }
        if("" == harga_pembelian){
          swal({
              title: "error!",
              text: "Mohon masukan harga pembelian",
              type: "error",
              confirmButtonText: "OK"
          });
          return false;
        }
        if("" == harga_jual){
          swal({
              title: "error!",
              text: "Mohon masukan harga jual",
              type: "error",
              confirmButtonText: "OK"
          });
          return false;
        }
        $('#table').bootstrapTable('insertRow', {
            index : 0,
            row : {
                nama_item : nama_item,
                stok : stok,
                harga_pembelian:harga_pembelian,
                harga_jual:harga_jual,
                subtotal: stok*harga_pembelian
            }
        });
            recount_data( $tableData );
            $('#modal_item').modal('hide');
            clear_item();
    });


    $("#remove_item").click( function(){
        var ids = $.map($('#table').bootstrapTable("getSelections"), function (row) {
            return row.nama_item;
        });

        $('#table').bootstrapTable("remove", {
            field: "nama_item",
            values: ids
        });
    });

  $('#save_pembelian').click(function(){
          if ( "0" == $('#suplier').val() ){
          swal({
              title: "Error!",
              text: "Anda belum memilih suplier",
              type: "error",
              confirmButtonText: 'OK'
          });
          return false;
      }

          if ( "" == $('#item').val() ){
          swal({
              title: "Error!",
              text: "Anda belum memasukan item",
              type: "error",
              confirmButtonText: 'OK'
          });
          return false;
      }

  });

  $('.modal_qty').click(function(){  
        var idtemp = $(this).attr("id"); 
        console.log(idtemp);
       $.ajax({  
            url:"{{url('/show-item-temp')}}",  
            method:"POST",  
            data:{
              _token: "{{ csrf_token() }}",
              idtemp:idtemp
            },  
            success:function(data){  
                console.log(data);
                 $('#modalcontent').html(data);  
                 $('#modal_item_edit').modal("show");  
            }  
       });  
  });

});

  function clear_item(){
      //Olds ways 
      $("#nama_item").val(null);
      $('#stok').val(null);
      $('#harga_pembelian').val(null);
      $('#harga_jual').val(null);
  };


</script>

@endsection