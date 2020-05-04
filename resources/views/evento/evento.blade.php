@extends('autenticacion')

<title>Taxad | Calendario</title>

@section('formulario')
<html>
  <head>
    <title></title>
    <meta content="">
    <style>
    body{
      font-family: 'Exo', sans-serif;
    }
    .header-col{
      background: #E3E9E5;
      color:#536170;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
    }
    .header-calendar{
      background: #EE192D;color:white;
    }
    .box-day{
      border:1px solid #E3E9E5;
      height:150px;
    }
    .box-dayoff{
      border:1px solid #E3E9E5;
      height:150px;
      background-color: #ccd1ce;
    }
    .right{
      float: right;
    }
    </style>

  </head>
  <body>

    <div class="container">
      <div style="height:50px"></div>
      <a class="btn btn-light"  href="{{ asset('/calendario') }}">Atras</a>
      @php($timezone  = -5)
            @php($fecha=gmdate("Y-m-d", time() + 3600*($timezone+date("I"))))
      @if(Auth::user()->id==$event->owner && $event->date>=$fecha && $event->state==1)
        <div class="right">
          <a href="{{route('calendario.edita', $event->id)}}" style="text-decoration: none;" class="btn btn-info">Editar</a>
          <a href="{{route('calendario.delete', $event->id)}}" style="text-decoration: none;" class="btn btn-danger">Eliminar</a>
        </div>
      @endif
      <h1 style="margin-top: 20px;">{{ $event->title }}</h1>
      @if($event->broadcast==0)
        <p style="font-size: 14.5px;">Evento propio</p>
      @else
        <p style="font-size: 14.5px;">Evento de la comunidad</p>
      @endif
      <hr>

      <div class="col-md-6">
        <div class="fomr-group">
            <h5 style="display: inline;">Prioridad:&nbsp;&nbsp;&nbsp;&nbsp; </h5>
            @if($event->priority==1)
              Alto
            @elseif($event->priority==2)
              Medio
            @else
              Bajo
            @endif
          </div><br><br>
          <div class="fomr-group">
            <h5>Descripcion del Evento</h5>
            {{ $event->description }}
          </div><br><br>
          
          <div class="fomr-group">
            <h5 style="display: inline;">Fecha: &nbsp;&nbsp;&nbsp;&nbsp;</h5>
            {{ $event->date[8] }}{{ $event->date[9] }}{{ $event->date[7] }}{{ $event->date[5] }}{{ $event->date[6] }}{{ $event->date[4] }}{{ $event->date[0] }}{{ $event->date[1] }}{{ $event->date[2] }}{{ $event->date[3] }}
          </div>
          <br>
      </div>


      <!-- inicio de semana -->


    </div> <!-- /container -->


  </body>
</html>
@endsection

@section('scripts')
    <script src="../../js/notificacion.js"></script>
@endsection