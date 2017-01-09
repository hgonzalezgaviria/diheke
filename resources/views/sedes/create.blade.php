@extends('layout')
@section('title', '/ Crear Espacio Físico')

@section('content')

	<h1 class="page-header">Nuevo Espacio Físico</h1>

	@include('partials/errors')
	
		{{ Form::open(array('url' => 'espaciofisico', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('ESFI_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('ESFI_DESCRIPCION', old('ESFI_DESCRIPCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('ESFI_AREA', 'Área (Mts2 o Hectareas)') }} 
			{{ Form::text('ESFI_AREA', old('ESFI_AREA'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>


		<div class="form-group">
			{{ Form::label('ESFI_NRONIVELES', 'Número de niveles') }} 
			{{ Form::number('ESFI_NRONIVELES', old('ESFI_NRONIVELES'), array('class' => 'form-control', 'min' => '0', 'max' => '999', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('ESFI_NOMBRE', 'Nombre') }} 
			{{ Form::text('ESFI_NOMBRE', old('ESFI_NOMBRE'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('ESFI_NOMENCLATURA', 'Nomenclatura') }} 
			{{ Form::text('ESFI_NOMENCLATURA', old('ESFI_NOMENCLATURA'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('TIPO_ID', 'Tipo Posesión') }} 
			{{ Form::select('TIPO_ID', [null => 'Seleccione un tipo...'] + $arrTiposPosesiones , old('TIPO_ID'), ['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('TIEF_ID', 'Tipo Espacio Físico') }} 
			{{ Form::select('TIEF_ID', [null => 'Seleccione un tipo...'] + $arrTiposEspaciosFisicos , old('TIEF_ID'), ['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('LOCA_ID', 'Localidad') }} 
			{{ Form::select('LOCA_ID', [null => 'Seleccione una localidad...'] + $arrLocalidades , old('LOCA_ID'), ['class' => 'form-control', 'required']) }}
		</div>


		<!-- Botones -->
		<div class="text-right">
			{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
			<a class="btn btn-warning" role="button" href="{{ URL::to('espaciofisico') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
		</div>

		
		{{ Form::close() }}
@endsection
