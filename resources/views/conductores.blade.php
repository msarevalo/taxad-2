@extends('autenticacion')

<title>Taxad | Conductores</title>

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
            <a href="{{ route('conductor.crea') }}" class="btn btn-primary">Crear</a>
        @endif
    </div>
    <h1>Listado Conductores:</h1>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Documento</th>
            <th scope="col">Usuario</th>
            <th scope="col">Nombre Completo</th>
            <th scope="col">Perfil</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha Creacion</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($conductores as $conductor)
        <tr>
            <th scope="row">{{$conductor->id}}</th>
            <td>
                <a href="{{route('conductor.detalle', $conductor)}}">
                    {{$conductor->document}}
                </a>
            </td>
            <td>
                <a href="{{route('conductor.detalle', $conductor)}}">
                    {{$conductor->username}}
                </a>
            </td>
            <td>
                <a href="{{route('conductor.detalle', $conductor)}}">
                    {{$conductor->name . " " .  $conductor->lastname}}
                </a>
            </td>
            <td>
                @foreach($perfiles as $perfil)
                    @if($conductor->profile==$perfil->id)
                        {{$perfil->profile_name}}
                    @endif
                @endforeach
            </td>
            @foreach($estados as $estado)
                @if($conductor->state==$estado->id)
                    <td>{{$estado->state}}</td>
                @endif
            @endforeach
            <td>{{$conductor->created_at}}</td>
            <td>
                @if($conductor->state==2)
                    @if($permiso[0]->edit==1)
                    <a href="{{route('conductor.permitir', $conductor)}}" style="text-decoration: none">
                        <button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-check" aria-hidden="true" title="Permitir"></i></button>
                    </a>
                    @endif
                    @if($permiso[0]->delete==1)
                        <form action="{{route('conductor.negar', $conductor)}}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-user-times" aria-hidden="true" title="Negar"></i></button>
                        </form>
                    @endif
                @else
                    @if($permiso[0]->edit==1)
                        <a href="{{route('conductor.edita', $conductor)}}" style="text-decoration: none">
                            <button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        </a>
                    @endif
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $conductores->links() }}
@endsection