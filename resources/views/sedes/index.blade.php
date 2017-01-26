@extends('layout')
@section('title', '/ Sedes')
@include('datatable')
@section('content')

	<h1 class="page-header">Sedes</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('sedes/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Elemento
			</a>
		</div>
	</div>
	
<table class="table table-striped" id="tabla">
	<thead>
		<tr class="info">
			<th class="col-md-2">ID</th>
			<th class="col-md-2">Descripción</th>
			<th class="col-md-2">Dirección</th>
			<th class="col-md-2">Observaciones</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>


		@foreach($sedes as $sede)
		<tr>
			<td>{{ $sede -> SEDE_ID }}</td>
			<td>{{ $sede -> SEDE_DESCRIPCION }}</td>
			<td>{{ $sede -> SEDE_DIRECCION }}</td>
			<td>{{ $sede -> SEDE_OBSERVACIONES }}</td>
			<td>

				<!-- Botón Ver (show) -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('sedes/'.$sede->SEDE_ID) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a><!-- Fin Botón Ver (show) -->

				<!-- Botón Editar (edit) -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('sedes/'.$sede->SEDE_ID.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a><!-- Fin Botón Editar (edit) -->

				<!-- Botón Borrar (destroy) -->			
				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->				
									
										{{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i> Borrar',[
										'class'=>'btn btn-xs btn-danger',
										'data-toggle'=>'modal',
										'data-id'=>$sede -> SEDE_ID,
											'data-modelo'=>'sede',
											'data-descripcion'=>$sede -> SEDE_DESCRIPCION,
											'data-action'=>'sedes/'.$sede -> SEDE_ID,
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