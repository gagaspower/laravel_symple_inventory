<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Alert;

class ReportPembelianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'LAPORAN PEMBELIAN';
        return view('mod_report_pembelian.index',compact('page_title'));
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
        $pembelians = DB::table('tr_pembelian')
                      ->join('master_suplier','master_suplier.id','=','tr_pembelian.suplier_id')
                      ->select(
                        'master_suplier.nama_suplier',
                        'tr_pembelian.pembelian_code',
                        'tr_pembelian.tgl_pembelian',
                        'tr_pembelian.total_harga',
                        'tr_pembelian.status',
                        'tr_pembelian.id')
                      ->groupBy(
                        'master_suplier.nama_suplier',
                        'tr_pembelian.pembelian_code',
                        'tr_pembelian.tgl_pembelian',
                        'tr_pembelian.total_harga',
                        'tr_pembelian.status',
                        'tr_pembelian.id')
                      ->where('tr_pembelian.status','<>','99')
                      ->whereBetween('tr_pembelian.tgl_pembelian',[$tgl_awal,$tgl_akhir])
                      ->orderBy('tr_pembelian.id','desc')
                      ->get();
        return response()->json($pembelians);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $det = DB::table('tr_pembelian_detail')->where('tr_pembelian_id',$id)->get();
        return response()->json($det);

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
