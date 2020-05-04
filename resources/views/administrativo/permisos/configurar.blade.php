@extends('autenticacion')

<title>Taxad | Permisos</title>

@section('formulario')

<div class="container">

<h1>Permisos {{$nombre->profile_name}}:</h1>
<br>
@php($largo = sizeof($menus)-1)
@php($contador=$largo)
@while($contador%3!=0)
	@php($contador++)
@endwhile
@php($fin = $contador-$largo)
<form action="{{route('permisos.configurar', $nombre->id)}}" method="post">
@method('PUT')
@csrf
<table class="table col-3">
    <tbody>
		@for($i=0;$i <=$contador;$i=$i+3)
			<tr>
				<td>
					<div class="showcase--wrapper">
						<div class="accordion-wrapper">
							<div class="accordion-tab">
								<table class="table col-1" style="width: 250px">
									<thead class="thead-light" style="cursor: pointer;">
										<tr>
											<th style="text-align: center;">
												{{$menus[$i]->name}}
											</th>
										</tr>
									</thead>
								</table>
							</div>
							<div class="accordion-panel tab-collapsed">
								<div class="accordion-panel-content">
									<select style="text-transform: capitalize" name="{{$menus[$i]->id}}[]" class="custom-select col-9" multiple="multiple" style="">
										<option style="text-transform: capitalize" value="vaciar">Vaciar</option>
										@if(!$perfil->isEmpty())
											@foreach($perfil as $per)
												@if($per->menu==$menus[$i]->id)
													@if($per->read==1)
														<option style="text-transform: capitalize" value="ver" selected>Ver</option>
													@else
														<option style="text-transform: capitalize" value="ver" >Ver</option>
													@endif
													@if($per->crear==1)
														<option style="text-transform: capitalize" value="crea" selected>Crear</option>
													@else
														<option style="text-transform: capitalize" value="crea" >Crear</option>
													@endif
													@if($per->editar==1)
														<option style="text-transform: capitalize" value="edita" selected>Editar</option>
													@else
														<option style="text-transform: capitalize" value="edita" >Editar</option>
													@endif
													@if($per->eliminar==1)
														<option style="text-transform: capitalize" value="elimina" selected>Eliminar</option>
													@else
														<option style="text-transform: capitalize" value="elimina" >Eliminar</option>
													@endif
												@elseif($per->menu!==$menus[$i]->id)
												@endif
			        						@endforeach
			        					@else
			        						<option style="text-transform: capitalize" value="ver" >Ver</option>
			        						<option style="text-transform: capitalize" value="crea" >Crear</option>
			        						<option style="text-transform: capitalize" value="edita" >Editar</option>
			        						<option style="text-transform: capitalize" value="elimina" >Eliminar</option>
			        					@endif
		            				</select>
								</div>
							</div>
						</div>
					</div>
				</td>
				@if($fin==0 && $i==$largo)
					@break
				@endif
				<td>
					<div class="showcase--wrapper">
						<div class="accordion-wrapper">
							<div class="accordion-tab">
								<table class="table col-1" style="width: 250px">
									<thead class="thead-light" style="cursor: pointer;">
										<tr>
											<th style="text-align: center;">
												{{$menus[$i+1]->name}}
											</th>
										</tr>
									</thead>
								</table>
							</div>
							<div class="accordion-panel tab-collapsed">
								<div class="accordion-panel-content">
									<select style="text-transform: capitalize" name="{{$menus[$i+1]->id}}[]" class="custom-select col-9" multiple="multiple" style="">
										<option style="text-transform: capitalize" value="vaciar">Vaciar</option>
										@if(!$perfil->isEmpty())
											@foreach($perfil as $per)
												@if($per->menu==$menus[$i+1]->id)
													@if($per->read==1)
														<option style="text-transform: capitalize" value="ver" selected>Ver</option>
													@else
														<option style="text-transform: capitalize" value="ver" >Ver</option>
													@endif
													@if($per->crear==1)
														<option style="text-transform: capitalize" value="crea" selected>Crear</option>
													@else
														<option style="text-transform: capitalize" value="crea" >Crear</option>
													@endif
													@if($per->editar==1)
														<option style="text-transform: capitalize" value="edita" selected>Editar</option>
													@else
														<option style="text-transform: capitalize" value="edita" >Editar</option>
													@endif
													@if($per->eliminar==1)
														<option style="text-transform: capitalize" value="elimina" selected>Eliminar</option>
													@else
														<option style="text-transform: capitalize" value="elimina" >Eliminar</option>
													@endif
												@elseif($per->menu!==$menus[$i+1]->id)
												@endif
			        						@endforeach
			        					@else
			        						<option style="text-transform: capitalize" value="ver" >Ver</option>
			        						<option style="text-transform: capitalize" value="crea" >Crear</option>
			        						<option style="text-transform: capitalize" value="edita" >Editar</option>
			        						<option style="text-transform: capitalize" value="elimina" >Eliminar</option>
			        					@endif
		            				</select>
								</div>
							</div>
						</div>
					</div>
				</td>
				@if($fin==2 && ($i+1)==$largo)
					@break
				@endif
				<td>
					<div class="showcase--wrapper">
						<div class="accordion-wrapper">
							<div class="accordion-tab">
								<table class="table col-1" style="width: 250px">
									<thead class="thead-light" style="cursor: pointer;">
										<tr>
											<th style="text-align: center;">
												{{$menus[$i+2]->name}}
											</th>
										</tr>
									</thead>
								</table>
							</div>
							<div class="accordion-panel tab-collapsed">
								<div class="accordion-panel-content">
									<select style="text-transform: capitalize" name="{{$menus[$i+2]->id}}[]" class="custom-select col-9" multiple="multiple" style="">
										<option style="text-transform: capitalize" value="vaciar">Vaciar</option>
										@if(!$perfil->isEmpty())
											@foreach($perfil as $per)
												@if($per->menu==$menus[$i+2]->id)
													@if($per->read==1)
														<option style="text-transform: capitalize" value="ver" selected>Ver</option>
													@else
														<option style="text-transform: capitalize" value="ver" >Ver</option>
													@endif
													@if($per->crear==1)
														<option style="text-transform: capitalize" value="crea" selected>Crear</option>
													@else
														<option style="text-transform: capitalize" value="crea" >Crear</option>
													@endif
													@if($per->editar==1)
														<option style="text-transform: capitalize" value="edita" selected>Editar</option>
													@else
														<option style="text-transform: capitalize" value="edita" >Editar</option>
													@endif
													@if($per->eliminar==1)
														<option style="text-transform: capitalize" value="elimina" selected>Eliminar</option>
													@else
														<option style="text-transform: capitalize" value="elimina" >Eliminar</option>
													@endif
												@elseif($per->menu!==$menus[$i+2]->id)
												@endif
			        						@endforeach
			        					@else
			        						<option style="text-transform: capitalize" value="vaciar">Vaciar</option>
			        						<option style="text-transform: capitalize" value="ver" >Ver</option>
			        						<option style="text-transform: capitalize" value="crea" >Crear</option>
			        						<option style="text-transform: capitalize" value="edita" >Editar</option>
			        						<option style="text-transform: capitalize" value="elimina" >Eliminar</option>
			        					@endif
		            				</select>
								</div>
							</div>
						</div>
					</div>
				</td>
				@if($fin==1 && ($i+2)==$largo)
					@break
				@endif
			</tr>
		@endfor
	</tbody>
</table>
<div class="form-group row mb-0">
	<div class="col-md-6 offset-md-4">
		<button type="submit" class="btn btn-primary">
			{{ __('Registrar') }}
		</button>
	</div>
</div>
</form>

<style type="text/css">
	// Shades
	$c-grey--lightest: #f2f2f2;
	$c-grey--lighter: #ebebeb;
	$c-grey--light: #e8e7e6;
	$c-grey: #cccbca;
	$c-grey--darker: #adadac;
	$c-grey--darkest: #575756;
	$c-grey-slate: #708090;



	.accordion-wrapper {
		border-top: 1px solid $c-grey--lightest;
		box-shadow: 0px 1px 0px $c-grey--lightest;
		background: white;
	}


	.accordion-tab {
		padding: 1px 18px;
		background: transparent;
		transition: 0.4s;
		position: relative;
		


		&:hover {
			cursor: pointer;
		}

		&::before {
			content:'';
			height: 4px;
			width: 28px;
			background-color: $c-grey--darker;
			position: absolute;
			right: 40px;
			top: 32px;
			transition: 0.4s;
		}

		&::after {
			content:'';
			height: 4px;
			width: 28px;
			background-color: $c-grey--darker;
			position: absolute;
			right: 40px;
			top: 32px;
			transform: rotate(-90deg);
			transition: 0.4s;
		}
	}

	.accordion-tab.tab-active {
		background: $c-grey--lightest;
		transition: 0.2s;
		box-shadow: inset 0px 2px 3px $c-grey--lighter;

		&::after {
			transform: rotate(0deg);
			transition: 0.2s;
		}
	}


	.accordion-panel {
		display: block;
		transition: 0.4s;
		max-height: none;
		overflow: hidden;
		background: $c-grey--lightest;
	}

	.accordion-panel.tab-collapsed {
		max-height: 0;
		transition: 0.2s;

		.accordion-panel-content {
			transform: translateY(-100px);
			transition: 0.2s;
		}
	}

	.accordion-panel-content {
		padding: 6px 18px 18px;
		transition: 0.2s ease;
		transform: translateY(0);
		transform-origin: 50% 0;
	}

	.showcase--wrapper {
		max-width: 800px;
		margin: 0 auto;
	}

</style>

<script type="text/javascript">
	function accordionToggle() {
		var accordion = document.getElementsByClassName('accordion-wrapper');

		for (i = 0; i < accordion.length; i++) {
			var tab = accordion[i].querySelector('.accordion-tab');

			tab.addEventListener('click', function() {
				this.classList.toggle("tab-active");
				var panel = this.nextElementSibling;
				panel.classList.toggle("tab-collapsed");
			});   
		}  
	}

	accordionToggle();
</script>

</div>
@endsection
