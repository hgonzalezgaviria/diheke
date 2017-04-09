@extends('layout')
@section('title', '/ Crear Reserva')

@section('head')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	{!! Html::style('assets/css/bootstrap-multiselect.css') !!}
@parent
@endsection

@section('scripts')
	{!! Html::script('assets/js/bootstrap-multiselect.js') !!}
	@include('reservas/index-scripts')
@parent
@endsection

@section('content')

{{-- <h1 class="page-header">Nueva Reserva</h1> --}}
@include('partials/errors')

<div class="panel panel-default">

	<div class="panel-heading">
		<h2>Calendario de Reservas</h2>
	</div>

	<div class="panel-body"> <!-- Main content -->

	<div class="row">

		<div class="col-xs-12 col-sm-4"> <!-- Columna con controles para crear reserva -->
		   
			<div class="box box-solid">

				<div class="box-header with-border">
					<h3 class="box-title">Crear Reserva</h3>
				</div>

				<div class="box-body">
					<!--form-->
					<div class="row">
						<div class="col-xs-7 form-group">
							<label>Desde:</label>
							<div class='input-group date' id='fechaInicio'>
								<input type='text' class="form-control" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>

						<div class="col-xs-5 form-group">
							<label>Horas:</label>
							<input type='number' class="form-control" id="nHoras" placeholder="No. de horas" />
						</div>

					</div>


					<div id="cp3" class="input-group colorpicker-component hide">
						<input type="text" class="form-control" id="color" readonly="true" />
						<span class="input-group-addon"><i></i></span>
					</div>


					<div class="form-group">
						<label>Tipo de Repetición:</label>
						<div class="input-group">
							<label class="radio-inline form-check-label">
								<input class="form-check-input" type="radio" name="tipoRepeticion" value="ninguna" checked>
								Ninguna
							</label>
							<label class="radio-inline">
								<input class="form-check-input" type="radio" name="tipoRepeticion" value="hasta">
								Hasta una Fecha
							</label>
							<label class="radio-inline">
								<input class="form-check-input" type="radio" name="tipoRepeticion" value="pordias">
								Por días
							</label>
						</div>
					</div>

					<div class="form-group reservaPorDias reservaHastaFecha hide">
						<label>Hasta:</label>
						<div class='input-group date' id='fechaHasta'>
							<input type='text' class="form-control" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>

					<div class="form-group reservaPorDias hide">
						<label for="chkdias">Dias:</label>
						<div class="input-group">
							<select id="chkdias" name="chkdias[]" class="form-control" multiple="multiple" required>
								<option value="lunes" id="lu">Lunes</option>
								<option value="martes" id="ma">Martes</option>
								<option value="miércoles" id="mi">Miércoles</option>
								<option value="jueves" id="ju">Jueves</option>
								<option value="viernes" id="vi">Viernes</option>
								<option value="sábado" id="sa">Sábado</option>
								<option value="domingo" id="do" disabled>Domingo</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label>Facultad:</label>
						<div class="selectContainer">
							<select class="form-control" name="size" id="cboxFacultades">
							  <option selected disabled>Seleccione...</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label>Docente:</label>
						<div class="selectContainer">
							<select class="form-control" name="size" id="cBoxDocentes">
							  <option selected disabled>Seleccione...</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-4 form-group">
							<label>Grupo:</label>
							<div class="selectContainer">
								<select class="form-control" name="size" id="cBoxGrupos">
								  <option selected disabled>Seleccione...</option>
								</select>
							</div>
						</div>

						<div class="col-xs-8 form-group">
							<label>Asignatura:</label>
							<div class="selectContainer">
								<select class="form-control" name="size" id="cboxAsignaturas">
								  <option selected disabled>Seleccione...</option>
								</select>
							</div>
						</div>
					</div>

					<div class="text-right">
						<button id="btn-reservar" type="submit" class="btn btn-primary btn-flat">
							Crear Reserva
						</button>
					</div>
					<!--/form-->
				</div> <!-- /.box-body -->
			<br>
			</div> <!-- /.box -->
		</div> <!-- /.col Controles para crear reserva -->

		<div class="col-xs-12 col-sm-8"> <!-- col calendar -->
			<div class="box box-primary">
				<div class="box-body no-padding">
					<!-- THE CALENDAR -->
					<div id="calendar"></div>
				</div><!-- /.box-body -->
			</div> <!-- /. box -->
		</div> <!-- /.col calendar -->

	</div> <!-- /.row -->
	<!-- /.Main content -->
  </div><!-- /.panel-body -->
</div><!-- /.panel -->

<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Detalle de Reserva</h4>
	  </div>
	  <div class="modal-body" id="divmodal">
		<p></p>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	  </div>
	</div>
  </div>
</div>


{{-- @include('reservas/index-modalReservasPorDias') --}}

<div id="errorAjax"></div>
@endsection