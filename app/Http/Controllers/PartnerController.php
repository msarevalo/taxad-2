<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PartnerController extends Controller
{
    //

    /*************************************************
     *************************************************
     * Creacion y administracion de Socios************
     *************************************************
     *************************************************/

    public function socio(){
        if (Auth::user()->profile!==3) {
            $socios = App\User::where('profile', '=', '4')->paginate(5);
            $perfiles = App\Profile::all();

            $permiso = App\Permission::where([['menu', '=', 11], ['profile', '=', Auth::user()->profile]])->get();

            if ($permiso[0]->read) {
                return view('socios', compact('socios', 'perfiles', 'permiso'));
            }else{
                return redirect('home')->with('error', 'No tienes permisos para este contenido');
            }
        }else{
            return redirect('home');
        }
    }

    public function creaSocio(){
        $permiso = App\Permission::where([['menu', '=', 11], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->create) {
            return view('socios/create');
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function crearSocio(Request $request){

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


                $socio = new App\User;
                $socio->username=strtolower($usuario);
                $socio->document=$request->document;
                $socio->name=$request->name;
                $socio->lastname=$request->lastname . ' ' . $request->lastname2;
                $socio->email=$request->email;
                $socio->password=Hash::make($request['document']);
                $socio->state='1';
                $socio->profile='4';
                $socio->new='1';

                $socio->save();

                return redirect('socios')->with('mensaje', 'Socio ' . $request->name . ' ' . $request->lastname . ' creado con exito');
            }else{
                return redirect('socios')->with('documento', 'El correo que ingresaste ya existe, verifica los datos');    
            }
        }else{
            return redirect('socios')->with('documento', 'El documento que ingresaste ya existe, verifica los datos');
        }
    }

    public function editaSocio($id){
        $socio = App\User::findOrFail($id);
        $perfiles = App\Profile::where('id', '=', '4')->get();

        if ($socio->profile==4) {
            $permiso = App\Permission::where([['menu', '=', 11], ['profile', '=', Auth::user()->profile]])->get();

            if ($permiso[0]->edit) {
                return view('socios.edit', compact('socio', 'profile'));
            }else{
                return redirect('home')->with('error', 'No tienes permisos para este contenido');
            }
        }else{
            return redirect('socios');
        }

    }

    public function editarSocio(Request $request, $id){
        $verificar = App\User::where([['email', '=', $request->email], ['id', '!=', $id]])->first();

        if ($verificar==null) {
            $socio = App\User::findOrFail($id);
            $socio->name = $request->name;
            $socio->lastname = $request->lastname;
            $socio->email = $request->email;
            $socio->profile = '4';
            $socio->state = $request->estado;

            $socio->save();

            return redirect('socios')->with('mensaje', 'Se edito el socio con exito');
        }else{
            return redirect('socios')->with('error', 'El correo que intentas registrar ya esta asociado para otro usuario');
        }
    }
}
