@extends('layout')
@section('title', '/ Situación Recurso Físico '.$sitRecursoFisico->SIRF_ID)

@section('content')

	<h1 class="page-header">Situación Recurso Físico {{ $sitRecursoFisico->SIRF_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<strong>Situación :</strong> {{ $sitRecursoFisico->SIRF_DESCRIPCION }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('situacionrecursofisico/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection