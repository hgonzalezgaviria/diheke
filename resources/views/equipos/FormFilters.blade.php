@section('head')
	<style>
		/* Define el tamaño de los input-group-addon para que sean todos iguales */
		.input-group-addon {
			min-width:100px;
			text-align:left;
		}
	</style>
@parent
@endsection

@section('scripts')
    
     <script>

      $(function () {


      	/*para posicionar un combobox lo unico que hay que hacer es que el selector (select) tenga
      	un id y referirce a el de la forma en que esta abajo de este comentario. Entonces le decimos
      	que el select con id ESTA_ID se seleccione la opción que trae el campo ESTA_ID en el registro
      	de equipo

      	

      	*/	

	 	$( "#SEDE_ID" ).change(function() {
		  	
 		var opcion = $("#SEDE_ID").val();
	 		crsfToken = document.getElementsByName("_token")[0].value;

			$.ajax({
	             url: '../consultaSalas',
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
					
	                
	              },
	              error: function(json){
	                console.log("Error al crear evento");
	              }        
        	});


		});

	  });

	  function habilitar(id) {
	  	alert(id);
    if (id != "") {    
			document.getElementById("SALA_ID").disabled=false;
       
    }else {
    	//$("#SALA_ID").append('<option value="">Seleccione una sede..</option>');
    		//document.getElementById("SALA_ID").value="Seleccione una sede..";
  
    		document.getElementById("SALA_ID").disabled=true;    		
    	}
	}
    </script>

@endsection



<!-- Filtrar datos en vista -->

<div id="frm-find" class="col-xs-3 col-md-9 col-lg-9">
	<a class='btn btn-primary' role='button' data-toggle="collapse" data-target="#filters" href="#">
		<i class="fa fa-filter" aria-hidden="true"></i> 
		<span class="hidden-xs">Filtrar resultados</span>
		<span class="sr-only">Filtrar</span>
	</a>
</div>


<div id="filters" class="collapse">
	<div class="form-group col-xs-12 col-md-8">
	<form>
		

			<div class="input-group">
			<div class="input-group-addon">Sedes</div>
			<select name="SEDE_ID" id="SEDE_ID" class="form-control" required >
				<option value="">Seleccione..</option>
	            @foreach($sedes as $sede)
	            <option value="{{ $sede->SEDE_ID }}">{{ $sede->SEDE_DESCRIPCION }}</option>
	            @endforeach
	        </select>
		</div>

	
			<div class="input-group">			
			<div class="input-group-addon">Salas</div>
			<select name="SALA_ID" id="SALA_ID" class="form-control" required disabled>
				<option value="">Seleccione una sede..</option>
	            @foreach($salas as $sala)
	            <option value="{{ $sala->SALA_ID }}">{{ $sala->SALA_DESCRIPCION }}</option>
	            @endforeach
	        </select>
		</div>




		<div class="input-group has-feedback">
			<div class="input-group-addon control-label">Descripción</div>
			<input type="text"
				class="form-control"
				id= "DES_ID"
				placeholder="Por Descripción..."
			>
			
		</div>


				
	</form>
	</div>
</div>



