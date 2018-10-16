<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class ReportPenjualanController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'LAPORAN PENJUALAN';
        return view('mod_report_penjualan.index',compact('page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $tgl_awal = $request->tanggal_awal;
        $tgl_akhir= $request->tanggal_akhir;
        $penjualans = DB::table('tr_penjualan')
                    ->join('master_kustomer','master_kustomer.id','=','tr_penjualan.kustomer_id')
                    ->select('tr_penjualan.id','tr_penjualan.penjualan_code','tr_penjualan.deskripsi_penjualan','tr_penjualan.tgl_penjualan','tr_penjualan.total_penjualan','master_kustomer.nama_kustomer')
                    ->groupBy('tr_penjualan.id','tr_penjualan.penjualan_code','tr_penjualan.deskripsi_penjualan','tr_penjualan.tgl_penjualan','tr_penjualan.total_penjualan','master_kustomer.nama_kustomer')
                      ->where('tr_penjualan.status','<>','99')
                      ->whereBetween('tr_penjualan.tgl_penjualan',[$tgl_awal,$tgl_akhir])
                      ->orderBy('tr_penjualan.id','desc')
                      ->get();
        return response()->json($penjualans);
    }


    public function detail($id)
    {
        $det = DB::table('tr_penjualan_detail')
                        ->join('master_item','master_item.id','=','tr_penjualan_detail.produk_id')
                        ->select('tr_penjualan_detail.tr_penjualan_id','tr_penjualan_detail.jumlah','tr_penjualan_detail.harga_jual_produk','master_item.nama_item')
                        ->where('tr_penjualan_id',$id)->get();
        return response()->json($det);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
