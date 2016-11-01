@extends('layout')
@section('title', '/ Crear Recurso')
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Nuevo Recurso</h1>

	@include('partials/errors')

	<!-- if there are creation errors, they will show here -->
	{{ Html::ul($errors->all() )}}

		{{ Form::open(array('url' => 'recursos', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('descripcion', 'Descripción') }} 
			{{ Form::text('descripcion', old('descripcion'), array('class' => 'form-control', 'required')) }}
		</div>

	  	<div class="form-group">
			{{ Form::label('version', 'Versión') }} 
			{{ Form::text('version', old('version'), array('class' => 'form-control')) }}
		</div>

	  	<div class="form-group">
			{{ Form::label('observaciones', 'Observaciones') }} 
			{{ Form::text('observaciones', old('observaciones'), array('class' => 'form-control')) }}
		</div>

		<div class="text-right">
			{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
			<a class="btn btn-warning" role="button" href="{{ URL::to('contratos') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
		</div>

		
		{{ Form::close() }}
@endsection
