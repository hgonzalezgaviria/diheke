<!-- Utilizado para mostrar mensajes provenientes de los controladores -->
@if (Session::has('message'))
	<div class="alert alert-info">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><i class="fa fa-info-circle" aria-hidden="true"></i></strong>
		{{ Session::get('message') }}
	</div>
@endif
@if (Session::has('error'))
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i></strong>
		{{ Session::get('error') }}
	</div>
@endif
@if (Session::has('warning'))
	<div class="alert alert-warning">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i></strong>
		{{ Session::get('warning') }}
	</div>
@endif

@if (Session::has('message-modal'))
	@section('scripts')
		<script type="text/javascript">
			$(document).ready(function () {
				var modal = $('#messageModal');
				modal.find('#message').text('{{Session::get('message-modal')}}');
				modal.find('.modal-header')
					.addClass('alert-success')
					.find('.modal-title').text('¡Operación exitosa!');
				modal.modal('show');
			})
		</script>
	@parent
	@endsection
@endif



<!-- Mensaje Modal para confirmar borrado de registro-->
<div class="modal fade" id="messageModal" role="dialog" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-xs-2">
						<i class="fa fa-exclamation-triangle fa-3x fa-fw"></i>
					</div>
					<div class="col-xs-10">
						<h4 id="message"></h4>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-xs btn-success" data-dismiss="modal">
					<i class="fa fa-times" aria-hidden="true"></i> OK
				</button>

			</div>
		</div>
	</div>
</div><!-- Fin de Mensaje Modal confirmar borrado de registro.-->
