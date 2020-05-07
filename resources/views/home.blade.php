@extends('autenticacion')

@section('formulario')
@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="container" onloadeddata="notificaciones()">
    <div class="row justify-content">
        <div class="col-md-8">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mes', 'Entradas', 'Gastos'],
          @foreach($reportes as $reporte)
            ['{{$reporte->año}}-{{$reporte->mes}}', {{$reporte->producido}}, {{$reporte->gastos}}],
          @endforeach
        ]);

        var options = {
          title: 'Producido vs Gastos',
          hAxis: {title: 'Mes',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    @if(sizeof($reportes)==0)
      <center><img src="../img/logo500x500.png" style="width: 300px; margin-left: 200px; margin-top: 100px"></center>
    @else
      @if($permiso[0]->read==1)
        <div id="chart_div" style="width: 1000px; height: 500px;"></div>
      @else
        <center><img src="../img/logo500x500.png" style="width: 300px;"></center>
      @endif
    @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="../js/notificacion.js"></script>
@endsection