@extends('autenticacion')

@section('formulario')

<a class="btn btn-light"  href="{{route('categoria')}}">Atras</a>
    @if($permiso[0]->edit==1)
      <a class="btn btn-info"  href="{{route('categoria.edita', $categoria->id)}}">Editar</a>
    @endif
    @if($permiso[0]->create==1)
      <a class="btn btn-info"  href="{{route('descripcion.creaDes', $categoria->id)}}">Crear Descripcion</a>
    @endif
    <h3>Descripciones de la categoria {{ $categoria->category }}:</h3>
    <table class="table col-8">
      <thead>
        <tr>
       		<th scope="col">Descripcion</th>
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
      				@if($descripcion->state==1)
      					Activo
      				@else
      					Inactivo
      				@endif
      			</td>
      			<td>
      				<a href="{{route('descripcion.edita', $descripcion->id)}}" style="text-decoration: none">
                <button style="width: 30px; height: 30px" class="btn btn-sm">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>
              </a>
      			</td>
      		</tr>
      	@endforeach
      </tbody>
@endsection