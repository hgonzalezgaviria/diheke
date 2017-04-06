@extends('layout')
@section('title', '/ Roles')
@include('datatable')

@section('content')

	<h1 class="page-header">Roles</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
	        <a class="btn btn-warning" role="button" href="{{ URL::to('usuarios/') }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>
			<a class='btn btn-primary' role='button' href="{{ URL::to('roles/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Rol
			</a>
		</div>
	</div>
	
	<table class="table table-striped">
		<thead>
			<tr>
				<th class="col-md-2">ID</th>
				<th class="col-md-2">Descripción</th>
				<th class="col-md-1">Usuarios</th>
				<th class="col-md-2">Creado por</th>
				<th class="col-md-2">Acciones</th>

			</tr>
		</thead>
		<tbody>


			@foreach($roles as $rol)
			<tr>
				<td>{{ $rol -> ROLE_ID }}</td>
				<td>{{ $rol -> ROLE_DESCRIPCION }}</td>
				<td>{{ $rol -> usuarios -> count() }}</td>
				<td>{{ $rol -> ROLE_CREADOPOR }}</td>
				<td>

					<!-- Botón Editar (edit) -->
					<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('roles/'.$rol->ROLE_ID.'/edit') }}">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
					</a><!-- Fin Botón Editar (edit) -->

					<!-- Botón Borrar (destroy) -->
					{{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i> <span class="-hidden-xs">Borrar</span>',[
							'class'=>'btn btn-xs btn-danger',
							'data-toggle'=>'modal',
							'data-id'=>$rol->ROLE_ID ,
							'data-count-users'=>$rol->usuarios->count(),
							'data-modelo'=>$rol->ROLE_DESCRIPCION,
							'data-action'=>'roles/'.$rol->ROLE_ID,
							'data-target'=>'#pregModalDelete',
						])
					}}

				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	@include('auth/roles/index-modalDelete')
@endsection