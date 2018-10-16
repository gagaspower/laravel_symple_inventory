 @extends ('layouts.admin_template')
  @section ('content')
@include('layouts.errors')
@include('sweet::alert')    
<fieldset><h3 class="box-title">{{ $page_title }}</h3></fieldset> 
<div class="box">
  <div class="box-body">
    <button type="button" class="btn btn-info" onclick="window.location.href='/tambah-item'">
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
            <th>Nama item</th>
            <th>Deskripsi</th>
            <th>Stok Item</th>
            <th>Harga Pembelian</th>
            <th>Harga Penjualan</th>
            <th></th>
      </tr>
      </thead>
      <tbody>
    @foreach($items as $item)
      <tr>
      <td>{{$item->nama_item}}</td>
      <td>
        @if($item->deskripsi == null)
        -
        @else
          {{ $item->deskripsi }}
        @endif
      </td>
      <td>{{$item->stok}}</td>
      <td>{{ number_format($item->harga_pembelian) }}</td>
      <td>{{ number_format($item->harga_jual)}}</td>
        <td>
          @if($item->status == '00')
          @if($item->deskripsi == null)
          <button type="button" class="btn btn-xs btn-info" title="Edit Kategori" onclick="window.location.href='/edit-item/{{$item->id}}'"><i class="fa fa-pencil-square-o"></i> Edit</button>
          @endif
          <button type="button" class="btn btn-xs btn-danger" title="Hapus Kategori" onclick="window.location.href='/hapus-item/{{$item->id}}'"><i class="fa fa-trash"></i> Hapus</button>

          <button type="button" class="btn btn-xs btn-warning" onclick="window.location.href='/void-item/{{$item->id}}'"><i class="fa fa-sign-out"></i> VOID</button>
          @else
             <p style="text-transform: uppercase;font-size: 18px; letter-spacing: 10px;color: #dd4b39 ;"><strong>VOID !</strong></p>
          @endif          
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