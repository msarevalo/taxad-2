@extends('autenticacion')

<title>Taxad | Taxis</title>

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
            <a href="{{ route('taxi.crea') }}" class="btn btn-primary">Crear Vehiculo</a>
        @endif
    </div>
    <br>

    <table class="table col-10">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Placa</th>
            <th scope="col">Marca</th>
            <th scope="col">Modelo y Serie</th>
            <th scope="col">Conductores</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha Creacion</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($taxdet as $taxi)
            <tr>
                <th scope="row">{{$taxi->id}}</th>
                <td>
                    <a href="{{route('taxi.detalle', $taxi->id)}}">
                        {{$taxi->plate}}
                    </a>
                </td>
                <td>
                    {{$taxi->marca}}
                </td>
                <td>
                    {{$taxi->makes}} - {{$taxi->serie}}
                </td>
                <td>
                    @php($contador=0)
                    @foreach($conductores as $conductor)
                        @if($conductor->idTaxi==$taxi->id)
                            {{$conductor->name}} {{$conductor->lastname}};     
                            @php($contador++)
                        @endif
                    @endforeach
                    @if($contador==0)
                        Sin Conductores
                    @endif
                </td>
                @if($taxi->state==1)
                    <td>Activo</td>
                @else($taxi->state==0)
                    <td>Inactivo</td>
                @endif
                <td>{{$taxi->created_at}}</td>
                <td>          
                    @if($permiso[0]->edit==1)          
                        <a href="{{route('taxi.edita', $taxi->id)}}" style="text-decoration: none">
                            <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: black"></i>
                        </a>
                        
                        @if($taxi->state==1 && $contador!=0)
                            <a href="{{route('taxi.reporta', $taxi->id)}}" style="text-decoration: none">
                                <i class="fa fa-money" style="color: black" title="Reportar"></i>
                            </a>
                        @endif
                        @if($contador==0)
                            <a href="{{route('taxi.asigna', $taxi->id)}}" style="text-decoration: none">
                                <i class="fa fa-user-plus" style="color: black" title="Asignar"></i>
                            </a>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$taxdet->links()}}
@endsection