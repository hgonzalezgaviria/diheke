@extends('layout')
@section('title', '/ Autorizar Reservas')
@include('datatable')
@section('content')

	<h1 class="page-header">Autorizar Reservas</h1>
		
	<table class="table table-striped" id="tabla">
		<thead>
			<tr class="info">
				<th class="col-md-2">ID</th>
				<th class="col-md-2">Fecha solicitud</th>
				<th class="col-md-2">Total reservas</th>
				<th class="col-md-2">Creado por</th>
				<th class="col-md-2">Acciones</th>

			</tr>
		</thead>
		<tbody>
			@foreach($pendientesAprobar as $autorizacion)
			<tr>
				<td>{{ $autorizacion -> AUTO_ID }}</td>
				<td>{{ $autorizacion -> AUTO_FECHASOLICITUD }}</td>
				<td>{{ count( $autorizacion -> reservas ) }}</td>
				<td>{{ $autorizacion -> AUTO_CREADOPOR }}</td>
				<td>

					<!-- Botón Aprobar -->
					{{ Form::button('<i class="fa fa-calendar-check-o" aria-hidden="true"></i> Aprobar',[
						'class'=>'btn btn-xs btn-success',
						'data-toggle'=>'modal',
						'data-id'=>$autorizacion->AUTO_ID,
						'data-accion'=>'aprobar',
						'data-target'=>'#pregModal',
					]) }}
					<!-- Botón Rechazar -->
					{{ Form::button('<i class="fa fa-calendar-times-o" aria-hidden="true"></i> Rechazar',[
						'class'=>'btn btn-xs btn-danger',
						'data-toggle'=>'modal',
						'data-id'=>$autorizacion->AUTO_ID,
						'data-accion'=>'rechazar',
						'data-target'=>'#pregModal',
					]) }}
					
							<!-- Botón Anular -->
					{{ Form::button('<i class="fa fa-calendar-times-o" aria-hidden="true"></i> Anular',[
						'class'=>'btn btn-xs btn-warning',
						'data-toggle'=>'modal',
						'data-id'=>$autorizacion->AUTO_ID,
						'data-accion'=>'anular',
						'data-target'=>'#pregModal',
					]) }}

					<!-- Botón Detalle reserva -->
					{{ Form::button('<i class="fa fa-calendar-times-o" aria-hidden="true"></i> Detalle Reserva',[
						'class'=>'btn btn-xs btn-info',
						'data-toggle'=>'modal',
						'data-id'=>$autorizacion->AUTO_ID,
						'data-accion'=>'rechazar',
						'data-target'=>'#modalReserva',
					]) }}


				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

@include('reservas/autorizar-modal')
@include('reservas/detalleReserva-modal')
@endsection