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
        <form action="{{route('descripcion.editar', $descripcion->id)}}" method="post">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

                <div class="col-md-6">
                    <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{$descripcion->description}}" required autocomplete="descripcion" autofocus>

                    @error('descripcion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>

                <div class="col-md-6">
                    <select id="categoria" class="form-control @error('perfil') is-invalid @enderror" name="categoria" value="{{ old('categoria') }}" required autocomplete="percategoriafil">
                        <option selected disabled value="">Seleccione una categoria</option>
                        @foreach($categorias as $categoria)
                            @if($categoria->id==$descripcion->category)
                                <option value="{{$categoria->id}}" selected>{{$categoria->category}}</option>
                            @else
                                <option value="{{$categoria->id}}">{{$categoria->category}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                <div class="col-md-6">
                    <select class="form-control mb-2" name="estado" required>
                        @if($descripcion->state==1)
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
                        {{ __('Agregar') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection