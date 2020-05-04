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
        <a class="btn btn-primary"  href="{{route('tipos.crea')}}">Crear</a>
        <a class="btn btn-primary"  href="{{route('servicios')}}">Servicios</a>
    @endif
</div>
<br>
<table class="table col-10">
	<thead>
        <tr>
        	<th scope="col">#</th>
            <th scope="col">Nombre del Servicio</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
    	@foreach($tipos as $tipo)
    		<tr>
    			<td>
    				{{$tipo->id}}
    			</td>
    			<td>
    				{{$tipo->name}}
    			</td>
    			<td>
					@if($tipo->state==1)
						Activo
					@else
						Inactivo
					@endif
				</td>
				<td>
                    @if($permiso[0]->edit==1)
					   <a href="{{route('tipos.edita', $tipo->id)}}" style="text-decoration: none">
                		  <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: black"></i>
	                   </a>
                    @endif
				</td>
    		</tr>
    	@endforeach
    </tbody>
</table>
@endsection