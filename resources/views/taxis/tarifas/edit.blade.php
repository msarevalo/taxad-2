@extends('autenticacion')

<title>Taxad | Taxis</title>

@section('formulario')
    <div class="container">
        <form action="{{ route('tarifa.editar') }}" method="post">
            @method('PUT')
            @csrf
            
            @foreach($tarifas as $tarifa)    
                <div class="form-group row">
                    <label for="{{$tarifa->day}}" class="col-md-4 col-form-label text-md-right">{{ $tarifa->day }}</label>

                    <div class="col-md-6">
                        <input id="{{$tarifa->day}}" type="number" class="form-control" name="{{$tarifa->day}}" required autofocus value="{{$tarifa->rates}}">
                    </div>
                </div>
            @endforeach

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