 @extends ('layouts.admin_template')
  @section ('content')
@include('layouts.errors')
@include('sweet::alert')    
<fieldset><h3 class="box-title">{{ $page_title }}</h3></fieldset> 
<div class="box">
  <div class="box-body">
    <button type="button" class="btn btn-info" onclick="window.location.href='/tambah-warehouse'">
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
            <th>NAMA WAREHOUSE</th>
            <th>ALAMAT WAREHOUSE</th>
            <th></th>
      </tr>
      </thead>
      <tbody>
    @foreach($warehouses as $warehouse)
      <tr>
      <td>{{$warehouse->warehouse_nama}}</td>
      <td>{{$warehouse->warehouse_alamat}}</td>
        <td>

          <button type="button" class="btn btn-sm btn-flat btn-info" title="Edit Kategori" onclick="window.location.href='/edit-warehouse/{{$warehouse->id}}'"><i class="fa fa-pencil-square-o"></i> Edit</button>

          <button type="button" class="btn btn-sm btn-flat btn-danger" title="Hapus Kategori" onclick="window.location.href='/hapus-warehouse/{{$warehouse->id}}'"><i class="fa fa-trash"></i> Hapus</button>
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