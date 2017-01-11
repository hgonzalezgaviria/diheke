@extends('layout')
@section('title', '/ Editar Sede '.$sede->SEDE_ID)
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Actualizar Sede</h1>

	@include('partials/errors')

	{{ Form::model($sede, array('action' => array('EspacioFisicoController@update', $sede->SEDE_ID), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('SEDE_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('SEDE_DESCRIPCION', old('SEDE_DESCRIPCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('SEDE_AREA', 'Área (Mts2 o Hectareas)') }} 
			{{ Form::text('SEDE_AREA', old('SEDE_AREA'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>


		<div class="form-group">
			{{ Form::label('SEDE_NRONIVELES', 'Número de niveles') }} 
			{{ Form::number('SEDE_NRONIVELES', old('SEDE_NRONIVELES'), array('class' => 'form-control', 'min' => '0', 'max' => '999', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('SEDE_NOMBRE', 'Nombre') }} 
			{{ Form::text('SEDE_NOMBRE', old('SEDE_NOMBRE'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('SEDE_NOMENCLATURA', 'Nomenclatura') }} 
			{{ Form::text('SEDE_NOMENCLATURA', old('SEDE_NOMENCLATURA'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('TIPO_ID', 'Tipo Posesión') }} 
			{{ Form::select('TIPO_ID', [null => 'Seleccione un tipo...'] + $arrTiposPosesiones , old('TIPO_ID'), ['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('TIEF_ID', 'Tipo Sede') }} 
			{{ Form::select('TIEF_ID', [null => 'Seleccione un tipo...'] + $arrTiposEspaciosFisicos , old('TIEF_ID'), ['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('LOCA_ID', 'Localidad') }} 
			{{ Form::select('LOCA_ID', [null => 'Seleccione una localidad...'] + $arrLocalidades , old('LOCA_ID'), ['class' => 'form-control', 'required']) }}
		</div>


		<!-- Botones -->
	    <div id="btn-form" class="text-right">
	    	{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
	        <a class="btn btn-warning" role="button" href="{{ URL::to('sede/') }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
	    </div>

	{{ Form::close() }}
    </div>

@endsection