@extends('layout')
@section('title', '/ Usuarios Locales')
@section('scripts')
    <script>
     $(function () {

     	/*
      	para realizar la paginacion de una tabla lo unico que hay que hacer es asignarle un id a la tabla,
      	en este caso el id es "tabla" e invocar la función Datatable, lo demas que ven sobre esta función
      	son configuraciones de presentación
      	HFG--Se Realiza ajuste de texto, otros atributos
      	*/
	 	$('#tabla').DataTable({  
	 		"lengthMenu": [[5, 10, 15, 25,50,100], [5, 10, 15, 25,50,100]],
	 		"sScrollY": "350px",
	        "pagingType": "full_numbers",
	        "bScrollCollapse": true,
	        rowReorder: {
            selector: 'td:nth-child(2)'
        		},
	        "responsive": true,
	    "language": { 
		    "sProcessing":     "Procesando...", 
		    "sLengthMenu":     "Mostrar _MENU_ registros", 
		    "sZeroRecords":    "No se encontraron resultados", 
		    "sEmptyTable":     "Ningún dato disponible en esta tabla", 
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", 
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros", 
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)", 
		    "sInfoPostFix":    "", 
		    "sSearch":         "Buscar:", 
		    "sUrl":            "", 
		    "sInfoThousands":  ",", 
		    "sLoadingRecords": "Cargando...", 
		    "oPaginate": { 
		        "sFirst":    "Primero", 
		        "sLast":     "Último", 
		        "sNext":     "Siguiente", 
		        "sPrevious": "Anterior"} 
   					 },	        
	 	});

	  });
    </script>
@endsection
@section('content')

	<h1 class="page-header">Usuarios Locales</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('roles') }}">
				<i class="fa fa-male" aria-hidden="true"></i> <i class="fa fa-female" aria-hidden="true"></i> Roles
			</a>
			<a class='btn btn-primary' role='button' href="{{ URL::to('register') }}">
				<i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo Usuario
			</a>
		</div>
	</div>
	
<table class="table table-striped" id="tabla">
		<thead>
			<tr class="active">
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
					<a class="btn btn-warning btn-xs" href="{{ URL::to('password/reset?USER_id='.$usuario->USER_id) }}">
						<i class="fa fa-key" aria-hidden="true"></i> <span class="hidden-xs">Contraseña</span>
					</a><!-- Fin Botón Contraseña (showResetForm) -->

					<!-- Botón Editar (edit) -->
					<a class="btn btn-info btn-xs" href="{{ URL::to('usuarios/'.$usuario->USER_ID.'/edit') }}">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span class="hidden-xs">Editar</span>
					</a><!-- Fin Botón Editar (edit) -->

					<!-- Botón Borrar (destroy) -->
					{{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i> <span class="hidden-xs">Borrar</span>',[
							'class'=>'btn btn-xs btn-danger',
							'data-toggle'=>'modal',
							'data-user_id'=>$usuario->USER_ID,
							'data-username'=>$usuario->username,
							'data-action'=>'usuarios/'.$usuario->USER_ID,
							'data-target'=>'#pregModalDelete',
						])
					}}


				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	@include('auth/index-modalDelete')
	
@endsection