@extends('layout')
@section('title', '/ Editar Recurso')
@section('head')
	{!! Html::style('assets/js/chosen_v1.6.2/chosen.css') !!}
@parent
@endsection

@section('scripts')
{!! Html::script('assets/js/chosen_v1.6.2/chosen.jquery.min.js') !!}
    
     <script>

      $(function () {

$("#SALA_ID option[value=" + '{{ $recurso->SALA_ID }}' + "]").attr("selected","selected");


      	/*para posicionar un combobox lo unico que hay que hacer es que el selector (select) tenga
      	un id y referirce a el de la forma en que esta abajo de este comentario. Entonces le decimos
      	que el select con id ESTA_ID se seleccione la opción que trae el campo ESTA_ID en el registro
      	de equipo

      	

      	*/	

	 	$( "#SEDE_ID" ).change(function() {
		  	
 		var opcion = $("#SEDE_ID").val();
	 		crsfToken = document.getElementsByName("_token")[0].value;
	 		
			$.ajax({
	             url: '../../consultaSalas',
	             data: 'sede='+ opcion,
	             dataType: "json",
	             type: "POST",
	             headers: {
	                    "X-CSRF-TOKEN": crsfToken
	                },
	             success: function(sala) {
			        $('#SALA_ID').empty();
					for(var i = 0; i < sala.length; i++){
						$("#SALA_ID").append('<option value=' + sala[i].SALA_ID + '>' + sala[i].SALA_DESCRIPCION + '</option>');
					}

					$("#SALA_ID").trigger("chosen:updated");
							
	                
	             },
	             error: function(req, err){

	                console.log("Error al crear evento"+ req );
	             }        
        	});

		});

		$("#SALA_ID").chosen({
			no_results_text: "Ningún resultado coincide."
		}); 

	  });

	  function habilitar(id) {
	  	//alert(id);
    if (id != "") {    
			document.getElementById("SALA_ID").disabled=false;
       
    }else {
    	//$("#SALA_ID").append('<option value="">Seleccione una sede..</option>');
    		//document.getElementById("SALA_ID").value="Seleccione una sede..";

    		document.getElementById("SALA_ID").disabled=true;    		
    	}
	}
    </script>
@parent
@endsection

@section('content')

	<h1 class="page-header">Actualizar Recurso</h1>

	@include('partials/errors')

	<!-- if there are creation errors, they will show here -->
	{{ Html::ul($errors->all() )}}

		{{ Form::model($recurso, [ 'action' => [ 'RecursosController@update', $recurso->RECU_ID ], 'method' => 'PUT', 'class' => 'form-vertical' ]) }}

	  	<div class="form-group">
			{{ Form::label('RECU_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('RECU_DESCRIPCION', old('RECU_DESCRIPCION'), array('class' => 'form-control', 'required')) }}
		</div>

	  	<div class="form-group">
			{{ Form::label('RECU_VERSION', 'Versión') }} 
			{{ Form::text('RECU_VERSION', old('RECU_VERSION'), array('class' => 'form-control')) }}
		</div>

	  	<div class="form-group">
			{{ Form::label('RECU_OBSERVACIONES', 'Observaciones') }} 
			{{ Form::text('RECU_OBSERVACIONES', old('RECU_OBSERVACIONES'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('sede', 'Sede') }} 
			<select name="SEDE_ID" id="SEDE_ID" class="form-control"  onchange="habilitar(this.value);">
				<option value="">Seleccione..</option>
	            @foreach($sedes as $sede)
	            <option value="{{ $sede->SEDE_ID }}">{{ $sede->SEDE_DESCRIPCION }}</option>
	            @endforeach
	        </select>
		</div>

		<div class="form-group">
			{{ Form::label('sala', 'Sala') }} 
			<select name="SALA_ID[]" id="SALA_ID" class="form-control chosen-select" multiple data-placeholder="Seleccione los salas..." >

				
	            @foreach($salas as $sala)
	            <option value="{{ $sala->SALA_ID }}"
	            		{{ in_array($sala->SALA_ID, $idsSalas) ? 'selected' : '' }}>
					{{ $sala->SALA_DESCRIPCION }}
	            </option>
	            @endforeach
	        </select>
		</div>


	    <div id="btn-form" class="text-right">

	    	{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}

	        <a class="btn btn-warning" role="button" href="{{ URL::to('recursos') }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>

			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
	    </div>

	{{ Form::close() }}
    </div><!-- End ng-controller -->

@endsection