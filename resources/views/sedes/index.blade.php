@extends('layout')
@section('title', '/ Espacios Físicos')

@section('content')

	<h1 class="page-header">Espacios Físicos</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('espaciofisico/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Elemento
			</a>
		</div>
	</div>
	
<table class="table table-striped">
	<thead>
		<tr>
			<th class="col-md-2">ID</th>
			<th class="col-md-2">Descripción</th>
			<th class="col-md-2">Tipo Espacio Físico</th>
			<th class="col-md-2">Tipo Posesión</th>
			<th class="col-md-2">Localidad</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>


		@foreach($espaciosFisicos as $espacioFisico)
		<tr>
			<td>{{ $espacioFisico -> ESFI_ID }}</td>
			<td>{{ $espacioFisico -> ESFI_DESCRIPCION }}</td>
			<td>{{ $espacioFisico -> tipoEspacioFisico -> TIEF_DESCRIPCION }}</td>
			<td>{{ $espacioFisico -> tipoPosesion -> TIPO_DESCRIPCION }}</td>
			<td>{{ $espacioFisico -> localidad -> LOCA_DESCRIPCION }}</td>
			<td>

				<!-- Botón Ver (show) -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('espaciofisico/'.$espacioFisico->ESFI_ID) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a><!-- Fin Botón Ver (show) -->

				<!-- Botón Editar (edit) -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('espaciofisico/'.$espacioFisico->ESFI_ID.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a><!-- Fin Botón Editar (edit) -->

				<!-- Botón Borrar (destroy) -->
				{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Borrar',[
						'class'=>'btn btn-xs btn-danger',
						'data-toggle'=>'modal',
						'data-target'=>'#pregModal'.$espacioFisico -> ESFI_ID ])
						}}

				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->
				<div class="modal fade" id="pregModal{{ $espacioFisico -> ESFI_ID }}" role="dialog" tabindex="-1" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">¿Borrar?</h4>
							</div>
							<div class="modal-body">
								<p>
									<i class="fa fa-exclamation-triangle"></i> ¿Desea borrar el registro {{ $espacioFisico -> ESFI_ID }}?
								</p>
							</div>
							<div class="modal-footer">
									{{ Form::open(array('url' => 'espaciofisico/'.$espacioFisico->ESFI_ID, 'class' => 'pull-right')) }}
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