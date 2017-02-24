@extends('layout')
@section('title', '/ Recursos')
@include('datatable')
@section('content')

	<h1 class="page-header">Recursos</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('recursos/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Recurso
			</a>
		</div>
	</div>

	
<table class="table table-striped" id="tabla">
	<thead>
		<tr class="info">
			<th class="col-md-1">ID</th>
			<th class="col-md-1">Descripción</th>
			<th class="col-md-2">Versión</th>
			<th class="col-md-2">Observaciones</th>
			
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>
		@foreach($recursos as $i => $recurso)
		<tr>
			<td>{{ $recurso -> RECU_ID }}</td>
			<td>{{ $recurso -> RECU_DESCRIPCION }}</td>
			<td>{{ $recurso -> RECU_VERSION }}</td>
			<td>{{ $recurso -> RECU_OBSERVACIONES }}</td>
			
		{{--dd( $recursos[$i]['salas'])--}}
		{{--dd( $i -> salas-> sala['SALA_DESCRIPCION'])--}}
			
			<td>


				<!-- Muestra este registro (Utiliza método show encontrado en GET /reservas/{reserva_id}/pregs/{id} -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('recursos/'.$recurso->RECU_ID) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a>

				<!-- Edita este registro (Utiliza método edit encontrado en GET /reservas/{reserva_id}/pregs/{id}/edit -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('recursos/'.$recurso->RECU_ID.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a>

				<!-- Botón Borrar (destroy) -->			
				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->				
									
										{{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i> Borrar',[
										'class'=>'btn btn-xs btn-danger',
										'data-toggle'=>'modal',
										'data-id'=>$recurso->RECU_ID,
											'data-modelo'=>'recurso',
											'data-descripcion'=>$recurso -> RECU_DESCRIPCION,
											'data-action'=>'recursos/'.$recurso->RECU_ID,
											'data-target'=>'#pregModalDelete',
										]) }}
					<!-- Fin Botón Borrar (destroy) -->
			
				<!-- Botón Borrar (destroy) -->			
				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->				
									
										{{ Form::button('<i class="	fa fa-external-link" aria-hidden="true"></i> Salas',[
										'class'=>'btn btn-xs btn-default',
										'data-toggle'=>'modal',
										'data-id'=>$recurso->RECU_ID,
											'data-modelo'=>'recurso',
											'data-index'=>$i, 
											'data-descripcion'=>$recurso -> RECU_DESCRIPCION,
											'data-target'=>'#modalSalas',
										]) }}
					<!-- Fin Botón Borrar (destroy) -->
			
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

@include('partials/modalDelete')
@include('recursos/modalSalas')
@endsection
