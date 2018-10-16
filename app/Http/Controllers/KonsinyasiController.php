<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Konsinyasi;
use App\KonsinyasiDetail;
use Alert;
use DB;

class KonsinyasiController extends Controller
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
        $page_title = 'KONSINYASI BARANG';
        $konsinyasis = DB::table('tr_konsinyasi')
                        ->join('master_suplier','master_suplier.id','=','tr_konsinyasi.konsinyasi_suplier_id')
                        ->select(
                                'tr_konsinyasi.id',
                                'tr_konsinyasi.konsinyasi_code',
                                'tr_konsinyasi.konsinyasi_tanggal',
                                'tr_konsinyasi.konsinyasi_deskripsi',
                                'tr_konsinyasi.konsinyasi_total',
                                'tr_konsinyasi.konsinyasi_tipe',
                                'tr_konsinyasi.konsinyasi_status',
                                'tr_konsinyasi.generate_status',
                                'master_suplier.nama_suplier'
                                )
                        ->groupBy(
                                'tr_konsinyasi.id',
                                'tr_konsinyasi.konsinyasi_code',
                                'tr_konsinyasi.konsinyasi_tanggal',
                                'tr_konsinyasi.konsinyasi_deskripsi',
                                'tr_konsinyasi.konsinyasi_total',
                                'tr_konsinyasi.konsinyasi_tipe',
                                'tr_konsinyasi.konsinyasi_status',
                                'tr_konsinyasi.generate_status',
                                'master_suplier.nama_suplier'
                                )
                        ->get();
        return view('mod_konsinyasi.index',compact('page_title','konsinyasis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'TAMBAH KONSINYASI';

        $prefix = 'SC';
        $char = date('Ymd');
        $q = DB::table('tr_konsinyasi')->select(DB::raw('MAX(RIGHT(konsinyasi_code,6)) as kode'));
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

        $items = DB::table('master_item')->where('status','=','00')->get();
        $supliers = DB::table('master_suplier')->get();
        return view('mod_konsinyasi.create',compact('page_title','items','newId','supliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $savekonsinyasi = new Konsinyasi;
        $savekonsinyasi->konsinyasi_code = $request->konsinyasi_code;
        $savekonsinyasi->konsinyasi_tanggal=$request->konsinyasi_tanggal;
        $savekonsinyasi->konsinyasi_deskripsi = $request->konsinyasi_deskripsi;
        $savekonsinyasi->konsinyasi_suplier_id= $request->konsinyasi_suplier_id;
        $savekonsinyasi->konsinyasi_total = $request->konsinyasi_total;
        $savekonsinyasi->konsinyasi_tipe = $request->konsinyasi_tipe;
        $savekonsinyasi->save();
        if($savekonsinyasi){

            foreach($request->table as $data_detail){
                $savedetail = DB::insert("INSERT INTO tr_konsinyasi_detail (tr_konsinyasi_id,konsinyasi_item_id,konsinyasi_item,konsinyasi_item_qty,konsinyasi_item_harga_beli,konsinyasi_item_harga_jual) VALUES (?,?,?,?,?,?)",
                    [ ''.$savekonsinyasi->id.'',
                      ''.$data_detail['konsinyasi_item_id'].'',
                      ''.$data_detail['konsinyasi_item'].'',
                      ''.$data_detail['konsinyasi_item_qty'].'',
                      ''.$data_detail['konsinyasi_item_harga_beli'].'',
                      ''.$data_detail['konsinyasi_item_harga_jual'].''
                    ]
                );
            }

            return response()->json('Konsinyasi telah dibuat');
        }else{
            return response()->json('Tidak dapat membuat konsinyasi');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $get_all_item = DB::table('master_item')->where('status','=','00')->where('id',$request->id)->first();
        return response()->json($get_all_item);
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
        $getKode = DB::table('tr_konsinyasi')->select('konsinyasi_code')->where('id',$id)->first();
        $void = DB::table('tr_konsinyasi')->where('id',$id)->update(['konsinyasi_status'=>'99','generate_status'=>'00']);
        if($void){

            DB::table('master_item')->where('deskripsi',' Auto Generate From '.$getKode->konsinyasi_code)->update(['status'=>'99']);
            Alert::success('Nota Konsinyasi '.$getKode->konsinyasi_code.' berhasil di void','success');
            return redirect('/konsinyasi-barang');           
        }else{
            Alert::error('Nota Konsinyasi '.$getKode->konsinyasi_code.' gagal di void','error');
            return redirect('/konsinyasi-barang');              
        }
    }

    public function generate($id)
    {
        $header = DB::table('tr_konsinyasi')->select('konsinyasi_code')->where('id',$id)->first();
        $detail = DB::table('tr_konsinyasi_detail')->where('tr_konsinyasi_id',$id)->get();
        if(count($detail) > 0){

            // cek apakah sudah ada item berdasarkan kode sc yang dipilih
            $cek = DB::table('master_item')->where('deskripsi',' Auto Generate From '.$header->konsinyasi_code)->get();
            if(count($cek) == 0){ 

            foreach($detail as $item_sc){

                $new_item_sc = new \App\MasterItem;
                $new_item_sc->nama_item = $item_sc->konsinyasi_item;
                $new_item_sc->stok      = $item_sc->konsinyasi_item_qty;
                $new_item_sc->harga_pembelian = $item_sc->konsinyasi_item_harga_beli;
                $new_item_sc->harga_jual      = $item_sc->konsinyasi_item_harga_jual;
                $new_item_sc->deskripsi       = ' Auto Generate From '.$header->konsinyasi_code;
                $new_item_sc->save();

            }
        }else{
            DB::table('master_item')->where('deskripsi',' Auto Generate From '.$header->konsinyasi_code)->update(['status'=>'00']);
        }
        DB::table('tr_konsinyasi')->where('id',$id)->update(['generate_status' => '01']);
        Alert::success('Item telah dibuat dari konsinyasi '.$header->konsinyasi_code.'','success');
        return redirect('/konsinyasi-barang');
        }
    }

    public function print($id)
    {
      $page_title = 'INVOICE KONSINYASI';
      $get_h = DB::table('tr_konsinyasi')
              ->join('master_suplier','master_suplier.id','=','tr_konsinyasi.konsinyasi_suplier_id')
              ->select('tr_konsinyasi.id',
                       'tr_konsinyasi.konsinyasi_code',
                       'tr_konsinyasi.konsinyasi_total',
                       'tr_konsinyasi.konsinyasi_tanggal',
                       'tr_konsinyasi.konsinyasi_tipe',
                       'master_suplier.nama_suplier',
                       'master_suplier.telp_suplier',
                       'master_suplier.alamat_suplier')
              ->where('tr_konsinyasi.id',$id)->first();
      $get_d = DB::table('tr_konsinyasi_detail')
              ->join('tr_konsinyasi','tr_konsinyasi.id','=','tr_konsinyasi_detail.tr_konsinyasi_id')
              ->select('tr_konsinyasi_detail.konsinyasi_item','tr_konsinyasi_detail.konsinyasi_item_qty','tr_konsinyasi_detail.konsinyasi_item_harga_jual','tr_konsinyasi_detail.konsinyasi_item_harga_beli')
              ->where('tr_konsinyasi_detail.tr_konsinyasi_id',$id)->get();

      return view('mod_konsinyasi.print_konsinyasi',compact('get_h','get_d','page_title'));      
    }

}
