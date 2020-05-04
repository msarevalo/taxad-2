@extends('autenticacion')

@section('formulario')

@php($concat = $id . "_" . $w)

<form action="{{route('taxi.gastos', $concat)}}" method="post" enctype="multipart/form-data">
	@csrf
	<center>
		<table class="table col-md-4">
			<thead>
				<th>
					Valor Gastos Semana
				</th>
				<th>
					Valor Ingresado
				</th>
			</thead>
			<tbody>
				<th>
					<p>{{$val}}</p>
				</th>
				<th id="ingreso">
					<p>0</p>
				</th>
			</tbody>
		</table>
	</center>
	<div class="form-group row">
	    <label for="cantidad" class="col-md-4 col-form-label text-md-right">{{ __('Cantidad de Gastos') }}</label>
	    <div class="col-md-6">
	        <input id="cantidad" type="number" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad" value="0" required autofocus min="1" max="15" onchange="ciclo('{{$val}}', '{{$w}}')">
	        @error('document')
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	            </span>
	        @enderror
	    </div>
	</div>
	<br><hr>

	<div id="respuesta" class="respuesta">

	</div>


	<div class="form-group row mb-0">
		<div class="col-md-6 offset-md-4">
			<button type="submit" class="btn btn-primary" id="enviar" name="enviar" disabled>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	<script src="../../../../js/gastos.js"></script>
@endsection