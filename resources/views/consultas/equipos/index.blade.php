@extends('layout')
@section('title', '/ Consulta Equipos')
@section('scripts')
    <script>
/**/




 var ids="";

		$(".switch").change(function() {
   		$('input[type=checkbox]:checked').each(function(){

   			
    
    		ids = $('input[type=checkbox]:checked').attr('id');
    		
			alert(ids);

			//var htmlvar=

	
if ($('input.checkbox_check').is(':checked')){
		$(".alert alert-info").html('Switched off.');

	}

	else {
		$(".alert alert-info").html('Switched on.');
        // Hacer algo si el checkbox ha sido deseleccionado
        //$(htmlvar).html('Switched off.');
    }
		  


});

});

		$('.switch:checked').each(
    function() {
        alert("El checkbox con valor " + $(this).val() + " está seleccionado");
    }
);

		

    </script>
@endsection
@section('content')

	<h1 class="page-header">Consultas De Equipos</h1>
	<div class="row well well-sm">

			
			{{ Form::label('SALA_ID', 'Salas') }} 
			{{ Form::select('SALA_ID', [null => 'Seleccione una sala...'] + $arrSalas , old('SALA_ID'), ['class' => 'form-control', 'required']) }}
		

			
			{{ Form::label('SEDE_ID', 'Sedes') }} 
			{{ Form::select('SEDE_ID', [null => 'Seleccione una sede...'] + $arrSedes , old('SEDE_ID'), ['class' => 'form-control', 'required']) }}
		
		

	</div>
	
	{{ Form::open(['id'=>'consulequi' , 'class' => 'form-horizontal']) }}
<table class="table table-striped" id="tabla">

	<tbody>


		
	

	@foreach ($equipos as $i => $equipo)

    
<div class="col-md-4 zoom-in-hover">
	<div class="panel panel-default">
		<div class="panel-heading">
	 		<div class="panel-body">
		<center>
			<IMG SRC='{{ asset('assets/img/monitor.png') }}' WIDTH=60 HEIGHT=60>
		</center>
			<!--
				<div class="checkbox">
	  		<label>
	    	<input type="checkbox"  data-toggle="toggle" class="filter-toggle" id="switch{{$i}}" value="1" data-onstyle="success" data-offstyle="danger">
	  		</label>
		</div>

		<div id="switchON">
	    		<label class="switch">
					<input class="switch-input" type="checkbox" id="switch{{$i}}" />
					<span class="switch-label" data-on="On" data-off="Off"></span> 
					<span class="switch-handle"></span> 
				</label>
			</div>
		
			
			-->
	
		<div id="switchON">
	    		<label class="switch">
					<input class="switch-input" type="checkbox" id="switch{{$equipo->EQUI_ID}}" />
					<span class="switch-label" data-on="On" data-off="Off"></span> 
					<span class="switch-handle"></span> 
				</label>
			</div>
		
			<div class="alert alert-info" id="switch{{$i}}">Switched off.</div>

		  </div>
	  </div>
  </div>
</div>
		@endforeach
	</tbody>
</table>

{{ Form::close() }}
@endsection