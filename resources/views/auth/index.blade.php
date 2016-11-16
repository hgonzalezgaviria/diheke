@extends('layout')
@section('title', '/ Usuarios Locales')

@section('content')

	<h1 class="page-header">Usuarios Locales</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('register') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Usuario
			</a>
		</div>
	</div>
	
<table class="table table-striped">
	<thead>
		<tr>
			<th class="col-md-2">ID</th>
			<th class="col-md-2">Nombre</th>
			<th class="col-md-2">Login</th>
			<th class="col-md-2">Rol</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>


		@foreach($usuarios as $usuario)
		<tr>
			<td>{{ $usuario -> id }}</td>
			<td>{{ $usuario -> name }}</td>
			<td>{{ $usuario -> username }}</td>
			<td>{{ $usuario -> role }}</td>
			<td>

				<!-- Botón Ver (show) -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('usuarios/'.$usuario->id) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a><!-- Fin Botón Ver (show) -->

				<!-- Botón Editar (edit) -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('usuarios/'.$usuario->id.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a><!-- Fin Botón Editar (edit) -->

				<!-- Botón Borrar (destroy) -->
				{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Borrar',[
						'class'=>'btn btn-xs btn-danger',
						'data-toggle'=>'modal',
						'data-target'=>'#pregModal'.$usuario -> id ])
						}}

				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->
				<div class="modal fade" id="pregModal{{ $usuario -> id }}" role="dialog" tabindex="-1" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">¿Borrar?</h4>
							</div>
							<div class="modal-body">
								<p>
									<i class="fa fa-exclamation-triangle"></i> ¿Desea borrar el usuario {{ $usuario -> username }}?
								</p>
							</div>
							<div class="modal-footer">
									{{ Form::open( ['url' => 'usuarios/'.$usuario->id, 'class' => 'pull-right'] ) }}
										{{ Form::hidden('_method', 'DELETE') }}
										{{ Form::button(' NO ', ['class'=>'btn btn-xs btn-success', 'type'=>'button','data-dismiss'=>'modal']) }}
										{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> SI',[
											'class'=>'btn btn-xs btn-danger',
											'type'=>'submit',
										]) }}
									{{ Form::close() }}
							</div>
				  		</div>
					</div>
				</div><!-- Fin Botón Borrar (destroy) -->

			</td>
		</tr>
		@endforeach
	</tbody>
</table>




@endsection