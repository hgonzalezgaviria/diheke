@extends('layout')
@section('title', '/ Consulta Equipos')
@section('scripts')
    <script>
/**/
	 $(function () {

	 		//con la siguiente linea se enciende o no el boton
			//$('#switch').bootstrapToggle('on');


		var arraid = [];

			var i = 0;
			//alert('estado equipo '+ '{{ $equipos }}');
			$( ".filter-toggle" ).each(function( i ) {
			    
			    var equipo = $(this).closest(".filter-toggle").attr("id");
			    arraid[i] = equipo;
			    i++;

			    //console.log('equipo '+equipo);

			});


			 
	 	crsfToken = document.getElementsByName("_token")[0].value;
 		//var opcion = $("#SEDE_ID").val();
			$.ajax({
	             url: 'consultarEquipos',
	             data: 'equipos=null',
	             dataType: "json",
	             type: "POST",
	             headers: {
	                    "X-CSRF-TOKEN": crsfToken
	                },
	              success: function(equipo) {
	         
	        
	      

					for(var i = 0; i < equipo.length; i++){
					
						if((equipo[i].EQUI_ID == arraid[i]) && equipo[i].ESTA_ID == 3){
							//console.log('si señor '+equipo[i].EQUI_ID+' == '+arraid[i]);
							$('#'+arraid[i]).bootstrapToggle('on');
						}
					//console.log(equipo[i].ESTA_ID);

					} 
	                
	              },
	              error: function(json){
	                console.log("Error");
	              }        
        	}); //Fin ajax
			

			
			



		    $('.switch-input').change(function() {
		      //$('#console-event').html('Toggle: ' + $(this).prop('checked'))
		      //alert('checkbox en estado: '+ $(this).prop('checked'));

		     var equipo = $(this).closest(".switch-input").attr("id");
			   // also tried $(this).parent(".head-div") -- same effect
			  alert('id seleccionado ' + abc); // Shows as Undefined

		     
		      

		    });
		 


	  });	
		

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
		
		<div id="switchON">
	    		<label class="switch">
					<input class="switch-input" type="checkbox" id="{{$equipo->EQUI_ID}}" />
					<span class="switch-label" data-on="On" data-off="Off"></span> 
					<span class="switch-handle"></span> 
				</label>
			</div>
			
			-->
		<div class="checkbox">
	  		<label>
	    	<input type="checkbox"  data-toggle="toggle" class="filter-toggle" id="{{$equipo->EQUI_ID}}" value="1" data-onstyle="success" data-offstyle="danger">
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