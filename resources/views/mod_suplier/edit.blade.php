@extends ('layouts.admin_template')
  @section ('content')
<div class="box-header with-border">
  <h3 class="box-title">{{ $page_title }}</h3>
</div>
@include('layouts.errors')
@include('sweet::alert')
<form action="{{url('/edit-suplier')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
{{ csrf_field() }}
<input type="hidden" name="id" value="{{$suplier->id}}">
  <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
            <div class="form-group">
              <label for="nama" class="col-sm-2 control-label">Nama Suplier <span class="required">*</span></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_suplier" required="required" value="{{$suplier->nama_suplier}}">
              </div>
            </div>
            <div class="form-group">
              <label for="nama" class="col-sm-2 control-label">No. telp </label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="telp_suplier" value="{{$suplier->telp_suplier}}">
              </div>
            </div>
            <div class="form-group">
              <label for="nama" class="col-sm-2 control-label">Alamat Suplier <span class="required">*</span></label>
              <div class="col-sm-10">
                <textarea class="form-control" name="alamat_suplier">{{$suplier->alamat_suplier}}</textarea>             
               </div>
            </div>
            </div>
        </div>
      </div>
    <div class="box-footer text-center">
      <button type="button" class="btn btn-default" onclick="window.location.href='/master-suplier'"><i class="fa fa-refresh"></i> Kembali</button>
      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>
</form> 
@endsection