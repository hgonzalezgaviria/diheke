@extends('layout')
@section('title', '/ Equipos')

@section('scripts')
    <script>

      $(function () {

      	/*
      	para realizar la paginacion de una tabla lo unico que hay que hacer es asignarle un id a la tabla,
      	en este caso el id es "tabla" e invocar la función Datatable, lo demas que ven sobre esta función
      	son configuraciones de presentación
      	*/
	 	var table = $('#tabla').DataTable({  
	 		"lengthMenu": [[5, 10, 15, 25,50,100], [5, 10, 15, 25,50,100]],
	 		//"sScrollY": "350px",
	        "pagingType": "full_numbers",
	        "bScrollCollapse": true,
		    "language": { 
			    "sProcessing":     "Procesando...", 
			    "sLengthMenu":     "Mostrar _MENU_ registros", 
			    "sZeroRecords":    "No se encontraron resultados", 
			    "sEmptyTable":     "Ningún dato disponible en esta tabla", 
			    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", 
			    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros", 
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)", 
			    "sInfoPostFix":    "", 
			    "sSearch":         "Buscar:", 
			    "sUrl":            "", 
			    "sInfoThousands":  ",", 
			    "sLoadingRecords": "Cargando...", 
			    "oPaginate": { 
			        "sFirst":    "Primero", 
			        "sLast":     "Último", 
			        "sNext":     "Siguiente", 
			        "sPrevious": "Anterior"
			    }
			},
        	dom: 'Bfrtip',
	        buttons: [
	            'copyHtml5',
	            'excelHtml5',
	            'csvHtml5',
	            'pdfHtml5'
	        ]        
	 	});

	 	

	//BUSQUEDA POR COLUMNA

		// #SEDE_ID is a <input type="text"> element
		$('#DES_ID').on( 'keyup', function () {
		    table
		        .columns( 1 )
		        .search( this.value )
		        .draw();
		} );


		// #SEDE_ID is a <input type="text"> element
		$('#SALA_ID').change(function () {
		    table
		        .columns( 4 )
		        .search( $('#SALA_ID option:selected').text() )
		        .draw();
		} );

	//CARGA DE COMBO POR JQUERY

	// #SEDE_ID is a <input type="text"> element
		$('#SEDE_ID').change(function () {
		    table
		        .columns( 3 )
		        .search( $('#SEDE_ID option:selected').text() )
		        .draw();




	 	crsfToken = document.getElementsByName("_token")[0].value;
 		var opcion = $("#SEDE_ID").val();
			$.ajax({
	             url: 'consultaSalas',
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
        	}); //Fin ajax
		} );





	  });

    </script>
@endsection

@section('content')


	<h1 class="page-header">Equipos</h1>
	<div class="row well well-sm">

		@include('equipos/FormFilters')

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('equipos/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Equipo
			</a>
		</div>
	</div>
	
<table class="table table-striped" id="tabla">
	<thead>
		<tr class="info">
			<th class="col-md-2">ID</th>
			<th class="col-md-2">Descripción</th>
			<th class="col-md-2">Observaciones</th>
			<th class="col-md-2">Sede</th>
			<th class="col-md-2">Sala</th>
			<th class="col-md-2">Estado</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>


		@foreach($equipos as $equipo)
		<tr>
			<td>{{ $equipo -> EQUI_ID }}</td>
			<td>{{ $equipo -> EQUI_DESCRIPCION }}</td>
			<td>{{ $equipo -> EQUI_OBSERVACIONES }}</td>
			<td>{{ $equipo -> sala -> sede -> SEDE_DESCRIPCION }}</td>
			<td>{{ $equipo -> sala -> SALA_DESCRIPCION }}</td>			
			<td>{{ $equipo -> estado -> ESTA_DESCRIPCION }}</td>

			<td>

				<!-- Botón Ver (show) -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('equipos/'.$equipo->EQUI_ID) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a><!-- Fin Botón Ver (show) -->

				<!-- Botón Editar (edit) -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('equipos/'.$equipo->EQUI_ID.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a><!-- Fin Botón Editar (edit) -->

				<!-- Botón Borrar (destroy) -->
				{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Borrar',[
						'class'=>'btn btn-xs btn-danger',
						'data-toggle'=>'modal',
						'data-target'=>'#pregModal'.$equipo -> EQUI_ID ])
						}}

				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->
				<div class="modal fade" id="pregModal{{ $equipo -> EQUI_ID }}" role="dialog" tabindex="-1" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">¿Borrar?</h4>
							</div>
							<div class="modal-body">
								<p>
									<i class="fa fa-exclamation-triangle"></i> ¿Desea borrar el registro {{ $equipo -> EQUI_ID }}?
								</p>
							</div>
							<div class="modal-footer">
									{{ Form::open(array('url' => 'equipos/'.$equipo->EQUI_ID, 'class' => 'pull-right')) }}
										{{ Form::hidden('_method', 'DELETE') }}
										{{ Form::button(' NO ', ['class'=>'btn btn-xs btn-success', 'type'=>'button','data-dismiss'=>'modal']) }}
										{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> SI',[
											'class'=>'btn btn-xs btn-danger',
											'type'=>'submit',
											'data-toggle'=>'modal',
											'data-backdrop'=>'static',
											'data-target'=>'#msgModal',
										]) }}
									{{ Form::close() }}
							</div>
				  		</div>
					</div>
				</div><!-- Fin Botón Borrar (destroy) -->

			</td>
		</tr>
		@endforeach
	</tbody>
</table>




@endsection