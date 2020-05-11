@extends('autenticacion')

<title>Taxad | Administradores</title>
@section('formulario')
    <div class="container">
        <form action="{{route('admin.editar', $conductor->id)}}" method="post">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                <div class="col-md-6">
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $conductor->username }}" disabled required autocomplete="username" autofocus>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="document" class="col-md-4 col-form-label text-md-right">{{ __('Documento') }}</label>

                <div class="col-md-6">
                    <input id="document" type="number" class="form-control @error('document') is-invalid @enderror" name="document" value="{{ $conductor->document }}" disabled required autocomplete="document" autofocus>

                    @error('document')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $conductor->name }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                <div class="col-md-6">
                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $conductor->lastname }}" required autocomplete="lastname" autofocus>

                    @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $conductor->email }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Perfil') }}</label>

            <div class="col-md-6">
                <select id="perfil" class="form-control @error('perfil') is-invalid @enderror" name="perfil" value="{{ old('perfil') }}" required autocomplete="perfil">
                    <option selected disabled value="">Seleccione un perfil</option>
                    @foreach($perfiles as $perfil)
                        @if($perfil->id==$conductor->profile)
                            <option selected value="{{$perfil->id}}">{{$perfil->profile_name}}</option>
                        @else
                            <option value="{{$perfil->id}}">{{$perfil->profile_name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            </div>

            <div class="form-group row">
                <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                <div class="col-md-6">
                    <select class="form-control mb-2" name="estado" required>
                        @foreach($estados as $estado)
                            @if($estado->id==$conductor->state)
                                <option style="text-transform: capitalize" value="{{$estado->id}}" selected>{{$estado->state}}</option>
                            @else
                                <option style="text-transform: capitalize" value="{{$estado->id}}">{{$estado->state}}</option>
                            @endif
                        @endforeach
                    </select>
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