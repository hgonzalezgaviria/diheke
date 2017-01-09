@extends('layout')
@section('title', '/ Recurso Físico '.$recursoFisico->REFI_ID)

@section('content')

	<h1 class="page-header">Recurso Físico {{ $recursoFisico->REFI_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<ul class="list-group">
			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Descripción:</strong></div>
						<div class="col-lg-8">{{ $recursoFisico -> REFI_DESCRIPCION }}</div>
					</div>
			  </li>
			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Área (Mts2 o Hectareas):</strong></div>
						<div class="col-lg-8">{{ $recursoFisico -> REFI_AREA }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Número de niveles:</strong></div>
						<div class="col-lg-8">{{ $recursoFisico -> REFI_NRONIVELES }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Nombre:</strong></div>
						<div class="col-lg-8">{{ $recursoFisico -> REFI_NOMBRE }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Nomenclatura:</strong></div>
						<div class="col-lg-8">{{ $recursoFisico -> REFI_NOMENCLATURA }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Tipo Recurso Físico:</strong></div>
						<div class="col-lg-8">{{ $recursoFisico -> tipoRecursoFisico -> TIEF_DESCRIPCION }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Tipo Posesión:</strong></div>
						<div class="col-lg-8">{{ $recursoFisico -> tipoPosesion -> TIPO_DESCRIPCION }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Localidad:</strong></div>
						<div class="col-lg-8">{{ $recursoFisico -> localidad -> LOCA_DESCRIPCION }}</div>
					</div>
			  </li>

			</ul>
		</p>
		<div class="text-right">
			<a class="btn btn-primary" role="button" href="{{ URL::to('recursofisico/') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
		</div>
	</div>

@endsection