<?php

namespace App\Http\Controllers;

use App\MasterItem;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Alert;
use DB;


class MasterItemController extends Controller
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
        $page_title = 'Master Item';
        $items = DB::table('master_item')->get();
        return view('mod_item.index',compact('items','page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Tambah master item';
        return view('mod_item.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new MasterItem;
        $add->nama_item = $request->nama_item;
        $add->stok      = $request->stok;
        $add->harga_pembelian=$request->harga_pembelian;
        $add->harga_jual = $request->harga_jual;
        $add->save();
        if($add){
            Alert::success('Item berhasil ditambah','sukses');
            return redirect('/master-item');
        }else{
            Alert::error('Gagal menambah item baru','gagal');
            return redirect('/tambah-item');            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MasterItem  $masterItem
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cus = DB::table('master_item')->where('id',$id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MasterItem  $masterItem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Edit master item';
        $items = MasterItem::where('id',$id)->first();
        return view('mod_item.edit',compact('items','page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MasterItem  $masterItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $edit = MasterItem::where('id',$request->id)->first();
        $edit->nama_item = $request->nama_item;
        $edit->stok      = $request->stok;
        $edit->harga_pembelian=$request->harga_pembelian;
        $edit->harga_jual = $request->harga_jual;
        $edit->update();
        if($edit){
            Alert::success('Item berhasil diubah','sukses');
            return redirect('/master-item');
        }else{
            Alert::error('Gagal menyimpan perubahan','gagal');
            return redirect('/master-item');            
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MasterItem  $masterItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $edit = MasterItem::where('id',$id)->delete();
        if($edit){
            Alert::success('Item berhasil dihapus','sukses');
            return redirect('/master-item');
        }else{
            Alert::error('Gagal menghapus item','gagal');
            return redirect('/master-item');            
        } 
    }

    public function void($id){
        $voids = MasterItem::where('id',$id)->update(['status' => '99']);
        if($voids){
            Alert::success('Item dinonaktifkan','sukses');
            return redirect('/master-item');
        }else{
            Alert::error('Gagal mengirim permintaan','gagal');
            return redirect('/master-item');            
        }         
    }
}
