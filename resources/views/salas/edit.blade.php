@extends('layout')
@section('title', '/ Editar Sala '.$recursoFisico->REFI_ID)
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Actualizar Sala</h1>

	@include('partials/errors')

	{{ Form::model($recursoFisico, array('action' => array('RecursoFisicoController@update', $recursoFisico->REFI_ID), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('REFI_NOMENCLATURA', 'Nomenclatura') }} 
			{{ Form::text('REFI_NOMENCLATURA', old('REFI_NOMENCLATURA'), [ 'class' => 'form-control', 'max' => '20', 'required' ]) }}
		</div>

	  	<div class="form-group">
			{{ Form::label('REFI_CAPACIDADMAXIMA', 'Capacidad Máxima') }} 
			{{ Form::number('REFI_CAPACIDADMAXIMA', old('REFI_CAPACIDADMAXIMA'), [ 'class' => 'form-control', 'min' => '0', 'required' ]) }}
		</div>


	  	<div class="form-group">
			{{ Form::label('REFI_TIPOASIGNACION', 'Tipo Asignación') }} 
			{{ Form::text('REFI_TIPOASIGNACION', old('REFI_TIPOASIGNACION'), [ 'class' => 'form-control', 'max' => '1', 'required' ]) }}
		</div>

	  	<div class="form-group">
			{{ Form::label('REFI_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('REFI_DESCRIPCION', old('REFI_DESCRIPCION'), [ 'class' => 'form-control', 'max' => '100', 'required' ]) }}
		</div>

		<div class="form-group">
			{{ Form::label('REFI_NIVEL', 'Número de niveles') }} 
			{{ Form::number('REFI_NIVEL', old('REFI_NIVEL'), [ 'class' => 'form-control', 'min' => '0', 'max' => '25', 'required' ]) }}
		</div>

		<div class="form-group">
			{{ Form::label('REFI_ESTADO', 'Estado') }} 
			{{ Form::text('REFI_ESTADO', old('REFI_ESTADO'), [ 'class' => 'form-control', 'max' => '20', 'required' ]) }}
		</div>

		<div class="form-group">
			{{ Form::label('REFI_CAPACIDADREAL', 'Capacidad Real') }} 
			{{ Form::number('REFI_CAPACIDADREAL', old('REFI_CAPACIDADREAL'), [ 'class' => 'form-control', 'min' => '0', 'required' ]) }}
		</div>


		<div class="input-group col-lg-4">
			<span class="input-group-addon">Prestable: </span>
	        <span class="input-group-addon">
	        	{{ Form::checkbox('REFI_PRESTABLE', true,old('REFI_PRESTABLE'), array('class' => 'form-control')) }}
	        </span>
		</div><br>

		<div class="form-group">
			{{ Form::label('REFI_AREAREAL', 'Área Real (Mts2)') }} 
			{{ Form::number('REFI_AREAREAL', old('REFI_AREAREAL'), [ 'class' => 'form-control', 'min' => '0', 'required' ]) }}
		</div>

		<div class="form-group">
			{{ Form::label('REFI_AREAUSADA', 'Área Usada (Mts2)') }} 
			{{ Form::number('REFI_AREAUSADA', old('REFI_AREAUSADA'), [ 'class' => 'form-control', 'min' => '0', 'required' ]) }}
		</div>

		<div class="form-group">
			{{ Form::label('SIRF_ID', 'Situación Sala') }} 
			{{ Form::select('SIRF_ID', [null => 'Seleccione una situación...'] + $arrSituacionesRecursosFisicos , old('SIRF_ID'), ['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('TIRF_ID', 'Tipo Espacio Físico') }} 
			{{ Form::select('TIRF_ID', [null => 'Seleccione un tipo...'] + $arrTiposRecursosFisicos , old('TIRF_ID'), ['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('TIPO_ID', 'Tipo Posesión') }} 
			{{ Form::select('TIPO_ID', [null => 'Seleccione un tipo...'] + $arrTiposPosesiones , old('TIPO_ID'), ['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('ESFI_ID', 'Espacio Físico') }} 
			{{ Form::select('ESFI_ID', [null => 'Seleccione un espacio...'] + $arrEspaciosFisicos , old('ESFI_ID'), ['class' => 'form-control', 'required']) }}
		</div>

		<!-- Botones -->
	    <div id="btn-form" class="text-right">
	    	{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
	        <a class="btn btn-warning" role="button" href="{{ URL::to('salas/') }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
	    </div>

	{{ Form::close() }}
    </div>

@endsection