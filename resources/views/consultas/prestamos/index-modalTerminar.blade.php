@section('scripts')
	<script type="text/javascript">
		
		$(document).ready(function () {
		$('.modal').on('show.bs.modal', function (event) {

			var button = $(event.relatedTarget); // Button that triggered the modal
			var modal = $(this);

			var PRES_ID = button.data('pres_id'); // Extract info from data-* attributes
			modal.find('.PRES_ID').text(PRES_ID);

			var urlForm = button.data('action'); // Extract info from data-* attributes
			$('.frmModal').attr('action', urlForm);
		});
	});
	</script>
@parent
@endsection

<!-- Mensaje Modal para confirmar borrado de registro-->
<div class="modal fade" id="pregModalTerminarPrestamo" role="dialog" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Terminar?</h4>
			</div>

			<div class="modal-body">
				<p>
					<i class="fa fa-exclamation-triangle"></i> ¿Desea Terminar la solicitud <span class="PRES_ID"></span>?
				</p>
			</div>

			<div class="modal-footer">
				<form id="frmTerminarPrestamo" method="GET" action="" class="frmModal pull-right">

					<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">
						<i class="fa fa-times" aria-hidden="true"></i> NO
					</button>

					{{ Form::token() }}
					{{ Form::button('<i class="fa fa-file-o" aria-hidden="true"></i> SI ',[
						'class'=>'btn btn-xs btn-success',
						'type'=>'submit',
						'data-toggle'=>'modal',
						'data-backdrop'=>'static',
						'data-target'=>'#msgModalend',
					]) }}

				</form>
			</div>
		</div>
	</div>
</div><!-- Fin de Mensaje Modal confirmar borrado de registro.-->


<!-- Mensaje Modal al borrar registro. Bloquea la pantalla mientras se procesa la solicitud -->
<div class="modal fade" id="msgModalend" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h4>
					<i class="fa fa-cog fa-spin fa-3x fa-fw" style="vertical-align: middle;"></i> Procesando ...
				</h4>
			</div>
		</div>
		
	</div>
</div><!-- Fin de Mensaje Modal al borrar registro.-->