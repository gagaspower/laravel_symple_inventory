@extends ('layouts.print')
  @section ('print_content')

  <table class="table" style="font-weight: bold">
    <tr>
       <td>KODE</td><td>:</td><td>{{$get_h->konsinyasi_code}}</td>
    </tr>
    <tr>
       <td>SUPLIER</td><td>:</td><td>{{$get_h->nama_suplier}}</td>
    </tr>
    <tr>
       <td>TIPE</td><td>:</td><td>
          @if($get_h->konsinyasi_tipe == 'in')
          BARANG MASUK
          @elseif($get_h->konsinyasi_tipe == 'out')
          BARANG KELUAR
          @endif
       </td>
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
      <?php $subtotal = $d->konsinyasi_item_qty*$d->konsinyasi_item_harga_beli ; ?>
        <tr>
          <td>{{$d->konsinyasi_item}}</td>
          <td>{{$d->konsinyasi_item_qty}}</td>
          <td>{{ number_format($d->konsinyasi_item_harga_beli) }}</td>
          <td>{{ number_format($subtotal)}}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr style="font-weight: bold;font-size: 20px;">
          <td colspan="3" align="right">Total:</td>
          <td>{{ number_format($get_h->konsinyasi_total) }}</td>
      </tr>
    </tfoot>
  </table>
@endsection
