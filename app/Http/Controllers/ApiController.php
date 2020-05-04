<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //
    public function encrip($id){
    	$prueba = Hash::make($id);
    	return $prueba;
    }

    public function categorias(){
    	$categorias = App\ExpenseCategory::where('state', '=', 1)->orderBy('category', 'asc')->get();

    	return $categorias;
    }

    public function descripciones($id){
    	$descripciones = App\ExpenseDescription::where([['state', '=', 1], ['category', '=', $id]])->orderBy('description', 'asc')->get();

    	return $descripciones;
    }

    public function notificaciones($id){
        $permisos = DB::table('notifications')
                        ->select(DB::raw('count(id) as conteo'))
                        ->where('readers', 'NOT LIKE', '%'.$id.'%')->orWhereNull('readers')->get();
        //return App\Notification::count('lectores', 'NOT LIKE', $id)->get();
        return $permisos;
    }

    public function leidas($id){
        $leidas = App\Notification::where('readers', 'LIKE', '%'.$id.'%')->orderBy('id', 'desc')->paginate(6);

        return $leidas;

    }

    public function menus(){
        $menu = App\Menu::where('submenu', '=', 0)->orderby('order', 'asc')->orderby('id', 'asc')->get();
        return $menu;
    }

    public function cantidades($id, $inicio=null, $fin=null){
        if (($inicio==null && $fin==null) || ($inicio=='null' && $fin=='null')) {
            $cantidades = DB::table('expenses')
                ->join('expense_categories', 'expenses.category', '=', 'expense_categories.id')
                ->select('expense_categories.category as nombre', DB::raw('count(expenses.id) as conteo'), DB::raw('sum(expenses.value) as suma'))
                ->groupBy('expense_categories.category')
                ->orderBy('expense_categories.category')->get();
        }elseif ($inicio!=null && $fin=="null" || $fin==null) {
            $cantidades = DB::table('expenses')
                ->join('expense_categories', 'expenses.category', '=', 'expense_categories.id')
                ->select('expense_categories.category as nombre', DB::raw('count(expenses.id) as conteo'), DB::raw('sum(expenses.value) as suma'))
                ->where('expenses.date', '>=', $inicio)
                ->groupBy('expense_categories.category')
                ->orderBy('expense_categories.category')->get();
        }elseif ($inicio==null && $fin!=null) {
            $cantidades = DB::table('expenses')
                ->join('expense_categories', 'expenses.category', '=', 'expense_categories.id')
                ->select('expense_categories.category as nombre', DB::raw('count(expenses.id) as conteo'), DB::raw('sum(expenses.value) as suma'))
                ->where('expenses.date', '<=', $fin)
                ->groupBy('expense_categories.category')
                ->orderBy('expense_categories.category')->get();
        }else{
            $cantidades = DB::table('expenses')
                ->join('expense_categories', 'expenses.category', '=', 'expense_categories.id')
                ->select('expense_categories.category as nombre', DB::raw('count(expenses.id) as conteo'), DB::raw('sum(expenses.value) as suma'))
                ->whereBetween('expenses.date', [$inicio, $fin])
                ->groupBy('expense_categories.category')
                ->orderBy('expense_categories.category')->get();
        }

        return $cantidades;

    }

}