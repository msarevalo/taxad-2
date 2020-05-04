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
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        <form action="{{route('marca.crear')}}" method="post">
            @csrf
            <div class="form-group row">
                <label for="marca" class="col-md-4 col-form-label text-md-right">{{ __('Marca') }}</label>

                <div class="col-md-6">
                    <input id="marca" type="text" class="form-control @error('marca') is-invalid @enderror" name="marca" value="{{ old('marca') }}" required autocomplete="marca" autofocus>

                    @error('marca')
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