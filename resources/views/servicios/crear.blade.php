@extends('autenticacion')

<title>Taxad | Servicios</title>

@section('formulario')

<div class="container">
    <form action="{{route('servicio.crear')}}" method="post">
        @csrf

        <div class="form-group row">
            <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

            <div class="col-md-6">
                <select class="form-control mb-2" name="tipo" required style="text-transform: capitalize">
                    <option selected disabled>Seleccione un tipo de servicio</option>
        	        @foreach($tipos as $tipo)
                        <option style="text-transform: capitalize" value="{{$tipo->id}}">
                          	{{$tipo->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre de Contacto</label>

            <div class="col-md-6">
                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="celular" class="col-md-4 col-form-label text-md-right">Numero de Celular</label>

            <div class="col-md-6">
                <input id="celular" type="number" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{ old('celular') }}" required autocomplete="celular" autofocus min="3000000000">

                @error('celular')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="correo" class="col-md-4 col-form-label text-md-right">Correo de Contacto</label>

            <div class="col-md-6">
                <input id="correo" type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required autocomplete="correo" autofocus>

                @error('correo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
        		    {{ __('Enviar') }}
                </button>
            </div>
        </div>
    </form>
</div>    
@endsection