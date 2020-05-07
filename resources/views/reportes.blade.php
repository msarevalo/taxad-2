@extends('autenticacion')

<title>Taxad | Reportes</title>

@section('formulario')
<a class="btn btn-success" style="text-transform: none;" href="{{route('reportes.excel')}}" title="Se bajara el historico sin filtro">Exportar Ingresos y Gastos</a>
<a class="btn btn-success" style="text-transform: none;" href="{{route('reportes.excel2')}}" title="Se bajara el historico sin filtro">Exportar Gastos</a>
@endsection