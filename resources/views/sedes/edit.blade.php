@extends('layout')
@section('title', '/ Editar Sede '.$sede->SEDE_ID)
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Actualizar Sede</h1>

	@include('partials/errors')

	{{ Form::model($sede, array('action' => array('SedesController@update', $sede->SEDE_ID), 'method' => 'PUT', 'class' => 'form-vertical')) }}

	  	<div class="form-group">
			{{ Form::label('SEDE_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('SEDE_DESCRIPCION', old('SEDE_DESCRIPCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('SEDE_DIRECCION', 'Dirección') }} 
			{{ Form::text('SEDE_DIRECCION', old('SEDE_DIRECCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('SEDE_OBSERVACIONES', 'Observaciones') }} 
			{{ Form::textarea('SEDE_OBSERVACIONES', old('SEDE_OBSERVACIONES'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>


		<!-- Botones -->
	    <div id="btn-form" class="text-right">
	    	{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
	        <a class="btn btn-warning" role="button" href="{{ URL::to('sedes/') }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
	    </div>

	{{ Form::close() }}
    </div>

@endsection