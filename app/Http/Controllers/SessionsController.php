<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use Auth;
class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }
    
    public function create()
    {    
        return view('sessions.create');
    }
    
    public function store()
    {
        // Attempt to authenticate the user.
        $email = request('email');
        $password = request('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect('/welcome');
        }
        
        else{
                return back()->withErrors([
                'message' => 'Email & password tidak cocok atau akun telah nonaktif. silahkan ulangi!'
                
            ]);  
        }
    }
    
    public function destroy()
    {
        auth()->logout();
        Alert::success('Anda Telah keluar','Logout');
        return redirect('/');
    }
}
