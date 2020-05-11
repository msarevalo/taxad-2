<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MessagesController extends Controller
{
    //
    public function buzon(){
		$mensajes = DB::table('message')
            ->join('users', 'users.username', '=', 'message.user')
            ->select('message.id as id', 'users.id as conductor','users.username as username', 'users.name as nombre', 'users.lastname as apellidos', 'message.message as mensaje', 'message.date as fecha')
            ->orderBy('id', 'desc')->paginate(6);

        $vehiculos = DB::table('taxi_drivers')
            ->join('taxis', 'taxi_drivers.idTaxi', '=', 'taxis.id')
            ->select('taxis.plate as placa', 'taxi_drivers.idDriver as conductor')
            ->where('taxi_drivers.state', '=', 1)
            ->get();

        $notificaciones = App\Notification::get();

        $opcion = "todas";

        $permiso = App\Permission::where([['menu', '=', 19], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read) {
            return view('buzon', compact('mensajes', 'notificaciones', 'opcion', 'vehiculos'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function leido(Request $request){
    	$mensaje = App\Notification::where('message', '=', $request->mensaje)->first();
    	$usuario = $request->user;

    	$userenvio;
    	if ($mensaje->readers==NULL) {
            $userenvio=$usuario . "_";
        }else{
            $user = explode("_", $mensaje->readers);
            $contador=0;
            for($i=0; $i<sizeof($user); $i++){
               	if ($user[$i]==$usuario) {
                    $contador++;
                }
            }
            if ($contador==0) {
            	$lectores = $mensaje->readers . $usuario . "_";
            	$userenvio=$lectores;
            }
        }
        $data = array('readers'=>$userenvio);
        Notification::leido($mensaje->id, $data);
      	/*echo 'Update successfully.';

      	exit;
      	/*$not = App\Notification::findOrFail($mensaje->id);
      	$not->usuario_envia=="prueba";
      	$not->save();

      	return redirect('/home');*/

    }

    public function leidas(){
        //$leidas = App\Notification::where('lectores', 'LIKE', '%'.$id.'%')->orderBy('id', 'desc')->paginate(6);

        $mensajes = DB::table('message')
            ->join('users', 'users.username', '=', 'message.user')
            ->join('notifications', 'notifications.message', '=', 'message.id')
            ->select('message.id as id', 'users.id as conductor', 'users.username as username', 'users.name as nombre', 'users.lastname as apellidos', 'message.message as mensaje', 'message.date as fecha')
            ->where('notifications.readers', 'LIKE', '%'.Auth::user()->username.'%')
            ->orderBy('id', 'desc')->paginate(6);

        $notificaciones = App\Notification::get();

        $vehiculos = DB::table('taxi_drivers')
            ->join('taxis', 'taxi_drivers.idTaxi', '=', 'taxis.id')
            ->select('taxis.plate as placa', 'taxi_drivers.idDriver as conductor')
            ->where('taxi_drivers.state', '=', 1)
            ->get();

        $opcion = "leidas";

        $permiso = App\Permission::where([['menu', '=', 19], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read) {
            return view('buzon', compact('mensajes', 'notificaciones', 'opcion', 'vehiculos'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function porLeer(){
        //$leidas = App\Notification::where('lectores', 'LIKE', '%'.$id.'%')->orderBy('id', 'desc')->paginate(6);

        $mensajes = DB::table('message')
            ->join('users', 'users.username', '=', 'message.user')
            ->join('notifications', 'notifications.message', '=', 'message.id')
            ->select('message.id as id', 'users.id as conductor', 'users.username as username', 'users.name as nombre', 'users.lastname as apellidos', 'message.message as mensaje', 'message.date as fecha')
            ->where('notifications.readers', 'NOT LIKE', '%'.Auth::user()->username.'%')
            ->orWhereNull('notifications.readers')
            ->orderBy('id', 'desc')->paginate(6);

        $notificaciones = App\Notification::get();

        $vehiculos = DB::table('taxi_drivers')
            ->join('taxis', 'taxi_drivers.idTaxi', '=', 'taxis.id')
            ->select('taxis.plate as placa', 'taxi_drivers.idDriver as conductor')
            ->where('taxi_drivers.state', '=', 1)
            ->get();

        $opcion = "pendientes";
        
        $permiso = App\Permission::where([['menu', '=', 19], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read) {
            return view('buzon', compact('mensajes', 'notificaciones', 'opcion', 'vehiculos'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }
}
