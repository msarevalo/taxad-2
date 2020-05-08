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
    	if (Auth::user()->profile==1) {
    		$socios = App\User::where([['state', '=', 1], ['profile', '=', 4]])->orderBy('name')->get();
    		return view('reportes', compact('socios'));
    	}elseif (Auth::user()->profile==4) {
    		$socios = App\User::where('id', '=', Auth::user()->id)->orderBy('name')->get();
    		return view('reportes', compact('socios'));
    	}else{
    		return view('reportes');
    	}
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

    public function correo(){
    	$to_name = 'Manuel Arevalo';
		$to_email = 'msscout11@gmail.com';
		$data = array('name'=>"Ogbonna Vitalis(sender_name)", 'body' => "A test mail");
		Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
			$message->to($to_email, $to_name)
			->subject('Prueba Taxad');
			$message->from('no-responder@taxad.com','Taxad');
		});
    }

}
