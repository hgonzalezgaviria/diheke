@extends('layout')
@section('title', '/ Consulta Equipos')
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

	 	$('')

	
	  });
    </script>
@endsection
@section('content')

	<h1 class="page-header">Consultas De Equipos</h1>
	<div class="row well well-sm">

			
			{{ Form::label('SALA_ID', 'Salas') }} 
			{{ Form::select('SALA_ID', [null => 'Seleccione una sala...'] + $arrSalas , old('SALA_ID'), ['class' => 'form-control', 'required']) }}
		

			
			{{ Form::label('SEDE_ID', 'Sedes') }} 
			{{ Form::select('SEDE_ID', [null => 'Seleccione una sede...'] + $arrSedes , old('SEDE_ID'), ['class' => 'form-control', 'required']) }}
		
		

	</div>
	
<table class="table table-striped" id="tabla">
	<thead>
		<tr class="info">
			<th class="col-md-2">ID Equipo</th>
			<th class="col-md-2">Descripción</th>
			<th class="col-md-2">Observaciones</th>
			<th class="col-md-2">Estado</th>
			<th class="col-md-2">Sala</th>
			<th class="col-md-2">Sede</th>

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

				

		

			</td>
		</tr>
		@endforeach
	</tbody>
</table>




@endsection