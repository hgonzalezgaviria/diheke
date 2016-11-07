@extends('layout')
@section('title', '/ Crear Estado Elemento Recurso Físico')

@section('content')

	<h1 class="page-header">Nuevo Tipo de Posesión</h1>

	@include('partials/errors')
	
		{{ Form::open(array('url' => 'tipoposesion', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('TIPO_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('TIPO_DESCRIPCION', old('TIPO_DESCRIPCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="input-group col-lg-4">
			<span class="input-group-addon">Centro de práctica: </span>
	        <span class="input-group-addon">
	        	{{ Form::checkbox('TIPO_CENTRODEPRACTICA', true,old('TIPO_CENTRODEPRACTICA'), array('class' => 'form-control')) }}
	        </span>
		</div>

		<!-- botones -->
		<div class="text-right">
			{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
			<a class="btn btn-warning" role="button" href="{{ URL::to('tipoposesion') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
		</div>

		
		{{ Form::close() }}
@endsection
