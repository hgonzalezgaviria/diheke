@extends('layout')
@section('title', '/ Crear Tipo Unidad')

@section('content')

	<h1 class="page-header">Nuevo Tipo de Unidad</h1>

	@include('partials/errors')
	
		{{ Form::open(array('url' => 'tipounidad', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('TIUN_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('TIUN_DESCRIPCION', old('TIUN_DESCRIPCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="text-right">
			{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
			<a class="btn btn-warning" role="button" href="{{ URL::to('tipounidad') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
		</div>

		
		{{ Form::close() }}
@endsection
