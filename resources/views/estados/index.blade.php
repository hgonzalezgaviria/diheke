@extends('layout')
@section('title', '/ Estados')
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Estados</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('estados/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Estado
			</a>
		</div>
	</div>
	
<table class="table table-striped">
	<thead>
		<tr>
			<th class="col-md-2">Descripción</th>
			<th class="col-md-2">Tipo de Estado</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>


		@foreach($estados as $estado)
		<tr>
			<td>{{ $estado -> descripcion }}</td>
			<td>{{ $estado -> tipoestado_desc }}</td>
			<td>
				<!-- Borrar registro (utiliza el método DESTROY /reservas/{reserva_id}/pregs/{id} -->
				{{ Form::open(array('url' => 'estados/'.$estado->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Borrar', array('class'=>'btn btn-xs btn-warning', 'type'=>'submit')) }}

				{{ Form::close() }}

				<!-- Muestra este registro (Utiliza método show encontrado en GET /reservas/{reserva_id}/pregs/{id} -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('estados/'.$estado->id) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a>

				<!-- Edita este registro (Utiliza método edit encontrado en GET /reservas/{reserva_id}/pregs/{id}/edit -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('estados/'.$estado->id.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>


@endsection
