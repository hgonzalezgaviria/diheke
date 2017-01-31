@extends('layout')
@section('title', '/ Sede '.$politica->POLI_ID)

@section('content')

	<h1 class="page-header">Politica {{ $politica->POLI_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<ul class="list-group">
				  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Descripción:</strong></div>
						<div class="col-lg-8">{{ $politica -> POLI_DESCRIPCION }}</div>
					</div>
			  </li>
			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Hora Mínima:</strong></div>
						<div class="col-lg-8">{{ $politica -> POLI_HORA_MIN }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Hora Maxima:</strong></div>
						<div class="col-lg-8">{{ $politica -> POLI_HORA_MAX }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Horas Mínima de Reserva:</strong></div>
						<div class="col-lg-8">{{ $politica -> POLI_HORAS_MIN_RESERVA }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Días Mínimo de Cancelación:</strong></div>
						<div class="col-lg-8">{{ $politica -> POLI_DIAS_MIN_CANCELAR }}</div>
					</div>
			  </li>

			</ul>
		</p>
		<div class="text-right">
			<a class="btn btn-primary" role="button" href="{{ URL::to('politicas/') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
		</div>
	</div>

@endsection