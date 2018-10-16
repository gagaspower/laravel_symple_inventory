<?php

namespace App\Http\Controllers;

use App\MasterSuplier;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Alert;
use DB;

class MasterSuplierController extends Controller
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
        $page_title = 'Master Suplier';
        $supliers = DB::table('master_suplier')->get();
        return view('mod_suplier.index',compact('page_title','supliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Tambah master suplier';
        return view('mod_suplier.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new MasterSuplier;
        $add->nama_suplier  = $request->nama_suplier;
        $add->telp_suplier  = $request->telp_suplier;
        $add->alamat_suplier=$request->alamat_suplier;
        $add->save();
        if($add){
            Alert::success('Suplier berhasil ditambah','sukses');
            return redirect('/master-suplier');
        }else{
            Alert::error('Gagal menambah suplier baru','gagal');
            return redirect('/tambah-suplier');            
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
        $page_title = 'Edit master suplier';
        $suplier = MasterSuplier::where('id',$id)->first();
        return view('mod_suplier.edit',compact('page_title','suplier'));
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
         $suplier = MasterSuplier::where('id',$request->id)->first();
        $suplier->nama_suplier  = $request->nama_suplier;
        $suplier->telp_suplier  = $request->telp_suplier;
        $suplier->alamat_suplier=$request->alamat_suplier;
        $suplier->update();
        if($suplier){
            Alert::success('Suplier berhasil diubah','sukses');
            return redirect('/master-suplier');
        }else{
            Alert::error('Gagal menyimpan perubahan','gagal');
            return redirect('/master-suplier');            
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
        $del = MasterSuplier::where('id',$id)->delete();
        if($del){
            Alert::success('Suplier berhasil dihapus','sukses');
            return redirect('/master-suplier');
        }else{
            Alert::error('Gagal menghapus suplier','gagal');
            return redirect('/master-suplier');            
        } 
    }
}
