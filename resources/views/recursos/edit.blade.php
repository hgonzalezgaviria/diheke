@extends('layout')
@section('title', '/ Editar Recurso')
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Actualizar Recurso</h1>

	@include('partials/errors')

	<!-- if there are creation errors, they will show here -->
	{{ Html::ul($errors->all() )}}

		{{ Form::model($recurso, array('action' => array('RecursosController@update', $recurso->id, $recurso->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

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

	    <div id="btn-form" class="text-right">
	    	{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
	        <a class="btn btn-warning" role="button" href="{{ URL::to('reservas/'.$recurso->id ) }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
	    </div>

	{{ Form::close() }}
    </div><!-- End ng-controller -->

@endsection