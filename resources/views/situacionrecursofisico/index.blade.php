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
				<!-- Borrar registro (utiliza el método DESTROY /reservas/{reserva_id}/pregs/{id} -->
				{{ Form::open(array('url' => 'situacionrecursofisico/'.$sitRecursoFisico->SIRF_ID, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Borrar', array('class'=>'btn btn-xs btn-warning', 'type'=>'submit')) }}

				{{ Form::close() }}

				<!-- Muestra este registro (Utiliza método show encontrado en GET /reservas/{reserva_id}/pregs/{id} -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('situacionrecursofisico/'.$sitRecursoFisico->SIRF_ID) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a>

				<!-- Edita este registro (Utiliza método edit encontrado en GET /reservas/{reserva_id}/pregs/{id}/edit -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('situacionrecursofisico/'.$sitRecursoFisico->SIRF_ID.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>




@endsection