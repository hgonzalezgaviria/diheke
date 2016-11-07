@extends('layout')
@section('title', '/ Elemento Recurso Físico '.$localidad->LOCA_ID)

@section('content')

	<h1 class="page-header">Situación Recurso Físico {{ $localidad->LOCA_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<strong>Elemento :</strong> {{ $localidad->LOCA_DESCRIPCION }} <br>
			<strong>Estado :</strong> {{ $localidad->estadoElementoRecursoFisico->TIPO_DESCRIPCION }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('localidad/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection