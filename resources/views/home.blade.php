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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mes', 'Producido', 'Gastos'],
          ['Diciembre\n2019',  1000,      400],
          ['Enero\n2020',  1000,      400],
          ['Febrero\n2020',  1170,      460],
          ['Marzo\n2020',  660,       1120],
          ['Abril\n2020',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    @if($permiso[0]->read==1)
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
    @else
      <center><img src="../img/logo500x500.png" style="width: 300px;"></center>
    @endif
  </body>
</html>

        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="../js/notificacion.js"></script>
@endsection