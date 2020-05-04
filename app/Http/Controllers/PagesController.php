<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        return view('login');
    }

    public function login(){
        return view('login');
    }

    public function registro(){
        return view('registro');
    }

    public function cambiar(Request $request){
        if ($request->npass===$request->rpass) {
            $usuario = App\User::findOrFail(Auth::user()->id);
            $usuario->password=Hash::make($request->npass);
            $usuario->nuevo='0';

            $usuario->save();
            return redirect('home');

        }else{
            return redirect('/')->with('error', 'Las constraseñas no coinsiden');            
        }
    }
    

}