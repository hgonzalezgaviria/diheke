<!-- Mensaje Modal para confirmar borrado de registro-->
<div class="modal fade" id="pregModalDelete" role="dialog" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">¿Borrar registro <span class="USER_ID"></span>?</h4>
			</div>

			<div class="modal-body">
				<p>
					<i class="fa fa-exclamation-triangle"></i> ¿Desea borrar el usuario <span class="username"></span>?
				</p>
			</div>

			<div class="modal-footer">
				<form id="frmDeleteUser" method="POST" action="" accept-charset="UTF-8" class="frmModal pull-right">

					<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">
						<i class="fa fa-times" aria-hidden="true"></i> NO
					</button>

					{{ Form::token() }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> SI ',[
						'class'=>'btn btn-xs btn-danger',
						'type'=>'submit',
						'data-toggle'=>'modal',
						'data-backdrop'=>'static',
						'data-target'=>'#msgModalDeleting',
					]) }}
				</form>
			</div>
		</div>
	</div>
</div><!-- Fin de Mensaje Modal confirmar borrado de registro.-->


<!-- Mensaje Modal al borrar registro. Bloquea la pantalla mientras se procesa la solicitud -->
<div class="modal fade" id="msgModalDeleting" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h4>
					<i class="fa fa-cog fa-spin fa-3x fa-fw" style="vertical-align: middle;"></i> Borrando usuario...
				</h4>
			</div>
		</div>

	</div>
</div><!-- Fin de Mensaje Modal al borrar registro.-->