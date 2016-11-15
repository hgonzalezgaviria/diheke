@extends('layout')
@section('title', '/ Tipo de Unidad '.$tipoUnidad->TIUN_ID)

@section('content')

	<h1 class="page-header">Tipo de Unidad {{ $tipoUnidad->TIUN_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<strong>Tipo :</strong> {{ $tipoUnidad->TIUN_DESCRIPCION }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('tipounidad/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection