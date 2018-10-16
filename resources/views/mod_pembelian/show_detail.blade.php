  <table class="table">
    <tr>
       <td>Kode</td><td>:</td><td>{{$get_h->pembelian_code}}</td>
    </tr>
    <tr>
       <td>Kode Referensi</td><td>:</td><td>{{$get_h->reference_kode}}</td>
    </tr>
    <tr>
       <td>Suplier</td><td>:</td><td>{{$get_h->nama_suplier}}</td>
    </tr>
  </table>
  <table class="table table-bordered table-condensed">
    <thead>
      <tr style="background: #00c0ef;color: #fff;">
        <th>Item</th>
        <th>Qty</th>
        <th>Harga </th>
      </tr>
    </thead>
    <tbody>
      @foreach($get_d as $d)
        <tr>
          <td>{{$d->nama_item}}</td>
          <td>{{$d->stok}}</td>
          <td>{{ number_format($d->harga_pembelian) }}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr style="font-weight: bold;">
          <td colspan="2" align="right">Total:</td>
          <td>{{ number_format($get_h->total_harga) }}</td>
      </tr>
    </tfoot>
  </table>