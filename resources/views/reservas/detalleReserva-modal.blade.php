@section('head')
	<style type="text/css">
		.modal {
		  text-align: center;
		}

		@media screen and (min-width: 768px) { 
		  .modal:before {
			display: inline-block;
			vertical-align: middle;
			content: " ";
			height: 100%;
		  }
		}

		.modal-dialog {
		  display: inline-block;
		  text-align: left;
		  vertical-align: middle;
		}

		.fa-3x{
			vertical-align: middle;
		}

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
	<script type="text/javascript">
		//Carga de datos a mensajes modales para eliminar y clonar registros
		$(document).ready(function () {


			$('#modalReserva').on('show.bs.modal', function (event) {

				var button = $(event.relatedTarget); // Button that triggered the modal
				var modal = $(this);
				


				var RESE_FECHAINI = button.data('rese_fechaini'); // Extract info from data-* attributes
				modal.find('.RESE_FECHAINI').text(RESE_FECHAINI);

				var RESE_FECHAFIN = button.data('rese_fechafin'); // Extract info from data-* attributes
				modal.find('.RESE_FECHAFIN').text(RESE_FECHAFIN);

				var SEDE_DESCRIPCION = button.data('sede_descripcion'); // Extract info from data-* attributes
				modal.find('.SEDE_DESCRIPCION').text(SEDE_DESCRIPCION);

				var SALA_DESCRIPCION = button.data('sala_descripcion'); // Extract info from data-* attributes
				modal.find('.SALA_DESCRIPCION').text(SALA_DESCRIPCION);

				var ESTA_DESCRIPCION = button.data('esta_descripcion'); // Extract info from data-* attributes
				modal.find('.ESTA_DESCRIPCION').text(ESTA_DESCRIPCION);

				var total_reservas = button.data('total_reservas'); // Extract info from data-* attributes
				modal.find('.total_reservas').text(total_reservas);

				var RESE_CREADOPOR = button.data('rese_creadopor'); // Extract info from data-* attributes
				modal.find('.RESE_CREADOPOR').text(RESE_CREADOPOR);

				var AUTO_DESCRIPCION = button.data('auto_descripcion'); // Extract info from data-* attributes
				modal.find('.AUTO_DESCRIPCION').text(AUTO_DESCRIPCION);

				var AUTO_ID = button.data('auto_id'); // Extract info from data-* attributes
				modal.find('.AUTO_ID').text(AUTO_ID);

			});


		});
	</script>
@parent
@endsection

<!-- Mensaje Modal para confirmar borrado de registro-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalReserva" role="dialog">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header modal-header-reserva" style="padding:40px 50px;">		
		<h2><span class="glyphicon glyphicon-modal-window"></span> Detalle Reserva</h2>
	  </div>
	  <div class="modal-body" id="divmodal" style="padding:40px 50px;">
		<div class="form-group">                
            <p>
                <b>Descripción: </b> <span class='AUTO_DESCRIPCION'></span><br>
                <b>Sede: </b> <span class='SEDE_DESCRIPCION'></span><br>
                <b>Espacio/Sala: </b> <span class='SALA_DESCRIPCION'></span><br>
                <b>Fecha de Inicio: </b> <span class='RESE_FECHAINI'></span><br>
                <b>Fecha Fin: </b> <span class='RESE_FECHAFIN'></span><br>
                <b>Estado:</b> <span class='ESTA_DESCRIPCION'></span><br>
                <b>Total reservas:</b> <span class='total_reservas'></span><br>
                <b>Creado por:</b> <span class='RESE_CREADOPOR'></span><br>
                <b>Autorización:</b> <span class='AUTO_ID'></span>
            </p>
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