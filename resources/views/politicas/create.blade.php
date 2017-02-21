@extends('layout')
@section('title', '/ Crear Politica')

@section('scripts')
    <script type="text/javascript">

  $(function () {

    $('#horaminima').datetimepicker({
          locale: 'es',
          format: 'HH:mm:ss',
          allowInputToggle: true          
    });

     $('#horamaxima').datetimepicker({
          locale: 'es',
          format: 'HH:mm:ss' ,
          allowInputToggle: true            
    });


  });
    </script>
@endsection

@section('content')

	<h1 class="page-header">Nueva Politica</h1>

	@include('partials/errors')
	
		{{ Form::open(array('url' => 'politicas', 'class' => 'form-vertical')) }}

			<div class="form-group">
			{{ Form::label('POLI_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('POLI_DESCRIPCION', old('POLI_DESCRIPCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
			</div>

		<div class="form-group">
		{{ Form::label('POLI_HORA_MIN', 'Hora Mínima') }}
		  	<div class='input-group date' id='horaminima'>
	                    <input type='text' name="POLI_HORA_MIN" class="form-control" />
	                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	        </div>
        </div>

        <div class="form-group">
		{{ Form::label('POLI_HORA_MAX', 'Hora Maxima') }}
		  	<div class='input-group date' id='horamaxima'>
	                    <input type='text' name="POLI_HORA_MAX" class="form-control" />
	                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	        </div>
        </div>

		<div class="form-group">
			{{ Form::label('POLI_HORAS_MIN_RESERVA', 'Horas Mínima de Reserva') }} 
			{{ Form::number('POLI_HORAS_MIN_RESERVA', old('POLI_HORAS_MIN_RESERVA'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('POLI_DIAS_MIN_CANCELAR', 'Horas Mínima de Reserva') }} 
			{{ Form::number('POLI_DIAS_MIN_CANCELAR', old('POLI_DIAS_MIN_CANCELAR'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>


		<!-- Botones -->
		<div class="text-right">
			{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
			<a class="btn btn-warning" role="button" href="{{ URL::to('politicas') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
		</div>

		
		{{ Form::close() }}
@endsection
