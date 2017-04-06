@extends('layout')
@section('title', '/ Editar Rol '.$rol->ROLE_ID)

@section('content')

	<h1 class="page-header">Actualizar Rol</h1>

	@include('partials/errors')

	{{ Form::model($rol, ['action' => ['Auth\RolController@update', $rol->ROLE_ID ], 'method' => 'PUT', 'class' => 'form-vertical' ]) }}

		<div class="form-group">
			{{ Form::label('ROLE_ROL', 'Identificador interno') }} 
			{{ Form::text('ROLE_ROL', old('ROLE_ROL'), [ 'class' => 'form-control', 'maxlength' => '15', 'required' ]) }}
		</div>

		<div class="form-group">
			{{ Form::label('ROLE_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('ROLE_DESCRIPCION', old('ROLE_DESCRIPCION'), [ 'class' => 'form-control', 'maxlength' => '50', 'required' ]) }}
		</div>

		<!-- Botones -->
		<div id="btn-form" class="text-right">
			{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', [ 'class'=>'btn btn-warning', 'type'=>'reset' ]) }}
			<a class="btn btn-warning" role="button" href="{{ URL::to('roles/') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', [ 'class'=>'btn btn-primary', 'type'=>'submit' ]) }}
		</div>

	{{ Form::close() }}
@endsection