<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function perfil(){
    	$info = App\User::where('id', '=', Auth::user()->id)->first();

        return view('perfil', compact('info'));
    }

    public function editar(Request $request, $id){
    	$validacion = App\User::where([['email', '=', $request->email], ['id', '!=', $id]])->first();

    	if ($validacion==null) {
    		$perfil = App\User::findOrFail($id);

    		$perfil->name = $request->name;
    		$perfil->lastname = $request->lastname;
    		$perfil->email = $request->email;

    		$perfil->save();

    		return redirect('perfil')->with('mensaje', 'Los datos han sido editados con exito');
    	}else{
    		return redirect('perfil')->with('error', 'El correo que escribiste ya se encuentra registrado para otro usuario');
    	}

    }

    public function cambio(){
    	return view('contraseña');
    }

    public function cambiar(Request $request){
    	if($request->pass !== $request->npass){
    		$usuario = App\User::findOrFail(Auth::user()->id);
    		if(Hash::check($request->pass, $usuario->password)){
    			$usuario->password = Hash::make($request->npass);

    			$usuario->save();

    			return redirect('perfil')->with('mensaje', 'La constraseña fue cambiada exitosamente');
    		}else{
    			return redirect('perfil/cambio')->with('error', 'La contraseña anterior no coincide');	
    		}
    	}else{
    		return redirect('perfil/cambio')->with('error', 'La contraseña nueva no puede ser igual a la anterior');
    	}

    }

}
