<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports;
class TaxisController extends Controller
{
    //
    /*********************************************
     *********************************************
     * Creacion y administracion de taxis*********
     *********************************************
     *********************************************/

    public function taxi(){

        $taxdet = DB::table('taxis')
            ->join('taxi_brands', 'taxis.brand', '=', 'taxi_brands.id')
            ->select('taxis.id', 'taxis.plate', 'taxi_brands.brand as marca', 'taxis.makes', 'taxis.serie', 'taxis.state', 'taxis.created_at')
            ->paginate(5);

        $conductores = DB::table('taxi_drivers')
            ->join('users', 'users.id', '=', 'taxi_drivers.idDriver')
            ->select('taxi_drivers.idTaxi', 'taxi_drivers.state', 'users.name', 'users.lastname')
            ->where([['users.state', '=', '1'], ['users.profile', '=', '3'], ['taxi_drivers.state', '=', '1']])
            ->get();

        $permiso = App\Permission::where([['menu', '=', 17], ['profile', '=', Auth::user()->profile]])->get();

        if ($permiso[0]->read) {
            return view('taxis', compact('taxdet', 'conductores', 'permiso'));
        }else{
            return redirect('home')->with('error', 'No tienes permisos para este contenido');
        }
    }

    public function detalleTax($id, $inicio=null, $fin=null){
        $taxi = App\Taxi::findOrFail($id);
        $marcas = App\TaxiBrand::where('state', 1)->get();
        $conductores = DB::table('taxi_drivers')
            ->join('users', 'users.id', '=', 'taxi_drivers.idDriver')
            ->select('taxi_drivers.idTaxi', 'taxi_drivers.state', 'users.name', 'users.lastname', 'users.id')
            ->where([['users.state', '=', '1'], ['users.profile', '=', '3'], ['taxi_drivers.state', '=', '1']])
            ->get();

        $categorias = App\ExpenseCategory::orderBy('category', 'asc')->get();

        $reportes = App\Record::where('vehicle', '=', $id)->paginate(5);

        if (($inicio==null && $fin==null) || ($inicio=='null' && $fin=='null')) {
            $cantidades = DB::table('expenses')
                ->join('expense_categories', 'expense_categories.id', '=', 'expenses.category')
                ->select('expense_categories.category as nombre', DB::raw('COUNT(expenses.id) as conteo'))
                ->groupBy('expense_categories.category')
                ->orderBy('expense_categories.category')->where('expenses.deleted_at', '=', null)->get();

            $gastos = DB::table('expenses')
                ->join('expense_categories', 'expenses.category', '=', 'expense_categories.id')
                ->select('expense_categories.category as nombre', DB::raw('sum(expenses.value) as conteo'))
                ->groupBy('expense_categories.category')
                ->orderBy('expense_categories.category')->where('deleted_at', '=', null)->get();

            $registros = App\Record::where('vehicle', '=', $id)->orderBy('begin', 'desc')->limit(4)->get();
        }elseif ($inicio!=null && $fin=="null") {
            $cantidades = DB::table('expenses')
                ->join('expense_categories', 'expenses.category', '=', 'expense_categories.id')
                ->select('expense_categories.category as nombre', DB::raw('count(expenses.id) as conteo'))
                ->where([['expenses.date', '>=', $inicio], ['deleted_at', '=', null]])
                ->groupBy('expense_categories.category')
                ->orderBy('expense_categories.category')->get();

            $gastos = DB::table('expenses')
                ->join('expense_categories', 'expenses.category', '=', 'expense_categories.id')
                ->select('expense_categories.category as nombre', DB::raw('sum(expenses.value) as conteo'))
                ->where([['expenses.date', '>=', $inicio], ['deleted_at', '=', null]])
                ->groupBy('expense_categories.category')
                ->orderBy('expense_categories.category')->get();

            $registros = App\Record::where('vehicle', '=', $id)
                ->orderBy('begin', 'desc')
                ->where('records.begin', '>=', $inicio)
                ->get();
        }elseif ($inicio=='null' && $fin!=null) {
            $cantidades = DB::table('expenses')
                ->join('expense_categories', 'expenses.category', '=', 'expense_categories.id')
                ->select('expense_categories.category as nombre', DB::raw('count(expenses.id) as conteo'))
                ->where([['expenses.date', '<=', $fin], ['deleted_at', '=', null]])
                ->groupBy('expense_categories.category')
                ->orderBy('expense_categories.category')->get();

            $gastos = DB::table('expenses')
                ->join('expense_categories', 'expenses.category', '=', 'expense_categories.id')
                ->select('expense_categories.category as nombre', DB::raw('sum(expenses.value) as conteo'))
                ->where([['expenses.date', '<=', $fin], ['deleted_at', '=', null]])
                ->groupBy('expense_categories.category')
                ->orderBy('expense_categories.category')->get();

            $registros = App\Record::where('vehicle', '=', $id)
                ->orderBy('begin', 'desc')
                ->where('records.begin', '<=', $fin)
                ->get();
        }else{
            $cantidades = DB::table('expenses')
                ->join('expense_categories', 'expenses.category', '=', 'expense_categories.id')
                ->select('expense_categories.category as nombre', DB::raw('count(expenses.id) as conteo'))
                ->whereBetween('expenses.date', [$inicio, $fin])
                ->where('deleted_at', '=', null)
                ->groupBy('expense_categories.category')
                ->orderBy('expense_categories.category')->get();

            $gastos = DB::table('expenses')
                ->join('expense_categories', 'expenses.category', '=', 'expense_categories.id')
                ->select('expense_categories.category as nombre', DB::raw('sum(expenses.value) as conteo'))
                ->whereBetween('expenses.date', [$inicio, $fin])
                ->where('deleted_at', '=', null)
                ->groupBy('expense_categories.category')
                ->orderBy('expense_categories.category')->get();

            $registros = App\Record::where('vehicle', '=', $id)
                ->orderBy('begin', 'desc')
                ->whereBetween('records.begin', [$inicio, $fin])
                ->get();
        }
        return view('taxis.detalle', compact('taxi', 'marcas', 'conductores', 'registros', 'cantidades', 'categorias', 'gastos', 'inicio', 'fin', 'reportes'));
    }

