@extends('layout')
@section('title', '/ Politicas')
@include('datatable')
@section('content')

	<h1 class="page-header">Politicas</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('politicas/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Elemento
			</a>
		</div>
	</div>
	
<table class="table table-striped" id="tabla">
	<thead>
		<tr class="info">
			<th class="col-md-2">ID</th>
			<th class="col-md-2">Descripción</th>
			<th class="col-md-2">Hora Mínima</th>
			<th class="col-md-2">Hora Maxima</th>
			<th class="col-md-2">Horas Mínima de Reserva</th>
			<th class="col-md-2">Días Mínimo de Cancelación</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>


		@foreach($politicas as $politica)
		<tr>
			<td>{{ $politica -> POLI_ID }}</td>
			<td>{{ $politica -> POLI_DESCRIPCION }}</td>			
			<td>{{ $politica -> POLI_HORA_MIN }}</td>
			<td>{{ $politica -> POLI_HORA_MAX }}</td>
			<td>{{ $politica -> POLI_HORAS_MIN_RESERVA }}</td>
			<td>{{ $politica -> POLI_DIAS_MIN_CANCELAR }}</td>
			<td>

				<!-- Botón Ver (show) -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('politicas/'.$politica->POLI_ID) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a><!-- Fin Botón Ver (show) -->

				<!-- Botón Editar (edit) -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('politicas/'.$politica->POLI_ID.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a><!-- Fin Botón Editar (edit) -->


				<!-- Botón Borrar (destroy) -->			
				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->				
									
										{{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i> Borrar',[
										'class'=>'btn btn-xs btn-danger',
										'data-toggle'=>'modal',
										'data-id'=>$politica -> POLI_ID,
											'data-modelo'=>'politica',
											'data-descripcion'=>$politica -> POLI_DESCRIPCION,
											'data-action'=>'politicas/'.$politica -> POLI_ID,
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