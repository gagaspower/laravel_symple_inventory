<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;
use Alert;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','clearance']); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title     = 'Hak akses pengguna';
        $permissions    = Permission::orderBy('id','desc')->get();
        return view('mod_hak_akses.index',compact('page_title','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Tambah hak akses';
        return view('mod_hak_akses.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'display_name'      => 'required'
                                  ]);
        $simpan = new Permission;
        $simpan->name = str_replace(' ', '_', $request->display_name);
        $simpan->display_name = $request->display_name;
        $simpan->save();
        if($simpan){
            Alert::success('Hak akses baru telah ditambahkan','Berhasil');
            return redirect('/hak-akses');
        }
        else{
            Alert::error('Tidak bisa menyimpan data','Gagal');
            return redirect('/tambah-akses');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title     = 'Edit Hak akses pengguna';
        $permissions    = Permission::where('id',$id)->first();
        return view('mod_hak_akses.edit',compact('page_title','permissions'));
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
        Permission::where('id',$id)->update([
                                           'name'           => str_replace(' ', '_', request('display_name')),
                                           'display_name'   => request('display_name')
                                            ]);

        $edit = Permission::where('id',$id)->first();
        $edit->name = str_replace(' ', '_', $request->display_name);
        $edit->display_name = $request->display_name;
        $edit->update();
        if($edit){
            Alert::success('Hak akses baru telah diubah','Berhasil');
            return redirect('/hak-akses');
        }
        else{
            Alert::error('Tidak bisa menyimpan perubahan','Gagal');
            return redirect('/ubah-akses/'.$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $del = Permission::where('id',$id)->delete();
        if($del){
            Alert::success('Hak akses baru telah dihapus','Berhasil');
            return redirect('/hak-akses');
        }
        else{
            Alert::error('Tidak bisa menghapus data','Gagal');
            return redirect('/hak-akses');
        }
    }
}
