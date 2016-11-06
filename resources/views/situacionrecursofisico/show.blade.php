@extends('layout')

@section('content')


<h1 class="page-header">Estado {{ $estado->id }}: {{ $estado->descripcion }} </h1>

	<div class="jumbotron text-center">
		<h3><strong>Estado {{ $estado->id }}:</strong> {{ $estado->descripcion }}</h3>
		<p>
			<strong>Tipo de Estado:</strong> {{ $estado->tipoestado_desc }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('estados/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection