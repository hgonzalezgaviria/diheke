@extends('layout')
@section('title', '/ Tipo de Posesión '.$tipoPosesion->TIPO_ID)

@section('content')

	<h1 class="page-header">Tipo de Posesión {{ $tipoPosesion->TIPO_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<strong>Situación :</strong> {{ $tipoPosesion->TIPO_DESCRIPCION }} <br>
			<strong>Centro de práctica :</strong> {{ $tipoPosesion -> TIPO_CENTRODEPRACTICA ? 'SI' : 'NO' }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('tipoposesion/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection