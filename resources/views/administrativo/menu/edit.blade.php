@extends('autenticacion')

<title>Taxad | Menu</title>

@section('formulario')
<div class="container">
        <form action="{{route('menu.editar', $menu->id)}}" method="post">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                <div class="col-md-6">
                    @if($menu->name!=="Notificaciones")
                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required autocomplete="nombre" autofocus value="{{$menu->name}}">
                    @else
                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required autocomplete="nombre" autofocus value="{{$menu->name}}" disabled>
                    @endif

                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ruta" class="col-md-4 col-form-label text-md-right">{{ __('Ruta') }}</label>

                <div class="col-md-6">
                    <input id="ruta" type="text" class="form-control @error('ruta') is-invalid @enderror" name="ruta" required autocomplete="ruta" autofocus value="{{$menu->ruta}}" disabled>

                    @error('ruta')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="submenu" class="col-md-4 col-form-label text-md-right">{{ __('Submenu') }}</label>

                <div class="col-md-6">
                    <select class="form-control mb-2" name="submenu" id="submenu" required style="text-transform: capitalize">
                        <option disabled value="">Seleccione una opción</option>
                        @if($menu->submenu==0)
                        	<option style="text-transform: capitalize" value="1">Si</option>
                        	<option style="text-transform: capitalize" value="0" selected>No</option>
                        @else
                        	<option style="text-transform: capitalize" value="1" selected>Si</option>
                        	<option style="text-transform: capitalize" value="0">No</option>
                        @endif
                    </select>
                </div>
            </div>

            @if($menu->submenu==1)
            	<div class="form-group row" id="padres">
            @else
            	<div class="form-group row" id="padres" style="display: none;">
            @endif
                <label for="padre" class="col-md-4 col-form-label text-md-right">{{ __('Padre') }}</label>

                <div class="col-md-6" style="display: inline-block;">
                    <select class="form-control mb-2" name="padre" id="padre" style="text-transform: capitalize">
                        <option disabled selected value="">Seleccione una opción</option>
                        @foreach($padres as $padre)
                        	@if($padre->name!="Cerrar Sesión")
                        		@if($menu->parent==$padre->id)
                        			<option style="text-transform: capitalize" value="{{$padre->id}}" selected>{{$padre->name}}</option>
                        		@else
                        			<option style="text-transform: capitalize" value="{{$padre->id}}" >{{$padre->name}}</option>
                        		@endif
                        	@endif
                        @endforeach
                    </select>
                    <span class="fa fa-fw mr-3"><i id="icono" aria-hidden="true" style="display: inline-block;"></i></span>
                </div>
            </div>

            @if($menu->submenu==0)
            	<div id="logoMenu">
            	
            @else
            	<div id="logoMenu" style="display: none;">
            @endif
            	<div class="form-group row">
	                <label for="icono" class="col-md-4 col-form-label text-md-right">{{ __('Icono') }}</label>

	                <div class="col-md-6" style="display: inline-block; width: 100%">
	                    <select class="form-control mb-2" name="iconos" id="iconos" required style="text-transform: capitalize">
	                        <option disabled selected value="">Seleccione una opción</option>
	                        @foreach($grupos as $grupo)
	                        	<optgroup label="{{$grupo->name}}">
	                        		@foreach($iconos as $icono)
	                        			@if($grupo->id==$icono->group)
		                        			@if($icono->class==$menu->class)
		                        				<option style="text-transform: capitalize" value="{{$icono->class}}" selected>{{$icono->name}}</option>
		                        			@else
		                        				<option style="text-transform: capitalize" value="{{$icono->class}}">{{$icono->name}}</option>
		                        			@endif
		                        		@endif
	                        		@endforeach
	                        	</optgroup>
	                        @endforeach
	                    </select>
	                </div>
	            </div>

	            <div class="form-group row" style="margin-left: 30%">
	            	<div id="inicial" style="display: block;">
		            	<span>
	            			<i class="{{$menu->class}}" aria-hidden="true"></i>
	            		</span>
	            	</div>
	            	<div id="seleccionado" style="display: none;">
	            		<span>
	            			<i id="icon" aria-hidden="true"></i>
	            		</span>
	            	</div>
	            </div>
        	</div>

        	<div class="form-group row">
                <label for="orden" class="col-md-4 col-form-label text-md-right">{{ __('Orden') }}</label>

                <div class="col-md-6">
                    <input id="orden" type="number" class="form-control @error('orden') is-invalid @enderror" name="orden" required autocomplete="orden" autofocus value="{{$menu->order}}">

                    @error('orden')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Editar') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="../../../js/menuPadre.js"></script>
@endsection