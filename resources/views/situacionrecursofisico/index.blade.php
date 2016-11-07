@extends('layout')
@section('title', '/ Situación Recurso Físico')

@section('content')

	<h1 class="page-header">Situación Recurso Físico</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('situacionrecursofisico/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nueva Situación
			</a>
		</div>
	</div>
	
<table class="table table-striped">
	<thead>
		<tr>
			<th class="col-md-2">ID</th>
			<th class="col-md-2">Descripción</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>


		@foreach($sitRecursosFisicos as $sitRecursoFisico)
		<tr>
			<td>{{ $sitRecursoFisico -> SIRF_ID }}</td>
			<td>{{ $sitRecursoFisico -> SIRF_DESCRIPCION }}</td>
			<td>
				<!-- Botón Ver (show) -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('situacionrecursofisico/'.$sitRecursoFisico->SIRF_ID) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a><!-- Fin Botón Ver (show) -->

				<!-- Botón Editar (edit) -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('situacionrecursofisico/'.$sitRecursoFisico->SIRF_ID.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a><!-- Fin Botón Editar (edit) -->

				<!-- Botón Borrar (destroy) -->
				{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Borrar',[
						'class'=>'btn btn-xs btn-danger',
						'data-toggle'=>'modal',
						'data-target'=>'#pregModal'.$sitRecursoFisico -> SIRF_ID ])
						}}

				<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->
				<div class="modal fade" id="pregModal{{ $sitRecursoFisico -> SIRF_ID }}" role="dialog" tabindex="-1" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">¿Borrar?</h4>
							</div>
							<div class="modal-body">
								<p>
									<i class="fa fa-exclamation-triangle"></i> ¿Desea borrar el registro {{ $sitRecursoFisico -> SIRF_ID }}?
								</p>
							</div>
							<div class="modal-footer">
									{{ Form::open(array('url' => 'situacionrecursofisico/'.$sitRecursoFisico->SIRF_ID, 'class' => 'pull-right')) }}
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


  <!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->
  <div class="modal fade" id="msgModal" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Borrando...</h4>
		</div>
		<div class="modal-body">
			<p>
				<i class="fa fa-cog fa-spin fa-3x fa-fw"></i> Borrando registro...
			</p>
		</div>
		<div class="modal-footer">
		</div>
	  </div>
	  
	</div>
  </div>

@endsection