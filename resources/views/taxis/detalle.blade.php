@extends('autenticacion')

<title>Taxad | Taxi</title>

@section('formulario')
@if(session('mensaje'))
  <div class="alert alert-success">
    {{session('mensaje')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<a class="btn btn-light"  href="{{ route('taxis') }}">Atras</a>
<a class="btn btn-info"  href="{{ route('taxi.edita', $taxi->id) }}">Editar</a>
<a class="btn btn-primary"  href="{{ route('taxi.reporta', $taxi->id) }}">Reportar</a>
<a class="btn btn-success" style="text-transform: none;" href="{{route('taxi.excel', $taxi->id)}}" title="Se bajara el historico sin filtro">Exportar Ingresos y Gastos</a>
<a class="btn btn-success" style="text-transform: none;" href="{{route('taxi.excelGastos', $taxi->id)}}" title="Se bajara el historico sin filtro">Exportar Gastos</a>
<div id="cabecera">
  <h3>Detalle del taxi {{$taxi->plate}}:</h3>
  <div id="reportes" style="display: block;">
      <table class="table col-8">
        <thead>
          <tr>
            <th scope="col">Inicio</th>
            <th scope="col">Fin</th>
            <th scope="col">Producido</th>
            <th scope="col">Gastos</th>
            <th scope="col">Entrada</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($reportes as $reporte)
            <tr>
              <td>
                {{$reporte->begin}}
              </td>
              <td>
                {{$reporte->end}}
              </td>
              <td>
                {{$reporte->produced}}
              </td>
              <td>
                {{$reporte->expenses}}
              </td>
              <td>
                {{$reporte->payment}}
              </td>
              <td>
                <form action="{{route('taxi.eliminar', $reporte->id)}}" method="post" class="d-inline">
                  @method('DELETE')
                  @csrf
                  <button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                <a href="{{ route('taxi.eliminar', $reporte->id) }}" style="text-decoration: none; color: black"></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{$reportes->links()}}
    </div><br>
  </div>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
      // Some raw data (not necessarily accurate)
      var data = google.visualization.arrayToDataTable([
        ['Semana', 'Producido', 'Gastos', 'Entrada'],
        @php($contador=0)
        @foreach($registros as $registro)
          ['{{$registro->begin}}', {{$registro->produced}}, {{$registro->expenses}}, {{$registro->payment}}],
          @php($contador=$registro->id)
        @endforeach
      ]);

      var options = {
        title : 'Producido vs Gastos',
        vAxis: {title: 'Dinero'},
        hAxis: {title: 'Semana'},
        seriesType: 'bars',
      };

      var chart = new google.visualization.ComboChart(document.getElementById('chart_div_barras'));
      @if($contador!=0)
        chart.draw(data, options);
      @else
        var data = google.visualization.arrayToDataTable([
          ['Semana', 'Producido', 'Gastos', 'Entrada'],
          [0, 0, 0, 0]]);
        chart.draw(data, options);
      @endif
          
    }

        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Categoria', 'Cantidad'],
            @foreach($cantidades as $cantidad)
                ['{{$cantidad->nombre}}', {{$cantidad->conteo}}],
            @endforeach
            ]);

          var options = {
            title: 'Cantidad de Daños por Categoría',
            vAxis: {title: 'Cantidad de Categorias'},
            hAxis: {title: 'Cantidad de Daños'},
            legend: { position: 'none' },
          };

          var chart = new google.visualization.Histogram(document.getElementById('chart_div_histograma'));
          chart.draw(data, options);
        }

        google.charts.setOnLoadCallback(drawChart1);
        function drawChart1() {
          var data = google.visualization.arrayToDataTable([
            ['Categoria', 'Cantidad'],
            @foreach($gastos as $gasto)
              ['{{$gasto->nombre}}', {{$gasto->conteo}}],
            @endforeach
            ]);

          var options = {
            title: 'Valor de Daños por Categoría',
            vAxis: {title: 'Cantidad de Categorias'},
            hAxis: {title: 'Valor de Daños'},
            legend: { position: 'none' },
          };

          var chart = new google.visualization.Histogram(document.getElementById('chart_div_histograma_gasto'));
          chart.draw(data, options);
        }

      </script>

      <div id="graficas" style="display: block;">
        <div>
          <form>
            <center>
              <label>Fecha Inicio</label>
              <input type="date" name="" id=inicio required onchange="minimo('{{$taxi->id}}')">
              <label>Fecha Fin</label>
              <input type="date" name="" id="fin" required onchange="maximo('{{$taxi->id}}')">
              <a id="redireccion" href="#" class="btn btn-primary">Filtrar</a>
              @if(!isset($inicio))
                @php($inicio="null")
              @endif
              @if(!isset($fin))
                @php($fin="null")
              @endif
              <a onclick="imprimir('{{$taxi->id}}', '{{$inicio}}', '{{$fin}}')" class="btn btn-primary" style="text-transform: none; cursor: pointer;">Imprimir</a>
            </center>
          </form>
        </div>
      
        <div id="impresion">
          <center>
            <div id="chart_div_barras" style="width: 900px; height: 250px;"></div>
          </center>
        </div>
        <div id="chart_div_histograma" style="width: 500px; height: 500px; float: left;"></div>
        <div id="chart_div_histograma_gasto" style="width: 500px; height: 500px; float: right;"></div>
      </div>
    </div>
  @endsection

  @section('scripts')
    <script src="../../../../js/taxis.js"></script>
  @endsection