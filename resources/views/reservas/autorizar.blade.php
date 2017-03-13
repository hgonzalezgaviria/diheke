@extends('layout')
@section('title', '/ Autorizar Reservas')
@include('datatable')
@section('content')

	<h1 class="page-header">Autorizar Reservas</h1>
		
	<table class="table table-striped" id="tabla">
		<thead>
			<tr class="info">
				<th class="col-md-2">ID</th>
				<th class="col-md-2">Título</th>
				<th class="col-md-2">Fecha inicio</th>
				<th class="col-md-2">Fecha fin</th>
				<th class="col-md-2">Sala</th>
				<th class="col-md-2">Creado por</th>
				<th class="col-md-2">Acciones</th>

			</tr>
		</thead>
		<tbody>
			@foreach($reservas as $reserva)
			<tr>
				<td>{{ $reserva -> RESE_ID }}</td>
				<td>{{ $reserva -> RESE_TITULO }}</td>
				<td>{{ $reserva -> RESE_FECHAINI }}</td>			
				<td>{{ $reserva -> RESE_FECHAFIN }}</td>
				<td>{{ $reserva -> sala -> SALA_DESCRIPCION }}</td>
				<td>{{ $reserva -> RESE_CREADOPOR }}</td>
				<td>

					<!-- Botón Ver (show) -->
					<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('autorizarReservas/'.$reserva->RESE_ID) }}">
						<span class="glyphicon glyphicon-eye-open"></span> Aprobar
					</a><!-- Fin Botón Ver (show) -->

					<!-- Botón Borrar (destroy) -->
					{{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i> Rechazar',[
						'class'=>'btn btn-xs btn-danger',
						'data-toggle'=>'modal',
						'data-id'=>$reserva->RESE_ID,
						'data-modelo'=>'politica',
						'data-descripcion'=>$reserva->RESE_DESCRIPCION,
						'data-action'=>'politicas/'.$reserva->RESE_ID,
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