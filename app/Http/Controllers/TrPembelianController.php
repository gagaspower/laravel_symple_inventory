<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Alert;
use DB;
use App\TrPembelian;
use App\TrPembelianDetail;
use App\MasterSuplier;
use Auth;
class TrPembelianController extends Controller
{

    public function __construct(){

        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Pembelian Barang';
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
                      ->orderBy('tr_pembelian.id','desc')
                      ->get();
        return view('mod_pembelian.index',compact('page_title','pembelians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Tambah Pembelian Barang';
        $supliers = DB::table('master_suplier')
                    ->select('id','nama_suplier')
                    ->get();

        $prefix = 'PO';
        $char = date('Ymd');
        $q = DB::table('tr_pembelian')->select(DB::raw('MAX(RIGHT(pembelian_code,6)) as kode'));
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
        return view('mod_pembelian.create',compact('page_title','supliers','newId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $add = new TrPembelian;
        $add->pembelian_code = $request->pembelian_code;
        $add->suplier_id = $request->suplier_id;
        $add->reference_kode = $request->reference_kode;
        $add->total_harga = $request->total_harga;
        $add->tgl_pembelian=$request->tgl_pembelian;
        $add->user_input = Auth::user()->name;
        $add->save();
        if($add){

        foreach($request->table as $data_details){
            $sql = DB::insert('INSERT INTO tr_pembelian_detail(tr_pembelian_id,nama_item,stok,harga_pembelian,harga_penjualan) VALUES (?,?,?,?,?)',
                                    [ ''.$add->id.'',
                                      ''.$data_details['nama_item'].'',
                                      ''.$data_details['stok'].'',
                                      ''.$data_details['harga_pembelian'].'',
                                      ''.$data_details['harga_jual'].''
                                    ]
                             );   


            $sql = DB::insert('INSERT INTO master_item(nama_item,stok,harga_pembelian,harga_jual,deskripsi) VALUES (?,?,?,?,?)',
                                    [ ''.$data_details['nama_item'].'',
                                      ''.$data_details['stok'].'',
                                      ''.$data_details['harga_pembelian'].'',
                                      ''.$data_details['harga_jual'].'',
                                      'Auto Generate From - ' .$add->pembelian_code.''
                                    ]
                             );       
        }
        return response()->json('Pembelian telah disimpan');

        }else{
          return response()->json('Pembelian tidak dapat disimpan');           
        }

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
        $get_code = DB::table('tr_pembelian')->select('pembelian_code')->where('id',$id)->first();
        $del = TrPembelian::where('id',$id)->update(['status' => '99']);
        if($del){
            Alert::success('Pembelian Nomor:'.$get_code->pembelian_code.' telah VOID','sukses');
            return redirect('/pembelian-barang');
        }else{
            Alert::error('Tidak dapat melakukan request','gagal');
            return redirect('/pembelian-barang');            
        }
    }



    public function detail($id)
    {
      $page_title = 'Invoice Pembelian Barang';
      $get_h = DB::table('tr_pembelian')
              ->join('master_suplier','master_suplier.id','=','tr_pembelian.suplier_id')
              ->select('tr_pembelian.id',
                       'tr_pembelian.pembelian_code',
                       'tr_pembelian.reference_kode',
                       'tr_pembelian.total_harga',
                       'tr_pembelian.tgl_pembelian',
                       'master_suplier.nama_suplier')
              ->where('tr_pembelian.id',$id)->first();
      $get_d = DB::table('tr_pembelian_detail')
              ->join('tr_pembelian','tr_pembelian.id','=','tr_pembelian_detail.tr_pembelian_id')
              ->select('tr_pembelian_detail.nama_item','tr_pembelian_detail.stok','tr_pembelian_detail.harga_pembelian')
              ->where('tr_pembelian_detail.tr_pembelian_id',$id)->get();

      return view('mod_pembelian.pembelian_print',compact('get_h','get_d','page_title'));
    }


}
