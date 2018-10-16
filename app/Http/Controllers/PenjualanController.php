<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Alert;
use DB;
use App\Penjualan ;

class PenjualanController extends Controller
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
        $page_title = 'Penjualan Barang';
        $data = DB::table('tr_penjualan')
                ->leftjoin('tr_penjualan_detail','tr_penjualan.id','=','tr_penjualan_detail.tr_penjualan_id')
                ->leftjoin('master_kustomer','master_kustomer.id','=','tr_penjualan.kustomer_id')
                ->select('tr_penjualan.id',
                        'tr_penjualan.penjualan_code',
                        'tr_penjualan.tgl_penjualan',
                        'tr_penjualan.deskripsi_penjualan',
                        'tr_penjualan.total_penjualan',
                        'tr_penjualan.status',
                        'master_kustomer.nama_kustomer'
                        )
                ->groupBy('tr_penjualan.id',
                        'tr_penjualan.penjualan_code',
                        'tr_penjualan.tgl_penjualan',
                        'tr_penjualan.deskripsi_penjualan',
                        'tr_penjualan.total_penjualan',
                        'tr_penjualan.status',
                        'master_kustomer.nama_kustomer')
                ->orderBy('tr_penjualan.id','desc')
                ->get();
        return view('mod_penjualan.index',compact('page_title','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Tambah Penjualan Barang';
        $kustomers = DB::table('master_kustomer')->get();
        $items = DB::table('master_item')->where('stok','<>','0')->where('status','<>','99')->get();
        $prefix = 'SO';
        $char = date('Ymd');
        $q = DB::table('tr_penjualan')->select(DB::raw('MAX(RIGHT(penjualan_code,6)) as kode'));
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
        return view('mod_penjualan.create',compact('page_title','kustomers','newId','items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $harga = $request->harga_jual_produk;
        // $tot = $request->harga_jual_produk;
        // var_dump($harga);exit;
        $add = new Penjualan;
        $add->penjualan_code = $request->penjualan_code;
        $add->kustomer_id = $request->kustomer_id;
        $add->tgl_penjualan = $request->tgl_penjualan;
        $add->deskripsi_penjualan = $request->deskripsi_penjualan;
        $add->total_penjualan=$request->total_penjualan;
        $add->save();
        if($add){

        foreach($request->table as $data_detail)
        {
            $sql = DB::insert('INSERT INTO tr_penjualan_detail(tr_penjualan_id,produk_id,jumlah,harga_jual_produk) VALUES (?,?,?,?)',
                                    [ ''.$add->id.'',
                                      ''.$data_detail['produk_id'].'',
                                      ''.$data_detail['jumlah'].'',
                                      ''.$data_detail['harga_jual_produk'].''
                                    ]
                             );


        }

        // mengurangi stok item
        DB::update("UPDATE master_item,tr_penjualan_detail SET master_item.stok = master_item.stok - tr_penjualan_detail.jumlah 
                    WHERE master_item.id = tr_penjualan_detail.produk_id AND tr_penjualan_detail.tr_penjualan_id = '".$add->id."'");

        return response()->json('Penjualan barang berhasil');
        }
        else{
        return response()->json('Tidak bisa membuat penjualan barang');           
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_item(Request $request)
    {

        $get_produk = DB::table('master_item')->where('id',$request->id)->first();
        // var_dump($get_produk);
        return response()->json($get_produk);
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
        $get_code = DB::table('tr_penjualan')->select('penjualan_code')->where('id',$id)->first();
        $del = Penjualan::where('id',$id)->update(['status' => '99']);
        if($del){

        DB::update("UPDATE master_item,tr_penjualan_detail SET master_item.stok = master_item.stok + tr_penjualan_detail.jumlah 
                    WHERE master_item.id = tr_penjualan_detail.produk_id AND tr_penjualan_detail.tr_penjualan_id = '".$id."'");

            Alert::success('Penjualan Nomor:'.$get_code->penjualan_code.' telah VOID','sukses');
            return redirect('/penjualan-barang');
        }else{
            Alert::error('Tidak dapat melakukan request','gagal');
            return redirect('/penjualan-barang');            
        }        
    }


    public function print($id)
    {
      $page_title = 'Invoice Penjualan Barang';
      $get_h = DB::table('tr_penjualan')
              ->join('master_kustomer','master_kustomer.id','=','tr_penjualan.kustomer_id')
              ->select('tr_penjualan.id',
                       'tr_penjualan.penjualan_code',
                       'tr_penjualan.total_penjualan',
                       'tr_penjualan.tgl_penjualan',
                       'master_kustomer.nama_kustomer',
                       'master_kustomer.telp_kustomer',
                       'master_kustomer.alamat_kustomer')
              ->where('tr_penjualan.id',$id)->first();
      $get_d = DB::table('tr_penjualan_detail')
              ->join('tr_penjualan','tr_penjualan.id','=','tr_penjualan_detail.tr_penjualan_id')
              ->join('master_item','master_item.id','=','tr_penjualan_detail.produk_id')
              ->select('tr_penjualan_detail.jumlah','tr_penjualan_detail.harga_jual_produk','master_item.nama_item')
              ->where('tr_penjualan_detail.tr_penjualan_id',$id)->get();

      return view('mod_penjualan.print_penjualan',compact('get_h','get_d','page_title'));
    }

    public function close_page()
    {
        DB::table('penjualan_temp')->delete();
        return redirect('/penjualan-barang');
    }

}

