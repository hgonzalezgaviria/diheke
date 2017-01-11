@extends('layout')
@section('title', '/ Equipo '.$equipo->EQUI_ID)

@section('content')

	<h1 class="page-header">Equipo {{ $equipo->EQUI_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<ul class="list-group">
			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Descripción:</strong></div>
						<div class="col-lg-8">{{ $equipo -> EQUI_DESCRIPCION }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Observaciones:</strong></div>
						<div class="col-lg-8">{{ $equipo -> EQUI_OBSERVACIONES }}</div>
					</div>
			  </li>

			  <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Sala:</strong></div>
						<div class="col-lg-8">{{ $equipo -> sala -> SALA_DESCRIPCION }}</div>
					</div>
			  </li>

			 <li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Estado:</strong></div>
						<div class="col-lg-8">{{ $equipo -> estado -> ESTA_DESCRIPCION }}</div>
					</div>
			  </li>

			</ul>
		</p>
		<div class="text-right">
			<a class="btn btn-primary" role="button" href="{{ URL::to('equipos/') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
		</div>
	</div>

@endsection