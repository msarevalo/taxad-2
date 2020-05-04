<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Home extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        if (Auth::user()->new===1) {
        	return view('/cambio');
        }else{
            $permiso = App\Permission::where([['menu', '=', 2], ['profile', '=', Auth::user()->profile]])->get();
            if (count($permiso)) {
                # code...
                return view('/home', compact('permiso'));
            }else{
                return redirect('logout');
            }
    	}
    }
}
