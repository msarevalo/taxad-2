@extends('autenticacion')

<title>Taxad | Taxis</title>

@section('formulario')
    <form action="{{route('taxi.cargardocumento', $taxi->id)}}" method="post" enctype="multipart/form-data">
    	@csrf

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Documento') }}</label>

            <div class="col-md-6">
                <select id="tipo" class="form-control @error('tipo') is-invalid @enderror" name="tipo" value="{{ old('tipo') }}" required autocomplete="tipo">
                    <option selected disabled>Seleccione un tipo de documento</option>
                    @foreach($tipos as $tipo)
                        <option value="{{$tipo->id}}">{{$tipo->type}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Archivo PDF') }}</label>

            <div class="col-md-6">
            	<input id="soat" type="file" class="" name="soat" value="{{ old('soat') }}" required autocomplete="soat" autofocus accept="application/pdf">
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Cargar Documento') }}
                </button>
            </div>
        </div>
    </form>
@endsection