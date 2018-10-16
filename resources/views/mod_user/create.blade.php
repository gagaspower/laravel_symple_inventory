@extends ('layouts.admin_template')
  @section ('content')
<div class="box-header with-border">
  <h3 class="box-title">{{ $page_title }}</h3>
</div>
@include('layouts.errors')
@include('sweet::alert')
<form action="/tambah-pengguna" method="post" enctype="multipart/form-data" class="form-horizontal">
      {{ csrf_field() }}
  <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label for="nama" class="col-sm-4 control-label">Nama Pengguna</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="name" required="required">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-4 control-label">Email Pengguna</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="email" required="required">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-4 control-label">Password</label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" name="password" required="required">
                </div>
              </div>

              <div class="form-group">
                <label for="nama" class="col-sm-4 control-label">Ulangi Password</label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" name="password_confirmation" required="required">
                </div>
              </div>

            </div>
        </div>
      </div>
    <div class="box-footer text-center">
     <button type="button" class="btn btn-default" onclick="window.location.href='/pengguna'"><i class="fa fa-refresh"></i> Kembali</button>
      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>
</form> 
@endsection