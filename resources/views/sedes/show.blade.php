@extends('layout')
@section('title', '/ Espacio Físico '.$espacioFisico->ESFI_ID)

@section('content')

	<h1 class="page-header">Espacio Físico {{ $espacioFisico->ESFI_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<ul class="list-group">
			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Descripción:</strong></div>
						<div class="col-lg-8">{{ $espacioFisico -> ESFI_DESCRIPCION }}</div>
					</div>
			  </li>
			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Área (Mts2 o Hectareas):</strong></div>
						<div class="col-lg-8">{{ $espacioFisico -> ESFI_AREA }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Número de niveles:</strong></div>
						<div class="col-lg-8">{{ $espacioFisico -> ESFI_NRONIVELES }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Nombre:</strong></div>
						<div class="col-lg-8">{{ $espacioFisico -> ESFI_NOMBRE }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Nomenclatura:</strong></div>
						<div class="col-lg-8">{{ $espacioFisico -> ESFI_NOMENCLATURA }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Tipo Espacio Físico:</strong></div>
						<div class="col-lg-8">{{ $espacioFisico -> tipoEspacioFisico -> TIEF_DESCRIPCION }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Tipo Posesión:</strong></div>
						<div class="col-lg-8">{{ $espacioFisico -> tipoPosesion -> TIPO_DESCRIPCION }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Localidad:</strong></div>
						<div class="col-lg-8">{{ $espacioFisico -> localidad -> LOCA_DESCRIPCION }}</div>
					</div>
			  </li>

			</ul>
		</p>
		<div class="text-right">
			<a class="btn btn-primary" role="button" href="{{ URL::to('espaciofisico/') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
		</div>
	</div>

@endsection