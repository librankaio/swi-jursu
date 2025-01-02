<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    protected $comp_name;
    protected $comp_code;

    public function index(){
        return view('login');
    }

    public function postLogin(Request $request){
        //Authentification is user and password are correct or not
        // dd(request()->all());
        if(Auth::attempt($request->only('username', 'password'))){
            $request->session()->regenerate();
            $username = Auth::User()->username;
            $request->session()->put('username', $username);
            
            return redirect()->intended('/packlist');
        }
        return redirect('/');
    }

    public function logout(request $request){
        Auth::logout();

        return redirect('/');
    }
}
