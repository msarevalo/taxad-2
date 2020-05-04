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
            <a href="{{ route('categoria.crea') }}" class="btn btn-primary">Crear</a>
        @endif
    </div>
    <h1>Listado de Categorias:</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Categoria</th>
            <th scope="col"># Detalles</th>
            <th scope="col"># Detalles Activos</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categorias as $categoria)
        <tr>
            <td>
                <a href="{{route('categoria.detalle', $categoria)}}">
                    {{$categoria->category}}
                </a>
            </td>
            <td>
                @foreach($detalles as $detalle)
                    @if($categoria->id==$detalle->category)
                        {{$detalle->conteo}}
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($activos as $activo)
                    @if($activo->categoria == $categoria->id)
                        {{$activo->conteo}}
                    @endif
                @endforeach
            </td>
            <td>
                @if($categoria->state==1)
                    Activo
                @else
                    Inactivo
                @endif
            </td>
            <td>
                @if($permiso[0]->edit==1)
                    <a href="{{route('categoria.edita', $categoria)}}" style="text-decoration: none">
                        <button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $categorias->links() }}

@endsection