<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ExpensesDescriptionController extends Controller
{
    //
    public function descripcion(){
        $descripciones = App\ExpenseDescription::orderBy('description')->paginate(10);
        $categorias = App\ExpenseCategory::get();

        $permiso = App\Permission::where([['menu', '=', 15], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read) {
            return view('descripciones', compact('descripciones', 'permiso', 'categorias'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function crea(){
        $categorias = App\ExpenseCategory::where('state', '=', 1)->orderBy('category', 'asc')->get();
        $permiso = App\Permission::where([['menu', '=', 15], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->create) {
            return view('taxis.descripciones.create', compact('categorias', 'permiso'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }   
    }

    public function crear(Request $request){
        $descripcion = new App\ExpenseDescription();

        $descripcion->category=$request->categoria;
        $descripcion->description=$request->descripcion;
        $descripcion->state=1;

        $descripcion->save();

        return redirect('descripcion')->with('mensaje', 'La descripcion fue creada con exito');
    }

    public function edita($id){
        $descripcion = App\ExpenseDescription::findOrFail($id);
        $categorias = App\ExpenseCategory::where('state', '=', 1)->orderBy('category', 'asc')->get();

        $permiso = App\Permission::where([['menu', '=', 15], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->edit) {
            return view('taxis.descripciones.edit', compact('descripcion', 'categorias'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function editar(Request $request, $id){
        $descripcion = App\ExpenseDescription::findOrFail($id);

        $descripcion->category=$request->categoria;
        $descripcion->description=$request->descripcion;
        $descripcion->state=$request->estado;

        $descripcion->save();

        return redirect('descripcion')->with('mensaje', 'La descripcion fue editada con exito');
    }

    public function creaDes($id){
        $categorias = App\ExpenseCategory::where('state', '=', 1)->orderBy('category', 'asc')->get();
        $permiso = App\Permission::where([['menu', '=', 15], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->create) {
            return view('taxis.descripciones.create', compact('categorias', 'permiso', 'id'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }  
    }
    
}
