<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Alert;
use DB;

// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

use Session;
class UserController extends Controller
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
        $page_title = 'Semua pengguna';
        $penggunas  = User::orderBy('id','DESC')->get();
        return view('mod_user.index',compact('page_title','penggunas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Tambah Pengguna';
        return view('mod_user.create',compact('page_title'));
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
            'name'      => 'required|max:120',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6|confirmed'

        ]);
        
        $user = User::create([
           'name'       => request('name'),
           'email'      => request('email'),
           'password'   => request('password')
        ]);
        
        
        if($user){
            Alert::success('Pengguna baru berhasil ditambah','Berhasil');
            return redirect('/pengguna');
        }else{
            Alert::error('Tidak bisa menyimpan data','Gagal');
            return redirect('/tambah-pengguna');            
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
    public function edit($id) {
        $page_title = 'Ubah Pengguna';
        
        $user = User::where('id', $id)->first();
        return view('mod_user.edit', compact('page_title', 'user')); 
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

        $user = User::where('id',$id)->first();

        // jika password di rubah
        if(!empty(request('password'))){

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); 
        $user->update();
        }

        // jika password tidak di rubah
        else{
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();              
        }
                
        if($user){
            Alert::success('Pengguna berhasil dirubah','Berhasil');
            return redirect('/pengguna');
        }else{
            Alert::error('Tidak bisa menyimpan perubahan','Gagal');
            return redirect('/ubah-pengguna/'.$id);            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $del = User::where('id',$id)->delete();
        if($del){
            Alert::success('Pengguna berhasil dihapus','Berhasil');
            return redirect('/pengguna');
        }else{
            Alert::error('Tidak bisa menghapus data','Gagal');
            return redirect('/pengguna');            
        }
    }
    
}
