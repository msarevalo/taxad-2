@extends('autenticacion')

@section('formulario')

@php($semana = date('W'))
@php($semana = $semana-1)
@php($año = date('Y'))

@if($semana<=9)
@php($maximo= $año . '-W0' . $semana)
@else
@php($maximo=$año . '-W' . $semana)
@endif
@php($dia=date("Y-m-d"))

@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div style="height:30px"></div>
<form action="{{ route('taxi.reportar', $taxi->id) }}" method="post">
	@method('PUT')
	@csrf

	<div class="form-group row">
		<label for="placa" class="col-md-4 col-form-label text-md-right">{{ __('Placa') }}</label>
		<div class="col-md-3">
			<input id="placa" type="text" class="form-control @error('placa') is-invalid @enderror" name="placa" value="{{$taxi->plate}}" disabled>

			@error('document')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>
	</div>

	<div class="form-group row">
		<label for="fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Actual') }}</label>
		<div class="col-md-3">
			<input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{$dia}}" disabled>

			@error('document')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>
	</div>

	<div class="form-group row">
		<label for="fecha" class="col-md-3 col-form-label text-md-right">Fecha Inicio:</label>
	 	<input type="text" id="inicio" value="" onchange="fechaFin()" class="form-control col-2" name="inicio" required autocomplete="off" />
		<label for="fecha" class="col-md-2 col-form-label text-md-right">Fecha Fin:</label>
		<input type="text" id="fin" disabled class="form-control col-2" name="fin">
	</div>

	<div class="col-md-3" style="margin-left: 15%">
		<table class="table col-md-3">
			<thead class="thead-light">
				<tr>
					<th colspan="8" style="text-align: center;">
						Pico y Placa
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						Domingo
					</td>
					<td>
						<p style="cursor: pointer;" id="lunes">Lunes</p>
					</td>
					<td>
						<p style="cursor: pointer;" id="martes">Martes</p>
					</td>
					<td>
						<p style="cursor: pointer;" id="miercoles">Miercoles</p>
					</td>
					<td>
						<p style="cursor: pointer;" id="jueves">Jueves</p>
					</td>
					<td>
						<p style="cursor: pointer;" id="viernes">Viernes</p>
					</td>
					<td>
						<p style="cursor: pointer;" id="sabado">Sabado</p>
					</td>
					<td>
						<p style="cursor: pointer;" id="sinpp">N/A</p>
					</td>
				</tr>
				<tr style="text-align: center;">
					<td>
						N/A
					</td>
					<td>
						<input id="ppL" type="radio" name="ppL" value="{{ old('ppL') }}" autocomplete="ppL" autofocus title="Pico y Placa" required>
					</td>
					<td>
						<input id="ppM" type="radio" name="ppM" value="{{ old('ppM') }}" autocomplete="ppM" autofocus title="Pico y Placa">
					</td>
					<td>
						<input id="ppMi" type="radio" name="ppMi" value="{{ old('ppMi') }}" autocomplete="ppMi" autofocus title="Pico y Placa">
					</td>
					<td>
						<input id="ppJ" type="radio" name="ppJ" value="{{ old('ppJ') }}" autocomplete="ppJ" autofocus title="Pico y Placa">
					</td>
					<td>
						<input id="ppV" type="radio" name="ppV" value="{{ old('ppV') }}" autocomplete="ppV" autofocus title="Pico y Placa">
					</td>
					<td>
						<input id="ppS" type="radio" name="ppS" value="{{ old('ppS') }}" autocomplete="ppS" autofocus title="Pico y Placa">
					</td>
					<td>
						<input id="spp" type="radio" name="spp" value="{{ old('spp') }}" autocomplete="spp" autofocus title="Sin Pico y Placa">
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<table class="table col-16">
		<tbody>
			<tr>
				<th>
					<div class="showcase--wrapper">
						<div class="accordion-wrapper">
							<div class="accordion-tab"> 
								<table class="table col-3" style="width: 350px">
									<thead class="thead-light" style="cursor: pointer;">
										<tr>
											<th colspan="3" style="text-align: center;">
												Domingo
											</th>
										</tr>
									</thead>
								</table>
							</div>
							<div class="accordion-panel tab-collapsed">
								<div class="accordion-panel-content">
									<table>
										<tr>
											<td>
												<div class="">
													<label for="producidoD" class="col-md-4 col-form-label text-md-right">{{ __('Producido') }}</label>
												</div>
											</td>
											<td>
												<div class="col-md-12">
													<input id="producidoD" type="number" class="form-control @error('producidoD') is-invalid @enderror" name="producidoD" value="{{$tarifas[6]->rates}}" required autocomplete="producidoD" autofocus required>

													@error('producidoD')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="gastosD" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
												</div>
											</td>
											<td>
												<div class="col-md-12">
													<input id="gastosD" type="number" class="form-control @error('gastosD') is-invalid @enderror" name="gastosD" value="0" required autocomplete="gastosD" autofocus>

													@error('gastos')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>

											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="otrosD" class="col-md-4 col-form-label text-md-right">{{ __('Otros') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="otrosD" type="number" class="form-control @error('otrosD') is-invalid @enderror" name="otrosD" value="0" required autocomplete="otrosD" autofocus>

													@error('otros')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="totalD" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="totalD" type="number" class="form-control @error('totalD') is-invalid @enderror" name="total" value="0" autocomplete="totalD" autofocus disabled>

													@error('totalD')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</th>
				<th>
					<div class="showcase--wrapper">
						<div class="accordion-wrapper">
							<div class="accordion-tab"> 
								<table class="table col-3" style="width: 350px">
									<thead class="thead-light" style="cursor: pointer;">
										<tr>
											<th colspan="3" style="text-align: center;">
												Lunes
											</th>
										</tr>
									</thead>
								</table>
							</div>
							<div class="accordion-panel tab-collapsed">
								<div class="accordion-panel-content">
									<table>
										<tr>
											<td>
												<div class="form-group row">
													<label for="producidoL" class="col-md-4 col-form-label text-md-right">{{ __('Producido') }}</label>
												</div>
											</td>
											<td>
												<div class="col-md-12">
													<input id="producidoL" type="number" class="form-control @error('producidoL') is-invalid @enderror" name="producidoL" value="{{$tarifas[0]->rates}}" required autocomplete="producidoL" autofocus>

													@error('producidoL')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="gastosL" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="gastosL" type="number" class="form-control @error('gastosL') is-invalid @enderror" name="gastosL" value="0" required autocomplete="gastosL" autofocus>

													@error('gastosL')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="otrosL" class="col-md-4 col-form-label text-md-right">{{ __('Otros') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="otrosL" type="number" class="form-control @error('otrosL') is-invalid @enderror" name="otrosL" value="0" required autocomplete="otrosL" autofocus>

													@error('otrosL')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="totalL" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="totalL" type="number" class="form-control @error('totalL') is-invalid @enderror" name="totalL" value="0" autocomplete="totalL" autofocus disabled>

													@error('totalL')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</th>
			</tr>
			<tr>
				<th>
					<div class="showcase--wrapper">
						<div class="accordion-wrapper">
							<div class="accordion-tab"> 
								<table class="table col-3" style="width: 350px">
									<thead class="thead-light" style="cursor: pointer;">
										<tr>
											<th colspan="3" style="text-align: center;">
												Martes
											</th>
										</tr>
									</thead>
								</table>
							</div>
							<div class="accordion-panel tab-collapsed">
								<div class="accordion-panel-content">
									<table>
										<tr>
											<td>
												<div class="form-group row">
													<label for="producidoM" class="col-md-4 col-form-label text-md-right">{{ __('Producido') }}</label>
												</div>
											</td>
											<td>
												<div class="col-md-12">
													<input id="producidoM" type="number" class="form-control @error('producidoM') is-invalid @enderror" name="producidoM" value="{{$tarifas[1]->rates}}" required autocomplete="producidoM" autofocus>

													@error('producidoM')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="gastosM" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="gastosM" type="number" class="form-control @error('gastosM') is-invalid @enderror" name="gastosM" value="0" required autocomplete="gastosM" autofocus>

													@error('gastosM')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="otrosM" class="col-md-4 col-form-label text-md-right">{{ __('Otros') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="otrosM" type="number" class="form-control @error('otrosM') is-invalid @enderror" name="otrosM" value="0" required autocomplete="otrosM" autofocus>

													@error('otrosM')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="totalM" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="totalM" type="number" class="form-control @error('totalM') is-invalid @enderror" name="totalM" value="0" autocomplete="totalM" autofocus disabled>

													@error('totalM')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</th>
				<th>
					<div class="showcase--wrapper">
						<div class="accordion-wrapper">
							<div class="accordion-tab"> 
								<table class="table col-3" style="width: 350px">
									<thead class="thead-light" style="cursor: pointer;">
										<tr>
											<th colspan="3" style="text-align: center;">
												Miercoles
											</th>
										</tr>
									</thead>
								</table>
							</div>
							<div class="accordion-panel tab-collapsed">
								<div class="accordion-panel-content">
									<table>
										<tr>
											<td>
												<div class="form-group row">
													<label for="producidoMi" class="col-md-4 col-form-label text-md-right">{{ __('Producido') }}</label>
												</div>
											</td>
											<td>
												<div class="col-md-12">
													<input id="producidoMi" type="number" class="form-control @error('producidoMi') is-invalid @enderror" name="producidoMi" value="{{$tarifas[2]->rates}}" required autocomplete="producidoMi" autofocus>

													@error('producidoMi')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="gastosMi" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="gastosMi" type="number" class="form-control @error('gastosMi') is-invalid @enderror" name="gastosMi" value="0" required autocomplete="gastosMi" autofocus>

													@error('gastosMi')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="otrosMi" class="col-md-4 col-form-label text-md-right">{{ __('Otros') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="otrosMi" type="number" class="form-control @error('otrosMi') is-invalid @enderror" name="otrosMi" value="0" required autocomplete="otrosMi" autofocus>

													@error('otrosMi')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="totalMiMi" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="totalMi" type="number" class="form-control @error('totalMi') is-invalid @enderror" name="totalMi" value="0" autocomplete="totalMi" autofocus disabled>

													@error('totalMi')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</th>
			</tr>
			<tr>
				<th>
					<div class="showcase--wrapper">
						<div class="accordion-wrapper">
							<div class="accordion-tab"> 
								<table class="table col-3" style="width: 350px">
									<thead class="thead-light" style="cursor: pointer;">
										<tr>
											<th colspan="3" style="text-align: center;">
												Jueves
											</th>
										</tr>
									</thead>
								</table>
							</div>
							<div class="accordion-panel tab-collapsed">
								<div class="accordion-panel-content">
									<table>
										<tr>
											<td>
												<div class="form-group row">
													<label for="producidoJ" class="col-md-4 col-form-label text-md-right">{{ __('Producido') }}</label>
												</div>
											</td>
											<td>
												<div class="col-md-12">
													<input id="producidoJ" type="number" class="form-control @error('producidoJ') is-invalid @enderror" name="producidoJ" value="{{$tarifas[3]->rates}}" required autocomplete="producidoJ" autofocus>

													@error('producidoJ')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="gastosJ" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="gastosJ" type="number" class="form-control @error('gastosJ') is-invalid @enderror" name="gastosJ" value="0" required autocomplete="gastosJ" autofocus>

													@error('gastosJ')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="otrosJ" class="col-md-4 col-form-label text-md-right">{{ __('Otros') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="otrosJ" type="number" class="form-control @error('otrosJ') is-invalid @enderror" name="otrosJ" value="0" required autocomplete="otrosJ" autofocus>

													@error('otrosJ')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="totalJ" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="totalJ" type="number" class="form-control @error('totalJ') is-invalid @enderror" name="totalJ" value="0" autocomplete="totalJ" autofocus disabled>

													@error('totalJ')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</th>
				<th>
					<div class="showcase--wrapper">
						<div class="accordion-wrapper">
							<div class="accordion-tab"> 
								<table class="table col-3" style="width: 350px">
									<thead class="thead-light" style="cursor: pointer;">
										<tr>
											<th colspan="3" style="text-align: center;">
												Viernes
											</th>
										</tr>
									</thead>
								</table>
							</div>
							<div class="accordion-panel tab-collapsed">
								<div class="accordion-panel-content">
									<table>
										<tr>
											<td>
												<div class="form-group row">
													<label for="producidoV" class="col-md-4 col-form-label text-md-right">{{ __('Producido') }}</label>
												</div>
											</td>
											<td>
												<div class="col-md-12">
													<input id="producidoV" type="number" class="form-control @error('producidoV') is-invalid @enderror" name="producidoV" value="{{$tarifas[4]->rates}}" required autocomplete="producidoV" autofocus>

													@error('producidoV')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="gastosV" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="gastosV" type="number" class="form-control @error('gastosV') is-invalid @enderror" name="gastosV" value="0" required autocomplete="gastosV" autofocus>

													@error('gastosV')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="otrosV" class="col-md-4 col-form-label text-md-right">{{ __('Otros') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="otrosV" type="number" class="form-control @error('otrosV') is-invalid @enderror" name="otrosV" value="0" required autocomplete="otrosV" autofocus>

													@error('otrosV')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
													<label for="totalV" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
												</div>
											</td>
											<td colspan="2">
												<div class="col-md-12">
													<input id="totalV" type="number" class="form-control @error('totalV') is-invalid @enderror" name="totalV" value="0" autocomplete="totalV" autofocus disabled>

													@error('totalV')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</th>
			</tr>
			<tr>
				<th>
					<div class="showcase--wrapper">
						<div class="accordion-wrapper">
							<div class="accordion-tab"> 
								<table class="table col-3" style="width: 350px">
									<thead class="thead-light" style="cursor: pointer;">
										<tr>
											<th colspan="3" style="text-align: center;">
												Sabado
											</th>
										</tr>
									</thead>
								</table>
							</div>
							<div class="accordion-panel tab-collapsed">
								<div class="accordion-panel-content">
									<table>
										<tr>
											<th>
												<div class="form-group row">
													<label for="producidoS" class="col-md-4 col-form-label text-md-right">{{ __('Producido') }}</label>
												</div>
											</th>
											<th>
												<div class="col-md-12">
													<input id="producidoS" type="number" class="form-control @error('producidoS') is-invalid @enderror" name="producidoS" value="{{$tarifas[5]->rates}}" required autocomplete="producidoS" autofocus>

													@error('producidoS')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</th>
										</tr>
										<tr>
											<th>
												<div class="form-group row">
													<label for="gastosS" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
												</div>
											</th>
											<th colspan="2">
												<div class="col-md-12">
													<input id="gastosS" type="number" class="form-control @error('gastosS') is-invalid @enderror" name="gastosS" value="0" required autocomplete="gastosS" autofocus>

													@error('gastos')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</th>
										</tr>
										<tr>
											<th>
												<div class="form-group row">
													<label for="otrosS" class="col-md-4 col-form-label text-md-right">{{ __('Otros') }}</label>
												</div>
											</th>
											<th colspan="2">
												<div class="col-md-12">
													<input id="otrosS" type="number" class="form-control @error('otrosS') is-invalid @enderror" name="otrosS" value="0" required autocomplete="otrosS" autofocus>

													@error('otrosS')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</th>
										</tr>
										<tr>
											<th>
												<div class="form-group row">
													<label for="totalS" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
												</div>
											</th>
											<th colspan="2">
												<div class="col-md-12">
													<input id="totalS" type="number" class="form-control @error('totalS') is-invalid @enderror" name="totalS" value="0" autocomplete="totalS" autofocus disabled>

													@error('totalS')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</th>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</th>
				<th>
					<div class="showcase--wrapper">
						<div class="accordion-wrapper">
							<div class="accordion-tab"> 
								<table class="table col-3" style="width: 350px">
									<thead class="thead-dark" style="cursor: pointer;">
										<tr>
											<th colspan="3" style="text-align: center;">
												TOTAL SEMANA
											</th>
										</tr>
									</thead>
								</table>
							</div>
							<div class="accordion-panel tab-collapsed">
								<div class="accordion-panel-content">
									<table>

										<tbody>
											<tr>
												<th>
													<div class="">
														<label for="producidoSem" class="col-md-4 col-form-label text-md-right">{{ __('Producidos') }}</label>
													</div>
												</th>
												<th>
													<div class="col-md-12">
														<input id="producidoSem" type="number" class="form-control @error('producidoSem') is-invalid @enderror" name="producidoSem" value="{{$tarifas[0]->rates+$tarifas[1]->rates+$tarifas[2]->rates+$tarifas[3]->rates+$tarifas[4]->rates+$tarifas[5]->rates+$tarifas[6]->rates}}" required autocomplete="producidoSem" autofocus disabled>

														@error('producidoSem')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
														@enderror
													</div>

												</th>
											</tr>

											<tr>
												<th>
													<div class="">
														<label for="gastosSem" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
													</div>
												</th>
												<th>
													<div class="col-md-12">
														<input id="gastosSem" type="number" class="form-control @error('gastosSem') is-invalid @enderror" name="gastosSem" value="0" required autocomplete="gastosSem" autofocus disabled>
														@error('gastosSem')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
														@enderror
													</div>	
												</th>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<table>
						<thead><tr><td colspan="3" style="text-align: center;">TOTAL A PAGAR</td></tr></thead>
						<tbody>
							<tr>
								<th>
									<div class="">
										<label for="pagar" class="col-md-4 col-form-label text-md-right">{{ __('Pago') }}</label>
									</div>
								</th>
								<th>
									<div class="col-md-12">
										<input id="pagar" type="number" class="form-control @error('pagar') is-invalid @enderror" name="pagar" value="{{$tarifas[0]->rates+$tarifas[1]->rates+$tarifas[2]->rates+$tarifas[3]->rates+$tarifas[4]->rates+$tarifas[5]->rates+$tarifas[6]->rates}}" required autocomplete="pagar" autofocus disabled>

										@error('pagar')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									
								</th>
							</tr>
						</tbody>
					</table>
					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
								{{ __('Registrar') }}
							</button>
						</div>
					</div>
				</th>
			</tr>
		</tbody>
	</table>
</form>

<style type="text/css">
	// Shades
	$c-grey--lightest: #f2f2f2;
	$c-grey--lighter: #ebebeb;
	$c-grey--light: #e8e7e6;
	$c-grey: #cccbca;
	$c-grey--darker: #adadac;
	$c-grey--darkest: #575756;
	$c-grey-slate: #708090;



	.accordion-wrapper {
		border-top: 1px solid $c-grey--lightest;
		box-shadow: 0px 1px 0px $c-grey--lightest;
		background: white;
	}


	.accordion-tab {
		padding: 1px 18px;
		background: transparent;
		transition: 0.4s;
		position: relative;
		padding-right: 86px;


		&:hover {
			cursor: pointer;
		}

		&::before {
			content:'';
			height: 4px;
			width: 28px;
			background-color: $c-grey--darker;
			position: absolute;
			right: 40px;
			top: 32px;
			transition: 0.4s;
		}

		&::after {
			content:'';
			height: 4px;
			width: 28px;
			background-color: $c-grey--darker;
			position: absolute;
			right: 40px;
			top: 32px;
			transform: rotate(-90deg);
			transition: 0.4s;
		}
	}

	.accordion-tab.tab-active {
		background: $c-grey--lightest;
		transition: 0.2s;
		box-shadow: inset 0px 2px 3px $c-grey--lighter;

		&::after {
			transform: rotate(0deg);
			transition: 0.2s;
		}
	}



	.accordion-panel {
		display: block;
		transition: 0.4s;
		max-height: none;
		overflow: hidden;
		background: $c-grey--lightest;
	}

	.accordion-panel.tab-collapsed {
		max-height: 0;
		transition: 0.2s;

		.accordion-panel-content {
			transform: translateY(-100px);
			transition: 0.2s;
		}
	}

	.accordion-panel-content {
		padding: 6px 18px 18px;
		transition: 0.2s ease;
		transform: translateY(0);
		transform-origin: 50% 0;
	}

	.showcase--wrapper {
		max-width: 800px;
		margin: 0 auto;
	}

</style>

<script type="text/javascript">
	function accordionToggle() {
		var accordion = document.getElementsByClassName('accordion-wrapper');

		for (i = 0; i < accordion.length; i++) {
			var tab = accordion[i].querySelector('.accordion-tab');

			tab.addEventListener('click', function() {
				this.classList.toggle("tab-active");
				var panel = this.nextElementSibling;
				panel.classList.toggle("tab-collapsed");
			});   
		}  
	}

	accordionToggle();
</script>
@endsection

@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>1
<script src="/js/reporta.js"></script>
@endsection
