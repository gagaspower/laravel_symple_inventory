@extends ('layouts.admin_template')
  @section ('content')
<div class="box-header with-border">
  <h3 class="box-title">{{ $page_title }}</h3>
</div>
@include('layouts.errors')
@include('sweet::alert')
<form action="{{url('/edit-warehouse')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
{{ csrf_field() }}
<input type="hidden" name="id" value="{{$warehouse->id}}">
  <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
            <div class="form-group">
              <label for="nama" class="col-sm-3 control-label">Nama Warehouse <span class="required">*</span></label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="warehouse_nama" required="required" value="{{$warehouse->warehouse_nama}}">
              </div>
            </div>
            <div class="form-group">
              <label for="nama" class="col-sm-3 control-label">Alamat Warehouse <span class="required">*</span></label>
              <div class="col-sm-9">
                <textarea class="form-control" name="warehouse_alamat">{{$warehouse->warehouse_alamat}}</textarea>             
               </div>
            </div>
            </div>
        </div>
      </div>
    <div class="box-footer text-center">
      <button type="button" class="btn btn-default" onclick="window.location.href='/master-warehouse'"><i class="fa fa-refresh"></i> Kembali</button>
      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>
</form> 
@endsection