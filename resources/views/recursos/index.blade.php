@extends('layout')
@section('title', '/ Recursos')
@section('scripts')
    <script>
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
	
<table class="table table-striped">
	<thead>
		<tr>
			<th class="col-md-1">Descripción</th>
			<th class="col-md-2">Versión</th>
			<th class="col-md-2">Observaciones</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>
		@foreach($recursos as $recurso)
		<tr>
			<td>{{ $recurso -> descripcion }}</td>
			<td>{{ $recurso -> version }}</td>
			<td>{{ $recurso -> observaciones }}</td>
			<td>
				<!-- Borrar registro (utiliza el método DESTROY /reservas/{reserva_id}/pregs/{id} -->
				{{ Form::open(array('url' => 'recursos/'.$recurso->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Borrar', array('class'=>'btn btn-xs btn-warning', 'type'=>'submit')) }}

				{{ Form::close() }}

				<!-- Muestra este registro (Utiliza método show encontrado en GET /reservas/{reserva_id}/pregs/{id} -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('recursos/'.$recurso->id) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a>

				<!-- Edita este registro (Utiliza método edit encontrado en GET /reservas/{reserva_id}/pregs/{id}/edit -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('recursos/'.$recurso->id.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>


@endsection
