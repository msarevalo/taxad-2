<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ExpensesCategoryController extends Controller
{
    //
    public function categoria(){
        $categorias = App\ExpenseCategory::orderBy('category')->paginate(10);
        $detalles = DB::table('expense_descriptions')
                        ->select('expense_descriptions.category',DB::raw('count(id) as conteo'))
                        ->groupBy('expense_descriptions.category')->get();
        $activos = DB::table('expense_descriptions')
                        ->select('expense_descriptions.category as categoria',DB::raw('count(id) as conteo'))
                        ->where('state', '=', 1)
                        ->groupBy('expense_descriptions.category')->get();

        $permiso = App\Permission::where([['menu', '=', 14], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read) {
            return view('categorias', compact('categorias', 'permiso', 'detalles', 'activos'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function destalleCategoria($id){
        $categoria = App\ExpenseCategory::findOrFail($id);
        $descripciones = App\ExpenseDescription::where('category', '=', $id)->orderBy('description')->paginate(5);

        $permiso = App\Permission::where([['menu', '=', 14], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read) {
            return view('taxis.categorias.detalle', compact('categoria', 'descripciones', 'permiso'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function crea(){
        $permiso = App\Permission::where([['menu', '=', 14], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->create) {
            return view('taxis.categorias.create');
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function crear(Request $request){
        $validacion = App\ExpenseCategory::where('category', 'LIKE', $request->categoria)->first();

        if ($validacion==NULL) {
            $categoria = new App\ExpenseCategory();

            $categoria->category = $request->categoria;
            $categoria->state = 1;

            $categoria->save();

            return redirect('/categoria')->with('mensaje', 'La categoria ' . $request->categoria . ' ha sido creada con exito');
        }else{
            return redirect('/categoria/crear')->with('error', 'La categoria que intentas crear ya existe previamente');
        }
    }

    public function edita($id){
        $categoria = App\ExpenseCategory::findOrFail($id);

        $permiso = App\Permission::where([['menu', '=', 14], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->edit) {
            return view('taxis.categorias.edit', compact('categoria'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function editar(Request $request, $id){
        if ($request->estado==0) {
            $descripciones = App\ExpenseDescription::where('category', '=', $id)->get();

            for ($i=0; $i < sizeof($descripciones) ; $i++) { 
                $descripcion = App\ExpenseDescription::findOrFail($descripciones[$i]->id);

                $descripcion->state = 0;

                $descripcion->save();
            }
        }else{
            $descripciones = App\ExpenseDescription::where('category', '=', $id)->get();

            for ($i=0; $i < sizeof($descripciones) ; $i++) { 
                $descripcion = App\ExpenseDescription::findOrFail($descripciones[$i]->id);

                $descripcion->state = 1;

                $descripcion->save();
            }
        }

        $categoria = App\ExpenseCategory::findOrFail($id);

        $categoria->category = $request->categoria;
        $categoria->state = $request->estado;

        $categoria->save();

        return redirect('/categoria')->with('mensaje', 'La categoria y las descripciones asociadas fue modificada con exito');
    }

}