    public function creaTax(){
        $marcas = App\TaxiBrand::where('state', 1)->orderBy('brand', 'asc')->get();
        $marca = App\TaxiBrand::where('state', '=', 1)->first();

        //var_dump($marca);

        if ($marca!==null) {
            return view('taxis.create', compact('marcas'));
        }else{
            return redirect('marcas/create')->with('sinMarca', 'Es necesario la creacion de una marca para poder crear un vehiculo');
        }

    }

    public function crearTax(Request $request){
        // return$request->all();
        $taxi = new App\Taxi();
        $taxi->plate=$request->placa;
        $taxi->brand=$request->marca;
        $taxi->makes=$request->modelo;
        $taxi->serie=$request->serie;
        $taxi->state='1';

        $taxi->save();

        return redirect('taxis')->with('mensaje', 'Vehiculo ' . $request->modelo . ' - ' . $request->placa . ' creado con exito');
    }

    public function editaTax($id){
        $taxi = App\Taxi::findOrFail($id);

        $marcas = App\TaxiBrand::where('state', '1')->orderBy('brand', 'asc')->get();

        $conductores = DB::table('users')
            ->where([['profile', '=', 3], ['state', '=', 1]])
            ->whereNotExists(function($query){
                $query->select('taxi_drivers.idDriver')
                ->from('taxi_drivers')
                ->whereRaw('taxi_drivers.idDriver = users.id AND taxi_drivers.state = 1');
            })
            ->orderBy('users.name', 'asc')
            ->get();

        //$asignacion = App\TaxiDriver::where([['state', '=', '1'], ['idTaxi', '=', $id]])->get();

        $asignacion = DB::table('taxi_drivers')
            ->join('users', 'users.id', '=', 'taxi_drivers.idDriver')
            ->select('taxi_drivers.idDriver as id', 'users.name as name', 'users.lastname as lastname')
            ->where([['taxi_drivers.state', '=', 1], ['idTaxi', '=', $id]])
            ->get();

        $soat = App\Document::where([['vehicle', '=', $id], ['type', '=', '1']])->orderBy('created_at', 'desc')->first();

        $tp = App\Document::where([['vehicle', '=', $id], ['type', '=', '2']])->orderBy('created_at', 'desc')->first();

        $to = App\Document::where([['vehicle', '=', $id], ['type', '=', '3']])->orderBy('created_at', 'desc')->first();

        $rt = App\Document::where([['vehicle', '=', $id], ['type', '=', '4']])->orderBy('created_at', 'desc')->first();

        return view('taxis.edita', compact('taxi', 'marcas', 'conductores', 'asignacion', 'soat', 'tp', 'to', 'rt'));
    }

