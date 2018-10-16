<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use DB;
use App\Mutasi;
use App\MutasiDetail;
use Auth;
class MutasiController extends Controller
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
        $page_title = 'MUTASI STOK BARANG';
        $mutasis = DB::table('tr_mutasi_stok')
                        ->leftjoin('master_warehouse','master_warehouse.id','=','tr_mutasi_stok.mutasi_warehouse_out')
                        ->leftjoin('master_warehouse AS ws','tr_mutasi_stok.mutasi_warehouse_in','=','ws.id')
                        ->select(
                                'tr_mutasi_stok.id',
                                'tr_mutasi_stok.mutasi_code',
                                'tr_mutasi_stok.mutasi_tanggal',
                                'tr_mutasi_stok.mutasi_deskripsi',
                                'tr_mutasi_stok.mutasi_total',
                                'tr_mutasi_stok.mutasi_status',
                                'master_warehouse.warehouse_nama AS warehouse_out',
                                'ws.warehouse_nama AS warehouse_in'
                                )
                        ->orderBy('tr_mutasi_stok.id','DESC')
                        ->get();
        return view('mod_mutasi.index',compact('page_title','mutasis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'TAMBAH MUTASI STOK';
        $prefix = 'SM';
        $char = date('Ymd');
        $q = DB::table('tr_mutasi_stok')->select(DB::raw('MAX(RIGHT(mutasi_code,6)) as kode'));
        if($q->count() > 0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kode)+1;
                $newId = $prefix.$char.sprintf("%06s",$tmp);
            }
        }else{

                $newId = $prefix.$char."000001";
        }
        $warehouses = DB::table('master_warehouse')->get();
        $items = DB::table('master_item')->where('stok','<>','0')->where('status','<>','99')->get();
        return view('mod_mutasi.create',compact('page_title','newId','warehouses','items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Mutasi;
        $add->mutasi_code = $request->mutasi_code;
        $add->mutasi_tanggal=$request->mutasi_tanggal;
        $add->mutasi_deskripsi = $request->mutasi_deskripsi;
        $add->mutasi_warehouse_out = $request->mutasi_warehouse_out;
        $add->mutasi_warehouse_in  = $request->mutasi_warehouse_in;
        $add->mutasi_total = $request->mutasi_total;
        $add->save();
        if($add){

            foreach($request->table as $data_detail){
                $details = new MutasiDetail;
                $details->mutasi_id = $add->id;
                $details->mutasi_item_id = $data_detail['mutasi_item_id'];
                $details->mutasi_item_qty= $data_detail['mutasi_item_qty'];
                $details->mutasi_item_harga_beli = $data_detail['mutasi_item_harga_beli'];
                $details->mutasi_item_harga_jual = $data_detail['mutasi_item_harga_jual'];
                $details->save();
            }

        DB::update("UPDATE master_item,tr_mutasi_stok_detail SET master_item.stok = master_item.stok - tr_mutasi_stok_detail.mutasi_item_qty 
                    WHERE master_item.id = tr_mutasi_stok_detail.mutasi_item_id AND tr_mutasi_stok_detail.mutasi_id = '".$add->id."'");
        return response()->json('Mutasi stok sukses');            
        }else{
            return response()->json('Mutasi stok gagal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $get_code = DB::table('tr_mutasi_stok')->select('mutasi_code')->where('id',$id)->first();
        $del = Mutasi::where('id',$id)->update(['mutasi_status' => '99']);
        if($del){

        DB::update("UPDATE master_item,tr_mutasi_stok_detail SET master_item.stok = master_item.stok + tr_mutasi_stok_detail.mutasi_item_qty 
                    WHERE master_item.id = tr_mutasi_stok_detail.mutasi_item_id AND tr_mutasi_stok_detail.mutasi_id = '".$id."'");

            Alert::success('Mutasi Stok Nomor:'.$get_code->mutasi_code.' telah VOID stok barang akan dikembalikan','sukses');
            return redirect('/mutasi-stok');
        }else{
            Alert::error('Tidak dapat melakukan request','gagal');
           return redirect('/mutasi-stok');            
        } 
    }


    public function print($id)
    {
      $page_title = 'INVOICE MUTASI STOK';
      $get_h = DB::table('tr_mutasi_stok')
              ->join('master_warehouse','master_warehouse.id','=','tr_mutasi_stok.mutasi_warehouse_out')
              ->join('master_warehouse AS ws','ws.id','=','tr_mutasi_stok.mutasi_warehouse_in')
              ->select('tr_mutasi_stok.id',
                       'tr_mutasi_stok.mutasi_code',
                       'tr_mutasi_stok.mutasi_total',
                       'tr_mutasi_stok.mutasi_tanggal',
                       'master_warehouse.warehouse_nama AS warehouse_out',
                       'ws.warehouse_nama AS warehouse_in')
              ->where('tr_mutasi_stok.id',$id)->first();
      $get_d = DB::table('tr_mutasi_stok_detail')
                        ->join('master_item','master_item.id','=','tr_mutasi_stok_detail.mutasi_item_id')
                        ->select('tr_mutasi_stok_detail.*','master_item.nama_item')
                        ->where('tr_mutasi_stok_detail.mutasi_id',$id)->get();

      return view('mod_mutasi.print_mutasi',compact('get_h','get_d','page_title'));        
    }
}
