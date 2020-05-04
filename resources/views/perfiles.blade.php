@extends('autenticacion')

<title>Taxad | Menus</title>

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
        <a href="{{ route('perfil.crea') }}" class="btn btn-primary">Crear</a>
    @endif
    </div>
    <h1>Listado Perfiles:</h1>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($perfiles as $perfil)
        	<tr>
        		<th>
        			{{$perfil->id}}
        		</th>
        		<td>
        			{{$perfil->profile_name}}
        		</td>
                <td>
                    @if($perfil->state==1)
                        Activo
                    @else
                        Inactivo
                    @endif
                </td>
        		<td>
        			@if($perfil->id>4)
                        @if($permiso[0]->edit==1)
                            <a href="{{ route('perfil.edita', $perfil->id) }}" style="text-decoration: none">
                    		  <button style="width: 30px; height: 30px" class="btn btn-sm">   <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              </button>
                            </a>
                        @endif
                    @endif
        		</td>
        	</tr>
        @endforeach

@endsection