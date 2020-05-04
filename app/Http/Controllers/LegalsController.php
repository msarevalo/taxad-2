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
    	$tratamiento = DB::table('data_tratament')->first();

    	$terminos = App\Term::first();

    	return view('legales', compact('tratamiento', 'terminos'));
    }
}
