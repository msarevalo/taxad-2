@extends('autenticacion')

<title>Taxad | Conductores</title>

@section('formulario')
@if(session('sinUsuario'))
        <div class="alert alert-danger">
            {{session('sinUsuario')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
@endif
<div class="container">
    <form action="{{route('conductor.crear')}}" method="post">
        @csrf
        <div class="form-group row">
            <label for="document" class="col-md-4 col-form-label text-md-right">{{ __('Documento') }}</label>

            <div class="col-md-6">
                <input id="document" type="number" class="form-control @error('document') is-invalid @enderror" name="document" value="{{ old('document') }}" required autocomplete="document" autofocus>

                @error('document')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>

            <div class="col-md-6">
                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="lastname2" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>

            <div class="col-md-6">
                <input id="lastname2" type="text" class="form-control @error('lastname2') is-invalid @enderror" name="lastname2" value="{{ old('lastname2') }}" required autocomplete="lastname2" autofocus>

                @error('lastname2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
        		    {{ __('Registrar') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection