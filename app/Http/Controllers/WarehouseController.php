<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Alert;
use App\Warehouse;

class WarehouseController extends Controller
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
        $page_title = 'MASTER WAREHOUSE';
        $warehouses = DB::table('master_warehouse')->get();
        return view('mod_warehouse.index',compact('page_title','warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'TAMBAH WAREHOUSE';
        return view('mod_warehouse.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add_warehouse = new Warehouse;
        $add_warehouse->warehouse_nama = $request->warehouse_nama;
        $add_warehouse->warehouse_alamat = $request->warehouse_alamat;
        $add_warehouse->save();
        if($add_warehouse)
        {
            Alert::success('Warehouse baru berhasil ditambah','success');
            return redirect('/master-warehouse');
        }
        else
        {
            Alert::error('Tidak bisa menambahkan warehouse','error');
            return redirect('/tambah-warehouse');
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
        $page_title = 'EDIT WAREHOUSE';
        $warehouse = DB::table('master_warehouse')->where('id',$id)->first();
        return view('mod_warehouse.edit',compact('page_title','warehouse'));
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
        $edit_warehouse = Warehouse::where('id',$request->id)->first();
        $edit_warehouse->warehouse_nama = $request->warehouse_nama;
        $edit_warehouse->warehouse_alamat= $request->warehouse_alamat;
        $edit_warehouse->update();
        if($edit_warehouse)
        {
            Alert::success('Warehouse Berhasil diupdate','success');
            return redirect('/master-warehouse');
        }
        else
        {
            Alert::error('Tidak bisa menyimpan perubahan','error');
            return redirect('/master-warehouse');
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
        $del = Warehouse::where('id',$id)->delete();
        if($del)
        {
            Alert::success('Warehouse Berhasil dihapus','success');
            return redirect('/master-warehouse');
        }
        else
        {
            Alert::error('Tidak bisa menghapus warehouse','error');
            return redirect('/master-warehouse');
        }
    }
}
