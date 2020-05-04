@extends('autenticacion')

<title>Taxad | Tarifas</title>

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
        @if($permiso[0]->edit==1)
            <a href="{{ route('tarifa.edita') }}" class="btn btn-primary">Actualizar Tarifas</a>
        @endif
    </div>
    <h1>Tarifas:</h1>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Día</th>
            <th scope="col">Tarifa</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tarifas as $tarifa)
        <tr>
            <td>
                {{$tarifa->id}}
            </td>
            <td>
                {{$tarifa->day}}
            </td>
            <td>
                {{$tarifa->rates}}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection