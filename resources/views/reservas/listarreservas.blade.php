@extends('layout')
@section('title', '/ Calendario de Reservas')

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
	@include('reservas/listarreservas-scripts')
@parent
@endsection

@section('content')

{{-- <h1 class="page-header">Nueva Reserva</h1> --}}
@include('partials/errors')

<div class="panel panel-default">

	<div class="panel-heading">
		<h2>Consulta calendario de Reservas</h2>
	</div>

	<div class="panel-body"> <!-- Main content -->

	<div class="row">

	{{ Form::open(array('url' => 'reservas/listReservasFiltro', 'class' => 'form-vertical', 'method' => 'GET')) }}

		<input type="text" hidden="true" value="{{Request::get('sala')}}" name="sala">

		<div class="col-xs-3 form-group">
			<label>Facultad:</label>
			<div class="selectContainer">
				<select class="form-control" id="cboxFacultades" name="cboxFacultades">
				  <option selected disabled>Todos...</option>
				</select>
			</div>
		</div>

		<div class="col-xs-4 form-group">
			<label>Docente:</label>
			<div class="selectContainer">
				<select class="form-control" id="cBoxDocentes" name="cBoxDocentes">
				  <option selected disabled>Todos...</option>
				</select>
			</div>
		</div>

	</div><!-- /.panel-body -->	

	<div class="row">
		<div class="col-xs-3 form-group">
			<label>Grupo:</label>
			<div class="selectContainer">
				<select class="form-control" id="cBoxGrupos" name="cBoxGrupos">
				  <option selected disabled>Todos...</option>
				</select>
			</div>
		</div>

		<div class="col-xs-4 form-group">
			<label>Asignatura:</label>
			<div class="selectContainer">
				<select class="form-control" id="cboxAsignaturas" name="cboxAsignaturas">
				  <option selected disabled>Todos...</option>
				</select>
			</div>
		</div>

	</div>

	<div class="row">

		<div class="col-xs-3 form-group">
			<label>Estado:</label>
			<div class="selectContainer">
				<select class="form-control" id="cboxEstados" name="cboxEstados">
				  <option selected disabled>Todos...</option>
				</select>
			</div>
		</div>

		<div class="col-xs-2 form-group">
			<label>Año:</label>
			<div class="selectContainer">
				<input class="form-control" type="text" id="ano" maxlength="4" minlength="4">
			</div>
		</div>

		<div class="col-xs-2 form-group">
			<label>Mes:</label>
			<div class="selectContainer">
				<select class="form-control" name="size" id="cboxMeses">
				  <option selected disabled>Todos...</option>
				  <option value="0">Enero</option>
				  <option value="1">Febrero</option>
				  <option value="2">Marzo</option>
				  <option value="3">Abril</option>
				  <option value="4">Mayo</option>
				  <option value="5">Junio</option>
				  <option value="6">Julio</option>
				  <option value="7">Agosto</option>
				  <option value="8">Septiembre</option>
				  <option value="9">Octubre</option>
				  <option value="10">Noviembre</option>
				  <option value="11">Diciembre</option>
				</select>
			</div>
		</div>

		<div class="col-xs-2 form-group">
			<label></label>
			<div class="selectContainer">
			<button type="button" id="btn-filtrar" class="btn btn-primary btn-flat">
			Filtrar
			</button>
			</div>
		</div>
		
		{{ Form::close() }}

	</div>


		<div class="row">

			<div class="col-xs-12 col-sm-14"> <!-- col calendar -->
				<div class="box box-primary">
					<div class="box-body no-padding">
						<!-- THE CALENDAR -->
						<div id="calendar"></div>
					</div><!-- /.box-body -->
				</div> <!-- /. box -->
			</div> <!-- /.col calendar -->

		</div> <!-- /.row -->
	<!-- /.Main content -->
  
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