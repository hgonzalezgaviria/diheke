@extends('layout')
@section('title', '/ Crear Reserva')
@section('scripts')
    <script type="text/javascript">
    	$(document).ready(function() {

		    // page is now ready, initialize the calendar...

		   $('#calendar').fullCalendar({
		        // put your options and callbacks here
		        locale: 'es',
		        header: {
			        center: 'month, day, week' // buttons for switching between views
			    },
			    views: {
			        day: {
			        	minTime: '09:00:00',
			        	maxTime: '22:00:00',
			            type: 'agenda',
			            buttonText: 'Día'
			        },
			        week: {
			        	type: 'basicWeek',
			        	buttonText: 'Semana'
			        },
			        
			    },





		    });

		    $( "#boton" ).click(function() {
			   var calendar = $('#calendar').fullCalendar('getCalendar');
			   var m1 = calendar.moment('2016-11-09');
			   var m2 = calendar.moment('2016-11-10');
			   console.log(m1);
			   console.log(m2);
			});
		    

		});
    </script>
@endsection

@section('content')

	<h1 class="page-header">Nueva Reserva</h1>

	@include('partials/errors')

	<!-- if there are creation errors, they will show here -->
	{{ Html::ul($errors->all() )}}

		{{ Form::open(array('url' => 'contratos', 'class' => 'form-horizontal')) }}

	  	<div id="calendar" class="form-group">
			
		</div>

		<div class="form-group">
			<input type="button" value="probar" id="boton">
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
