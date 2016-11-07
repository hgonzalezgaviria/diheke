@extends('layout')
@section('title', '/ Editar Tipo de Espacio Físico '.$tipoEspacioFisico->TIEF_ID)
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Actualizar Tipo de Espacio Físico</h1>

	@include('partials/errors')

	{{ Form::model($tipoEspacioFisico, array('action' => array('TipoEspacioFisicoController@update', $tipoEspacioFisico->TIEF_ID), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('TIEF_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('TIEF_DESCRIPCION', old('TIEF_DESCRIPCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

	    <div id="btn-form" class="text-right">
	    	{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
	        <a class="btn btn-warning" role="button" href="{{ URL::to('tipoespaciofisico/') }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
	    </div>

	{{ Form::close() }}
    </div>

@endsection