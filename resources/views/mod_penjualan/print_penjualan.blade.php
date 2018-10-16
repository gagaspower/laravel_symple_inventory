@extends ('layouts.print')
  @section ('print_content')

  <table class="table" style="font-weight: bold">
    <tr>
       <td>Kode</td><td>:</td><td>{{$get_h->penjualan_code}}</td>
    </tr>
    <tr>
       <td>Kustomer</td><td>:</td><td>{{$get_h->nama_kustomer}}</td>
    </tr>
  </table>

  <table class="table table-bordered table-condensed">
    <thead>
      <tr style="background: #00c0ef;color: #fff;">
        <th>Item</th>
        <th>Qty</th>
        <th>Harga </th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php $subtotal = 0; ?>
      @foreach($get_d as $d)
      <?php $subtotal = $d->jumlah*$d->harga_jual_produk ; ?>
        <tr>
          <td>{{$d->nama_item}}</td>
          <td>{{$d->jumlah}}</td>
          <td>{{ number_format($d->harga_jual_produk) }}</td>
          <td>{{ number_format($subtotal)}}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr style="font-weight: bold;font-size: 20px;">
          <td colspan="3" align="right">Total:</td>
          <td>{{ number_format($get_h->total_penjualan) }}</td>
      </tr>
    </tfoot>
  </table>
@endsection
