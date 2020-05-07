<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DriversController extends Controller
{
    //
    /*********************************************
     *********************************************
     * Creacion y administracion de conductores***
     *********************************************
     *********************************************/

    public function conductor(){
        if (Auth::user()->profile!==3) {
            $conductores = App\User::where([['id', '!=', Auth::user()->id], ['profile', '=', '3']])->paginate(5);
            $perfiles = App\Profile::all();
            $estados = App\DriversStatus::all();

            $permiso = App\Permission::where([['menu', '=', 10], ['profile', '=', Auth::user()->profile]])->get();

            if ($permiso[0]->read) {
                return view('conductores', compact('conductores', 'perfiles', 'estados', 'permiso'));
            }else{
                return redirect('home')->with('error', 'No tienes permisos para este contenido');
            }
        }else{
            return redirect('home');
        }
    }

    public function detalle($id=null){
        $conductor = App\User::findOrFail($id);
        $mensajes = DB::table('message')
            ->join('users', 'users.username', '=', 'message.user')
            ->select('message.id as id', 'users.username as username', 'users.name as nombre', 'users.lastname as apellidos', 'message.message as mensaje', 'message.date as fecha')
            ->where('user', 'LIKE', $conductor->username)
            ->orderBy('id', 'desc')->paginate(3);

        $notificaciones = App\Notification::get();


        if ($conductor->profile==3) {
            $permiso = App\Permission::where([['menu', '=', 10], ['profile', '=', Auth::user()->profile]])->get();

            if ($permiso[0]->read) {
                return view('conductores.detalle', compact('conductor', 'mensajes', 'notificaciones'));
            }else{
                return redirect('home')->with('error', 'No tienes permisos para este contenido');
            }
        }else{
            return redirect('conductores');
        }

        
    }

    public function creaCond(){
        $perfiles = App\Profile::where('id', '=', '3')->get();

        $permiso = App\Permission::where([['menu', '=', 10], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->create) {
            return view('conductores.create', compact('perfiles'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function crearCond(Request $request){
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

                $conductor = new App\User();
                $conductor->username=strtolower($usuario);
                $conductor->document=$request->document;
                $conductor->name=$request->name;
                $conductor->lastname=$request->lastname . ' ' . $request->lastname2;
                $conductor->email=$request->email;
                $conductor->password=Hash::make($request['document']);
                $conductor->profile='3';
                $conductor->state='1';
                $conductor->new='1';

                $conductor->save();

                return redirect('conductores')->with('mensaje', 'Conductor ' . $request->name . ' ' . $request->lastname . ' creado con exito');
            }else{
                return redirect('conductores')->with('documento', 'El correo que ingresaste ya existe, verifica los datos');    
            }
        }else{
            return redirect('conductores')->with('documento', 'El documento que ingresaste ya existe, verifica los datos');
        }
    }

    public function editaCon($id){
        $conductor = App\User::findOrFail($id);
        $perfiles = App\Profile::where('id', '=', '3')->get();
        $estados = App\DriversStatus::where('id', '<', '2')->get();

        if ($conductor->profile==3) {
            $permiso = App\Permission::where([['menu', '=', 10], ['profile', '=', Auth::user()->profile]])->get();

            if ($permiso[0]->edit) {
                return view('conductores.edita', compact('conductor', 'perfiles', 'estados'));
            }else{
                return redirect('home')->with('error', 'No tienes permisos para este contenido');
            }
        }else{
            return redirect('conductores');
        }
        
    }

    public function editarCond(Request $request, $id){
        $verifica = App\User::where([['email', '=', $request->email], ['id', '!=', $id]])->first();        

        if ($verifica == null) {
            $conductor = App\User::findOrFail($id);
            $conductor->name = $request->name;
            $conductor->lastname = $request->lastname;
            $conductor->email = $request->email;
            $conductor->profile = '3';
            $conductor->state = $request->estado;

            $conductor->save();

            $vehiculo = App\TaxiDriver::where('idDriver', '=', $id)->first();
            if ($vehiculo!==null) {
                if ($request->estado==0) {
                    $vehiculo->state='0';
                    $vehiculo->save();
                }
            }

            return redirect('conductores')->with('mensaje', 'Conductor ' . $request->name . ' actualizado con exito');
        }
        else{
            return redirect('conductores')->with('mensaje', 'El correo que intentas registrar ya se encuentra asociado a otro usuario');
        }

    }

    public function permitir($id){
        $conductor = App\User::findOrFail($id);
        $conductor->state = 1;

        $conductor->save();

        return redirect('conductores')->with('mensaje', 'Conductor ' . $conductor->name . ' actualizado con exito');

    }

    public function negar($id){
        $conductor = App\User::findOrFail($id);

        $conductor->delete();

        return redirect('conductores')->with('mensaje-delete', 'Conductor ' . $conductor->name . ' eliminado con exito');

    }
}
