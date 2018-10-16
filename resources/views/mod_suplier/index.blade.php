 @extends ('layouts.admin_template')
  @section ('content')
@include('layouts.errors')
@include('sweet::alert')    
<fieldset><h3 class="box-title">{{ $page_title }}</h3></fieldset> 
<div class="box">
  <div class="box-body">
    <button type="button" class="btn btn-info" onclick="window.location.href='/tambah-suplier'">
<i class="fa fa-plus-square"></i> Tambah</button>
    <table id="table"
   class="table table-striped"
   data-pagination="true" 
   data-toggle="table" 
   data-search="true"  
   data-page-size="20"
   data-show-export="true"
   data-show-refresh="true"
   data-toolbar="#toolbar">
      <thead>
      <tr>
            <th>Nama suplier</th>
            <th>Telp suplier</th>
            <th>Alamat suplier</th>
            <th></th>
      </tr>
      </thead>
      <tbody>
    @foreach($supliers as $suplier)
      <tr>
      <td>{{$suplier->nama_suplier}}</td>
      <td>{{$suplier->telp_suplier}}</td>
      <td>{{$suplier->alamat_suplier}}</td>
        <td>

          <button type="button" class="btn btn-xs btn-info" title="Edit Kategori" onclick="window.location.href='/edit-suplier/{{$suplier->id}}'"><i class="fa fa-pencil-square-o"></i> Edit</button>

          <button type="button" class="btn btn-xs btn-danger" title="Hapus Kategori" onclick="window.location.href='/hapus-suplier/{{$suplier->id}}'"><i class="fa fa-trash"></i> Hapus</button>
        </td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
@section('pagescript')
<script type="text/javascript">
    $('#table').bootstrapTable();
</script>
@endsection