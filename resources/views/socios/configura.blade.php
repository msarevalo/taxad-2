@extends('autenticacion')

<title>Taxad | Socios</title>

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

<center>
	<table class="table col-md-4">
		<thead>
			<th>
				Valor Ingresado
			</th>
		</thead>
		<tbody>
			<th id="ingreso">
				<p>{{$suma[0]->suma}}%</p>
			</th>
		</tbody>
	</table>
</center>
<form action="{{route('socio.configurar')}}" method="post">
@csrf
@foreach($socios as $socio)
	<div class="form-group row">
		<label for="categoria-{{$socio->id}}" class="col-md-4 col-form-label text-md-right">Ganancia {{$socio->name}}</label>
		<div class="col-md-6" style="display: inline-block; width: 100%">
			<div class="input-group">
				<input type="range" min="0" max="100" step="1" onchange="barra(this.id), ingresado('{{$socios[sizeof($socios)-1]->id}}')" class="input-range-bar" id="input-range-bar-{{$socio->id}}" value="{{$socio->porcentaje}}">
				<div class="input-group-addon">
					<input type="number" min="0" max="100" step="1" onchange="caja(this.id), ingresado('{{$socios[sizeof($socios)-1]->id}}')" class="input-range-box" id="input-range-box-{{$socio->id}}" value="{{$socio->porcentaje}}" name="valor{{$socio->id}}">
				</div>
			</div>
		</div>
	</div>
@endforeach

<div class="form-group row mb-0">
	<div class="col-md-6 offset-md-4">
		<button type="submit" class="btn btn-primary" id="enviar" name="enviar">
			{{ __('Enviar') }}
		</button>
	</div>
</div>
</form>
<style type="text/css">
	input[type=range] { 
	-webkit-appearance: none;
	width: 80%;
}

input[type=range]::-webkit-slider-runnable-track {
	width: 100%;
	height: 8px;
	cursor: pointer;
	box-shadow: 1.4px 1.4px 3px rgba(0, 0, 0, 0.25), 0px 0px 1.4px rgba(13, 13, 13, 0.25);
	background: #c8c8c8;
	border-radius: 25px;
	border: 1px solid #afafaf;
}

input[type=range]::-webkit-slider-thumb {
	box-shadow: 1.4px 1.4px 3px rgba(0, 0, 0, 0.25), 0px 0px 1.4px rgba(13, 13, 13, 0.25);
	border: 0.2px solid #35a3c7;
	height: 20px;
	width: 20px;
	border-radius: 50px;
	background: #132644;
	cursor: pointer;
	-webkit-appearance: none;
	margin-top: -7px;
}

input[type=range]:focus::-webkit-slider-runnable-track {
	background: #c8c8c8;
}
</style>

@endsection

@section('scripts')
	<script src="../../js/socio.js"></script>
@endsection