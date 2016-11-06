@extends('layout')
@section('title', '/ Tipos de Recursos Fisicos')
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Tipos de Recursos Fisicos</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('tiporecursofisico/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Tipo de Recurso Fisico
			</a>
		</div>
	</div>
	
<table class="table table-striped">
	<thead>
		<tr>
			<th class="col-md-1">Descripcion</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>
		@foreach($tiporecursosfisicos as $tiporecursofisico)
		<tr>
			<td>{{ $contrato -> tirf_descripcion }}</td>
			<td>
				<!-- Borrar registro (utiliza el método DESTROY /reservas/{reserva_id}/pregs/{id} -->
				{{ Form::open(array('url' => 'tiporecursofisico/'.$tiporecursofisico->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Borrar', array('class'=>'btn btn-xs btn-warning', 'type'=>'submit')) }}

				{{ Form::close() }}

				<!-- Muestra este registro (Utiliza método show encontrado en GET /reservas/{reserva_id}/pregs/{id} -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('tiporecursofisico/'.$tiporecursofisico->id) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a>

				<!-- Edita este registro (Utiliza método edit encontrado en GET /reservas/{reserva_id}/pregs/{id}/edit -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('tiporecursofisico/'.$tiporecursofisico->id.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>


@endsection
