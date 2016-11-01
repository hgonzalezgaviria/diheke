@extends('layout')

@section('content')

<h1 class="page-header">Contrato {{ $contrato->id }}: {{ $contrato->cedula }} </h1>

	<div class="jumbotron text-center">
		<h3><strong>Contrato {{ $contrato->id }}:</strong> {{ $contrato->nombres }}</h3>
		<p>
			<strong>Apellidos:</strong> {{ $contrato->apellidos }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('contratos/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection