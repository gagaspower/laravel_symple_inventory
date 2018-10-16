<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class ReportMutasiController extends Controller
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
        $page_title = 'LAPORAN MUTASI STOK';
        return view('mod_report_mutasi.index',compact('page_title'));
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
        $mutasi = DB::table('tr_mutasi_stok')
                        ->leftjoin('master_warehouse','master_warehouse.id','=','tr_mutasi_stok.mutasi_warehouse_out')
                        ->leftjoin('master_warehouse AS ws','tr_mutasi_stok.mutasi_warehouse_in','=','ws.id')
                        ->select(
                                'tr_mutasi_stok.id',
                                'tr_mutasi_stok.mutasi_code',
                                'tr_mutasi_stok.mutasi_tanggal',
                                'tr_mutasi_stok.mutasi_deskripsi',
                                'tr_mutasi_stok.mutasi_total',
                                'master_warehouse.warehouse_nama AS warehouse_out',
                                'ws.warehouse_nama AS warehouse_in'
                                )
                      ->where('tr_mutasi_stok.mutasi_status','<>','99')
                      ->whereBetween('tr_mutasi_stok.mutasi_tanggal',[$tgl_awal,$tgl_akhir])
                      ->orderBy('tr_mutasi_stok.id','DESC')
                      ->get();
        return response()->json($mutasi);
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

    public function detail_mutasi($id)
    {
      $details = DB::table('tr_mutasi_stok_detail')
                        ->join('master_item','master_item.id','=','tr_mutasi_stok_detail.mutasi_item_id')
                        ->select('tr_mutasi_stok_detail.*','master_item.nama_item')
                        ->where('tr_mutasi_stok_detail.mutasi_id',$id)->get();
        return response()->json($details);        
    }
}
