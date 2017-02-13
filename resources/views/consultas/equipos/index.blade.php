@extends('layout')
@section('title', '/ Consulta Equipos')
@section('scripts')
    <script>
/**/
	 $(function () {

 		//con la siguiente linea se enciende o no el boton
		//$('#switch').bootstrapToggle('on');

		// INICIO Obtiene id de cada checkbox y lo adiciona a un arreglo
		var arraid = [];
		var i = 0;
		$( ".filter-toggle" ).each(function( i ) {
		    var equipo = $(this).closest(".filter-toggle").attr("id");
		    arraid[i] = equipo;
		    i++;
		});// FIN Obtiene id de cada checkbox y lo adiciona a un arreglo

		var sala = '{{$sala}}';
	 	
		// INICIO Obtiene los equipos por medio de ajax y Json
	 	crsfToken = document.getElementsByName("_token")[0].value; 		
			$.ajax({
	             url: 'consultarEquipos',
	             data: 'equipos=null&sala='+sala,
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
						//	$('#'+arraid[i]).bootstrapToggle('disable');
						}else {
						//	$('#'+arraid[i]).bootstrapToggle('disable');
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

		    //Captura onchange al momento de cambiar
		    $('.filter-toggle').change(function() {
		    	      //$('#console-event').html('Toggle: ' + $(this).prop('checked'))
		      //alert('checkbox en estado: '+ $(this).prop('checked'));

			    var checkeado =  $(this).prop('checked');
			    if(!checkeado){

		     		var equipo = $(this).attr("id");
			     	$('#frmPrestamo').find('#equipo').val(equipo)
			     	$("#modalPrestamoEquipos").modal('show');
			     	//ert(checkeado);  
			    }

		      //if
		      //if($(".filter-toggle").is(':checked')) {  
            //alert(checkeado);  
     //   } else {  

        	//}

		      
		       //$("#myModal").modal();
		     //var equipo = $(this).closest(".filter-toggle").attr("id");
			   // also tried $(this).parent(".head-div") -- same effect
			  //alert('id seleccionado ' + equipo); // Shows as Undefined

		     
		      

		    });
		 


	  });	
		

    </script>
@parent
@endsection

@section('content')

	<h1 class="page-header">Consultas De Equipos</h1>
	
	{{ Form::open(['id'=>'consulequi' , 'class' => 'form-horizontal']) }}
	
	@foreach ($equipos as $i => $equipo)
		<div class="col-md-4 zoom-in-hover">
			<div class="panel panel-default">

				<div class="panel-heading">
					<center><b>Equipo {{$equipo->EQUI_ID}} </b></center>
				</div>

			 	<div class="panel-body">

					<center>
						<IMG SRC='{{ asset('assets/img/monitor.png') }}' WIDTH=60 HEIGHT=60>
					</center>

					<!--
					<div id="switchON">
			    		<label class="switch">
							<input class="switch-input" type="checkbox" id="{{$equipo->EQUI_ID}}" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</div>
					-->

					<center>
						<div class="checkbox">
			  				<label>
			    				<input type="checkbox" data-toggle="toggle" class="filter-toggle" id="{{$equipo->EQUI_ID}}" value="1" data-onstyle="success" data-offstyle="danger" data-width="100" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-close'></i>" >
			  				</label>
						</div>
					</center>
				
					<br>

					<div class="alert alert-info" id="switch{{$i}}">
						{{ $equipo -> estado -> ESTA_DESCRIPCION }}
					</div>

				</div> <!-- panel-body -->

			</div>
		</div>
	@endforeach

	{{ Form::close() }}

@include('consultas/equipos/index-modalPrestamo')
@endsection