    public function editarTax(Request $request, $id){
        $taxi = App\Taxi::findOrFail($id);
        /*echo $request->marca;
        echo $request->modelo;
        echo $request->serie;
        echo $request->estado;*/
        $taxi->brand = $request->marca;
        $taxi->makes = $request->modelo;
        $taxi->serie = $request->serie;
        $taxi->state = $request->estado;

        $taxi->save();

        if ($request->idCond!=null) {
            if (sizeof($request->idCond)<=4){
                for ($i=0; $i < sizeof($request->idCond); $i++) { 
                    $comprobar = App\TaxiDriver::where([['idDriver', '=', $request->idCond[$i]], ['idTaxi', '=', $id]])->first();

                    if ($comprobar==null) {
                        $asignar = new App\TaxiDriver();
                        $asignar->idTaxi=$id;
                        $asignar->idDriver=$request->idCond[$i];
                        $asignar->state='1';

                        $asignar->save();
                    }else{
                        $comprobar->state='1';
                        $comprobar->save();
                    }
                }
            }else{
                return redirect(route('taxis'))->with('error', 'No se pueden asignar mas de 4 conductores a un vehiculo, los demas datos fueron editados con exito');
            }
        }
        $asignaciones = App\TaxiDriver::where('state', '=', '1')->get();

        /*foreach ($asignaciones as $asigna) {
            $valor = in_array($asigna->idDriver, $request->idCond);
            if ($valor==null) {
                $taxi = App\TaxiDriver::findOrFail($asigna->id);
                $taxi->state='0';
                $taxi->save();
            }
        }*/

        return redirect('taxis')->with('mensaje', 'Taxi ' . $request->modelo . ' - ' . $taxi->plate . ' actualizado con exito');
    }

    public function asignaTax($id){
        $taxi = App\Taxi::findOrFail($id);

        //$conductores = App\User::where([['profile', '=', 3], ['state', '=', 1]])->get();

        //$con = App\TaxiDriver::where('state', '=', 1)->get();

        /*$prueba = App\User::whereNotExists(function($query){
            $query->select('taxi_drivers.idDriver')
                ->from('taxi_drivers')
                ->where([['taxi_drivers.idDriver', '=', 'users.id'], ['state', '=', 1]]);
        })->where([['profile', '=', 3], ['state', '=', 1]])->get();
*/      
        $conductores = DB::table('users')
            ->where([['profile', '=', 3], ['state', '=', 1]])
            ->whereNotExists(function($query){
                $query->select('taxi_drivers.idDriver')
                ->from('taxi_drivers')
                ->whereRaw('taxi_drivers.idDriver = users.id AND taxi_drivers.state = 1');
            })
            ->orderBy('users.name', 'asc')
            ->get();

        /*echo sizeof($prueba) . "<br>";

        for ($i=0; $i < sizeof($prueba); $i++) { 
            echo $prueba[$i]->name . "<br>";
        }*/

        if (sizeof($conductores)!=0) {
            return view('taxis.asigna', compact('taxi', 'conductores'));
        }else{
            return redirect('conductores/create')->with('sinUsuario', 'Es necesario la creacion de un conductor para poder asignar un vehiculo');
        }
    }

