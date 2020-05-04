<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BrandsController extends Controller
{
    //
    /*************************************************
     *************************************************
     * Creacion y administracion de Marcas Vehiculos**
     *************************************************
     *************************************************/

    public function marca(){
        $marcas = App\TaxiBrand::paginate(5);

        $permiso = App\Permission::where([['menu', '=', 16], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read) {
            return view('taxis/marcas', compact('marcas', 'permiso'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function creaMarca(){
        $permiso = App\Permission::where([['menu', '=', 16], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->create) {
            return view('taxis.marcas.create');
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function crearMarca(Request $request){

        $validacion = App\TaxiBrand::where('brand', 'LIKE', $request->marca)->first();

        if ($validacion==NULL) {
        // return$request->all();
            $marca = new App\TaxiBrand();
            $marca->brand=$request->marca;
            $marca->state='1';

            $marca->save();

            return redirect(route('marcas'))->with('mensaje', 'Marca ' . $request->marca . ' 
                creada con exito');
        }else{
            return redirect('/marcas/create')->with('error', 'La marca que intentas crear ya existe previamente');
        }
    }

    public function detalleMarca($id=null){
        $marca = App\TaxiBrand::findOrFail($id);

        $taxdet = DB::table('taxis')
            ->join('taxi_brands', 'taxis.brand', '=', 'taxi_brands.id')
            ->select('taxis.id', 'taxis.plate', 'taxi_brands.brand as marca', 'taxis.makes', 'taxis.serie', 'taxis.state', 'taxis.created_at')
            ->where('taxis.brand', '=', $id)
            ->paginate(5);

        $conductores = DB::table('taxi_drivers')
            ->join('users', 'users.id', '=', 'taxi_drivers.idDriver')
            ->select('taxi_drivers.idTaxi', 'taxi_drivers.state', 'users.name', 'users.lastname')
            ->where([['users.state', '=', '1'], ['users.profile', '=', '3'], ['taxi_drivers.state', '=', '1']])
            ->get();


        $permiso = App\Permission::where([['menu', '=', 16], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read) {
            return view('taxis.marcas.detalle', compact('marca', 'taxdet', 'conductores'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function editaMarca($id){
        $marca = App\TaxiBrand::findOrFail($id);

        $permiso = App\Permission::where([['menu', '=', 16], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->edit) {
            return view('taxis.marcas.edita', compact('marca'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function editarMarca(Request $request, $id){
        $vehiculos = App\taxi::where([['brand', '=', $id], ['state', '=', 1]])->first();
//        var_dump($vehiculos);
        if ($request->estado==0) {
            if ($vehiculos==null) {
                $marca = App\TaxiBrand::findOrFail($id);
                $marca->brand = $request->marca;
                $marca->state = $request->estado;

                $marca->save();

                return redirect('marcas')->with('mensaje', 'Marca ' . $request->marca . ' actualizada con exito');
            }else{
                return redirect('marcas')->with('error', 'No se puede inactivar la marca ' . $request->marca . ' pues tiene vehiculos asociados');
            }
        }else{
            $marca = App\TaxiBrand::findOrFail($id);
                $marca->brand = $request->marca;
                $marca->state = $request->estado;

                $marca->save();

                return redirect('marcas')->with('mensaje', 'Marca ' . $request->marca . ' actualizada con exito');
        }
        
    }
}
