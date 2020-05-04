<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MenusController extends Controller
{
    //
    /*************************************************
     *************************************************
     * Creacion y administracion de Menus*************
     *************************************************
     *************************************************/
    
    public function menus(){
        $menus = App\Menu::paginate(10);
        $padres = App\Menu::where([['submenu', '=', 0], ['name', 'not like', '%Cerrar Sesión%']])->get();
        $permiso = App\Permission::where([['menu', '=', 4], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read) {
            # code...
            return view('menus', compact('menus', 'padres', 'permiso'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function editaMenu($id){
        $menu = App\Menu::findOrFail($id);
        $padres = App\Menu::where('submenu', '=', 0)->get();
        $iconos = App\Icon::orderBy('name', 'asc')->get();
        $grupos = App\IconGroup::orderBy('name', 'asc')->get();

        $permiso = App\Permission::where([['menu', '=', 4], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->edit) {
            if ($menu->name=="Perfil") {
                return redirect('administrativo/menus')->with('negar', 'Este menu no se puede editar');
            }elseif ($menu->name=="Cerrar Sesión") {
                return redirect('administrativo/menus')->with('negar', 'Este menu no se puede editar');
            }elseif ($menu->name=="Menús") {
                return redirect('administrativo/menus')->with('negar', 'Este menu no se puede editar');
            }else{
                return view('administrativo.menu.edit', compact('menu', 'padres', 'iconos', 'grupos'));
            }
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function menuPadre(){
        return App\Menu::where('submenu', '=', 0)->get();
    }

    public function editarMenu(Request $request, $id){
        $menu = App\Menu::findOrFail($id);

        $menu->name=$request->nombre;
        $menu->submenu=$request->submenu;
        $padre = $request->padre;
        $icono = $request->iconos;
        if ($request->submenu==0) {
            $padre = NULL;
        }else{
            $icono = NULL;
        }
        $menu->parent=$padre;
        $menu->class=$icono;
        $menu->order=$request->orden;

        $menu->save();

        return redirect('administrativo/menus')->with('mensaje', 'Se edito el menú con exito');

    }

    /*************************************************
     *************************************************
     * Creacion y administracion de Separadores*******
     *************************************************
     *************************************************/
    public function separadores(){
        $separadores = App\Separator::all();
        $menu = App\Menu::select('id', 'name')->get();

        $permiso = App\Permission::where([['menu', '=', 5], ['profile', '=', Auth::user()->profile]])->get();
        if ($permiso[0]->read) {
            return view('separadores', compact('separadores', 'menu', 'permiso'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function editaSepara($id){
        $separador = App\Separator::findOrFail($id);
        $padres = App\Menu::where('submenu', '=', 0)->get();
        $permiso = App\Permission::where([['menu', '=', 5], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->edit) {
            return view('administrativo.separador.edit', compact('separador', 'padres'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');   
        }
    }

    public function editarSepara(Request $request, $id){
        $separador = App\Separator::findOrFail($id);

        $separador->name=$request->nombre;
        $separador->subsequent_menu=$request->menu;
        $separador->state = $request->estado;
        
        $separador->save();

        return redirect('administrativo/separadores')->with('mensaje', 'Se edito el menú con exito');

    }

    public function creaSepara(){
        $padres = App\Menu::where('submenu', '=', 0)->get();
        $permiso = App\Permission::where([['menu', '=', 5], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->create) {
            return view('administrativo.separador.create', compact('padres'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function crearSepara(Request $request){
        $separador = new App\Separator();
        $separador->name=$request->nombre;
        $separador->subsequent_menu=$request->menu;
        
        $separador->save();

        return redirect('administrativo/separadores')->with('mensaje', 'El separador fue agregado con exito');
    }
}
