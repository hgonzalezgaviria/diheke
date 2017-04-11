@extends('layout')
@section('title', '/ Festivos')
@include('datatable')
@section('content')

	<h1 class="page-header">Festivos</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<!-- botón de importar usuarios -->
			@include('festivos/index-modal-import')

	
			<a class='btn btn-primary' role='button' href="{{ URL::to('festivos/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Día Festivo
			</a>
		</div>
	</div>
	
<table class="table table-striped" id="tabla">
	<thead>
		<tr class="info">
			<th class="col-md-2">ID</th>
			<th class="col-md-2">Fecha</th>
			<th class="col-md-2">Descripción</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>
		@foreach($festivos as $festivo)
		<tr>
			<td>{{ $festivo -> FEST_ID }}</td>
			<td>{{ $festivo -> FEST_FECHA }}</td>
			<td>{{ $festivo -> FEST_DESCRIPCION }}</td>
			<td>

			<!-- Muestra este registro (Utiliza método show encontrado en GET /reservas/{reserva_id}/pregs/{id} -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('festivos/'.$festivo->FEST_ID) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a>

				<!-- Edita este registro (Utiliza método edit encontrado en GET /reservas/{reserva_id}/pregs/{id}/edit -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('festivos/'.$festivo->FEST_ID.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a>

				<!-- Botón Borrar (destroy) -->			
				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->				
									
										{{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i> Borrar',[
										'class'=>'btn btn-xs btn-danger',
										'data-toggle'=>'modal',
										'data-id'=>$festivo->FEST_ID,
											'data-modelo'=>'festivo',
											'data-descripcion'=>$festivo -> FEST_DESCRIPCION,
											'data-action'=>'festivos/'.$festivo->FEST_ID,
											'data-target'=>'#pregModalDelete',
										]) }}
					<!-- Fin Botón Borrar (destroy) -->

							
				
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

@include('partials/modalDelete') <!-- incluye el modal del Delete -->
@endsection
