@extends('autenticacion')

<title>Taxad | Taxis</title>

@section('formulario')
	@if(session('sinMarca'))
        <div class="alert alert-danger">
            {{session('sinMarca')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        <form action="{{route('separador.crear')}}" method="post">
            @csrf
            <div class="form-group row">
                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Texto Separador') }}</label>

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
                <label for="menu" class="col-md-4 col-form-label text-md-right">{{ __('Menu Posterior') }}</label>

                <div class="col-md-6">
                    <select class="form-control mb-2" name="menu" id="menu" required style="text-transform: capitalize">
                        <option disabled selected value="">Seleccione una opción</option>
                        @foreach($padres as $padre)
                            @if($padre->name!="Cerrar Sesión")
                                <option style="text-transform: capitalize" value="{{$padre->id}}" >{{$padre->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="fa fa-fw mr-3"><i id="icono" aria-hidden="true" style="display: inline-block;"></i></span>
                </div>
            </div>


            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Agregar') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection