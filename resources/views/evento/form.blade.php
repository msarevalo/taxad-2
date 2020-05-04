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
    </style>

  </head>
  <body>

    <div class="container">
      <h3>Evento</h3>
      <a class="btn btn-light"  href="{{ asset('calendario') }}">Atras</a>
      <hr>

      @if (count($errors) > 0)
        <div class="alert alert-danger">
         <button type="button" class="close" data-dismiss="alert">×</button>
         <ul>
          @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
          @endforeach
         </ul>
        </div>
       @endif
       @if ($message = Session::get('success'))
       <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
       </div>
       @endif


      <div class="col-md-6">
        <form action="{{ asset('/evento/create/') }}" method="post">
          @csrf
          <div class="fomr-group">
            <label>Titulo</label>
            <input type="text" class="form-control" name="titulo" maxlength="16" placeholder="Titulo">
          </div>
          <div class="fomr-group">
            <label>Descripcion del Evento</label>
            <textarea type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion del evento" rows="4" style="resize: none;" maxlength="190" onpaste="contarcaracteres();" onkeyup="contarcaracteres();"></textarea>
            <label id="res" style="color: #bbbbbb;">0 / 190</label>
          </div>
          <div class="fomr-group">
            <label>Propietario</label><br>
            <input type="radio" name="usuario" value="{{  Auth::user()->id  }}" checked="checked">Evento para mi<br>
            <input type="radio" name="usuario" value="0">Evento para la comunidad<br><br>
          </div>
          <div class="fomr-group">
            <label>Prioridad</label>
            <select name="prioridad" id="prioridad" class="form-control" required>
              <option selected disabled>Seleccione la prioridad</option>
              <option value="3">Bajo</option>
              <option value="2">Medio</option>
              <option value="1">Alta</option>
            </select>
          </div>
          <div class="fomr-group">
            <label>Fecha</label>
            @php($timezone  = -5)
            @php($fecha=gmdate("Y-m-d", time() + 3600*($timezone+date("I"))))
            <input type="date" class="form-control" name="fecha" min="{{$fecha}}">
          </div>
          <br>
          <input type="submit" class="btn btn-info" value="Guardar">
        </form>
      </div>


      <!-- inicio de semana -->


    </div> <!-- /container -->

    <!-- Footer -->

  </body>
</html>
@endsection

@section('scripts')
  <script src="../js/evento.js"></script>
@endsection