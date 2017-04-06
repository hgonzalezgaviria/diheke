

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function () {
			$('.modal').on('show.bs.modal', function (event) {

				var button = $(event.relatedTarget); // Button that triggered the modal
				var modal = $(this);

				var ROLE_ID = button.data('id'); // Extract info from data-* attributes
				modal.find('.ROLE_ID').text(ROLE_ID);
				//getCountUsuarios(ROLE_ID);


				var modelo = button.data('modelo');
				modal.find('.modelo').html(modelo);
				
				var countUsers = button.data('count-users');
				if(countUsers > 0){
					modal.find('.withRelations').removeClass('hide');
					modal.find('.withoutRelations').addClass('hide');
				} else {
					modal.find('.withoutRelations').removeClass('hide');
					modal.find('.withRelations').addClass('hide');
				}

				var urlForm = button.data('action'); // Extract info from data-* attributes
				$('.frmModal').attr('action', urlForm);

			});

		});


		$('select[name="opcBorrado"]').on('change', function () {
			var selected = $(this).val();
			if (selected == 'moveRelations'){
				var selectRoles = $('#roles');
				selectRoles.removeClass('hide')
				getRoles();
			} else {
				selectRoles.addClass('hide')
			}
		});

		function getRoles(){
			$.ajax({
				//async: false, 
				url: 'roles/getRoles',
				dataType: "json",
				type: "GET",
				headers: {
					"X-CSRF-TOKEN": $('input[name="_token"]').val()
				},
				success: function(roles) {
					var selectRoles = $('#roles');
					$.each(roles, function (id, rol) {
						if(id != $('.modal').find('.ROLE_ID').text()){
							selectRoles.append($('<option>', { 
								value: id,
								text : rol 
							}));
						}
					});
					selectRoles.find('option:first').text("Seleccione un rol...");
				},
				error: function(event){
					console.log('Error ajax: '+event);
				}
			});
		}
	</script>
@parent
@endsection

<!-- Mensaje Modal para confirmar borrado de registro-->
{{ Form::open(['method'=>'DELETE', 'id'=>'frmDeleteUser', 'class'=>'frmModal pull-right']) }}
<div class="modal fade" id="pregModalDelete" role="dialog" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content panel-danger">
			<div class="modal-header panel-heading" style="border-top-left-radius: inherit; border-top-right-radius: inherit;">
				<h4 class="modal-title">¿Borrar registro <span class="ROLE_ID"></span>?</h4>
			</div>

			<div class="modal-body">
				<h4 class="descripcion">
				<i class="fa fa-exclamation-triangle fa-3x fa-fw"></i>
					<span class="withRelations hide">
						Existen <span class"countUsers"></span> asociados al rol <span class="modelo label label-danger"></span>.
					</span>
					<span class="withoutRelations hide">
						¿Borrar <span class="modelo label label-danger"></span>?
					</span>
				</h4>
				<div class="withRelations hide">
					¿Qué desea hacer?
					<select name="opcBorrado" class="form-control">
						<option value="deleteRelations" selected>Borrar relaciones</option>
						<option value="moveRelations">Mover usuarios a otro rol</option>
					</select>
					<select name="roles" id="roles" class="hide form-control">
						<option value="" selected disabled>Cargando roles...</option>
					</select>
				</div>
			</div>

			<div class="modal-footer">
					<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">
						<i class="fa fa-times" aria-hidden="true"></i> NO
					</button>
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> SI ',[
						'class'=>'btn btn-xs btn-danger',
						'type'=>'submit',
						'data-toggle'=>'modal',
						'data-backdrop'=>'static',
						'data-target'=>'#msgModalDeleting',
					]) }}
			</div>
		</div>
	</div>
</div><!-- Fin de Mensaje Modal confirmar borrado de registro.-->
{{ Form::close() }}

<!-- Mensaje Modal al borrar registro. Bloquea la pantalla mientras se procesa la solicitud -->
<div class="modal fade" id="msgModalDeleting" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h4>
					<i class="fa fa-cog fa-spin fa-3x fa-fw" style="vertical-align: middle;"></i> Borrando rol...
				</h4>
			</div>
		</div>

	</div>
</div><!-- Fin de Mensaje Modal al borrar registro.-->