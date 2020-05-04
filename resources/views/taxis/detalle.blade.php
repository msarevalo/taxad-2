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
    <div id="cabecera">
    <h3>Detalle del taxi {{$taxi->plate}}:</h3>
    <table class="table col-8">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Placa</th>
          <th scope="col">Marca</th>
          <th scope="col">Modelo</th>
          <th scope="col">Serie</th>
          <th scope="col">Conductores</th>
          <th scope="col">Estado</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$taxi->id}}</td>
          <td>{{$taxi->plate}}</td>
          <td>
            @foreach($marcas as $marca)
              @if($marca->id==$taxi->brand)
                {{$marca->brand}}
              @endif
            @endforeach
          </td>
          <td>{{$taxi->makes}}</td>
          <td>{{$taxi->serie}}</td>
          <td>
            @php($contador=0)
            @foreach($conductores as $conductor)
              @if($conductor->idTaxi==$taxi->id)
                <a href="{{route('conductor.detalle', $conductor->id)}}"> {{$conductor->name}} {{$conductor->lastname}}</a> ;
                @php($contador++)
              @endif
            @endforeach
          </td>
          <td>
            @if($taxi->state==1)
                Activo
            @else
              Inactivo
            @endif
          </td>
        </tr>
      </tbody>
    </table>
  </div>
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
          <a onclick="imprimir('{{$taxi->id}}', '{{$inicio}}', '{{$fin}}')" class="btn btn-primary" style="text-transform: none;">Imprimir</a>
          <a class="btn btn-success" style="text-transform: none;" href="{{route('taxi.excel', $taxi->id)}}">Exportar</a>
        </center>
      </form>
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
          title : 'Producido vs Gastos - Ultimos 4 registros',
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
          @foreach($categorias as $categoria)
            @foreach($cantidades as $cantidad)
              @if($cantidad->nombre == $categoria->category)
                ['{{$categoria->category}}', {{$cantidad->conteo}}],
              @else
                ['{{$categoria->category}}', 0],
              @endif
            @endforeach
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
          @foreach($categorias as $categoria)
            @foreach($gastos as $gasto)
              @if($gasto->nombre == $categoria->category)
                ['{{$categoria->category}}', {{$gasto->conteo}}],
              @else
                ['{{$categoria->category}}', 0],
              @endif
            @endforeach
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
    
    <div id="impresion">
      <center>
      <div id="chart_div_barras" style="width: 900px; height: 250px;"></div>
    </center>
    </div>
    <div id="chart_div_histograma" style="width: 500px; height: 500px; float: left;"></div>
    <div id="chart_div_histograma_gasto" style="width: 500px; height: 500px; float: right;"></div>
  </div>
@endsection

@section('scripts')
  <script src="../../../../js/taxis.js"></script>
@endsection