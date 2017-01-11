@extends('layout')
@section('title', '/ Recursos')
@section('scripts')
    <script>
     $(function () {

      	/*
      	para realizar la paginacion de una tabla lo unico que hay que hacer es asignarle un id a la tabla,
      	en este caso el id es "tabla" e invocar la función Datatable, lo demas que ven sobre esta función
      	son configuraciones de presentación
      	*/
	 	$('#tabla').DataTable({  
	        "sScrollY": "350px",
	        "pagingType": "full_numbers",
	        "bScrollCollapse": true,
	 	});

	  });
    </script>
@endsection

@section('content')

	<h1 class="page-header">Recursos</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('recursos/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Recurso
			</a>
		</div>
	</div>

	
<table class="table table-striped" id="tabla">
	<thead>
		<tr class="info">
			<th class="col-md-1">ID</th>
			<th class="col-md-1">Descripción</th>
			<th class="col-md-2">Versión</th>
			<th class="col-md-2">Observaciones</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>
		@foreach($recursos as $recurso)
		<tr>
			<td>{{ $recurso -> RECU_ID }}</td>
			<td>{{ $recurso -> RECU_DESCRIPCION }}</td>
			<td>{{ $recurso -> RECU_VERSION }}</td>
			<td>{{ $recurso -> RECU_OBSERVACIONES }}</td>
			<td>


				<!-- Muestra este registro (Utiliza método show encontrado en GET /reservas/{reserva_id}/pregs/{id} -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('recursos/'.$recurso->RECU_ID) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a>

				<!-- Edita este registro (Utiliza método edit encontrado en GET /reservas/{reserva_id}/pregs/{id}/edit -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('recursos/'.$recurso->RECU_ID.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a>

				<!-- Botón Borrar (destroy) -->
				{{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i> Borrar',[
						'class'=>'btn btn-xs btn-danger',
						'data-toggle'=>'modal',
						'data-target'=>'#pregModal'.$recurso->RECU_ID ])
						}}

				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->
				<div class="modal fade" id="pregModal{{ $recurso->RECU_ID }}" role="dialog" tabindex="-1" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">¿Borrar?</h4>
							</div>
							<div class="modal-body">
								<p>
									<i class="fa fa-exclamation-triangle"></i> ¿Desea borrar el Recurso {{ $recurso -> RECU_DESCRIPCION }}?
								</p>
							</div>
							<div class="modal-footer">
										{{ Form::open(array('url' => 'recursos/'.$recurso->RECU_ID, 'class' => 'pull-right')) }}
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
