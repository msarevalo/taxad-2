<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ServicesController extends Controller
{
    //
    public function servicios(){
    	$servicios = DB::table('services')
    		->join('services_types', 'services.service_type', '=', 'services_types.id')
    		->select('services.id as id', 'services_types.name as servicio', 'services.contact_name as nombre', 'services.cellphone as celular', 'services.email as correo', 'services.state as estado')
    		->paginate(7);

        $permiso = App\Permission::where([['menu', '=', 22], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read) {
            return view('servicios', compact('servicios', 'permiso'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function crea(){
    	$validacion = App\ServicesType::where('state', '=', 1)->first();

    	if ($validacion!==null) {
    		$tipos = App\ServicesType::where('state', '=', 1)->orderBy('name', 'asc')->get();

            $permiso = App\Permission::where([['menu', '=', 22], ['profile', '=', Auth::user()->profile]])->get();

            if ($permiso[0]->create) {
                return view('servicios.crear', compact('tipos'));
            }else{
                return redirect('home')->with('error', 'No tienes permisos para este contenido');
            }
    	}else{
    		return redirect('servicios/tipos/crear')->with('error', 'Para crear un servicio debe existir un tipo de servicio previamente');
    	}
    }

    public function crear(Request $request){
    	$servicio = new App\Services();

    	$servicio->service_type = $request->tipo;
    	$servicio->contact_name = $request->nombre;
    	$servicio->cellphone = $request->celular;
    	$servicio->email = $request->correo;
    	$servicio->state = 1;

    	$servicio->save();

    	return redirect('servicios')->with('mensaje', 'El servicio fue creado con exito');
    }

    public function edita($id){
    	$validacion = App\ServicesType::where('state', '=', 1)->first();

    	if ($validacion!==null) {
    		$servicio = App\Services::findOrFail($id);
	    	$tipos = App\ServicesType::where('state', '=', 1)->orderBy('name', 'asc')->get();

            $permiso = App\Permission::where([['menu', '=', 22], ['profile', '=', Auth::user()->profile]])->get();

            if ($permiso[0]->edit) {
                return view('servicios.editar', compact('servicio', 'tipos'));
            }else{
                return redirect('home')->with('error', 'No tienes permisos para este contenido');
            }
    	}else{
    		return redirect('servicios/tipos/crear')->with('error', 'Para crear un servicio debe existir un tipo de servicio previamente');
    	}
    }

    public function editar(Request $request, $id){
    	$servicio = App\Services::findOrFail($id);

    	$servicio->service_type = $request->tipo;
    	$servicio->contact_name = $request->nombre;
    	$servicio->cellphone = $request->celular;
    	$servicio->email = $request->correo;
    	$servicio->state = $request->estado;

    	$servicio->save();

    	return redirect('servicios')->with('mensaje', 'Servicio editado con exito');
    }

    public function tipos(){
    	$tipos = App\ServicesType::get();

        $permiso = App\Permission::where([['menu', '=', 22], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read) {
            return view('servicios.tipos.tipos', compact('tipos', 'permiso'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function tiposCrea(){

        $permiso = App\Permission::where([['menu', '=', 22], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->create) {
            return view('servicios.tipos.crear');
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function tiposCrear(Request $request){
    	$validacion = App\ServicesType::where('name', 'LIKE', $request->tipo)->first();

    	if ($validacion==NULL) {
    		$tipo = new App\ServicesType();

    		$tipo->name = $request->tipo;
    		$tipo->state = 1;

    		$tipo->save();

	    	return redirect('/servicios/tipos')->with('mensaje', 'El tipo de servicio fue agregado con exito');
    	}else{
    		return redirect('servicios/tipos/crear')->with('error', 'El tipo de servicio que desea crear ya existe');
    	}

    }

    public function tiposEdita($id){
    	$tipo = App\ServicesType::findOrFail($id);

        $permiso = App\Permission::where([['menu', '=', 22], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->edit) {
            return view('servicios.tipos.editar', compact('tipo'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function tiposEditar(Request $request, $id){
    	$tipo = App\ServicesType::findOrFail($id);

    	if ($request->estado==0) {
			$servicios = App\Services::where('service_type', '=', $id)->get();

			foreach ($servicios as $servicio) {
				$ser = App\Services::findOrFail($servicio->id);

				$ser->state = 0;

				$ser->save();
			}
    	}

    	$tipo->name = $request->tipo;
    	$tipo->state = $request->estado;

    	$tipo->save();

    	return redirect('/servicios/tipos')->with('mensaje', 'El tipo de servicio fue editado con exito');
    }
}
