@extends('layout')
@section('title', '/ Contratos')
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Contratos</h1>
	<div class="row well well-sm">

		<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('contratos/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Nuevo contrato
			</a>
		</div>
	</div>
	
<table class="table table-striped">
	<thead>
		<tr>
			<th class="col-md-1">Cédula</th>
			<th class="col-md-2">Nombres</th>
			<th class="col-md-2">Apellidos</th>
			<th>NDC</th>
			<th>Estado</th>
			<th>Fec. Ingreso</th>
			<th>Fec. Retiro</th>
			<th>Salario</th>
			<th>Tipo de Nómina</th>
			<th>C. Costo</th>
			<th class="col-md-2">Acciones</th>

		</tr>
	</thead>
	<tbody>
		@foreach($contratos as $contrato)
		<tr>
			<td>{{ $contrato -> cedula }}</td>
			<td>{{ $contrato -> nombres }}</td>
			<td>{{ $contrato -> apellidos }}</td>
			<td>{{ $contrato -> nro_contrato }}</td>
			<td>{{ $contrato -> estado }}</td>
			<td>{{ $contrato -> fecha_ingreso }}</td>
			<td>{{ $contrato -> fecha_retiro }}</td>
			<td>{{ $contrato -> salario }}</td>
			<td>{{ $contrato -> tipo_nomina }}</td>
			<td>{{ $contrato -> centro_costo }}</td>
			<td>
				<!-- Borrar registro (utiliza el método DESTROY /reservas/{reserva_id}/pregs/{id} -->
				{{ Form::open(array('url' => 'contratos/'.$contrato->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Borrar', array('class'=>'btn btn-xs btn-warning', 'type'=>'submit')) }}

				{{ Form::close() }}

				<!-- Muestra este registro (Utiliza método show encontrado en GET /reservas/{reserva_id}/pregs/{id} -->
				<a class="btn btn-small btn-success btn-xs" href="{{ URL::to('contratos/'.$contrato->id) }}">
					<span class="glyphicon glyphicon-eye-open"></span> Ver
				</a>

				<!-- Edita este registro (Utiliza método edit encontrado en GET /reservas/{reserva_id}/pregs/{id}/edit -->
				<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('contratos/'.$contrato->id.'/edit') }}">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>


@endsection
