@extends('layout')

@section('content')

<h1 class="page-header">Festivo {{ $festivo->FEST_ID }} </h1>

	<div class="jumbotron text-center">
		<h3><strong>Festivo:</strong> {{ $festivo->FEST_FECHA }}
		<p>
			<strong>Descripción:</strong> {{ $festivo->FEST_DESCRIPCION }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('festivos') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection