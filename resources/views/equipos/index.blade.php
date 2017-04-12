@extends('layout')
@section('title', '/ Equipos')
@include('datatableExport')
@section('scripts')
    <script>


     $(document).ready(function (){

     	var table1 = $('#tabla').DataTable();

      	
	//BUSQUEDA POR COLUMNA

		// #SEDE_ID is a <input type="text"> element
		$('#DES_ID').on( 'keyup', function () {
		    table1
		        .columns( 1 )
		        .search( this.value )
		        .draw();
		} );


		// #SEDE_ID is a <input type="text"> element
		$('#SALA_ID').change(function () {
		    table1
		        .columns( 4 )
		        .search( $('#SALA_ID option:selected').text() )
		        .draw();
		} );

	//CARGA DE COMBO POR JQUERY

	// #SEDE_ID is a <input type="text"> element
		$('#SEDE_ID').change(function () {
		    table1
		        .columns( 3 )
		        .search( $('#SEDE_ID option:selected').text() )
		        .draw();


		        	//Habilitar selector de Salas

			 
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

	//Obtener fecha del sistemas
		var name="ReporteEquipos";
		var title="Reporte De Equipos";
		var columnss= [ 0, 1, 2, 3,4,5 ];
		function fecha(){
				var hoy = new Date();
				var dd = hoy.getDate();
				var mm = hoy.getMonth()+1; //hoy es 0!
				var yyyy = hoy.getFullYear();
				var hora = hoy.getHours();
				var minuto = hoy.getMinutes();
				var segundo = hoy.getSeconds(); 

				if(dd<10) {
				    dd='0'+dd
				} 

				if(mm<10) {
				    mm='0'+mm
				} 

				//hoy = mm+'/'+dd+'/'+yyyy;
				hoy = yyyy+mm+dd+'_'+hora+minuto+segundo;

				return hoy;
		}

		

    </script>
@parent
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
	
{{ Form::open(['id'=>'indexequi' , 'class' => 'form-vertical']) }}
<!--<table class="table table-striped" id="tabla">-->
<table class="table table-striped table-bordered dt-responsive nowrap" id="tabla">
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
				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->				
									
										{{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i> Borrar',[
										'class'=>'btn btn-xs btn-danger',
										'data-toggle'=>'modal',
										'data-id'=>$equipo->EQUI_ID,
											'data-modelo'=>'equipo',
											'data-descripcion'=>$equipo->EQUI_DESCRIPCION,
											'data-action'=>'equipos/'.$equipo->EQUI_ID,
											'data-target'=>'#pregModalDelete',
										]) }}
					<!-- Fin Botón Borrar (destroy) -->

			</td>
		</tr>
		@endforeach
	</tbody>
	{{ Form::close() }}
</table>



@include('partials/modalDelete')
@endsection