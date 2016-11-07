@extends('layout')
@section('title', '/ Editar Elemento Recurso Físico '.$elemRecursoFisico->ELRF_ID)
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Actualizar Estado para Elemento Recurso Físico</h1>

	@include('partials/errors')

	{{ Form::model($elemRecursoFisico, array('action' => array('ElementoRecursoFisicoController@update', $elemRecursoFisico->ELRF_ID), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('ELRF_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('ELRF_DESCRIPCION', old('ELRF_DESCRIPCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('EERF_ID', 'Estado') }} 
			{{ Form::select('EERF_ID', [null => 'Seleccione un estado...'] + $arrEstados , old('EERF_ID'), ['class' => 'form-control', 'required']) }}
		</div>

		<!-- Botones -->
	    <div id="btn-form" class="text-right">
	    	{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
	        <a class="btn btn-warning" role="button" href="{{ URL::to('elementorecursofisico/') }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
	    </div>

	{{ Form::close() }}
    </div>

@endsection