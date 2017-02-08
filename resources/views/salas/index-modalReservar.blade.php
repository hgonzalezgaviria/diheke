@section('scripts')
	<script type="text/javascript">
		
		$(document).ready(function () {
		$('.modal').on('show.bs.modal', function (event) {

			var button = $(event.relatedTarget); // Button that triggered the modal
			var modal = $(this);

			var SALA_ID = button.data('sala_id'); // Extract info from data-* attributes
			modal.find('.SALA_ID').text(SALA_ID);

			var urlForm = button.data('action'); // Extract info from data-* attributes
			$('.frmModal').attr('action', urlForm);
		});
	});
	</script>
@parent
@endsection

<!-- Mensaje Modal para confirmar borrado de registro-->
<div class="modal fade" id="pregModalReservar" role="dialog" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Reservar?</h4>
			</div>

			<div class="modal-body">
				<p>
					<i class="fa fa-exclamation-triangle"></i> ¿Desea Reservar esta sala <span class="SALA_ID"></span>?
				</p>
			</div>

			<div class="modal-footer">
				<form id="frmReservaSala" method="GET" action="" class="frmModal pull-right">

					<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">
						<i class="fa fa-times" aria-hidden="true"></i> NO
					</button>

					{{ Form::token() }}
					{{ Form::button('<i class="fa fa-file-o" aria-hidden="true"></i> SI ',[
						'class'=>'btn btn-xs btn-success',
						'type'=>'submit',
						'data-toggle'=>'modal',
						'data-backdrop'=>'static',
						'data-target'=>'#msgModalreserved',
					]) }}

				</form>
			</div>
		</div>
	</div>
</div><!-- Fin de Mensaje Modal confirmar borrado de registro.-->


<!-- Mensaje Modal al borrar registro. Bloquea la pantalla mientras se procesa la solicitud -->
<div class="modal fade" id="msgModalreserved" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h4>
					<i class="fa fa-cog fa-spin fa-3x fa-fw" style="vertical-align: middle;"></i> Reservado ...
				</h4>
			</div>
		</div>
		
	</div>
</div><!-- Fin de Mensaje Modal al borrar registro.-->