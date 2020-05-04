@extends('autenticacion')

@section('formulario')

@if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        @if($permiso[0]->create==1)
            <a href="{{ route('descripcion.crea') }}" class="btn btn-primary">Crear</a>
        @endif
    </div>
    <h1>Listado de Descripciones:</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Descripcion</th>
            <th scope="col">Categoria</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($descripciones as $descripcion)
        <tr>
            <td>
                {{$descripcion->description}}
            </td>
            <td>
                @foreach($categorias as $categoria)
                    @if($categoria->id == $descripcion->category)
                        {{$categoria->category}}
                    @endif
                @endforeach
            </td>
            <td>
                @if($descripcion->state==1)
                    Activo
                @else
                    Inactivo
                @endif
            </td>
            <td>
                @if($permiso[0]->edit==1)
                    <a href="{{route('descripcion.edita', $descripcion->id)}}" style="text-decoration: none">
                        <button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $descripciones->links() }}

@endsection