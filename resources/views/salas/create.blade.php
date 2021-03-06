@extends('layout')
@section('title', '/ Crear Sala')

@section('content')

	<h1 class="page-header">Nueva Sala</h1>

	@include('partials/errors')
	
	{{ Form::open([ 'url' => 'salas', 'files' => true, 'class' => 'form-vertical' ]) }}

	  	<div class="form-group">
			{{ Form::label('SALA_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('SALA_DESCRIPCION', old('SALA_DESCRIPCION'), [ 'class' => 'form-control', 'max' => '300', 'required' ]) }}
		</div>

	  	<div class="form-group">
			{{ Form::label('SALA_CAPACIDAD', 'Capacidad') }} 
			{{ Form::number('SALA_CAPACIDAD', old('SALA_CAPACIDAD'), [ 'class' => 'form-control', 'min' => '0', 'required' ]) }}
		</div>


		<div class="form-group">
			{{ Form::label('SALA_FOTOSALA', 'Foto Sala') }}
			{{ Form::file('SALA_FOTOSALA', [ 
				'class' => 'form-control',
				'accept' => 'image/*',
				'max' => '500',
				'required',
			]) }}
		</div>

		<div class="form-group">
			{{ Form::label('SALA_FOTOCROQUIS', 'Foto Croquis') }}
			{{ Form::file('SALA_FOTOCROQUIS', [ 
				'class' => 'form-control',
				'accept' => 'image/*',
				'max' => '500',
				'required',
			]) }}
		</div>


	  	<div class="form-group">
			{{ Form::label('SALA_OBSERVACIONES', 'Descripción') }} 
			{{ Form::text('SALA_OBSERVACIONES', old('SALA_OBSERVACIONES'), [ 'class' => 'form-control', 'max' => '300', 'required' ]) }}
		</div>


		<div class="form-group">
			{{ Form::label('ESTA_ID', 'Estado') }} 
			{{ Form::select('ESTA_ID', [null => 'Seleccione un estado...'] + $arrEstadosSala , old('ESTA_ID'), ['class' => 'form-control', 'required']) }}
		</div>
		
		<div class="form-group">
			{{ Form::label('SEDE_ID', 'Sede') }} 
			{{ Form::select('SEDE_ID', [null => 'Seleccione una sede...'] + $arrSedes , old('SEDE_ID'), ['class' => 'form-control', 'required']) }}
		</div>

		<!-- Botones -->
		<div class="text-right">
			{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', [ 'class'=>'btn btn-warning', 'type'=>'reset' ]) }}
			<a class="btn btn-warning" role="button" href="{{ URL::to('salas') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', [ 'class'=>'btn btn-primary', 'type'=>'submit' ]) }}
		</div>

		
	{{ Form::close() }}
@endsection
