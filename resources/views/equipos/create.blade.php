@extends('layout')
@section('title', '/ Crear Equipo')

@section('content')

	<h1 class="page-header">Nuevo Equipo</h1>

	@include('partials/errors')
	
		{{ Form::open(array('url' => 'equipos', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('EQUI_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('EQUI_DESCRIPCION', old('EQUI_DESCRIPCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('EQUI_OBSERVACIONES', 'Observaciones') }} 
			{{ Form::textarea('EQUI_OBSERVACIONES', old('EQUI_OBSERVACIONES'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('sala', 'Sala') }} 
			<select name="SALA_ID" id="SALA_ID" class="form-control" required>
				<option value="">Seleccione..</option>
	            @foreach($salas as $sala)
	            <option value="{{ $sala->SALA_ID }}">{{ $sala->SALA_DESCRIPCION }}</option>
	            @endforeach
	        </select>
		</div>

		<div class="form-group">
			{{ Form::label('estado', 'Estado') }} 
			<select name="ESTA_ID" id="ESTA_ID" class="form-control" required>
				<option value="">Seleccione..</option>
	            @foreach($estados as $estado)
	            <option value="{{ $estado->ESTA_ID }}">{{ $estado->ESTA_DESCRIPCION }}</option>
	            @endforeach
	        </select>
		</div>




		<!-- Botones -->
		<div class="text-right">
			{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
			<a class="btn btn-warning" role="button" href="{{ URL::to('espaciofisico') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
		</div>

		
		{{ Form::close() }}
@endsection
