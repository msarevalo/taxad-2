@extends('autenticacion')

<title>Taxad | Socios</title>

@section('formulario')
@if(session('sinUsuario'))
        <div class="alert alert-danger">
            {{session('sinUsuario')}}
        </div>
@endif
<div class="container">
    <form action="{{route('socio.editar', $socio->id)}}" method="post">
        @method('PUT')
        @csrf
        <div class="form-group row">
            <label for="usuario" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

            <div class="col-md-6">
                <input id="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror" name="usuario" value="{{ $socio->username }}" required autocomplete="usuario" autofocus disabled>

                @error('usuario')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="document" class="col-md-4 col-form-label text-md-right">{{ __('Documento') }}</label>

            <div class="col-md-6">
                <input id="document" type="number" class="form-control @error('document') is-invalid @enderror" name="document" value="{{ $socio->document }}" required autocomplete="document" autofocus disabled>

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
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $socio->name }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

            <div class="col-md-6">
                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $socio->lastname }}" required autocomplete="lastname" autofocus>

                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $socio->email }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
                <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                <div class="col-md-6">
                    <select class="form-control mb-2" name="estado" required>
                            @if($socio->state==1)
                                <option style="text-transform: capitalize" value="1" selected>Activo</option>
                                <option style="text-transform: capitalize" value="0">Inactivo</option>
                            @else
                                <option style="text-transform: capitalize" value="1">Activo</option>
                                <option style="text-transform: capitalize" value="0" selected>Inactivo</option>
                            @endif
                    </select>
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