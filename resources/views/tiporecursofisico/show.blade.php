@extends('layout')
@section('title', '/ Tipo de Recurso Físico '.$tipoRecursoFisico->TIRF_ID)

@section('content')

	<h1 class="page-header">Tipo de Recurso Físico {{ $tipoRecursoFisico->TIRF_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<strong>Situación :</strong> {{ $tipoRecursoFisico->TIRF_DESCRIPCION }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('tiporecursofisico/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection