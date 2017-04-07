@extends('layout')
@section('title', '/ Crear Reserva')
@section('scripts')
	<script type="text/javascript">

		$(function () {

			$('#fechainicio').datetimepicker({
				  locale: 'es',
				  format: 'YYYY-MM-DD HH:mm',
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

			$('#fechafin').datetimepicker({
				  locale: 'es',
				  format: 'YYYY-MM-DD HH:mm',
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

	<h1 class="page-header">Nueva Reserva</h1>

	@include('partials/errors')

	<!-- if there are creation errors, they will show here -->
	{{ Html::ul($errors->all() )}}

		{{ Form::open(['url' => 'reservas', 'class' => 'form-vertical']) }}

		{{ Form::hidden('back', 'rgb(192,192,192)') }}
		{{ Form::hidden('title', 'Prueba') }}


		<div class="form-group">
			{{ Form::label('sala', 'Sala ID') }} 
			{{ Form::number('sala', old('sala'), array('class' => 'form-control', 'required')) }}
		</div>

		<div class="row">
			<div class="col-xs-6">
				<div class="input-group">
					{{ Form::label('equipo', 'Equipo', [ 'class'=>'form-control' ]) }}
					<span class="input-group-addon">
						<input type="radio"
							title="Requerido!" 
							value="1"
							name="equipo"
							class="">
					</span>
				</div>
			</div>

			<div class="col-xs-6">
				<div class="input-group">
					{{ Form::label('equipo', 'Sala', [ 'class'=>'form-control' ]) }}
					<span class="input-group-addon">
						<input type="radio"
							value="0"
							name="equipo"
							class="">
					</span>
				</div>
			</div>
		</div>

		<br>

		<div class='input-group date' id='fechainicio'>
			<input name="start" type='text' class="form-control" />
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>

		<br>

		<div class='input-group date' id='fechafin'>
			<input name="end" type='text' class="form-control" />
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
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
