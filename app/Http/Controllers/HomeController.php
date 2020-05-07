<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $permiso = App\Permission::where([['menu', '=', 2], ['profile', '=', Auth::user()->profile]])->get();
        $reportes = App\Record::select(DB::raw('YEAR(begin) as año'), DB::raw('MONTH(begin) as mes'), DB::raw('sum(payment) as producido'), DB::raw('sum(expenses) as gastos'))->groupBy(DB::raw('YEAR(begin)'))->groupBy(DB::raw('MONTH(begin)'))->orderBy('año', 'desc')->orderBy('mes', 'desc')->take(12)->get();
        /*permisos = DB::table('notifications')
                        ->select(DB::raw('count(id) as conteo'))
                        ->where('readers', 'NOT LIKE', '%'.$id.'%')->orWhereNull('readers')->get();*/
        return view('home', compact('permiso', 'reportes'));
    }
}
