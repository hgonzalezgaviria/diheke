@extends('layout')
@section('title', '/ Editar Tipo de Unidad '.$tipoUnidad->TIUN_ID)
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Actualizar Tipo de Unidad</h1>

	@include('partials/errors')

	{{ Form::model($tipoUnidad, array('action' => array('TipoUnidadController@update', $tipoUnidad->TIUN_ID), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('TIUN_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('TIUN_DESCRIPCION', old('TIUN_DESCRIPCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

	    <div id="btn-form" class="text-right">
	    	{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
	        <a class="btn btn-warning" role="button" href="{{ URL::to('tipounidad/') }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
	    </div>

	{{ Form::close() }}
    </div>

@endsection