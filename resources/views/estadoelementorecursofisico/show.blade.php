@extends('layout')
@section('title', '/ Situación Recurso Físico '.$estElemRecursoFisico->EERF_ID)

@section('content')

	<h1 class="page-header">Situación Recurso Físico {{ $estElemRecursoFisico->EERF_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<strong>Situación :</strong> {{ $estElemRecursoFisico->EERF_DESCRIPCION }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('estadoelementorecursofisico/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection