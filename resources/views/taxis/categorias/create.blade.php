@extends('autenticacion')

<title>Taxad | Taxis</title>

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
        <form action="{{route('categoria.crear')}}" method="post">
            @csrf
            <div class="form-group row">
                <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>

                <div class="col-md-6">
                    <input id="categoria" type="text" class="form-control @error('categoria') is-invalid @enderror" name="categoria" value="{{ old('categoria') }}" required autocomplete="categoria" autofocus>

                    @error('categoria')
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