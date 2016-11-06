@extends('layout')
@section('title', '/ Crear contrato')

@section('scripts')
<script type="text/javascript">
    $(function () {
        $('#dttmpicker_fecha_ingreso').datetimepicker({
        	locale: 'es',
        	format: 'YYYY-MM-DD',
        	//minDate: new Date(),
        	sideBySide: true,
        });
    });


    $(function () {
        $('#dttmpicker_fecha_retiro').datetimepicker({
        	locale: 'es',
        	format: 'YYYY-MM-DD',
        	//minDate: new Date(),
        	sideBySide: true,
        	icons: {
        		autoclose: true,
        		time: 'fa fa-clock-o',
        		date: 'fa fa-calendar',
        		up:   'fa fa-arrow-up',
        		down: 'fa fa-arrow-down'
        	}
        });
    });

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
			{{ Form::label('sexol', 'Sexo') }} 
			{{ Form::select('sexo', array(
				'' => 'Seleccione..', 
				'M' => 'Masculino',
				'F' => 'Femenino',
				'I' => 'Indefinido'),
			old('sexo'), 
			['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('casomedic', '¿Caso Medico?') }} 
			{{ Form::checkbox('caso_medico', 1, true), array('class' => 'form-control') }}
		</div>

		<div class="form-group">
			{{ Form::label('nro_contrato', 'Numero de Contrato') }} 
			{{ Form::text('nro_contrato', old('nro_contrato'), array('class' => 'form-control', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('tipocontracto', 'Tipo de Contrato') }} 
			{{ Form::select('tipo_contrato', array(
				'' => 'Seleccione..', 
				'IND' => 'Termino Indefinido',
				'FIJ' => 'Termino Fijo',
				'TEM' => 'Temporal'),
			old('tipo_contrato'), 
			['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('cargo', 'Cargo') }} 
			<select name="cargo" id="cargo" class="form-control">
				<option value="">Seleccione..</option>
	            @foreach($cargos as $cargo)
	            dd($cargos)
	            <option value="{{ $cargo->id }}">{{ $cargo->cargo }}</option>
	            @endforeach
	        </select>
	    </div>

		<div class="form-group">
			
			{{ Form::label('estado_contrato', 'Estado Contrato') }} 
			{{ Form::select('estado_contrato', array(
				'' => 'Seleccione..', 
				'N' => 'Normal Activo',
				'R' => 'Retirado',
				'V' => 'Vacación'),
			old('estado_contrato'), 
			['class' => 'form-control', 'required']) }}
		</div>



		<div class="form-group ">
			{{ Form::label('fecha_ingreso', 'Fecha de Ingreso') }} 
	        <div class='input-group date' id='dttmpicker_fecha_ingreso'>
				{{ Form::text('fecha_ingreso', old('fecha_ingreso'), ['class' => 'form-control', 'required']) }}
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
			</div>
		</div>


		<div class="form-group ">
			{{ Form::label('fecha_retiro', 'Fecha de Retiro') }} 
	        <div class='input-group date' id='dttmpicker_fecha_retiro'>
			{{ Form::input('date', 'fecha_retiro', old('fecha_retiro'), ['class' => 'form-control']) }}
                <span class="input-group-addon">
                    <span class="fa fa-calendar">
                    </span>
                </span>
			</div>
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
			{{ Form::label('cno', 'Clasificación de Ocupación') }} 
			{{ Form::select('cno', array(
				'' => 'Seleccione..', 
				'1' => 'Gerentes',
				'2' => 'Jefes y Coordinadores'),
			old('cno'), 
			['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('centro_costo', 'Centro de Costo') }} 
			{{ Form::select('centro_costo', array(
				'' => 'Seleccione..', 
				1 => 'Gerencia General',
				2 => 'Gerencia de Gestión Humana'),
			old('centro_costo'), 
			['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('gerencia', 'Gerencia') }} 
			{{ Form::select('gerencia', array(
				'' => 'Seleccione..', 
				'003' => 'Gerencia Corporativa',
				'004' => 'Gerencia de Operaciones'),
			old('gerencia'), 
			['class' => 'form-control', 'required']) }}
		</div>

		<div class="form-group">
			{{ Form::label('empleador', 'Empleador') }} 
			{{ Form::select('empleador', array(
				'' => 'Seleccione..', 
				'1' => 'Promoambiental Cali',
				'2' => 'Promoambiental Valle'),
			old('empleador'), 
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
