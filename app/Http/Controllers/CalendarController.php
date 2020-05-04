<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CalendarController extends Controller
{
    //

	/*************************************************
     *************************************************
     ********************Calendario*******************
     *************************************************
     *************************************************/

    
    public function calendario(){
        return view('calendar');
    }

    public function formulario(){
      return view("evento/form");
    }

    public function crearEvento(Request $request){

      $this->validate($request, [
      'titulo'     =>  'required',
      'descripcion'  =>  'required',
      'prioridad'   =>  'required',
      'fecha' =>  'required'
     ]);

      if ($request->usuario==0) {
          $broadcast=1;
      }else{
        $broadcast=0;
      }
      /*App\Event::insert([
        'titulo'       => $request->input("titulo"),
        'descripcion'  => $request->input("descripcion"),
        'prioridad'    => $request->prioridad,
        'propietario'  => Auth::user()->id,
        'broadcast'    => $broadcast,
        'fecha'        => $request->input("fecha"),
        'estado'       => '1'
      ]);*/

        $evento = new App\Event();
        $evento->title=$request->titulo;
        $evento->description=$request->descripcion;
        $evento->priority=$request->prioridad;
        $evento->owner=Auth::user()->id;
        $evento->broadcast=$broadcast;
        $evento->date=$request->fecha;
        $evento->state='1';

        $evento->save();


      return redirect('calendario');

    }

    public function eliminarEvento($id){
        $evento = App\Event::findOrFail($id);

        $evento->state = '0';

        $evento->save();

        return redirect('calendario');
    }

    public function detalles($id){

      $event = App\Event::find($id);

      return view("evento/evento",[
        "event" => $event
      ]);

    }

    public function editaCalendario($id){
        $event = App\Event::find($id);

        return view("evento/edit",[
            "event" => $event
        ]);
    }

    public function editarCalendario(Request $request, $id){
        $evento = App\Event::findOrFail($id);

        if ($request->usuario==0) {
          $broadcast=1;
        }else{
            $broadcast=0;
        }
        $evento->title=$request->titulo;
        $evento->description=$request->descripcion;
        $evento->priority=$request->prioridad;
        $evento->broadcast=$broadcast;
        $evento->date=$request->fecha;

        $evento->save();

        return redirect('calendario');

    }


    // =================== CALENDARIO =====================

    public function index(){

       $month = date("Y-m");
       //
       $data = $this->calendar_month($month);
       $mes = $data['month'];
       // obtener mes en espanol
       $mespanish = $this->spanish_month($mes);
       $mes = $data['month'];

       return view("evento/calendario",[
         'data' => $data,
         'mes' => $mes,
         'mespanish' => $mespanish
       ]);

   }

   public function mes($month){

      $data = $this->calendar_month($month);
      $mes = $data['month'];
      // obtener mes en espanol
      $mespanish = $this->spanish_month($mes);
      $mes = $data['month'];

      return view("evento/calendario",[
        'data' => $data,
        'mes' => $mes,
        'mespanish' => $mespanish
      ]);

    }

    public static function calendar_month($month){
      //$mes = date("Y-m");
      $mes = $month;
      //sacar el ultimo de dia del mes
      $daylast =  date("Y-m-d", strtotime("last day of ".$mes));
      //sacar el dia de dia del mes
      $fecha      =  date("Y-m-d", strtotime("first day of ".$mes));
      $daysmonth  =  date("d", strtotime($fecha));
      $montmonth  =  date("m", strtotime($fecha));
      $yearmonth  =  date("Y", strtotime($fecha));
      // sacar el lunes de la primera semana
      $nuevaFecha = mktime(0,0,0,$montmonth,$daysmonth,$yearmonth);
      $diaDeLaSemana = date("w", $nuevaFecha);
      $nuevaFecha = $nuevaFecha - ($diaDeLaSemana*24*3600); //Restar los segundos totales de los dias transcurridos de la semana
      $dateini = date ("Y-m-d",$nuevaFecha);
      //$dateini = date("Y-m-d",strtotime($dateini."+ 1 day"));
      // numero de primer semana del mes
      $semana1 = date("W",strtotime($fecha));
      // numero de ultima semana del mes
      $semana2 = date("W",strtotime($daylast));
      // semana todal del mes
      // en caso si es diciembre
      if (date("m", strtotime($mes))==12) {
          $semana = 5;
      }
      else {
        $semana = ($semana2-$semana1)+1;
      }
      // semana todal del mes
      $datafecha = $dateini;
      $calendario = array();
      $iweek = 0;
      while ($iweek < $semana):
          $iweek++;
          //echo "Semana $iweek <br>";
          //
          $weekdata = [];
          for ($iday=0; $iday < 7 ; $iday++){
            // code...
            $datafecha = date("Y-m-d",strtotime($datafecha."+ 1 day"));
            $datanew['mes'] = date("M", strtotime($datafecha));
            $datanew['dia'] = date("d", strtotime($datafecha));
            $datanew['fecha'] = $datafecha;
            //AGREGAR CONSULTAS EVENTO
            $usuario=Auth::user()->id;
            $datanew['evento'] = App\Event::where([["date", '=', $datafecha], ["broadcast", '=', 1], ["state", "=", '1']])->orwhere([["date", '=', $datafecha],["owner", '=', '1'], ["state", "=", '1']])->get();

            array_push($weekdata,$datanew);
          }
          $dataweek['semana'] = $iweek;
          $dataweek['datos'] = $weekdata;
          //$datafecha['horario'] = $datahorario;
          array_push($calendario,$dataweek);
      endwhile;
      $nextmonth = date("Y-M",strtotime($mes."+ 1 month"));
      $lastmonth = date("Y-M",strtotime($mes."- 1 month"));
      $month = date("M",strtotime($mes));
      $yearmonth = date("Y",strtotime($mes));
      //$month = date("M",strtotime("2019-03"));
      $data = array(
        'next' => $nextmonth,
        'month'=> $month,
        'year' => $yearmonth,
        'last' => $lastmonth,
        'calendar' => $calendario,
      );
      return $data;
    }

    public static function spanish_month($month)
    {

        $mes = $month;
        if ($month=="Jan") {
          $mes = "Enero";
        }
        elseif ($month=="Feb")  {
          $mes = "Febrero";
        }
        elseif ($month=="Mar")  {
          $mes = "Marzo";
        }
        elseif ($month=="Apr") {
          $mes = "Abril";
        }
        elseif ($month=="May") {
          $mes = "Mayo";
        }
        elseif ($month=="Jun") {
          $mes = "Junio";
        }
        elseif ($month=="Jul") {
          $mes = "Julio";
        }
        elseif ($month=="Aug") {
          $mes = "Agosto";
        }
        elseif ($month=="Sep") {
          $mes = "Septiembre";
        }
        elseif ($month=="Oct") {
          $mes = "Octubre";
        }
        elseif ($month=="Nov") {
          $mes = "Noviembre";
        }
        elseif ($month=="Dec") {
          $mes = "Diciembre";
        }
        else {
          $mes = $month;
        }
        return $mes;
    }

}