    public function asignarTax(Request $request, $id){
        $validar = App\TaxiDriver::where([['idTaxi', '=', $id], ['state', '=', 1]])->first();

        if ($validar==null) {
            if (!empty($request->idCond)) {
                if (sizeof($request->idCond)<=4){
                    for ($i=0; $i < sizeof($request->idCond); $i++) { 
                        $comprobar = App\TaxiDriver::where([['idDriver', '=', $request->idCond[$i]], ['idTaxi', '=', $id]])->first();

                        if ($comprobar==null) {
                            $asignar = new App\TaxiDriver();
                            $asignar->idTaxi=$id;
                            $asignar->idDriver=$request->idCond[$i];
                            $asignar->state='1';

                            $asignar->save();
                        }else{
                            $comprobar->state='1';
                            $comprobar->save();
                        }

                        
                    }        

                    return redirect('taxis')->with('mensaje', 'Asignacion realizada con exito');
                }else{
                    return redirect(route('taxi.asignar', $id))->with('error', 'No se pueden asignar mas de 4 conductores a un vehiculo');
                }
            }else{
                return redirect(route('taxi.asignar', $id))->with('error', 'No has seleccionado ningun conductor');
            }
        }else{
            return redirect('taxis')->with('error', 'El vehiculo ya cuenta con un conductor asignado');
        }
    }

    public function documento($id){
        $taxi = App\Taxi::findOrFail($id);
        $tipos = App\DocumentType::all();

        return view('taxis/documento', compact('taxi', 'tipos'));
    }

    public function cargarDocumento(Request $request, $id){
        //return $request;
        if ($request->hasFile('soat')) {
            $file = $request->file('soat');
            if ($request->tipo==1) {
                $name = 'soat-'.$id.'-'.time().'.pdf';
                $file->move(public_path().'/documentos/soat/', $name);
            }elseif ($request->tipo==2) {
                $name = 'tp-'.$id.'-'.time().'.pdf';
                $file->move(public_path().'/documentos/tp/', $name);
            }elseif($request->tipo==3){
                $name = 'to-'.$id.'-'.time().'.pdf';
                $file->move(public_path().'/documentos/to/', $name);
            }else{
                $name = 'rt-'.$id.'-'.time().'.pdf';
                $file->move(public_path().'/documentos/rt/', $name);
            }
        }
        $documento = new App\Document();
        $documento->type = $request->tipo;
        $documento->vehicle = $id;
        $documento->document = $name;
        $documento->save();

        return redirect('taxis/edita/'.$id)->with('cargado', 'El SOAT fue cargado con exito');
    }

    public function reporta($id){
        $taxi = App\Taxi::findOrFail($id);
        $tarifas = App\Rate::get();

        $verifica = App\TaxiDriver::where([['state', '=', 1], ['idTaxi', '=', $id]])->first();

        if ($verifica!==null) {
            return view('taxis/reportar', compact('taxi', 'tarifas', '$id'));
        }else{
            return redirect('taxis/asigna/'.$id)->with('error', 'Es la asignacion de un condutor');
        }

    }

    public function reportar(Request $request, $id){
        $validacion = App\Record::where([['begin', '=', $request->inicio], ['vehicle', '=', $id]])->first();

        if ($validacion==null) {
            
            $reporte = new App\Record();
            $reporte->vehicle=$id;
            $reporte->week=date('W', strtotime($request->inicio));
            $reporte->begin=$request->inicio;
            $reporte->end=date('Y-m-d', strtotime($request->inicio.'+ 6 days'));
            $reporte->sunday=$request->producidoD . ';' . $request->gastosD . ';' . $request->otrosD;
            $reporte->monday=$request->producidoL . ';' . $request->gastosL . ';' . $request->otrosL;
            $reporte->tuesday=$request->producidoM . ';' . $request->gastosM . ';' . $request->otrosM;
            $reporte->wednesday=$request->producidoMi . ';' . $request->gastosMi . ';' . $request->otrosMi;
            $reporte->thursday=$request->producidoJ . ';' . $request->gastosJ . ';' . $request->otrosJ;
            $reporte->friday=$request->producidoV . ';' . $request->gastosV . ';' . $request->otrosV;
            $reporte->saturday=$request->producidoS . ';' . $request->gastosS . ';' . $request->otrosS;
            
            $prod = $request->producidoD + $request->producidoL + $request->producidoM + $request->producidoMi + $request->producidoJ + $request->producidoV + $request->producidoS;
            $gastos = $request->gastosD + $request->otrosD + $request->gastosL + $request->otrosL + $request->gastosM + $request->otrosM + $request->gastosMi + $request->otrosMi + $request->gastosJ + $request->otrosJ + $request->gastosV + $request->otrosV + $request->gastosS + $request->otrosS;

            $pago = $prod - $gastos;

            $reporte->produced=$prod;
            $reporte->expenses=$gastos;
            $reporte->payment=$pago;

            $reporte->save();

            if ($gastos==0) {
                return redirect('taxis')->with('mensaje', 'Reporte de la semana ' . $request->semana . ' creado con exito');   
            }else{
                return redirect('taxis/gastos/' . $id . '/' . $request->inicio . '/' . $gastos);
            }

        }else{
            return redirect('taxis/reporta/' . $id)->with('error', 'Ya se encuentra un registro para esta semana con este vehiculo');
        }
    }

