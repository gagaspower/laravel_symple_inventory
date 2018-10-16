<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome','AdminContoller@index')->name('home');

Route::get('/pengguna','UserController@index');
Route::get('/tambah-pengguna','UserController@create');
Route::post('/tambah-pengguna','UserController@store');
Route::get('/ubah-pengguna/{id}','UserController@edit');
Route::post('/ubah-pengguna/{id}','UserController@update');
Route::get('/hapus-pengguna/{id}','UserController@destroy');


//route ubah password
Route::get('/ubah-password','ChangePasswordController@index');
Route::post('/ubah-password/{id}','ChangePasswordController@update');


// master item
Route::get('/master-item','MasterItemController@index');
Route::get('/tambah-item','MasterItemController@create');
Route::post('/tambah-item','MasterItemController@store');
Route::get('/edit-item/{id}','MasterItemController@edit');
Route::post('/edit-item','MasterItemController@update');
Route::get('/hapus-item/{id}','MasterItemController@destroy');
Route::get('/void-item/{id}','MasterItemController@void');
Route::get('/show-item/{id}','MasterItemController@show');
// suplier
Route::get('/master-suplier','MasterSuplierController@index');
Route::get('/tambah-suplier','MasterSuplierController@create');
Route::post('/tambah-suplier','MasterSuplierController@store');
Route::get('/edit-suplier/{id}','MasterSuplierController@edit');
Route::post('/edit-suplier','MasterSuplierController@update');
Route::get('/hapus-suplier/{id}','MasterSuplierController@destroy');

// kustomer
Route::get('/master-kustomer','MasterKustomerController@index');
Route::get('/tambah-kustomer','MasterKustomerController@create');
Route::post('/tambah-kustomer','MasterKustomerController@store');
Route::get('/edit-kustomer/{id}','MasterKustomerController@edit');
Route::post('/edit-kustomer','MasterKustomerController@update');
Route::get('/hapus-kustomer/{id}','MasterKustomerController@destroy');
Route::post('/save-kustomer-modal','MasterKustomerController@save_kustomer');

// pembelian barang
Route::get('/pembelian-barang','TrPembelianController@index');
Route::get('/tambah-pembelian','TrPembelianController@create');
Route::post('/tambah-pembelian','TrPembelianController@store');
Route::get('/void-pembelian/{id}','TrPembelianController@destroy');
Route::get('/show-detail-pembelian/{id}','TrPembelianController@detail');



// penjualan
Route::get('/penjualan-barang','PenjualanController@index');
Route::get('/tambah-penjualan','PenjualanController@create');
Route::post('/tambah-penjualan','PenjualanController@store');
Route::get('/void-penjualan/{id}','PenjualanController@destroy');
Route::get('/print/{id}','PenjualanController@print');
Route::post('/get-item','PenjualanController@show_item');


// warehouse
Route::get('/master-warehouse','WarehouseController@index');
Route::get('/tambah-warehouse','WarehouseController@create');
Route::post('/tambah-warehouse','WarehouseController@store');
Route::get('/edit-warehouse/{id}','WarehouseController@edit');
Route::post('/edit-warehouse','WarehouseController@update');
Route::get('/hapus-warehouse/{id}','WarehouseController@destroy');


//konsinyasi barang
Route::get('/konsinyasi-barang','KonsinyasiController@index');
Route::get('/tambah-konsinyasi','KonsinyasiController@create');
Route::post('/get-item-konsinyasi','KonsinyasiController@show');
Route::post('/tambah-konsinyasi','KonsinyasiController@store');
Route::get('/generate-item/{id}','KonsinyasiController@generate');
Route::get('/void-konsinyasi/{id}','KonsinyasiController@destroy');
Route::get('/cetak/{id}','KonsinyasiController@print');

// mutasi stok
Route::get('/mutasi-stok','MutasiController@index');
Route::get('/tambah-mutasi','MutasiController@create');
Route::post('/tambah-mutasi','MutasiController@store');
Route::get('/void-mutasi-stok/{id}','MutasiController@destroy');
Route::get('/cetak-mutasi/{id}','MutasiController@print');

// report pembelian
Route::get('/laporan-pembelian-barang','ReportPembelianController@index');
Route::post('/get-report-pembelian','ReportPembelianController@show');
Route::get('/get-detail-pembelian/{id}','ReportPembelianController@detail');

Route::get('/laporan-penjualan-barang','ReportPenjualanController@index');
Route::post('/get-report-penjualan','ReportPenjualanController@show');
Route::get('/get-detail-penjualan/{id}','ReportPenjualanController@detail');

// report mutasi
Route::get('/laporan-mutasi-stok','ReportMutasiController@index');
Route::post('/get-report-mutasi','ReportMutasiController@show');
Route::get('/get-detail-mutasi/{id}','ReportMutasiController@detail_mutasi');

Route::get('/', 'SessionsController@create');
Route::post('/ameliapuspita', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');





