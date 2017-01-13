@extends('layout')
@section('title', '/ Crear Equipo')
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

    </script>

@endsection
@section('content')

	<h1 class="page-header">Nuevo Equipo</h1>

	@include('partials/errors')
	
		{{ Form::open(array('url' => 'equipos', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('EQUI_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('EQUI_DESCRIPCION', old('EQUI_DESCRIPCION'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('EQUI_OBSERVACIONES', 'Observaciones') }} 
			{{ Form::textarea('EQUI_OBSERVACIONES', old('EQUI_OBSERVACIONES'), array('class' => 'form-control', 'max' => '300', 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('sede', 'Sede') }} 
			<select name="SEDE_ID" id="SEDE_ID" class="form-control" required>
				<option value="">Seleccione..</option>
	            @foreach($sedes as $sede)
	            <option value="{{ $sede->SEDE_ID }}">{{ $sede->SEDE_DESCRIPCION }}</option>
	            @endforeach
	        </select>
		</div>

		<div class="form-group">
			{{ Form::label('sala', 'Sala') }} 
			<select name="SALA_ID" id="SALA_ID" class="form-control" required>
				<option value="">Seleccione..</option>
	            @foreach($salas as $sala)
	            <option value="{{ $sala->SALA_ID }}">{{ $sala->SALA_DESCRIPCION }}</option>
	            @endforeach
	        </select>
		</div>

		<div class="form-group">
			{{ Form::label('estado', 'Estado') }} 
			<select name="ESTA_ID" id="ESTA_ID" class="form-control" required>
				<option value="">Seleccione..</option>
	            @foreach($estados as $estado)
	            <option value="{{ $estado->ESTA_ID }}">{{ $estado->ESTA_DESCRIPCION }}</option>
	            @endforeach
	        </select>
		</div>




		<!-- Botones -->
		<div class="text-right">
			{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
			<a class="btn btn-warning" role="button" href="{{ URL::to('equipos') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
		</div>

		
		{{ Form::close() }}
@endsection
