@extends('autenticacion')

<title>Taxad | Socios</title>

@section('formulario')
    @if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('mensaje-delete'))
        <div class="alert alert-danger">
            {{session('mensaje-delete')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('documento'))
        <div class="alert alert-danger">
            {{session('documento')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        @if($permiso[0]->create==1)
            <a href="{{route('socio.crea')}}" class="btn btn-primary">Crear</a>
        @endif
        @if($permiso[0]->edit==1)
            <a href="{{route('socio.configura')}}" class="btn btn-primary">Ajustar Ganancias</a>
        @endif
    </div>
    <h1>Listado Socios:</h1>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Documento</th>
            <th scope="col">Usuario</th>
            <th scope="col">Nombre Completo</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha Creacion</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($socios as $socio)
        <tr>
            <th scope="row">{{$socio->id}}</th>
            <td>
                {{$socio->document}}
            </td>
            <td>
                {{$socio->username}}
            </td>
            <td>
                {{$socio->name . " " .  $socio->lastname}}
            </td>
            <td>
                @if($socio->state==1)
                    Activo
                @else
                    Inactivo
                @endif
            </td>
            <td>{{$socio->created_at}}</td>
            <td>
                @if($permiso[0]->edit==1)
                    <a href="{{route('socio.edita', $socio->id)}}" style="text-decoration: none">
                        <button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $socios->links() }}
@endsection