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

  .btn-primaryy {
  -webkit-border-radius: 8;
  -moz-border-radius: 8;
  border-radius: 8px;
  font-family: Arial;
  color: #ffffff;
  font-size: 28px;
  background: #265a88;
  padding: 10px 23px 10px 20px;
  text-decoration: none;
}

.borderesa {
	
	background-color: rgb(0, 255, 0); z-index: 8;
	width:100px;
	border-radius: 8px;
}
.borderesp {
	
	background-color: rgb(255, 255, 0); z-index: 8;
	width:200px;
	border-radius: 8px;
}

.btn-primaryy:hover {
  background: #23527c;
  color: #ffffff;
  text-decoration: none;
}
.btn-primaryy:focus {
  background: #23527c;
  color: #ffffff;
  text-decoration: none;
}
table.width100 {

	width:500px;
	border: solid 1px #999;
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
@include('reservas/index-modalCrearReservas')

<div class="panel panel-default">

	<div class="panel-heading">
	<div class="row">
	<div class="col-xs-8">
		<h2>Calendario de Reservas <small>{{\reservas\Sala::find(Request::get('sala'))->sede->SEDE_DESCRIPCION}}</small> <small>{{\reservas\Sala::find(Request::get('sala'))->SALA_DESCRIPCION}}</small></h2>	</div>
	<div  class="col-xs-4 text-right" id="btn-create" class="col-xs-3 col-md-9 col-lg-9">
	<a class='btn btn-primary btn-lg' role='button' data-toggle="modal" data-target="#modalcrearres" href="#">
		<i class="fa fa-plus" aria-hidden="true"></i> 
		<span class="hidden-xs">Crear Reserva</span>
		<span class="sr-only">Crear</span>
	</a>
	</div>	
</div>

		

	</div>
		

	<div class="panel-body"> <!-- Main content -->

	<div class="row">
	<div class="col-xs-12 col-sm-12"> <!-- col des. estados -->

		<table class="status-legend width100" cellspacing="1">
		<tbody>
			<tr>
			<td class="borderesa"> APROBADAS </td>
			<td class="borderesp"> PENDIENTE POR APROBAR </td>				
			</tr>
		</tbody>
		</table>

	</div>

		<div class="col-xs-12 col-sm-12"> <!-- col calendar -->
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
			//var select = $('#cboxFacultades').val();
			

			


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
				}else{
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