    public function eliminarReporte($id){
        $reporte = App\Record::where('id', '=', $id)->first();

        $gastos = App\Expense::where([['begin', '=', $reporte->begin], ['end', '=', $reporte->end]])->get();

        $elimina_reporte = App\Record::findOrFail($id);

        $elimina_reporte->delete();

        foreach ($gastos as $gasto) {
            $elimina_gasto = App\Expense::findOrFail($gasto->id);

            $elimina_gasto->delete();   
        }

        return redirect('taxis')->with('mensaje', 'Registro eliminado correctamente');

    }

    public function gastos($id, $w, $val){
        $categorias = App\ExpenseCategory::where('state', '=', 1)->get();
        $descripciones = App\ExpenseDescription::where('state', '=', 1)->get();

        return view('taxis/gastos', compact('id', 'w', 'val', 'categorias', 'descripciones'));
    }

    public function gastosIngresar(Request $request, $id){
        $identificador = explode("_", $id);
        $validar = App\Expense::where("begin", '=', $identificador[1])->first();
        if ($validar==NULL) {
            # code...
            for ($i=1; $i<=$request->cantidad ; $i++) {
                $name="";
                if ($request->hasFile('factura' . $i)) {
                    $file = $request->file('factura' . $i);
                    $name = 'factura-'.$identificador[0].'-'.time(). '-' . $i .'.pdf';
                    $file->move(public_path().'/documentos/facturas/', $name);
                }else{
                    $name="fallo";
                }

                $gasto = new App\Expense();
                $gasto->vehicle=$identificador[0];
                $gasto->week=date('W', strtotime($identificador[1]));
                $gasto->begin=$identificador[1];
                $gasto->end=date('Y-m-d', strtotime($identificador[1].'+ 6 days'));
                $gasto->date=$request['fecha'.$i];
                $gasto->value=$request['valor'.$i];
                $gasto->pay_to=$request['pagoa'.$i];
                $gasto->category=$request['categoria'.$i];
                $gasto->description=$request['descripcion'.$i];
                $gasto->other=$request['otros'.$i];
                $gasto->bill=$name;

                $gasto->save();

                if ($request['km'.$i]!=NULL) {
                    $kilometaje = new App\OilChange();
                    $kilometaje->vehicle=$identificador[0];
                    $kilometaje->km=$request['km'.$i];
                    $kilometaje->date=$request['fecha'.$i];

                    $kilometaje->save();
                }
            }
            return redirect('taxis/detalle/'.$id)->with('mensaje', 'Los gastos se registraron con exito');
        }else{
            return redirect('taxis')->with('error', 'Ya has registrado gastos para esta semana');
        }

    }

    public function excel($id){
        //return Excel::download(new TaxiExport,'taxi.xlsx');
        return (new Exports\TaxiExport(intval($id)))->download('taxis_historico.xlsx');
    }

    public function excelGastos($id){
        //return Excel::download(new TaxiExport,'taxi.xlsx');
        return (new Exports\TaxiGastos(intval($id)))->download('taxis_gastos.xlsx');
    }
}
