@extends('layout')

@section('content')


<h1 class="page-header">Estado {{ $estado->ESTA_ID }}: {{ $estado->ESTA_DESCRIPCION }} </h1>

	<div class="jumbotron text-center">
		<h3><strong>Estado {{ $estado->ESTA_ID }}:</strong> {{ $estado->ESTA_DESCRIPCION }}</h3>
		<p>
			<strong>Tipo de Estado:</strong> {{ $estado -> tipoEstado -> TIES_DESCRIPCION  }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('estados/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection