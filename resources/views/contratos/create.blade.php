@extends('layout')
@section('title', '/ Crear contrato')
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Nuevo Contrato</h1>

	@include('partials/errors')

	<!-- if there are creation errors, they will show here -->
	{{ Html::ul($errors->all() )}}

		{{ Form::open(array('url' => 'contratos', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('cedula', 'Cédula') }} 
			{{ Form::input('number', 'cedula', old('cedula'), ['class' => 'form-control', 'required']) }}
		</div>

	  	<div class="form-group">
			{{ Form::label('nombres', 'Nombres') }} 
			{{ Form::text('nombres', old('nombres'), array('class' => 'form-control', 'required')) }}
		</div>

	  	<div class="form-group">
			{{ Form::label('apellidos', 'Apellidos') }} 
			{{ Form::text('apellidos', old('apellidos'), array('class' => 'form-control', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('nro_contrato', 'Numero de Contrato') }} 
			{{ Form::text('nro_contrato', old('nro_contrato'), array('class' => 'form-control', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('estado_contrato', 'Estado de Contrato') }} 
			{{ Form::text('estado_contrato', old('estado_contrato'), array('class' => 'form-control', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('fecha_ingreso', 'Fecha de Ingreso') }} 
			{{ Form::input('date', 'fecha_ingreso', old('fecha_ingreso'), ['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('fecha_retiro', 'Fecha de Retiro') }} 
			{{ Form::input('date', 'fecha_retiro', old('fecha_retiro'), ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
			{{ Form::label('salario', 'Salario') }} 
			{{ Form::input('number', 'salario', old('salario'), ['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('tipo_nomina', 'Tipo de Nómina') }} 
			{{ Form::select('tipo_nomina', array(
				'' => 'Seleccione..', 
				'Q' => 'Quincenal',
				'M' => 'Mensual'),
			old('tipo_nomina'), 
			['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('centro_costo', 'Centro de Costo') }} 
			{{ Form::select('centro_costo', array(
				'' => 'Seleccione..', 
				'001' => 'Gerencia General',
				'002' => 'Gerencia de Gestión Humana'),
			old('centro_costo'), 
			['class' => 'form-control', 'required']) }}
		</div>



		<div class="text-right">
			{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
			<a class="btn btn-warning" role="button" href="{{ URL::to('contratos') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
		</div>

		
		{{ Form::close() }}
@endsection
