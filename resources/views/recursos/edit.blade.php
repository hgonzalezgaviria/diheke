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

		{{ Form::model($recurso, [ 'action' => [ 'RecursosController@update', $recurso->RECU_ID ], 'method' => 'PUT', 'class' => 'form-vertical' ]) }}

	  	<div class="form-group">
			{{ Form::label('RECU_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('RECU_DESCRIPCION', old('RECU_DESCRIPCION'), array('class' => 'form-control', 'required')) }}
		</div>

	  	<div class="form-group">
			{{ Form::label('RECU_VERSION', 'Versión') }} 
			{{ Form::text('RECU_VERSION', old('RECU_VERSION'), array('class' => 'form-control')) }}
		</div>

	  	<div class="form-group">
			{{ Form::label('RECU_OBSERVACIONES', 'Observaciones') }} 
			{{ Form::text('RECU_OBSERVACIONES', old('RECU_OBSERVACIONES'), array('class' => 'form-control')) }}
		</div>

	    <div id="btn-form" class="text-right">

	    	{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}

	        <a class="btn btn-warning" role="button" href="{{ URL::to('recursos') }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>

			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
	    </div>

	{{ Form::close() }}
    </div><!-- End ng-controller -->

@endsection