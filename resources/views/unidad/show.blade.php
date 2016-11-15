@extends('layout')
@section('title', '/ Unidad '.$unidad->UNID_ID)

@section('content')

	<h1 class="page-header">Unidad {{ $unidad->UNID_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<ul class="list-group">
			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Descripción:</strong></div>
						<div class="col-lg-8">{{ $unidad -> UNID_DESCRIPCION }}</div>
					</div>
			  </li>
			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Área (Mts2 o Hectareas):</strong></div>
						<div class="col-lg-8">{{ $unidad -> UNID_AREA }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Número de niveles:</strong></div>
						<div class="col-lg-8">{{ $unidad -> UNID_NRONIVELES }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Nombre:</strong></div>
						<div class="col-lg-8">{{ $unidad -> UNID_NOMBRE }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Nomenclatura:</strong></div>
						<div class="col-lg-8">{{ $unidad -> UNID_NOMENCLATURA }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Tipo Unidad:</strong></div>
						<div class="col-lg-8">{{ $unidad -> tipoRecursoFisico -> TIEF_DESCRIPCION }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Tipo Posesión:</strong></div>
						<div class="col-lg-8">{{ $unidad -> tipoPosesion -> TIPO_DESCRIPCION }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Localidad:</strong></div>
						<div class="col-lg-8">{{ $unidad -> localidad -> LOCA_DESCRIPCION }}</div>
					</div>
			  </li>

			</ul>
		</p>
		<div class="text-right">
			<a class="btn btn-primary" role="button" href="{{ URL::to('unidad/') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
		</div>
	</div>

@endsection