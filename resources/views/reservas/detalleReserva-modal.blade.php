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

	</style>
@parent
@endsection

@section('scripts')
	<script type="text/javascript">
		//Carga de datos a mensajes modales para eliminar y clonar registros
		$(document).ready(function () {


			$('#pregModal').on('show.bs.modal', function (event) {

				var button = $(event.relatedTarget); // Button that triggered the modal
				var modal = $(this);
				
				var id = button.data('id'); // Se obtiene valor en data-id
				modal.find('.id').text(id); //Se asigna en la etiqueta con clase id

				var accion = button.data('accion');

				if(accion == 'aprobar'){
					modal.find('.modal-content')
						.addClass('panel-success')
						.find('.modal-title').text('¿Aprobar '+id+'?');
					modal.find('.body').text('¿Desea aprobar el registro'+id+'?');
				}
				else if(accion == 'rechazar'){
					modal.find('.modal-content')
						.addClass('panel-warning')
						.find('.modal-title').text('¿Rechazar '+id+'?');
					modal.find('.body').text('¿Desea rechazar el registro'+id+'?');
				}
				else if(accion == 'anular'){
					modal.find('.modal-content')
						.addClass('panel-warning')
						.find('.modal-title').text('¿Anular '+id+'?');
					modal.find('.body').text('¿Desea Anular el registro'+id+'?');
				}

				$('.frmModal').attr('action', 'autorizarReservas/'+id+'/'+accion);
			});


			var form = $('#frmAutorizacion');
			$('#submit').click(function (e) {
				var AUTO_OBSERVACIONES = form.find('#AUTO_OBSERVACIONES').val();
				if(AUTO_OBSERVACIONES != ''){
					$('#msgModalProcesando')
						.modal({backdrop: 'static', keyboard: false})
						.modal('show');
					return form.submit();
				} else {
					return form.submit(); //Se retorna para que valide el campo y muestre el tooltip.
				}
				e.preventDefault()
			});
		});
	</script>
@parent
@endsection

<!-- Mensaje Modal para confirmar borrado de registro-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalReserva" role="dialog">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header" style="padding:40px 50px;">		
		<h4><span class="glyphicon glyphicon-modal-window"></span> Detalle Reserva</h4>
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