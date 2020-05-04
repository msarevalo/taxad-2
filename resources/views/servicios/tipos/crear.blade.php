@extends('autenticacion')

<title>Taxad | Servicios</title>

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
        <form action="{{route('tipos.crear')}}" method="post">
            @csrf
            <div class="form-group row">
                <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

                <div class="col-md-6">
                    <input id="tipo" type="text" class="form-control @error('tipo') is-invalid @enderror" name="tipo" value="{{ old('tipo') }}" required autocomplete="ripo" autofocus>

                    @error('tipo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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