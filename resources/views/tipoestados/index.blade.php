@extends('layout')
@section('title', '/ Tipos de Estados')
@include('datatable')
@section('content')

	<h1 class="page-header">Tipos de Estados</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('tipoestados/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Tipo de Estado
			</a>
		</div>
	</div>
	
<table class="table table-striped" id="tabla">
	<thead>
		<tr class="info">
			<th class="col-md-2">ID</th>
			<th class="col-md-2">Tipo de Estado</th>
			<th class="col-md-2">Observaciones</th>
			<th class="col-md-2">Creado por</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>
		@foreach($tipoestados as $tipoestado)
		<tr>
			<td>{{ $tipoestado -> TIES_ID }}</td>
			<td>{{ $tipoestado -> TIES_DESCRIPCION }}</td>
			<td>{{ $tipoestado -> TIES_OBSERVACIONES }}</td>
			<td>{{ $tipoestado -> TIES_CREADOPOR }}</td>
			<td>

			<!-- Muestra este registro (Utiliza método show encontrado en GET /reservas/{reserva_id}/pregs/{id} -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('tipoestados/'.$tipoestado->TIES_ID) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a>

				<!-- Edita este registro (Utiliza método edit encontrado en GET /reservas/{reserva_id}/pregs/{id}/edit -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('tipoestados/'.$tipoestado->TIES_ID.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a>

				<!-- Botón Borrar (destroy) -->			
				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->				
									
										{{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i> Borrar',[
										'class'=>'btn btn-xs btn-danger',
										'data-toggle'=>'modal',
										'data-id'=>$tipoestado->TIES_ID,
											'data-modelo'=>'tipoestado',
											'data-descripcion'=>$tipoestado -> TIES_DESCRIPCION,
											'data-action'=>'tipoestados/'.$tipoestado->TIES_ID,
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
