@extends('layout')
@section('title', '/ Editar Situación Recurso Físico '.$sitRecursoFisico->SIRF_ID)
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Actualizar Situación Recurso Físico</h1>

	@include('partials/errors')

	<!-- if there are creation errors, they will show here -->
	{{ Html::ul($errors->all() )}}

	{{ Form::model($sitRecursoFisico, array('action' => array('SituacionRecursoFisicoController@update', $sitRecursoFisico->SIRF_ID), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('SIRF_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('SIRF_DESCRIPCION', old('SIRF_DESCRIPCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

	    <div id="btn-form" class="text-right">
	    	{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
	        <a class="btn btn-warning" role="button" href="{{ URL::to('situacionrecursofisico/') }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
	    </div>

	{{ Form::close() }}
    </div><!-- End ng-controller -->

@endsection