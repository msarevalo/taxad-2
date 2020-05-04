<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilesController extends Controller
{
    //
    /*************************************************
     *************************************************
     * Creacion y administracion de Perfiles**********
     *************************************************
     *************************************************/

    public function perfiles(){
        $perfiles = App\Profile::all();
        $permiso = App\Permission::where([['menu', '=', 7], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read) {
            return view('perfiles', compact('perfiles', 'permiso'));   
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function creaPerfil(){
        $permiso = App\Permission::where([['menu', '=', 7], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->create) {
            return view('administrativo/perfiles/create');
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function crearPerfil(Request $request){
        $validacion = App\Profile::where('profile_name', 'LIKE', $request->nombre)->first();

        if ($validacion==NULL) {

            $perfil = new App\Profile();

            $perfil->profile_name=$request->nombre;
            $perfil->state=1;

            $perfil->save();

            return redirect('administrativo/perfiles')->with('mensaje', 'Perfil creado con exito');
        }else{
            return redirect('administrativo/perfiles/crea')->with('error', 'El nombre de perfil que desea crear ya existe');
        }
    }

    public function editaPerfil($id){
        $permiso = App\Permission::where([['menu', '=', 7], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->edit) {
            $perfil = App\Profile::findOrFail($id);

            return view('administrativo.perfiles.edit', compact('perfil'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function editarPerfil(Request $request, $id){
        $perfil = App\Profile::findOrFail($id);

        $perfil->profile_name=$request->nombre;
        $perfil->state = $request->estado;
        
        $perfil->save();

        return redirect('administrativo/perfiles')->with('mensaje', 'Se edito el perfil con exito');

    }
}
