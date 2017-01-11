@extends('layout')
@section('title', '/ Sede '.$sede->SEDE_ID)

@section('content')

	<h1 class="page-header">Sede {{ $sede->SEDE_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<ul class="list-group">
			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Descripción:</strong></div>
						<div class="col-lg-8">{{ $sede -> SEDE_DESCRIPCION }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Dirección:</strong></div>
						<div class="col-lg-8">{{ $sede -> SEDE_DIRECCION }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Observaciones:</strong></div>
						<div class="col-lg-8">{{ $sede -> SEDE_OBSERVACIONES }}</div>
					</div>
			  </li>

			</ul>
		</p>
		<div class="text-right">
			<a class="btn btn-primary" role="button" href="{{ URL::to('sedes/') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
		</div>
	</div>

@endsection