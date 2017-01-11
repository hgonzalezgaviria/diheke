@extends('layout')
@section('title', '/ Sala '.$sala->SALA_ID)

@section('content')

	<h1 class="page-header">Sala {{ $sala->SALA_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<ul class="list-group">
				<li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Descripción:</strong></div>
						<div class="col-lg-8">{{ $sala -> SALA_DESCRIPCION }}</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Capacidad:</strong></div>
						<div class="col-lg-8">{{ $sala -> SALA_CAPACIDAD }}</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Estado:</strong></div>
						<div class="col-lg-8">{{ $sala -> estado -> ESTA_DESCRIPCION }}</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Sede:</strong></div>
						<div class="col-lg-8">{{ $sala -> sede -> SEDE_DESCRIPCION }}</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Foto Croquis:</strong></div>
						<div class="col-lg-8">
							{{ $sala -> SALA_FOTOCROQUIS }}
							{{ Html::image($sala -> SALA_FOTOCROQUIS, 'SALA_FOTOCROQUIS', [
								'class'=>'img-responsive',
							]) }}
						</div>
					</div>
				</li>
			</ul>
		</p>
		<div class="text-right">
			<a class="btn btn-primary" role="button" href="{{ URL::to('salas/') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
		</div>
	</div>

@endsection
