@extends('autenticacion')

<title>Taxad | Legales</title>

@section('formulario')
@if(session('mensaje'))
  <div class="alert alert-success">
    {{session('mensaje')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

<div>
  <form action="{{route('legales.tratamiento')}}" method="post">
    @method('PUT')
    @csrf
    <h3>Tratamiento de Datos</h3>
      <textarea rows="8" cols="120" required style="resize: none;" id="tratamiento" name="tratamiento">{{$tratamiento->text}}</textarea>
    <div class="form-group row mb-0" style="margin-top: 10px;">
      <div class="col-md-6 offset-md-4">
        @if($permiso[0]->edit==1)
          <button type="submit" class="btn btn-primary">
            {{ __('Agregar') }}
          </button>
        @endif
      </div>
    </div>
  </form>
  <form action="{{route('legales.terminos')}}" method="post">
    @method('PUT')
    @csrf
    <h3>Terminos y Condiciones</h3>
      <textarea rows="8" cols="120" required style="resize: none;" id="terminos" name="terminos">{{$terminos->text}}</textarea>
    <div class="form-group row mb-0" style="margin-top: 10px;">
      <div class="col-md-6 offset-md-4">
        @if($permiso[0]->edit==1)
          <button type="submit" class="btn btn-primary">
            {{ __('Agregar') }}
          </button>
        @endif
      </div>
    </div>
  </form>
</div>
@endsection