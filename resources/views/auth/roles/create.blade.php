@extends('layout')
@section('title', '/ Crear Rol')

@section('content')

	<h1 class="page-header">Nuevo Rol</h1>
	@include('partials/errors')
	
	{{ Form::open(['url' => 'roles', 'class' => 'form-vertical']) }}

		<div class="form-group{{ $errors->has('ROLE_ROL') ? ' has-error' : '' }}">
			{{ Form::label('ROLE_ROL', 'Identificador interno',  [ 'class' => 'col-md-4 control-label' ]) }} 
			{{ Form::text('ROLE_ROL', old('ROLE_ROL'), [ 'class' => 'form-control', 'maxlength' => '15', 'required' ]) }}
			@if ($errors->has('ROLE_ROL'))
				<span class="help-block">
					<strong>{{ $errors->first('ROLE_ROL') }}</strong>
				</span>
			@endif
		</div>

		<div class="form-group">
			{{ Form::label('ROLE_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('ROLE_DESCRIPCION', old('ROLE_DESCRIPCION'), [ 'class' => 'form-control', 'maxlength' => '50', 'required' ]) }}
		</div>

		<!-- Botones -->
		<div class="text-right">
			{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', ['class'=>'btn btn-warning', 'type'=>'reset']) }}
			<a class="btn btn-warning" role="button" href="{{ URL::to('roles') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', ['class'=>'btn btn-primary', 'type'=>'submit']) }}
		</div>

	{{ Form::close() }}
@endsection
