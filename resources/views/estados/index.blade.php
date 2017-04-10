@extends('layout')
@section('title', '/ Estados')

@include('datatable')

@section('content')

	<h1 class="page-header">Estados</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('estados/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Estado
			</a>
		</div>
	</div>
	
	<table class="table table-striped" id="tabla">
		<thead>
			<tr class="info">
				<th class="col-md-2">ID</th>
				<th class="col-md-2">Descripción</th>
				<th class="col-md-2">Tipo de Estado</th>
				<th class="col-md-2">Creado por</th>
				<th class="col-md-2">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($estados as $estado)
			<tr>
				<td>{{ $estado -> ESTA_ID }}</td>
				<td>{{ $estado -> ESTA_DESCRIPCION }}</td>
				<td>{{ $estado -> tipoEstado -> TIES_DESCRIPCION  }}</td>
				<td>{{ $estado -> ESTA_CREADOPOR }}</td>
				<td>

					<!-- Muestra este registro (Utiliza método show encontrado en GET /reservas/{reserva_id}/pregs/{id} -->
					<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('estados/'.$estado->ESTA_ID) }}">
						<span class="glyphicon glyphicon-eye-open"></span> Ver
					</a>

					<!-- Edita este registro (Utiliza método edit encontrado en GET /reservas/{reserva_id}/pregs/{id}/edit -->
					<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('estados/'.$estado->ESTA_ID.'/edit') }}">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
					</a>

					<!-- Botón Borrar (destroy) -->
					{{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i> Borrar',[
							'class'=>'btn btn-xs btn-danger',
							'data-toggle'=>'modal',
							'data-id'=>$estado->ESTA_ID,
							'data-modelo'=>'estado',
							'data-descripcion'=>$estado->ESTA_DESCRIPCION,
							'data-action'=>'estados/'.$estado->ESTA_ID,
							'data-target'=>'#pregModalDelete',
						])
					}}
					
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>


@include('partials/modalDelete')
@endsection
