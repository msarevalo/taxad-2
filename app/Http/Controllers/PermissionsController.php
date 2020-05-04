<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PermissionsController extends Controller
{
    //
    /*************************************************
     *************************************************
     * Creacion y administracion de Permisos**********
     *************************************************
     *************************************************/

    public function permisos(){
        $menus = App\Menu::count();
        $permisos = DB::table('permissions')
                        ->select(DB::raw('profile, count(*) as conteo'))
                        ->where('read', '=', 1)
                        ->groupBy('profile')->get();
        $listap = App\Profile::where('state', '=', 1)->get();

        $per = App\Permission::where([['menu', '=', 6], ['profile', '=', Auth::user()->profile]])->get();

        if ($per[0]->read) {
            # code...
            return view('permisos', compact('menus', 'permisos', 'listap', 'per'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
        
    }

    public function configuraPermisos($id){
        $per = App\Permission::where([['menu', '=', 6], ['profile', '=', Auth::user()->profile]])->get();

        if ($per[0]->edit==1) {
            if ($id!=1) {
                $perfil = App\Permission::where([['profile', '=', $id], ['menu', '<>', 1], ['menu', '<>', 21]])->get();
                $nombre = App\Profile::findOrFail($id);
                $menus = App\Menu::select('id', 'name')->where([['name', '<>', 'Perfil'], ['name', '<>', 'Cerrar Sesión']])->get();

                return view('administrativo.permisos.configurar', compact('perfil', 'menus', 'nombre'));
            }else{
                return redirect('/administrativo/permisos')->with('error', 'No puedes editar permisos sobre el perfil Super Administrador');
            }
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function configurar(Request $request, $id){
        $perfil = App\Permission::where([['profile', '=', $id], ['menu', '<>', 1], ['menu', '<>', 21]])->get();

        if(!$perfil->isEmpty()){
            $menus = App\Menu::select('id', 'name')->where([['name', '<>', 'Perfil'], ['name', '<>', 'Cerrar Sesión']])->get();
            for($i=0; $i<sizeof($menus); $i++){
                $permisoId = App\Permission::select('id')->where([['profile', '=', $id], ['menu', '=', $menus[$i]->id]])->get();
                
                $permiso = App\Permission::findOrFail($permisoId[0]->id);

                $campo = $menus[$i]->id;
                //echo $campo . sizeof($request[$campo]) . "<br>";
                $ver = 0;
                $crea = 0;
                $edita = 0;
                $elimina = 0;
                if (empty(!$request[$campo])) {
                    for($j=0; $j<sizeof($request[$campo]); $j++){
                        if ($request[$campo][$j]=="vaciar") {
                            $ver = 0;
                            $crea = 0;
                            $edita = 0;
                            $elimina = 0;
                        }else{
                            if ($request[$campo][$j]=="ver") {
                                $ver++;
                            }elseif ($request[$campo][$j]=="crea") {
                                $crea++;
                            }elseif ($request[$campo][$j]=="edita") {
                                $edita++;
                            }elseif ($request[$campo][$j]=="elimina") {
                                $elimina++;
                            }
                        }
                    }
                }else{
                    $ver = 0;
                    $crea = 0;
                    $edita = 0;
                    $elimina = 0;
                }

                $permiso->read=$ver;
                $permiso->edit=$edita;
                $permiso->create=$crea;
                $permiso->delete=$elimina;

                $permiso->save();
            }
        }else{
            $menus = App\Menu::select('id', 'name')->get();
            for($i=0; $i<sizeof($menus); $i++){

                $permiso = new App\Permission();

                $campo = $menus[$i]->id;
                //echo $campo . sizeof($request[$campo]) . "<br>";
                $ver = 0;
                $crea = 0;
                $edita = 0;
                $elimina = 0;
                if ($menus[$i]->name!="Perfil") {
                    if ($menus[$i]->name!="Cerrar Sesión") {
                        if (empty(!$request[$campo])) {
                            for($j=0; $j<sizeof($request[$campo]); $j++){
                                if ($request[$campo][$j]=="vaciar") {
                                    $ver = 0;
                                    $crea = 0;
                                    $edita = 0;
                                    $elimina = 0;
                                }else{
                                    if ($request[$campo][$j]=="ver") {
                                        $ver++;
                                    }elseif ($request[$campo][$j]=="crea") {
                                        $crea++;
                                    }elseif ($request[$campo][$j]=="edita") {
                                        $edita++;
                                    }elseif ($request[$campo][$j]=="elimina") {
                                        $elimina++;
                                    }
                                }
                            }
                        }else{
                            $ver = 0;
                            $crea = 0;
                            $edita = 0;
                            $elimina = 0;
                        }
                    }else{
                        $ver = 1;
                        $crea = 1;
                        $edita = 1;
                        $elimina = 1;
                    }
                }else{
                    $ver = 1;
                    $crea = 1;
                    $edita = 1;
                    $elimina = 1;
                }
                $permiso->profile=$id;
                $permiso->menu=$menus[$i]->id;
                $permiso->read=$ver;
                $permiso->edit=$edita;
                $permiso->create=$crea;
                $permiso->delete=$elimina;

                $permiso->save();
            }
        }

        $per = App\Profile::findOrFail($id);

        return redirect('/administrativo/permisos')->with('mensaje', 'Los permisos del perfil ' . $per->profile_name . ' fueron actualizados con exito');
    }
}
