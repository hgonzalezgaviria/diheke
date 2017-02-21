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
							$('#'+arraid[i]).bootstrapToggle('disable');
						}
					//console.log(equipo[i].ESTA_ID);

					} 
	                
	              },
	              error: function(json){
	                console.log("Error");
	              }        
        	}); //Fin ajax
			

			
			
		
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
		 //Funcio para habilitar el checkbox si cancela el prestamo
			$('#modalPrestamoEquipos').on('hide.bs.modal', function (event) {
				
				var equipo = $(this).find('#equipo').val();
				$('#'+equipo).bootstrapToggle('on');
				$('#doc_usuario').val('');
				$('#nombre').val('');

			})

	  });	
		

    </script>
@parent
@endsection

@section('content')

	<h1 class="page-header">Consultas De Equipos</h1>

	<div class="row well well-sm"><!--Radio buttons -->
		
		  		<label  class="radio-inline">
		    	<input type="radio" name="opciones" id="opciones_1" value="opcion_1" checked>
		    	Todos
		  		</label>		
	
		  		<label  class="radio-inline">
		    	<input type="radio" name="opciones" id="opciones_2" value="opcion_2">
		    	Disponibles
		  		</label>
		
			
		  		<label  class="radio-inline">
		    	<input type="radio" name="opciones" id="opciones_3" value="opcion_3">
		    	Ocupados
		  		</label>		

	</div>
	
	{{ Form::open(['id'=>'consulequi' , 'class' => 'form-vertical']) }}
	
	@foreach ($equipos as $i => $equipo)
		<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 zoom-in-hover">
			<div class="panel panel-default">

				<div class="panel-heading">
					<center><b>Equipo {{$equipo->EQUI_ID}} </b></center>
				</div>

			 	<div class="panel-body">

					<center>
						<IMG SRC='{{ asset('assets/img/monitor.png') }}' WIDTH=60 HEIGHT=60>
					</center>

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