<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LegalsController extends Controller
{
    //
    public function legales(){
    	$tratamiento = DB::table('data_trataments')->first();

    	$terminos = App\Term::first();

    	return view('legales', compact('tratamiento', 'terminos'));
    }

    public function tratamiento(Request $request){
    	$tratamiento = App\DataTratament::findOrFail(1);

    	$tratamiento->text = $request->tratamiento;

    	$tratamiento->save();

    	return redirect('administrativo/legales')->with('mensaje', 'El Tratamiento de Datos fue editado con exito');
    }

    public function terminos(Request $request){
    	$terminos = App\Term::findOrFail(1);

    	$terminos->text = $request->terminos;

    	$terminos->save();

    	return redirect('administrativo/legales')->with('mensaje', 'Los Terminos y Condiciones fueros editados con exito');
    }
}
