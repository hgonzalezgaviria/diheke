@extends('layout')
@section('title', '/ Editar Situación Recurso Físico '.$estElemRecursoFisico->EERF_ID)
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Actualizar Estado para Elemento Recurso Físico</h1>

	@include('partials/errors')

	{{ Form::model($estElemRecursoFisico, array('action' => array('EstadoElementoRecursoFisicoController@update', $estElemRecursoFisico->EERF_ID), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('EERF_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('EERF_DESCRIPCION', old('EERF_DESCRIPCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

	    <div id="btn-form" class="text-right">
	    	{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
	        <a class="btn btn-warning" role="button" href="{{ URL::to('estadoelementorecursofisico/') }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
	    </div>

	{{ Form::close() }}
    </div>

@endsection