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
    	return view('reportes');
    }

    public function historico(){
    	return (new Exports\TaxisHistorico())->download('Revenue_and_Expenses.xlsx');
    }

    public function gastos(){
    	return (new Exports\TaxisGastos())->download('GastosTaxis.xlsx');
    }


}
