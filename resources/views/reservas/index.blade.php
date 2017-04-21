@extends('layout')
@section('title', '/ Crear Reserva')

@section('head')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	{!! Html::style('assets/css/bootstrap-multiselect.css') !!}

		<style type="text/css">
	.modal-header-reserva {
      background-color: #286090;
      color:white !important;
      text-align: center;
      font-size: 25px;
      border-radius:6px;
  	}

	</style>
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
							<input type='number' class="form-control" min="1" max="12" id="nHoras" placeholder="No. de horas" />
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

            				@if (in_array(Auth::user()->rol->ROLE_ROL , ['audit','admin']))
							<label class="radio-inline">
								<input class="form-check-input" type="radio" name="tipoRepeticion" value="hasta">
								Hasta una Fecha
							</label>
							@endif
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

					<div class="form-group reservaPorDias reservaHastaFecha hide">
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
						<button id="btn-reservar" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#msgModalProcessing">
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




@section('scripts')
	<script type="text/javascript">
		//Carga de datos a mensajes modales para eliminar y clonar registros
		$(document).ready(function () {


			$('#modalReserva').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget); // Button that triggered the modal
				var modal = $(this);
				
				var RESE_CREADOPOR = modal.find('.RESE_CREADOPOR').text();
				var userCurrent = '{{ Auth::user()->username }}';
				var rolCurrent = '{{ Auth::user()->rol->ROLE_ROL }}';

				if(userCurrent == RESE_CREADOPOR || rolCurrent == 'admin'){
					var AUTO_ID = modal.find('.AUTO_ID').text();
					var btnAnular = modal.find('#anularReserva');
					btnAnular
						.attr('href', '../autorizarReservas/'+AUTO_ID+'/anular')
						.removeClass('hide');
				}
			});

			$('#anularReserva').on('click', function (event) {
				//alert('llamar método para anular');
			});

		});
	</script>
@parent
@endsection


<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalReserva" role="dialog">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header modal-header-reserva" style="padding:40px 50px;">		
		<h2><span class="glyphicon glyphicon-modal-window"></span> Detalle Reserva</h2>
	  </div>
	  <div class="modal-body" id="divmodal" style="padding:40px 50px;">
		<p></p>
		<div class="form-group">
                <label for="nombre"> Duración</label>
                </div>
	  </div>
	  <div class="modal-footer">
        	<a href="" id="anularReserva" class="btn btn-danger pull-right hide">
              <span class="glyphicon glyphicon-remove"></span> Anular
            </a>
        	<button class="btn btn-success btn-default pull-right" data-dismiss="modal">
              <span class="glyphicon glyphicon-remove"></span> Cerrar
            </button>
          </div>
	</div>
  </div>
</div>



<!-- Mensaje Modal al borrar registro. Bloquea la pantalla mientras se procesa la solicitud -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="msgModalProcessing" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h4>
					<i class="fa fa-cog fa-spin fa-3x fa-fw" style="vertical-align: middle;"></i> Cargando...
				</h4>
			</div>
		</div>

	</div>
</div><!-- Fin de Mensaje Modal al borrar registro.-->

{{-- @include('reservas/index-modalReservasPorDias') --}}

<div id="errorAjax"></div>
@endsection