<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports;

class ReportsController extends Controller
{
    //
    public function reporte(){
    	$socios = App\User::where([['state', '=', 1], ['profile', '=', 4]])->orderBy('name')->get();

    	return view('reportes', compact('socios'));
    }

    public function historico(){
    	return (new Exports\TaxisHistorico())->download('Revenue_and_Expenses.xlsx');
    }

    public function gastos(){
    	return (new Exports\TaxisGastos())->download('GastosTaxis.xlsx');
    }

    public function socios($id){
    	return (new Exports\TaxisSocios(intval($id)))->download('Ganancias_Socio.xlsx');
    }

}
