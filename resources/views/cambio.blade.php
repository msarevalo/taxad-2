@extends('layouts.app')
<title>Cambio contraseña</title>
@section('content')
@if(session('error'))
    <div class="alert alert-danger">
      {{session('error')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cambio de contraseña') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('cambiar') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="npass" class="col-sm-4 col-form-label text-md-right">{{ __('Nueva Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="npass" type="password" class="form-control{{ $errors->has('npass') ? ' is-invalid' : '' }}" name="npass" value="{{ old('npass') }}" required autofocus>

                                @if ($errors->has('npass'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('npass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rpass" class="col-md-4 col-form-label text-md-right">{{ __('Repitir contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="rpass" type="password" class="form-control @error('rpass') is-invalid @enderror" name="rpass" required autocomplete="current-password">

                                @error('rpass')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cambiar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
