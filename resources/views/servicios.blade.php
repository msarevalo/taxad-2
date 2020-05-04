@extends('autenticacion')

<title>Taxad | Servicios</title>

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
	<a class="btn btn-primary"  href="{{route('servicio.crea')}}">Crear</a>
	<a class="btn btn-primary"  href="{{route('tipos')}}">Tipos de Servicios</a>
@endif
</div>
<br>
<table class="table col-10">
	<thead>
        <tr>
        	<th scope="col">#</th>
            <th scope="col">Servicio</th>
            <th scope="col">Nombre de Contacto</th>
            <th scope="col">Celular</th>
            <th scope="col">Correo</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
	@foreach($servicios as $servicio)
		<tr>
			<td>
				{{$servicio->id}}
			</td>
			<td>
				{{$servicio->servicio}}
			</td>
			<td>
				{{$servicio->nombre}}
			</td>
			<td>
				{{$servicio->celular}}
			</td>
			<td>
				{{$servicio->correo}}
			</td>
			<td>
				@if($servicio->estado==1)
					Activo
				@else
					Inactivo
				@endif
			</td>
			<td>
				@if($permiso[0]->edit==1)
					<a href="{{route('servicio.edita', $servicio->id)}}" style="text-decoration: none">
                		<i class="fa fa-pencil-square-o" aria-hidden="true" style="color: black"></i>
                	</a>
                @endif
			</td>
		</tr>
	@endforeach
    </tbody>
</table>
{{$servicios->links()}}
@endsection