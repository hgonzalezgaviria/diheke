@extends('layout')
@section('title', '/ Crear Reserva')
@section('scripts')
    <script type="text/javascript">
    	$(document).ready(function() {

		    // page is now ready, initialize the calendar...

		    $('#calendar').fullCalendar({
		        // put your options and callbacks here

		        header: {
			        center: 'month, day' // buttons for switching between views
			    },
			    views: {
			        day: {
			            type: 'agenda',
			            buttonText: 'day'
			        }
			    }




		    })

		});
    </script>
@endsection

@section('content')

	<h1 class="page-header">Nueva Reserva</h1>

	@include('partials/errors')

	<!-- if there are creation errors, they will show here -->
	{{ Html::ul($errors->all() )}}

		{{ Form::open(array('url' => 'contratos', 'class' => 'form-horizontal')) }}

	  	<div class="form-group" id='calendar'>
			
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
