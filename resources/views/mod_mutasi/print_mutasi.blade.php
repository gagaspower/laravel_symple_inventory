@extends ('layouts.print')
  @section ('print_content')

  <table class="table" style="font-weight: bold">
    <tr>
       <td>KODE</td><td>:</td><td>{{$get_h->mutasi_code}}</td>
    </tr>
    <tr>
       <td>TANGGAL</td><td>:</td><td>{{$get_h->mutasi_tanggal}}</td>
    </tr>
    <tr>
       <td>WAREHOUSE ASAL</td><td>:</td><td>{{$get_h->warehouse_out}}</td>
    </tr>
    <tr>
       <td>WAREHOUSE TUJUAN</td><td>:</td><td>{{$get_h->warehouse_in}}</td>
    </tr>
  </table>

  <table class="table table-bordered table-condensed">
    <thead>
      <tr style="background: #00c0ef;color: #fff;">
        <th>ITEM</th>
        <th>QTY</th>
        <th>HARGA </th>
        <th>SUBTOTAL</th>
      </tr>
    </thead>
    <tbody>
      <?php $subtotal = 0; ?>
      @foreach($get_d as $d)
      <?php $subtotal = $d->mutasi_item_qty*$d->mutasi_item_harga_jual ; ?>
        <tr>
          <td>{{$d->nama_item}}</td>
          <td>{{$d->mutasi_item_qty}}</td>
          <td>{{ number_format($d->mutasi_item_harga_jual) }}</td>
          <td>{{ number_format($subtotal)}}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr style="font-weight: bold;font-size: 20px;">
          <td colspan="3" align="right">Total:</td>
          <td>{{ number_format($get_h->mutasi_total) }}</td>
      </tr>
    </tfoot>
  </table>
@endsection
