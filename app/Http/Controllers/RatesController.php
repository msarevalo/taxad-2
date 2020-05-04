<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RatesController extends Controller
{
    //
    /*************************************************
     *************************************************
     * Creacion y administracion de Tarifas***********
     *************************************************
     *************************************************/

    public function tarifa(){
        $tarifas = App\Rate::get();
        $permiso = App\Permission::where([['menu', '=', 13], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read) {
            return view('tarifas', compact('tarifas', 'permiso'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function editaTarifa(){
        $tarifas = App\Rate::get();

        $permiso = App\Permission::where([['menu', '=', 13], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->edit) {
            return view('taxis.tarifas.edit', compact('tarifas'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function editarTarifa(Request $request){

        $lunes = App\Rate::findOrFail(1);
        $lunes->rates=$request->Lunes;
        $lunes->save();

        $martes = App\Rate::findOrFail(2);
        $martes->rates=$request->Martes;
        $martes->save();

        $miercoles = App\Rate::findOrFail(3);
        $miercoles->rates=$request->Miercoles;
        $miercoles->save();

        $jueves = App\Rate::findOrFail(4);
        $jueves->rates=$request->Jueves;
        $jueves->save();

        $viernes = App\Rate::findOrFail(5);
        $viernes->rates=$request->Viernes;
        $viernes->save();

        $sabado = App\Rate::findOrFail(6);
        $sabado->rates=$request->Sabado;
        $sabado->save();

        $domingo = App\Rate::findOrFail(7);
        $domingo->rates=$request->Domingo;
        $domingo->save();

        return redirect('tarifa')->with('mensaje', 'Las tarifas se han actualizado con exito');

    }

}
