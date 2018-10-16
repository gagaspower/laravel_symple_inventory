<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Alert;
use DB;
use App\MasterKustomer;
class MasterKustomerController extends Controller
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
        $page_title = 'Master Kustomer';
        $kustomers = MasterKustomer::get();
        return view('mod_kustomer.index',compact('page_title','kustomers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Tambah Master Kustomer';
        return view('mod_kustomer.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new MasterKustomer;
        $add->nama_kustomer  = $request->nama_kustomer;
        $add->telp_kustomer = $request->telp_kustomer;
        $add->alamat_kustomer=$request->alamat_kustomer;
        $add->save();
        if($add){
            Alert::success('Kustomer berhasil ditambah','sukses');
            return redirect('/master-kustomer');
        }else{
            Alert::error('Gagal menambah Kustomer baru','gagal');
            return redirect('/tambah-kustomer');            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save_kustomer(Request $request)
    {
        $add = new MasterKustomer;
        $add->nama_kustomer  = $request->nama_kustomer;
        $add->telp_kustomer = $request->telp_kustomer;
        $add->alamat_kustomer=$request->alamat_kustomer;
        $add->save();
        if($add){
            Alert::success('Kustomer berhasil ditambah','sukses');
            return redirect('/tambah-penjualan');
        }else{
            Alert::error('Gagal menambah Kustomer baru','gagal');
            return redirect('/tambah-penjualan');           
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
        $page_title = 'Edit master kustomer';
        $kustomer = MasterKustomer::where('id',$id)->first();
        return view('mod_kustomer.edit',compact('page_title','kustomer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $kustomer = MasterKustomer::where('id',$request->id)->first();
        $kustomer->nama_kustomer  = $request->nama_kustomer;
        $kustomer->telp_kustomer  = $request->telp_kustomer;
        $kustomer->alamat_kustomer=$request->alamat_kustomer;
        $kustomer->update();
        if($kustomer){
            Alert::success('Kustomer berhasil diubah','sukses');
            return redirect('/master-kustomer');
        }else{
            Alert::error('Gagal menyimpan perubahan','gagal');
            return redirect('/master-kustomer');            
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = MasterKustomer::where('id',$id)->delete();
        if($del){
            Alert::success('kustomer berhasil dihapus','sukses');
            return redirect('/master-kustomer');
        }else{
            Alert::error('Gagal menghapus kustomer','gagal');
            return redirect('/master-kustomer');            
        } 
    }



}
