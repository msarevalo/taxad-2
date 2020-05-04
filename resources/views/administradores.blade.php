@extends('autenticacion')

<title>Taxad | Administradores</title>

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
            <a href="{{ route('admin.crea') }}" class="btn btn-primary">Crear</a>
        @endif
    </div>
    <h1>Listado Administradores:</h1>


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
        @foreach($administradores as $administrador)
        <tr>
            <th scope="row">{{$administrador->id}}</th>
            <td>
                <a href="{{route('admin.detalle', $administrador)}}">
                    {{$administrador->document}}
                </a>
            </td>
            <td>
                <a href="{{route('admin.detalle', $administrador)}}">
                    {{$administrador->username}}
                </a>
            </td>
            <td>
                <a href="{{route('admin.detalle', $administrador)}}">
                    {{$administrador->name . " " .  $administrador->lastname}}
                </a>
            </td>
            <td>
                @foreach($perfiles as $perfil)
                    @if($administrador->profile==$perfil->id)
                        {{$perfil->profile_name}}
                    @endif
                @endforeach
            </td>
            @foreach($estados as $estado)
                @if($administrador->state==$estado->id)
                    <td>{{$estado->state}}</td>
                @endif
            @endforeach
            <td>{{$administrador->created_at}}</td>
            <td>
                @if($permiso[0]->edit==1)
                    <a href="{{route('admin.edita', $administrador)}}" style="text-decoration: none">
                        <button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $administradores->links() }}
@endsection