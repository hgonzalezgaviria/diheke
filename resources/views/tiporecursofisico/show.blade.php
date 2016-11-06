@extends('layout')

@section('content')

<h1 class="page-header">Contrato No: {{ $contrato->nro_contrato }} - {{ $contrato->nombres }} {{ $contrato->apellidos }} </h1>

	<div class="jumbotron text-left">
		<p>
			<strong>Cedula:</strong> {{ $contrato->cedula }} <br>
			<strong>Sexo:</strong> {{ $contrato->sexo }} <br>
			<strong>Caso Médico:</strong> {{ $contrato->caso_medico }} <br>
			<strong>Tipo de Contrato:</strong> {{ $contrato->tipo_contrato }} <br>
			<strong>Cargo:</strong> {{ $contrato->cargo_desc }} <br>
			<strong>Estado Contrato:</strong> {{ $contrato->estado_contrato }} <br>
			<strong>Fecha de Ingreso:</strong> {{ $contrato->fecha_ingreso }} <br>
			<strong>Fecha de Retiro:</strong> {{ $contrato->fecha_retiro }} <br>
			<strong>Salario:</strong> ${{ $contrato->salario }} <br>
			<strong>Tipo de Nómina:</strong> {{ $contrato->tipo_nomina }} <br>
			<strong>CNO:</strong> {{ $contrato->cno }} <br>
			<strong>Centro de Costo:</strong> {{ $contrato->centro_costo }} <br>
			<strong>Gerencia:</strong> {{ $contrato->gerencia }} <br>
			<strong>Empleador:</strong> {{ $contrato->empleador }} <br>
			<strong>Fecha de Sistema:</strong> {{ $contrato->created_at }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('contratos/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection