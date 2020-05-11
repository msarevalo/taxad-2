@extends('autenticacion')

<title>Taxad | Taxis</title>

@section('formulario')
    <div class="container">
        <form action="{{route('taxi.editar', $taxi->id)}}" method="post">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <label for="placa" class="col-md-4 col-form-label text-md-right">{{ __('Placa') }}</label>

                <div class="col-md-6">
                    <input id="placa" type="text" class="form-control @error('placa') is-invalid @enderror" name="placa" required autocomplete="placa" autofocus value="{{$taxi->plate}}" disabled>

                    @error('document')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="marca" class="col-md-4 col-form-label text-md-right">{{ __('Marca') }}</label>

                <div class="col-md-6">
                    <select class="form-control mb-2" name="marca" required style="text-transform: capitalize">
                        <option selected disabled value="">Seleccione una marca</option>
                        @foreach($marcas as $marca)
                            @if($marca->id==$taxi->brand)
                                <option style="text-transform: capitalize" value="{{$marca->id}}" selected>{{$marca->brand}}</option>
                            @else
                                <option style="text-transform: capitalize" value="{{$marca->id}}">{{$marca->brand}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Conductores') }}</label>

                <div class="col-md-6">
                    <select class="form-control mb-2" name="idCond[]" required style="text-transform: capitalize" multiple="multiple">
                        <option disabled value="">Seleccione un conductor</option>
                        @foreach($asignacion as $asigna)
                            <option selected style="text-transform: capitalize" value="{{$asigna->id}}">{{$asigna->name}} {{$asigna->lastname}}</option>
                        @endforeach
                        @foreach($conductores as $conductor)
                            <option style="text-transform: capitalize" value="{{$conductor->id}}">{{$conductor->name}} {{$conductor->lastname}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="modelo" class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}</label>

                <div class="col-md-6">
                    <input id="modelo" type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo" value="{{$taxi->makes}}" required autocomplete="modelo" autofocus>

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
                    <input id="serie" type="number" class="form-control @error('serie') is-invalid @enderror" name="serie" value="{{$taxi->serie}}" required autocomplete="serie" autofocus min="2000" name="serie">

                    @error('serie')
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
                    @if($taxi->state==1)
                        <option selected value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    @else
                        <option value="1">Activo</option>
                        <option value="0" selected>Inactivo</option>
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

        <table class="table">
            <tr>
                <td>
                    @if($soat==null)
                        <label for="name" class="col-6">{{ __('No has cargado aun el SOAT para este vehiculo') }}</label>
                    @else
                        <label for="name" class="col-3">{{ __('SOAT') }}</label>
                        @php($ruta='soat_'.$soat->document)
                        <a href="{{route('taxi.descargar', $ruta)}}" class="col-6" style="text-decoration: none;">
                            <img src="../../img/pdf.png" style="width: 3.5%"> {{$soat->document}}
                        </a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    @if($tp==null)
                        <label for="name" class="col-6">{{ __('No has cargado aun el Tarjeta de Propiedad para este vehiculo') }}</label>
                    @else
                        <label for="name" class="col-3">{{ __('Tarjeta de Propiedad') }}</label>
                        @php($ruta='tp_'.$tp->document)
                        <a href="{{route('taxi.descargar', $ruta)}}" class="col-6" style="text-decoration: none;">
                            <img src="../../img/pdf.png" style="width: 3.5%"> {{$tp->document}}
                        </a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    @if($to==null)
                        <label for="name" class="col-6">{{ __('No has cargado aun Tarjeta de operacion para este vehiculo') }}</label>
                    @else
                        <label for="name" class="col-3">{{ __('Tarjeta de Operacion') }}</label>
                        @php($ruta='tp_'.$tp->document)
                        <a href="{{route('taxi.descargar', $ruta)}}" class="col-6" style="text-decoration: none;">
                            <img src="../../img/pdf.png" style="width: 3.5%"> {{$to->document}}
                        </a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    @if($rt==null)
                        <label for="name" class="col-6">{{ __('No has cargado aun Revision Tecnomecanica para este vehiculo') }}</label>
                    @else
                        <label for="name" class="col-3">{{ __('Revision Tecnomecanica') }}</label>
                        @php($ruta='rt_'.$rt->document)
                        <a href="{{route('taxi.descargar', $ruta)}}" class="col-6" style="text-decoration: none;">
                            <img src="../../img/pdf.png" style="width: 3.5%"> {{$rt->document}}
                        </a>
                    @endif
                </td>
            </tr>
        </table>
        <a href="{{ route('taxi.documentos', $taxi->id) }}" class="btn btn-primary btn-block">Cargar/Actualizar Documentos</a>
    </div>
@endsection