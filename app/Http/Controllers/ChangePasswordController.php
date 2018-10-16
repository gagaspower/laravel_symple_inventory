<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use Alert;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class ChangePasswordController extends Controller
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
        $page_title = 'Ubah Password';
        $user = User::where('id', Auth::user()->id)->first();
        return view('mod_password.index',compact('page_title','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $this->validate($request, [
            'password'=>'required|min:6|confirmed',
            'password_lama' => 'required'
        ]); 

        $user_password = Auth::user()->password;
        $old_password = request('password_lama');
        $password = request('password');


    if (\Hash::check($old_password, $user_password)) {


        Auth::user()->update([
            'password' => $password
        ]);

        Alert::success('Password Anda telah dirubah','Berhasil');
        return redirect('/ubah-password');
        } else {

        Alert::error('Pastikan password lama anda benar','Gagal');
        return redirect('/ubah-password');
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
        //
    }
}
