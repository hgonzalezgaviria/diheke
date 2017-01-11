@extends('layout')

@section('content')

<h1 class="page-header">Recurso {{ $recurso->RECU_ID }}: {{ $recurso->RECU_DESCRIPCION }} </h1>

	<div class="jumbotron text-center">
		<h3><strong>Recurso {{ $recurso->RECU_ID }}:</strong> {{ $recurso->RECU_DESCRIPCION }}</h3>
		<p>
			<strong>Versión:</strong> {{ $recurso->RECU_VERSION }} <br>
		</p>
		<p>
			<strong>Observaciones:</strong> {{ $recurso->RECU_OBSERVACIONES }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('recursos/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection