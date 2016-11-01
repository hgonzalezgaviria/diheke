@extends('layout')

@section('content')

<h1 class="page-header">Tipo de Estado {{ $tipoestado->id }}: {{ $tipoestado->descripcion }} </h1>

	<div class="jumbotron text-center">
		<h3><strong>Tipo de Estado {{ $tipoestado->id }}:</strong> {{ $tipoestado->descripcion }}</h3>
		<p>
			<strong>Observaciones:</strong> {{ $tipoestado->observaciones }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('tipoestados/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection