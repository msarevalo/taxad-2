<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports;
use Illuminate\Support\Facades\Mail;
class ReportsController extends Controller
{
    //
    public function reporte(){
        $permiso = App\Permission::where([['menu', '=', 20], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read==1) {
    	   if (Auth::user()->profile==1) {
    		  $socios = App\User::where([['state', '=', 1], ['profile', '=', 4]])->orderBy('name')->get();
    		  return view('reportes', compact('socios'));
    	   }elseif (Auth::user()->profile==4) {
    		  $socios = App\User::where('id', '=', Auth::user()->id)->orderBy('name')->get();
    		  return view('reportes', compact('socios'));
    	   }else{
    	       return view('reportes');
    	   }
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function historico(){
        $permiso = App\Permission::where([['menu', '=', 20], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->create==1) {
    	   return (new Exports\TaxisHistorico())->download('Revenue_and_Expenses.xlsx');
        }else{
            return redirect('reportes')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function gastos(){
        $permiso = App\Permission::where([['menu', '=', 20], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->create==1) {
           return (new Exports\TaxisGastos())->download('GastosTaxis.xlsx');
        }else{
            return redirect('reportes')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function socios($id){
    	$permiso = App\Permission::where([['menu', '=', 20], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->create==1) {
           return (new Exports\TaxisSocios(intval($id)))->download('Ganancias_Socio.xlsx');
        }else{
            return redirect('reportes')->with('error', 'No tienes permisos para este contenido');
        }
    }

}
