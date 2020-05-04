<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    //

    public function menus(){

        $menu = DB::table('menus')
            ->join('permissions', 'permissions.menu', '=', 'menus.id')
            ->select('menus.submenu as submenu', 'menus.route as ruta', 'menus.class as class', 'menus.name as nombre', 'menus.id as id')
            ->where([['permissions.read', '=', 1], ['menus.submenu', '=', 0], ['permissions.profile', '=', Auth::user()->profile]])
            ->orderby('menus.order', 'asc')->orderby('menus.id', 'asc')
            ->get();

        return $menu;
    }

    public function hijos($id){
        $menu = App\Menu::where([['submenu', '=', 1], ['parent', '=', $id]])->orderby('order', 'asc')->get();

        $menu = DB::table('menus')
            ->join('permissions', 'permissions.menu', '=', 'menus.id')
            ->select('menus.submenu as submenu', 'menus.route as ruta', 'menus.class as class', 'menus.name as nombre', 'menus.id as id', 'menus.parent as padre')
            ->where([['permissions.read', '=', 1], ['menus.submenu', '=', 1], ['permissions.profile', '=', Auth::user()->profile], ['parent', '=', $id]])
            ->orderby('menus.order', 'asc')->orderby('menus.id', 'asc')
            ->get();
        return $menu;
    }

    public function separador(){
    	$separa = App\Separator::where('state', '=', 1)->get();
    	return $separa;
    }

}

$items = new MenuController;
