@extends ('layouts.admin_template')
  @section ('content')
<div class="box-header with-border">
  <h3 class="box-title">{{ $page_title }}</h3>
</div>
@include('layouts.errors')
@include('sweet::alert')
<form action="{{url('/edit-item')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
{{ csrf_field() }}
<input type="hidden" name="id" value="{{$items->id}}">
  <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
            <div class="form-group">
              <label for="nama" class="col-sm-2 control-label">Nama Item <span class="required">*</span></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_item" required="required" value="{{$items->nama_item}}">
              </div>
            </div>
            <div class="form-group">
              <label for="nama" class="col-sm-2 control-label">Stok <span class="required">*</span></label>
              <div class="col-sm-10">
                <input type="number" class="form-control number" name="stok" required="required" min="0" value="{{$items->stok}}">
              </div>
            </div>
            <div class="form-group">
              <label for="nama" class="col-sm-2 control-label">Harga Pembelian <span class="required">*</span></label>
              <div class="col-sm-10">
                <input type="number" class="form-control number" name="harga_pembelian" required="required" min="0" value="{{$items->harga_pembelian}}">
              </div>
            </div>
            <div class="form-group">
              <label for="nama" class="col-sm-2 control-label">Harga Jual <span class="required">*</span></label>
              <div class="col-sm-10">
                <input type="number" class="form-control number" name="harga_jual" required="required" min="0" value="{{$items->harga_jual}}">
              </div>
            </div>
            </div>
        </div>
      </div>
    <div class="box-footer text-center">
      <button type="button" class="btn btn-default" onclick="window.location.href='/master-item'"><i class="fa fa-refresh"></i> Kembali</button>
      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>
</form> 
@endsection