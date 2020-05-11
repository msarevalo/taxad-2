@extends('autenticacion')

<title>Taxad | Reportes</title>

@section('formulario')
@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<table align="center" style="border-spacing: 30px 15px; border-collapse: separate; margin-top: 40px;">
	<tbody>
		<tr>
			<td>
				<a style="text-transform: none; text-decoration: none" href="{{route('reportes.excel')}}">
					<div class="cajas">
						<div align="center">
							<img src="../../img/ingresos.png" width="50px" style="margin-top: 30px;">
							<p style="margin-top: 15px">Exportar<br>Ingresos y Gastos</p>
						</div>
					</div>
				</a>
			</td>
			<td>
				<a style="text-transform: none; text-decoration: none" href="{{route('reportes.excel2')}}">
					<div class="cajas">
						<div align="center">
							<img src="../../img/aprobar.png" width="50px" style="margin-top: 30px;">
							<p style="margin-top: 15px">Exportar<br>Gastos</p>
						</div>
					</div>
				</a>
			</td>
		</tr>
	</tbody>
</table>
@if(isset($socios))
@php($largo = sizeof($socios)-1)
@php($contador=$largo)
@while($contador%4 != 0)
	@php($contador++)
@endwhile
@php($fin = $contador-$largo)
@if(sizeof($socios)!=0)
<table align="center" style="border-spacing: 30px 15px; border-collapse: separate;">
	<tbody>
		@for($i=0;$i <=$contador;$i=$i+4)
			<tr>
				<td>
					<a style="text-transform: none; text-decoration: none" href="{{route('reportes.socios', $socios[$i]->id)}}">
						<div class="cajas">
							<div align="center">
								<img src="../../img/socios.png" width="60px" style="margin-top: 30px;">
								<p style="margin-top: 15px">Exportar Ganancias<br>Socio {{$socios[$i]->name}}</p>
							</div>
						</div>
					</a>
				</td>
				@if($fin==0 && $i==$largo)
					@break
				@endif
				<td>
					<a style="text-transform: none; text-decoration: none" href="{{route('reportes.socios', $socios[$i+1]->id)}}">
						<div class="cajas">
							<div align="center">
								<img src="../../img/socios.png" width="65px" style="margin-top: 30px;">
								<p style="margin-top: 15px">Exportar Ganancias<br>Socio {{$socios[$i+1]->name}}</p>
							</div>
						</div>
					</a>
				</td>
				@if($fin==3 && ($i+1)==$largo)
					@break
				@endif
				<td>
					<a style="text-transform: none; text-decoration: none" href="{{route('reportes.socios', $socios[$i+2]->id)}}">
						<div class="cajas">
							<div align="center">
								<img src="../../img/socios.png" width="65px" style="margin-top: 30px;">
								<p style="margin-top: 15px">Exportar Ganancias<br>Socio {{$socios[$i+2]->name}}</p>
							</div>
						</div>
					</a>
				</td>
				@if($fin==2 && ($i+2)==$largo)
					@break
				@endif
				<td>
					<a style="text-transform: none; text-decoration: none" href="{{route('reportes.socios', $socios[$i+3]->id)}}">
						<div class="cajas">
							<div align="center">
								<img src="../../img/socios.png" width="65px" style="margin-top: 30px;">
								<p style="margin-top: 15px">Exportar Ganancias<br>Socio {{$socios[$i+3]->name}}</p>
							</div>
						</div>
					</a>
				</td>
				@if($fin==1 && ($i+3)==$largo)
					@break
				@endif
			</tr>
		@endfor
	</tbody>
</table>
@endif
@endif
<style type="text/css">
	.cajas{
		border-top: 1px solid;
  		border-right: 1px solid;
  		border-bottom: 1px solid;
  		border-left: 1px solid;
  		width: 180px;
  		height: 180px;
	}
</style>
@endsection