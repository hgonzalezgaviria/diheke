@extends('layout')
@section('title', '/ Elemento Recurso Físico '.$elemRecursoFisico->ELRF_ID)

@section('content')

	<h1 class="page-header">Situación Recurso Físico {{ $elemRecursoFisico->ELRF_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<strong>Elemento :</strong> {{ $elemRecursoFisico->ELRF_DESCRIPCION }} <br>
			<strong>Estado :</strong> {{ $elemRecursoFisico->estadoElementoRecursoFisico->EERF_DESCRIPCION }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('elementorecursofisico/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection