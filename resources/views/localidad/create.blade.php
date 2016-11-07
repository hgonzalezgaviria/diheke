@extends('layout')
@section('title', '/ Crear Localidad')

@section('content')

	<h1 class="page-header">Nueva Localidad</h1>

	@include('partials/errors')
	
		{{ Form::open(array('url' => 'localidad', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('LOCA_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('LOCA_DESCRIPCION', old('LOCA_DESCRIPCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

	  	<div class="form-group">
			{{ Form::label('LOCA_AREA', 'Área (Mts2 o Hectareas)') }} 
			{{ Form::text('LOCA_AREA', old('LOCA_AREA'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('TIPO_ID', 'Estado') }} 
			{{ Form::select('TIPO_ID', [null => 'Seleccione un tipo...'] + $arrTiposPosesiones , old('TIPO_ID'), ['class' => 'form-control', 'required']) }}
		</div>

		<!-- Botones -->
		<div class="text-right">
			{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
			<a class="btn btn-warning" role="button" href="{{ URL::to('localidad') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
		</div>

		
		{{ Form::close() }}
@endsection
