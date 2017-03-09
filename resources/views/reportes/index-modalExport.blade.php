@section('head')
	<meta name="csrf-token" content="{{ csrf_token() }}">
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
			$('#msgModalDownloading')
			.on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget); // Button that triggered the modal
				var modal = $(this);

				var formato = button.data('formato'); // Se obtiene valor en data-formato
				modal.find('.formato').text(formato); //Se asigna en la etiqueta con clase formato
			})
			.on('shown.bs.modal', function (event) {
				var button = $(event.relatedTarget); // Button that triggered the modal
				var modal = $(this);
				var formato = button.data('formato'); // Se obtiene valor en data-formato
				
				if(formato == 'PDF'){
					exportarPDF(modal);
				} else {
					//window.location.href = button.data('url');
					downloadAjax(button.data('url'), formato, modal);
				}
			}); //Fin evento show en msgModalDownloading

			function downloadAjax(url, formato, modal) {
				$.ajax({
					url: url,
					type: "GET",
					dataType: 'binary',
					success: function(result) {
						var url = URL.createObjectURL(result);
						var $a = $('<a />', {
							'href': url,
							'download': 'Encuesta {{ $ENCU_id }}.'+formato.toLowerCase(),
							'text': "click"
						}).hide().appendTo("body")[0].click();
						setTimeout(function() {
							URL.revokeObjectURL(url);
						}, 10000);
						modal.modal('hide');
					},
					error: function(event){
						console.log('Error ajax: '+event);
						alert('Error ajax: '+event);
						modal.modal('hide');
					}
				});
			}; // Fin downloadAjax
		});
	</script>
@parent
@endsection


{{ Form::button('<i class="fa fa-download" aria-hidden="true"></i> <span class="hidden-xs">Exportar</span>',[
		'class'=>'btn btn-lg btn-primary',
		'data-toggle'=>'modal',
		'data-target'=>'#pregModalExport',
]) }}

<!-- Mensaje Modal. Bloquea la pantalla mientras se procesa la solicitud -->
<div class="modal fade" id="pregModalExport" role="dialog" tabindex="-1" >
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Exportar</h4>
			</div>
			<div class="modal-body text-center">
				<!-- carga botón de exportar a Excel -->
				{{ Form::button(Html::image('assets/img/icons/excel-xls-icon.png', 'Exportar a XLS'),[
					'class'=>'btn',
					'data-toggle'=>'modal',
					'data-backdrop'=>'static',
					'data-formato'=>'XLS',
					'data-url'=>URL::to('encuestas/'.$ENCU_id.'/excel'),
					'data-target'=>'#msgModalDownloading',
				])}}

				<!-- carga botón de exportar a CSV -->
				{{ Form::button(Html::image('assets/img/icons/csv-icon.png', 'Exportar a CSV'),[
					'class'=>'btn',
					'data-toggle'=>'modal',
					'data-backdrop'=>'static',
					'data-formato'=>'CSV',
					'data-url'=>URL::to('encuestas/'.$ENCU_id.'/csv'),
					'data-target'=>'#msgModalDownloading',
				])}}

				<!-- carga botón de exportar a PDF -->
				{{ Form::button(Html::image('assets/img/icons/pdf-icon.png', 'Exportar a PDF'),[
					'class'=>'btn',
					'data-toggle'=>'modal',
					'data-backdrop'=>'static',
					'data-formato'=>'PDF',
					'data-target'=>'#msgModalDownloading',
				])}}

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					<i class="fa fa-times" aria-hidden="true"></i> Cancelar
				</button>
			</div>
		</div>
	</div>
</div>

<!-- Mensaje Modal al descargar. Bloquea la pantalla mientras se procesa la solicitud -->
<div class="modal fade" id="msgModalDownloading" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h4>
					<i class="fa fa-cog fa-spin fa-3x fa-fw" style="vertical-align: middle;"></i> Descargando <span class="formato"></span>...
				</h4>
			</div>
		</div>

	</div>
</div><!-- Fin de Mensaje Modal-->
