@extends('layout')
@section('title', '/ Consulta Prestamos')
@include('datatable')
@section('content')

	<h1 class="page-header">Sedes</h1>
	<div class="row well well-sm">

	</div>
	
<table class="table table-striped" id="tabla">
	<thead>
		<tr class="info">
			<th class="col-xs-1">ID</th>
			<th class="col-xs-1">Cod/ID Estudiante</th>
			<th class="col-xs-2">Nombre completo</th>
			<th class="col-xs-1">Equipo</th>			
			<th class="col-xs-2">Sala</th>
			<th class="col-xs-2">Usuario</th>
			<th class="col-xs-2">Fecha Inicio P</th>
			<th class="col-xs-1">Tiempo trans</th>
			<th> </th>

		</tr>
	</thead>
	<tbody>


		@foreach($equipoPrestamos as $prestamo)
		<tr>
			<td>{{ $prestamo -> PRES_ID }}</td>
			<td>{{ $prestamo -> PRES_IDUSARIO }}</td>
			<td>{{ $prestamo -> PRES_NOMBREUSARIO }}</td>
			<td>{{ $prestamo -> EQUI_ID }}</td>
			 	
			<td>{{ $prestamo -> equipo -> sala -> SALA_DESCRIPCION }}</td>
			<td>{{ $prestamo -> PRES_CREADOPOR }}</td>
			<td>{{ $prestamo -> PRES_FECHACREADO }}</td>
			<td>{{ $prestamo -> PRES_FECHACREADO }}</td>
			<td>

				<!-- Botón Ver (show) -->
				<a class="btn btn-small btn-success btn-xs" href="">
					<span class="glyphicon glyphicon-eye-open"></span> Terminar
				</a><!-- Fin Botón Ver (show) -->

				
				

			</td>
		</tr>
		@endforeach
	</tbody>
</table>




@endsection