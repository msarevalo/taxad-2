<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdministratorsController extends Controller
{
    //

    /*************************************************
     *************************************************
     * Creacion y administracion de Administradores***
     *************************************************
     *************************************************/

    public function administrador(){
        if (Auth::user()->profile!==3) {
            $administradores = App\User::where([['id', '!=', Auth::user()->id], ['profile', '!=', '4'], ['profile', '!=', '3']])->paginate(5);
            $perfiles = App\Profile::where('state', '=', '1')->get();
            $estados = App\DriversStatus::all();

            $permiso = App\Permission::where([['menu', '=', 9], ['profile', '=', Auth::user()->profile]])->get();

            if ($permiso[0]->read) {
                return view('administradores', compact('administradores', 'perfiles', 'estados', 'permiso'));   
            }else{
                return redirect('home')->with('error', 'No tienes permisos para este contenido');
            }
        }else{
            return redirect('home');
        }
    }

    public function creaAdmin(){
        $perfiles = App\Profile::where([['id', '!=', '3'], ['id', '!=', '4'], ['state', '=', '1']])->get();

        $permiso = App\Permission::where([['menu', '=', 9], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->create) {
            return view('administradores.create', compact('perfiles'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function crearAdmin(Request $request){
       // return$request->all();
        $verificacion = App\User::where('document', '=', $request->document)->first();
        $verificacion2 = App\User::where('email', '=', $request->email)->first();

        //var_dump($verificacion2);exit();
        if ($verificacion==null) {
            if ($verificacion2==null) {
                $apellido1=explode(" ", $request['lastname']);
                $usuario = $request['name'][0] . $apellido1[0];

                $existe = App\User::where('username', '=', $usuario)->first();;

                $contador1 = strlen($request['name'])-1;
                $contador2 = strlen($request['lastname2'])-1;

                $cont1 = 0;
                $cont2=0;

                while ($existe!==null) {
                    if ($cont1==$cont2) {
                        $usuario = substr($request['name'],0, -$contador1) . $apellido1[0] . substr($request['lastname2'],0, -$contador2);
                        $existe = App\User::where('username', '=', $usuario)->first();
                        $contador1--;
                        $cont1++;
                    }else{
                        $usuario = substr($request['name'],0, -$contador1) . $apellido1[0] . substr($request['lastname2'],0, -$contador2);
                        $existe = App\User::where('username', '=', $usuario)->first();
                        $contador2--;
                        $cont2++;
                    }
                }

                $conductor = new App\User;
                $conductor->username=strtolower($usuario);
                $conductor->document=$request->document;
                $conductor->name=$request->name;
                $conductor->lastname=$request->lastname . ' ' . $request->lastname2;
                $conductor->email=$request->email;
                $conductor->password=Hash::make($request['document']);
                $conductor->profile=$request->perfil;
                $conductor->state='1';
                $conductor->new='1';

                $conductor->save();

                return redirect('administradores')->with('mensaje', 'Administrador ' . $request->name . ' ' . $request->lastname . ' creado con exito');
            }else{
                return redirect('administradores')->with('documento', 'El correo que ingresaste ya existen, verifica los datos');    
            }
        }else{
            return redirect('administradores')->with('documento', 'El documento que ingresaste ya existen, verifica los datos');
        }
    }

    public function detalleAdmin($id=null){
        $conductor = App\User::findOrFail($id);

        if ($conductor->profile!==3) {
            $permiso = App\Permission::where([['menu', '=', 9], ['profile', '=', Auth::user()->profile]])->get();

            if ($permiso[0]->read) {
                return view('administradores.detalle', compact('conductor'));
            }else{
                return redirect('home')->with('error', 'No tienes permisos para este contenido');
            }
        }else{
            return redirect('administradores');
        } 
    }

    public function editaAdmin($id){
        $conductor = App\User::findOrFail($id);
        $perfiles = App\Profile::where([['id', '!=', '4'], ['id', '!=', '3'], ['state', '=', '1']])->get();
        $estados = App\DriversStatus::all();

        if ($conductor->profile!==3) {
            $permiso = App\Permission::where([['menu', '=', 9], ['profile', '=', Auth::user()->profile]])->get();

            if ($permiso[0]->edit) {
                return view('administradores.edita', compact('conductor', 'perfiles', 'estados'));
            }else{
                return redirect('home')->with('error', 'No tienes permisos para este contenido');
            }
        }else{
            return redirect('administradores');
        }
    }

    public function editarAdmin(Request $request, $id){
        $verificar = App\User::where([['email', '=', $request->email], ['id', '!=', $id]])->first();

        if ($verificar == null) {
            $conductor = App\User::findOrFail($id);
            $conductor->name = $request->name;
            $conductor->lastname = $request->lastname;
            $conductor->email = $request->email;
            $conductor->profile = $request->perfil;
            $conductor->state = $request->estado;

            $conductor->save();

            return redirect('administradores')->with('mensaje', 'Administrador ' . $request->name . ' actualizado con exito');
        }else{
            return redirect('administradores')->with('error', 'El correo que intentas ingresar ya esta registrado para otro usuario');
        }
    }
}
