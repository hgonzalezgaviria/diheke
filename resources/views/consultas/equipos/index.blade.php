@extends('layout')
@section('title', '/ Consulta Equipos')
@section('scripts')
    <script>
/**/
	 $(function () {


	 	/*
			Control botones filtro por estado del equipo.
	 	*/
		$('input:radio[name ="opcFiltro"]').on('change', function () {
			var selected = $(this).filter(':checked').val();

			switch (selected){
			    case 'all':
			    	$('.equipo').removeClass('hide');
			        break;
			    case 'enabled':
			    	$('.equipo').each(function( index ) {
			    		var estado = $(this).find('.estado').data('estado');
			    		if(estado != {{\reservas\Estado::EQUIPO_DISPONIBLE}})
			    			$(this).addClass('hide');
			    		else
			    			$(this).removeClass('hide');
			    	});
			        break;
			    case 'disabled':
			    	$('.equipo').each(function( index ) {
			    		var estado = $(this).find('.estado').data('estado');
			    		if(estado != {{\reservas\Estado::EQUIPO_OCUPADO}})
			    			$(this).addClass('hide');
			    		else
			    			$(this).removeClass('hide');
			    	});
			        break;
			}

		});// Fin Control filtro por estado de equipo.



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

			    var checkeado =  $(this).prop('checked');
			    if(!checkeado){

		     		var equipo = $(this).attr("id");
			     	$('#frmPrestamo').find('#equipo').val(equipo)
			     	$("#modalPrestamoEquipos").modal('show');
			    }

		    });

		 //Funcion para habilitar el checkbox si cancela el prestamo
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
  		<label class="radio-inline">
	    	<input type="radio" name="opcFiltro" value="all" checked>
	    	Todos
  		</label>
  		<label  class="radio-inline">
	    	<input type="radio" name="opcFiltro" value="enabled">
	    	Disponibles
  		</label>
  		<label  class="radio-inline">
	    	<input type="radio" name="opcFiltro" value="disabled">
	    	Ocupados
  		</label>		
	</div>
	
	{{ Form::open(['id'=>'consulequi' , 'class' => 'form-vertical']) }}
	
	@foreach ($equipos as $i => $equipo)
		<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 zoom-in-hover equipo">
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

					<div class="alert alert-{{$equipo->ESTA_ID == \reservas\Estado::EQUIPO_DISPONIBLE ? 'success' : 'warning'}} estado" data-estado="{{$equipo->ESTA_ID}}">
						{{ $equipo -> estado -> ESTA_DESCRIPCION }}
					</div>

				</div> <!-- panel-body -->

			</div>
		</div>
	@endforeach

	{{ Form::close() }}

@include('consultas/equipos/index-modalPrestamo')
@endsection