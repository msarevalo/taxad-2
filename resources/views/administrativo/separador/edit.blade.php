@extends('autenticacion')

<title>Taxad | Separador</title>

@section('formulario')
<div class="container">
        <form action="{{route('separador.editar', $separador->id)}}" method="post">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                <div class="col-md-6">
                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required autocomplete="nombre" autofocus value="{{$separador->name}}">

                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="menu" class="col-md-4 col-form-label text-md-right">{{ __('Menu Posterior') }}</label>

                <div class="col-md-6">
                    <select class="form-control mb-2" name="menu" id="menu" required style="text-transform: capitalize">
                        <option disabled selected>Seleccione una opción</option>
                        @foreach($padres as $padre)
                            @if($padre->nombre!="Cerrar Sesión")
                                @if($separador->subsequent_menu==$padre->id)
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

            <div class="form-group row">
                <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                <div class="col-md-6">
                    <select class="form-control mb-2" name="estado" id="estado" required style="text-transform: capitalize">
                        <option disabled>Seleccione una opción</option>
                        @if($separador->state==0)
                        	<option style="text-transform: capitalize" value="1">Activo</option>
                        	<option style="text-transform: capitalize" value="0" selected>Inactivo</option>
                        @else
                        	<option style="text-transform: capitalize" value="1" selected>Activo</option>
                        	<option style="text-transform: capitalize" value="0">Inactivo</option>
                        @endif
                    </select>
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