@extends('layout')

@section('content')

<h1 class="page-header">Tipo de Estado {{ $tipoestado->TIES_ID }}: {{ $tipoestado->TIES_DESCRIPCION }} </h1>

	<div class="jumbotron text-center">
		<h3><strong>Tipo de Estado {{ $tipoestado->TIES_ID }}:</strong> {{ $tipoestado->TIES_DESCRIPCION }}</h3>
		<p>
			<strong>Observaciones:</strong> {{ $tipoestado->TIES_OBSERVACIONES }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('tipoestados') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection