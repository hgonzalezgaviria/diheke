@extends('layout')
@section('title', '/ Salas')
@include('datatable')
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


	
	//CARGA DE COMBO POR JQUERY

	// #SEDE_ID is a <input type="text"> element
		$('#SEDE_ID').change(function () {
		    table1
		        .columns( 4 )
		        .search( $('#SEDE_ID option:selected').text() )
		        .draw();


	
		} );





	  });
		

    </script>
@parent
@endsection
@section('content')

	<h1 class="page-header">Salas</h1>
	<div class="row well well-sm">

	@include('salas/FormFilters')

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('salas/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nueva Sala
			</a>
		</div>
	</div>
	
<table class="table table-striped" id="tabla">
	<thead>
		<tr class="info">
			<th class="col-xs-1">ID</th>
			<th class="col-xs-2">Descripción</th>
			<th class="col-xs-1">Capacidad</th>
			<th class="col-xs-2">Estado</th>
			<th class="col-xs-2">Sede</th>
			<th class="col-xs-2">Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($salas as $i => $sala)
		<tr>
			<td>{{ $sala -> SALA_ID }}</td>
			<td>{{ $sala -> SALA_DESCRIPCION }}</td>
			<td>{{ $sala -> SALA_CAPACIDAD }}</td>
			<td>{{ $sala -> estado -> ESTA_DESCRIPCION }}</td>
			<td>{{ $sala -> sede -> SEDE_DESCRIPCION }}</td>
			<td>
				<!-- Botón Ver (show) -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('salas/'.$sala->SALA_ID) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a><!-- Fin Botón Ver (show) -->

				<!-- Botón Editar (edit) -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('salas/'.$sala->SALA_ID.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a><!-- Fin Botón Editar (edit) -->

	
	<!-- Botón Ocupar/reservar (salaparaequipos) -->		

	@if($sala->SALA_PRESTAMO)

		{{ Form::button('<i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Liberar',[
								'class'=>'btn btn-xs btn-default',
								'data-toggle'=>'modal',
								'data-sala_id'=>$sala -> SALA_ID,
								'data-action'=>'salas/' . $sala -> SALA_ID . '/reservarSalaEquipos',
								'data-target'=>'#pregModalReservar',
							])
						}}
		@else
	{{ Form::button('<i class="fa fa-calendar-minus-o" aria-hidden="true"></i> Ocupar ',[
								'class'=>'btn btn-xs btn-warning',
								'data-toggle'=>'modal',
								'data-sala_id'=>$sala -> SALA_ID,
								'data-action'=>'salas/' . $sala -> SALA_ID . '/reservarSalaEquipos',
								'data-target'=>'#pregModalReservar',
							])
						}}

		@endif
		<!-- FIN Botón Ocupar/reservar (salaparaequipos) -->					

				<!-- Botón Borrar (destroy) -->			
				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->				
									
										{{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i> Borrar',[
										'class'=>'btn btn-xs btn-danger',
										'data-toggle'=>'modal',
										'data-id'=>$sala -> SALA_ID,
											'data-modelo'=>'sala',
											'data-descripcion'=>$sala -> SALA_DESCRIPCION,
											'data-action'=>'salas/'.$sala -> SALA_ID,
											'data-target'=>'#pregModalDelete',
										]) }}
					<!-- Fin Botón Borrar (destroy) -->

				<!-- Botón Recursos -->	
					{{ Form::button('<i class="	fa fa-wrench" aria-hidden="true"></i> ',[
										'class'=>'btn btn-xs btn-default',
										'data-toggle'=>'modal',
										'data-id'=>$sala -> SALA_ID,
											'data-modelo'=>'sala',
											'data-index'=>$i, 
											'data-descripcion'=>$sala -> SALA_DESCRIPCION,
											'data-target'=>'#modalRecursos',
							]) }}

				<!-- FIN Botón Recursos -->	


				<!-- Botón Equipos -->	
					{{ Form::button('<i class="	fa fa-desktop" aria-hidden="true"></i>',[
										'class'=>'btn btn-xs btn-default',
										'data-toggle'=>'modal',
										'data-id'=>$sala -> SALA_ID,
											'data-modelo'=>'sala',
											'data-index'=>$i, 
											'data-descripcion'=>$sala -> SALA_DESCRIPCION,
											'data-target'=>'#modalEquipos',
							]) }}

				<!-- FIN Botón Equipos -->	

				
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

@include('salas/index-modalReservar')
@include('partials/modalDelete')
@include('salas/modalRecursos')
@include('salas/modalEquipos')
@endsection