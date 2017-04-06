@extends('layout')
@section('title', '/ Usuarios Locales')
@include('datatable')
@section('content')

	<h1 class="page-header">Usuarios Locales</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<!-- botón de importar usuarios -->
			@include('auth/index-modal-import')

			<a class='btn btn-primary' role='button' href="{{ URL::to('roles') }}">
				<i class="fa fa-male" aria-hidden="true"></i> <i class="fa fa-female" aria-hidden="true"></i>
				Roles<span class="hidden-xs"></span>
			</a>
			<a class='btn btn-primary' role='button' href="{{ URL::to('register') }}">
				<i class="fa fa-user-plus" aria-hidden="true"></i>
				Nuevo<span class="hidden-xs"> Usuario</span>
			</a>
		</div>
	</div>
	
<table class="table table-striped" id="tabla">
		<thead>
			<tr class="info">
				<th class="col-xs-1 col-sm-1 col-md-1 col-lg-1">ID</th>
				<th class="col-xs-4 col-sm-4 col-md-4 col-lg-2">Nombre</th>
				<th class="col-xs-2 col-sm-1 col-md-1 col-lg-1">Login</th>
				<th class="col-xs-2 col-sm-1 col-md-1 col-lg-1">Rol</th>
				<th class="hidden-xs col-sm-1 col-md-1 col-lg-1">Creador</th>
				<th class="col-xs-1 col-sm-4 col-md-4 col-lg-4">Acciones</th>
			</tr>
		</thead>
		<tbody>


			@foreach($usuarios as $usuario)
			<tr>
				<td>{{ $usuario -> USER_ID }}</td>
				<td>{{ $usuario -> name }}</td>
				<td>{{ $usuario -> username }}</td>
				<td>{{ $usuario -> rol -> ROLE_DESCRIPCION }}</td>
				<td class="hidden-xs">{{ $usuario -> USER_CREADOPOR }}</td>
				<td>

					{{-- <!-- Botón Ver (show) -->
					<a class="btn btn-success btn-xs" href="{{ URL::to('usuarios/'.$usuario->USER_ID) }}">
						<span class="glyphicon glyphicon-eye-open"></span> <span class="hidden-xs">Ver</span>
					</a><!-- Fin Botón Ver (show) --> --}}

					{{-- <!-- Botón Contraseña (sendResetLinkEmail) -->
					<a class="btn btn-warning btn-xs" href="{{ URL::to('password/email/'.$usuario->USER_ID) }}">
						<i class="fa fa-envelope" aria-hidden="true"></i> <span class="hidden-xs">Contraseña</span>
					</a><!-- Fin Botón Contraseña (sendResetLinkEmail) --> --}}

					<!-- Botón Contraseña (showResetForm) -->
					<a class="btn btn-warning btn-xs" href="{{ URL::to('password/reset?USER_ID='.$usuario->USER_ID) }}">
						<i class="fa fa-key" aria-hidden="true"></i> <span class="hidden-xs">Contraseña</span>
					</a><!-- Fin Botón Contraseña (showResetForm) -->

					<!-- Botón Editar (edit) -->
					<a class="btn btn-info btn-xs" href="{{ URL::to('usuarios/'.$usuario->USER_ID.'/edit') }}">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span class="hidden-xs">Editar</span>
					</a><!-- Fin Botón Editar (edit) -->


					<!-- Botón Borrar (destroy) -->			
				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->				
									
										{{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i> <span class="hidden-xs">Borrar</span>',[
										'class'=>'btn btn-xs btn-danger',
										'data-toggle'=>'modal',
										'data-id'=>$usuario->USER_ID,
											'data-modelo'=>'usuario',
											'data-descripcion'=>$usuario->username,
											'data-action'=>'usuarios/'.$usuario->USER_ID,
											'data-target'=>'#pregModalDelete',
										]) }}
					<!-- Fin Botón Borrar (destroy) -->

	


				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{--@include('auth/index-modalDelete')--}}
	@include('partials/modalDelete') <!-- incluye el modal del Delete -->	
@endsection