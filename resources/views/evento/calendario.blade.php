@extends('autenticacion')

<title>Taxad | Calendario</title>

@section('formulario')
<html>
  <head>  
    <style>
    .header-col{
      background: #E3E9E5;
      color:#536170;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
    }
    .header-calendar{
      background: #132644;color:white;
      height: 60px;
      margin-top: -35px
    }
    .box-day{
      border:1px solid #E3E9E5;
      height:110px;
      overflow: auto;
    }
    .box-dayoff{
      border:1px solid #E3E9E5;
      height:110px;
      background-color: #ccd1ce;
    }
    .actual{
      height: 28px;
      width: 28px;
      display: table-cell;
      text-align: center;
      vertical-align: middle;
      border-radius: 50%;
      background: #132644;
      color: white;
    }
    .actual-ejem{
      display: inline;
      text-align: center;
      vertical-align: middle;
      border-radius: 50%;
      background: #132644;
      color: white;
      width: 30px;
    }
    </style>

  </head>
  <body>

    <div class="container">
      <p class="lead">
      <a class="btn btn-primary"  href="{{ asset('/calendario/form') }}">Crear un evento</a><br><br>
      <div class="row header-calendar" >
        <div class="col" style="display: flex; justify-content: space-between; padding: 10px;">
          <a  href="{{ asset('calendario/') }}/<?= $data['last']; ?>" style="margin:5px;">
            <i class="fa fa-arrow-circle-left" style="font-size:30px;color:white;"></i>
          </a>
          <h2 style="font-weight:bold;margin:5px;"><?= $mespanish; ?> <small><?= $data['year']; ?></small></h2>
          <a  href="{{ asset('calendario/') }}/<?= $data['next']; ?>" style="margin:5px;">
            <i class="fa fa-arrow-circle-right" style="font-size:30px;color:white;"></i>
          </a>
        </div>

      </div>
      <div class="row">
        <div class="col header-col">Lunes</div>
        <div class="col header-col">Martes</div>
        <div class="col header-col">Miercoles</div>
        <div class="col header-col">Jueves</div>
        <div class="col header-col">Viernes</div>
        <div class="col header-col">Sabado</div>
        <div class="col header-col">Domingo</div>
      </div>
      
      <!-- inicio de semana -->
      @php($timezone  = -5)
      @php($dia=gmdate("d", time() + 3600*($timezone+date("I"))))
      @php($mactual=gmdate("M", time() + 3600*($timezone+date("I"))))
      @php($primerdia=$data['calendar'][0]['datos'][0]['dia'])
      @if($primerdia>1 && $primerdia<5)

      @endif
      @foreach ($data['calendar'] as $weekdata)
        <div class="row">
          <!-- ciclo de dia por semana -->
          @foreach  ($weekdata['datos'] as $dayweek)
          @if  ($dayweek['mes']==$mes)
            <div class="col box-day">
            @if($dayweek['dia']==$dia && $dayweek['mes']==$mactual)
              <p class="actual">{{ $dayweek['dia'] }}</p>
            @else
              <p>{{ $dayweek['dia']  }}</p>
            @endif
              <!-- evento -->
              @foreach  ($dayweek['evento'] as $event)
                  @if($event->broadcast==1)
                    @if($event->priority==3)
                      <a class="badge badge-primary" style="background-color: #7e9ccc" href="{{ asset('/calendario/details/') }}/{{ $event->id }}">
                      {{ $event->title }} *
                      </a>
                    @elseif($event->priority==2)
                      <a class="badge badge-primary" style="background-color: #b3b053" href="{{ asset('/calendario/details/') }}/{{ $event->id }}">
                      {{ $event->title }} *
                      </a>
                    @else
                      <a class="badge badge-primary" style="background-color: #b35353" href="{{ asset('/calendario/details/') }}/{{ $event->id }}">
                      {{ $event->title }} *
                      </a>
                    @endif
                  @else
                    @if($event->priority==3)
                      <a class="badge badge-primary" style="background-color: #7e9ccc" href="{{ asset('/calendario/details/') }}/{{ $event->id }}">
                      {{ $event->title }}
                      </a>
                    @elseif($event->priority==2)
                      <a class="badge badge-primary" style="background-color: #b3b053" href="{{ asset('/calendario/details/') }}/{{ $event->id }}">
                      {{ $event->title }}
                      </a>
                    @else
                      <a class="badge badge-primary" style="background-color: #b35353" href="{{ asset('/calendario/details/') }}/{{ $event->id }}">
                      {{ $event->title }}
                      </a>
                    @endif
                  @endif
              @endforeach
            </div>
          @else
          <div class="col box-dayoff">
          </div>
          @endif


          @endforeach
        </div>
      @endforeach
      <br>
      <table>
        <tbody>
          <tr>
            <td style="background-color: #7e9ccc; color: #FFFFFF; width: 50px; text-align: center;">
              Bajo
            </td>
            <td style="background-color: #b3b053; color: #FFFFFF; width: 50px; text-align: center;">
              Medio
            </td>
            <td style="background-color: #b35353; color: #FFFFFF; width: 50px; text-align: center;">
              Alto
            </td>
            <td>
              <strong>*</strong> Evento para la comunidad
            </td>
            <td>
              <p class="actual-ejem">#</p> Fecha Actual
            </td>
          </tr>
        </tbody>
      </table>
    </div> <!-- /container -->

  </body>
</html>
@endsection