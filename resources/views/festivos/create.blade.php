@extends('layout')
@section('title', '/ Crear Día Festivo')
@section('scripts')
    <script>

    	$(function () {

    		$('#fecha').datetimepicker({
				  locale: 'es',
				  format: 'YYYY-MM-DD',
				  //format: 'DD/MM/YYYY hh:mm A',
				  stepping: 30,
				  useCurrent: false,  //Important! See issue #1075. Requerido para minDate
				  minDate: new Date()-1, //-1 Permite seleccionar el dia actual
				  icons: {
					time: "fa fa-clock-o",
					date: "fa fa-calendar",
					up: "fa fa-arrow-up",
					down: "fa fa-arrow-down",
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right',
					today: 'glyphicon glyphicon-screenshot',
					clear: 'fa fa-trash',
					close: 'fa fa-times'
				  },
					tooltips: {
						//today: 'Go to today',
						//clear: 'Clear selection',
						//close: 'Close the picker',
						selectMonth: 'Seleccione Mes',
						prevMonth: 'Mes Anterior',
						nextMonth: 'Mes Siguiente',
						selectYear: 'Seleccione Año',
						prevYear: 'Año Anterior',
						nextYear: 'Año Siguiente',
						selectDecade: 'Seleccione Década',
						prevDecade: 'Década Anterior',
						nextDecade: 'Década Siguiente',
						prevCentury: 'Siglo Anterior',
						nextCentury: 'Siglo Siguiente'
					}
			});

    	});


    </script>
@endsection

@section('content')

	<h1 class="page-header">Nuevo Día Festivo</h1>

	@include('partials/errors')

	<!-- if there are creation errors, they will show here -->
	{{ Html::ul($errors->all() )}}

		{{ Form::open(array('url' => 'festivos', 'class' => 'form-vertical')) }}

		{{ Form::label('FEST_FECHA', 'Fecha') }} 
		<div class='input-group date' id='fecha'>
			{{ Form::text('FEST_FECHA', old('FEST_FECHA'), array('class' => 'form-control', 'required')) }}
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>

		<br>

		<div class="form-group">
			{{ Form::label('FEST_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('FEST_DESCRIPCION', old('FEST_DESCRIPCION'), array('class' => 'form-control', 'required')) }}
		</div>

		<div class="text-right">
			{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
			<a class="btn btn-warning" role="button" href="{{ URL::to('festivos') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
		</div>

		
		{{ Form::close() }}
@endsection
