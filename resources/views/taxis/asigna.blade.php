@extends('autenticacion')

<title>Taxad | Taxis</title>
@section('formulario')
    @if(session('error'))
        <div class="alert alert-danger" id="success-alert">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        <form action="{{route('taxi.asignar', $taxi->id)}}" method="post">
            @csrf
            <input type="text" name="placa" value="{{$taxi->plate}}" disabled class="form-control mb-2" required>
            <select style="text-transform: capitalize" name="idCond[]" class="form-control mb-2" multiple="multiple" required>
                <option selected disabled>Seleccione una opcion</option>
                @foreach($conductores as $conductor)
                    <option style="text-transform: capitalize" value="{{$conductor->id}}">{{$conductor->name}} {{$conductor->lastname}}</option>
                @endforeach
            </select>
            <button class="btn btn-primary btn-block" type="submit">Agregar</button>
        </form>
    </div>
@endsection