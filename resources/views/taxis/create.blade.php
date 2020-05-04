@extends('autenticacion')
@php($año = date('Y'))
@php($año=$año+1)

<title>Taxad | Taxis</title>

@section('formulario')
    <div class="container">
        <form action="{{route('taxi.crear')}}" method="post">
            @csrf
            <div class="form-group row">
                <label for="placa" class="col-md-4 col-form-label text-md-right">{{ __('Placa') }}</label>

                <div class="col-md-6">
                    <input id="placa" type="text" class="form-control @error('placa') is-invalid @enderror" name="placa" value="{{ old('placa') }}" required autocomplete="placa" autofocus pattern="[A-Z]{3}\d{3}" title="Recuerde que son 3 letras en mayuscula y 3 numeros. &#10; Ejm: AAA000">

                    @error('document')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Marca') }}</label>

                <div class="col-md-6">
                    <select class="form-control mb-2" name="marca" required style="text-transform: capitalize">
                        <option selected disabled>Seleccione una marca</option>
                        @foreach($marcas as $marca)
                            <option style="text-transform: capitalize" value="{{$marca->id}}">{{$marca->brand}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="modelo" class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}</label>

                <div class="col-md-6">
                    <input id="modelo" type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo" value="{{ old('modelo') }}" required autocomplete="modelo" autofocus>

                    @error('modelo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="serie" class="col-md-4 col-form-label text-md-right">{{ __('Serie') }}</label>

                <div class="col-md-6">
                    <input id="serie" type="number" class="form-control @error('serie') is-invalid @enderror" name="serie" value="{{ old('serie') }}" required autocomplete="serie" autofocus min="2000" max="{{$año}}" name="serie">

                    @error('serie')
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