@extends('autenticacion')

<title>Taxad | Marcas</title>

@section('formulario')
    <div class="container">
        <form action="{{route('marca.editar', $marca->id)}}" method="post">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <label for="marca" class="col-md-4 col-form-label text-md-right">{{ __('Marca') }}</label>

                <div class="col-md-6">
                    <input id="marca" type="text" class="form-control @error('marca') is-invalid @enderror" name="marca" value="{{$marca->brand}}" required autocomplete="marca">

                    @error('marca')
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
                        @if($marca->state==1)
                            <option selected value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        @else
                            <option value="1">Activo</option>
                            <option selected value="0">Inactivo</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Editar') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection