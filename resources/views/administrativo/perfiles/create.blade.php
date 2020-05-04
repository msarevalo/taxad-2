@extends('autenticacion')

<title>Taxad | Perfil</title>

@section('formulario')
@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="container">
        <form action="{{route('perfil.crea')}}" method="post">
            @csrf
            <div class="form-group row">
                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                <div class="col-md-6">
                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required autocomplete="nombre" autofocus>

                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Crear') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection