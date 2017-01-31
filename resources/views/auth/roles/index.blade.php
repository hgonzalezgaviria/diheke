@extends('layout')
@section('title', '/ Roles')
@include('datatable')

@section('content')

	<h1 class="page-header">Roles</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('roles/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Rol
			</a>
		</div>
	</div>
	
<table class="table table-striped" id="tabla">
	<thead>
		<tr class="info">
			<th class="col-md-2">ID</th>
			<th class="col-md-2">Descripción</th>
			<th class="col-md-2">Creado por</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>


		@foreach($roles as $rol)
		<tr>
			<td>{{ $rol -> ROLE_ID }}</td>
			<td>{{ $rol -> ROLE_DESCRIPCION }}</td>
			<td>{{ $rol -> ROLE_CREADOPOR }}</td>
			<td>

				<!-- Botón Editar (edit) -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('roles/'.$rol->ROLE_ID.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a><!-- Fin Botón Editar (edit) -->


				<!-- Botón Borrar (destroy) -->			
				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->				
									
										{{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i> Borrar',[
										'class'=>'btn btn-xs btn-danger',
										'data-toggle'=>'modal',
										'data-id'=>$rol -> ROLE_ID,
											'data-modelo'=>'rol',
											'data-descripcion'=>$rol -> ROLE_DESCRIPCION,
											'data-action'=>'roles/'.$rol -> ROLE_ID,
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