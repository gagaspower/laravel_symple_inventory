<aside class="main-sidebar">
  <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">

        <li {{{ (Request::is('welcome') ? 'class=active' : '') }}}>
          <a href="/welcome"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
          </a>
        </li>
        <li><a href="{{url('/pengguna')}}"><i class="fa fa-user"></i> <span>PENGGUNA</span></a></li>
        
        <li class="treeview {{{ (Request::is('master-item','tambah-item','edit-item/*',
                                              'master-suplier','tambah-suplier','edit-suplier/*',
                                              'master-kustomer','tambah-kustomer','edit-kustomer/*',
                                              'master-warehouse','tambah-warehouse','edit-warehouse/*'
                                            ) ? 'active' : '') }}}">
          <a href="#">
            <i class="fa fa-database"></i> <span>MASTER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{{ (Request::is('master-item','tambah-item','edit-item/*') ? 'class=active' : '') }}}><a href="{{url('/master-item')}}"><i class="fa fa-circle-o text-aqua"></i> <span>ITEM</span></a></li>
            <li {{{ (Request::is('master-suplier','tambah-suplier','edit-suplier/*') ? 'class=active' : '') }}}><a href="{{url('/master-suplier')}}"><i class="fa fa-circle-o text-aqua"></i> <span>SUPLIER</span></a></li>
            <li {{{ (Request::is('master-kustomer','tambah-kustomer','edit-kustomer/*') ? 'class=active' : '') }}}><a href="{{url('/master-kustomer')}}"><i class="fa fa-circle-o text-aqua"></i> <span>KUSTOMER</span></a></li>
            <li {{{ (Request::is('master-warehouse','tambah-warehouse','edit-warehouse/*') ? 'class=active' : '') }}}><a href="{{url('/master-warehouse')}}"><i class="fa fa-circle-o text-aqua"></i> <span>WAREHOUSE</span></a></li>
          </ul>
        </li>

        <li class="treeview {{{ (Request::is('konsinyasi-barang','tambah-konsinyasi',
                                              'mutasi-stok','tambah-mutasi'
                                            ) ? 'active' : '') }}}">
          <a href="#">
            <i class="fa fa-exchange"></i> <span>INVENTORI</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{{ (Request::is('konsinyasi-barang','tambah-konsinyasi') ? 'class=active' : '') }}}><a href="{{url('/konsinyasi-barang')}}"><i class="fa fa-circle-o text-aqua"></i> <span> KONSINYASI</span></a></li>
            <li {{{ (Request::is('mutasi-stok','tambah-mutasi') ? 'class=active' : '') }}}><a href="{{url('/mutasi-stok')}}"><i class="fa fa-circle-o text-aqua"></i> <span>MUTASI STOK</span></a></li>
          </ul>
        </li> 

        <li class="treeview {{{ (Request::is('pembelian-barang','tambah-pembelian','edit-pembelian/*',
                                              'penjualan-barang','tambah-penjualan','edit-penjualan/*'
                                            ) ? 'active' : '') }}}">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>TRANSAKSI</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{{ (Request::is('pembelian-barang','tambah-pembelian') ? 'class=active' : '') }}}><a href="{{url('/pembelian-barang')}}"><i class="fa fa-circle-o text-aqua"></i> <span> PURCHASE ORDER</span></a></li>
            <li {{{ (Request::is('penjualan-barang','tambah-penjualan') ? 'class=active' : '') }}}><a href="{{url('/penjualan-barang')}}"><i class="fa fa-circle-o text-aqua"></i> <span>SALES ORDER</span></a></li>
          </ul>
        </li> 

        <li class="treeview {{{ (Request::is('laporan-pembelian-barang','laporan-penjualan-barang','laporan-mutasi-stok') ? 'active' : '') }}}">
          <a href="#">
            <i class="fa  fa-print"></i> <span>REPORT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li {{{ (Request::is('laporan-pembelian-barang') ? 'class=active' : '') }}}><a href="{{url('/laporan-pembelian-barang')}}"><i class="fa fa-circle-o text-aqua"></i> <span>REPORT PEMBELIAN</span></a></li>
            <li {{{ (Request::is('laporan-penjualan-barang') ? 'class=active' : '') }}}><a href="{{url('/laporan-penjualan-barang')}}"><i class="fa fa-circle-o text-aqua"></i> <span>REPORT PENJUALAN</span></a></li>
            <li {{{ (Request::is('laporan-mutasi-stok') ? 'class=active' : '') }}}><a href="{{url('/laporan-mutasi-stok')}}"><i class="fa fa-circle-o text-aqua"></i> <span>REPORT MUTASI STOK</span></a></li>
          </ul>
        </li> 
      </ul>
  </section>
</aside>