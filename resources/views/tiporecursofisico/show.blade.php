@extends('layout')
@section('title', '/ Tipo de Espacio Físico '.$tipoEspacioFisico->TIEF_ID)

@section('content')

	<h1 class="page-header">Tipo de Espacio Físico {{ $tipoEspacioFisico->TIEF_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<strong>Situación :</strong> {{ $tipoEspacioFisico->TIEF_DESCRIPCION }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('tipoespaciofisico/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection