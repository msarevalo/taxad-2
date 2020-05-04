@extends('autenticacion')

<title>Taxad | Marcas</title>
@section('formulario')
    @if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        @if($permiso[0]->create==1)
            <a href="{{ route('marca.crea') }}" class="btn btn-primary">Crear Marca</a>
        @endif
    </div>
    <h1>Listado de Marcas de Taxis:</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Marca</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha Creacion</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($marcas as $marca)
            <tr>
                <th scope="row">{{$marca->id}}</th>
                <td>
                    <a href="{{route('marca.detalle', $marca)}}">
                        {{$marca->brand}}
                    </a>
                </td>
                @if($marca->state==1)
                    <td>Activo</td>
                @else($marca->state==0)
                    <td>Inactivo</td>
                @endif
                <td>{{$marca->created_at}}</td>
                <td>
                    @if($permiso[0]->edit==1)
                        <a href="{{route('marca.edita', $marca)}}" style="text-transform: none;">
                            <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: black"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $marcas->links() }}
@endsection