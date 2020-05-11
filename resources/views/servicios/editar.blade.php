@extends('autenticacion')

<title>Taxad | Servicios</title>

@section('formulario')

<div class="container">
    <form action="{{route('servicio.editar', $servicio->id)}}" method="post">
        @method('PUT')
        @csrf
        <div class="form-group row">
            <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

            <div class="col-md-6">
                <select class="form-control mb-2" name="tipo" required style="text-transform: capitalize">
                    <option selected disabled value="">Seleccione un tipo de servicio</option>
        	        @foreach($tipos as $tipo)
                        @if($tipo->id==$servicio->service_type)
                            <option style="text-transform: capitalize" value="{{$tipo->id}}" selected>
                                {{$tipo->name}}
                            </option>
                        @else
                            <option style="text-transform: capitalize" value="{{$tipo->id}}">
                                {{$tipo->name}}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre de Contacto</label>

            <div class="col-md-6">
                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $servicio->contact_name }}" required autocomplete="nombre" autofocus>

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
                <input id="celular" type="number" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{ $servicio->cellphone }}" required autocomplete="celular" autofocus min="3000000000">

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
                <input id="correo" type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ $servicio->email }}" required autocomplete="correo" autofocus>

                @error('correo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

            <div class="col-md-6">
                <select class="form-control mb-2" name="estado" required style="text-transform: capitalize">
                    <option selected disabled value="">Seleccione un estado</option>
                    @if($servicio->state==1)
                        <option style="text-transform: capitalize" value="1" selected>
                            Activo
                        </option>
                        <option style="text-transform: capitalize" value="0">
                            Inactivo
                        </option>
                    @else
                        <option style="text-transform: capitalize" value="1">
                            Activo
                        </option>
                        <option style="text-transform: capitalize" value="0" selected>
                            Inactivo
                        </option>
                    @endif
                </select>
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