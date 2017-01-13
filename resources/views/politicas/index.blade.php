@extends('layout')
@section('title', '/ Politicas')
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

	 	$('')

	 	/*
	 	$.msgBox({
					title:"Error",
					content:"¡Se ha producido un error, favor contacte al administrador!",
					type:"confirm"
				});
		*/

	  });
    </script>
@endsection
@section('content')

	<h1 class="page-header">Politicas</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('politicas/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Elemento
			</a>
		</div>
	</div>
	
<table class="table table-striped" id="tabla">
	<thead>
		<tr class="info">
			<th class="col-md-2">ID</th>
			<th class="col-md-2">Hora Mínima</th>
			<th class="col-md-2">Hora Maxima</th>
			<th class="col-md-2">Horas Mínima de Reserva</th>
			<th class="col-md-2">Días Mínimo de Cancelación</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>


		@foreach($politicas as $politica)
		<tr>
			<td>{{ $politica -> POLI_ID }}</td>
			<td>{{ $politica -> POLI_HORA_MIN }}</td>
			<td>{{ $politica -> POLI_HORA_MAX }}</td>
			<td>{{ $politica -> POLI_HORAS_MIN_RESERVA }}</td>
			<td>{{ $politica -> POLI_DIAS_MIN_CANCELAR }}</td>
			<td>

				<!-- Botón Ver (show) -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('politicas/'.$politica->POLI_ID) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a><!-- Fin Botón Ver (show) -->

				<!-- Botón Editar (edit) -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('politicas/'.$politica->POLI_ID.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a><!-- Fin Botón Editar (edit) -->

				<!-- Botón Borrar (destroy) -->
				{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Borrar',[
						'class'=>'btn btn-xs btn-danger',
						'data-toggle'=>'modal',
						'data-target'=>'#pregModal'.$politica -> POLI_ID ])
						}}

				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->
				<div class="modal fade" id="pregModal{{ $politica -> POLI_ID }}" role="dialog" tabindex="-1" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">¿Borrar?</h4>
							</div>
							<div class="modal-body">
								<p>
									<i class="fa fa-exclamation-triangle"></i> ¿Desea borrar el registro {{ $politica -> POLI_ID }}?
								</p>
							</div>
							<div class="modal-footer">
									{{ Form::open(array('url' => 'politicas/'.$politica->POLI_ID, 'class' => 'pull-right')) }}
										{{ Form::hidden('_method', 'DELETE') }}
										{{ Form::button(' NO ', ['class'=>'btn btn-xs btn-success', 'type'=>'button','data-dismiss'=>'modal']) }}
										{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> SI',[
											'class'=>'btn btn-xs btn-danger',
											'type'=>'submit',
											'data-toggle'=>'modal',
											'data-backdrop'=>'static',
											'data-target'=>'#msgModal',
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