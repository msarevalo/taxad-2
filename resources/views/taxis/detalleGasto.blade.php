@extends('autenticacion')

<title>Taxad | Taxi</title>

@section('formulario')
@if(session('mensaje'))
  <div class="alert alert-success">
    {{session('mensaje')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

<table class="table col-10">
    <thead>
    	<tr>
        	<th scope="col">Fecha</th>
            <th scope="col">Pagado a</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Factura</th>
            <th scope="col">Valor de Pago</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
        	@php($contador=0)
          	@foreach($gastos as $gasto)
            	<tr>
              		<td>
                		{{$gasto->date}}
              		</td>
              		<td>
                		{{$gasto->pay_to}}
              		</td>
              		<td>
                		{{$gasto->category}} - {{$gasto->description}}
              		</td>
              		<td>
                    @php($ruta='facturas_'.$gasto->bill)
                		<a href="{{route('taxi.descargar', $ruta)}}">
                  			{{$gasto->bill}}
                		</a>
              		</td>
              		<td>
                		{{$gasto->value}}
              		</td>
              		@if($contador==0)
              		<td rowspan="{{sizeof($gastos)}}" class="align-middle">            
	                	{{$reporte[0]->expenses}}
              		</td>
              		@endif
            	</tr>
            	@php($contador++)
          	@endforeach
        </tbody>
      </table>

@endsection