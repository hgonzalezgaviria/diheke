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
<div class="modal fade" id="pregModal" role="dialog" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header panel-heading" style="border-top-left-radius: inherit; border-top-right-radius: inherit;">
				<h4 class="modal-title"></h4>
			</div>

			<div class="modal-body">
				<h4>
					<i class="fa fa-exclamation-triangle fa-3x fa-fw"></i>
					<span class="body"></span>
				</h4>

				{{ Form::open( ['id'=>'frmAutorizacion', 'class'=>'frmModal form-vertical', 'accept-charset'=>'UTF-8'] ) }}
					{{ Form::textarea('AUTO_OBSERVACIONES', old('AUTO_OBSERVACIONES'), [
						'id'=>'AUTO_OBSERVACIONES',
						'class' => 'form-control',
						'size' => '20x3',
						'placeholder' => 'Escriba aquí una observación.',
						'style' => 'resize: vertical',
						'required'
					]) }}
			</div>

			<div class="modal-footer">
					{{ Form::button('<i class="fa fa-times" aria-hidden="true"></i> NO',[
						'class'=>'btn btn-xs btn-default',
						'data-dismiss'=>'modal',
					]) }}
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> SI ',[
						'class'=>'btn btn-xs btn-success',
						'type'=>'submit',
					]) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div><!-- Fin de Mensaje Modal confirmar borrado de registro.-->


<!-- Mensaje Modal al borrar registro. Bloquea la pantalla mientras se procesa la solicitud -->
<div class="modal fade" id="msgModalProcesando" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h4>
					<i class="fa fa-cog fa-spin fa-3x fa-fw" style="vertical-align: middle;"></i> Procesando solicitud...
				</h4>
			</div>
		</div>

	</div>
</div><!-- Fin de Mensaje Modal al borrar registro.-->