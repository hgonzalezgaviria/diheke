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
			$('#modalRecursos').on('show.bs.modal', function (event) {

				var button = $(event.relatedTarget); // Button that triggered the modal
				var modal = $(this);
				
				var id = button.data('id'); // Se obtiene valor en data-id
				modal.find('.id').text(id); //Se asigna en la etiqueta con clase id

				var modelo = button.data('modelo');
				modal.find('.modelo').text(modelo);

				var descripcion = button.data('descripcion');
	//				alert(modal.find('.descripcion').text(descripcion));
				modal.find('.descripcion').text(descripcion);

				var index = button.data('index');
				var salas = {!! $salas !!};
				var recursos = salas[index]['recursos'];
				var html = '';
				for (var i = 0 ; i < recursos.length; i++){
					html += recursos[i].RECU_DESCRIPCION +' '+ recursos[i].RECU_VERSION +'<br>';

					modal.find('.recursos').html(html);
				}

				var urlForm = button.data('action'); // Se cambia acción del formulario.
				$('.frmModal').attr('action', urlForm);
			});
		});
	</script>
@parent
@endsection

<!-- Mensaje Modal para confirmar borrado de registro-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalRecursos" role="dialog" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header alert-info">
				<h4 class="modal-title">Recursos de Sala <span class="id"></span></h4>
			</div>

			<div class="modal-body">

				<div class="row">
					<div class="col-xs-2">
						<i class="fa fa-info-circle fa-3x fa-fw"></i>
					</div>
					<div class="col-xs-10">
						<h3><span class="descripcion"></span></h3>
						<h4><span class="recursos"></span></h4>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<form id="frmRecurso" method="POST" action="" accept-charset="UTF-8" class="frmModal pull-right">
				
				</form>
			</div>

          <div class="modal-footer">
            <button type="submit" class="btn-xs btn-danger btn-xs" data-dismiss="modal">
                  <span class="glyphicon glyphicon-remove"></span> Cancelar
                </button>
          </div>
		</div>
	</div>
</div><!-- Fin de Mensaje Modal confirmar borrado de registro.-->


<!-- Mensaje Modal al borrar registro. Bloquea la pantalla mientras se procesa la solicitud -->
