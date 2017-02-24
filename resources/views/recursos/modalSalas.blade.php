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
			$('#modalSalas').on('show.bs.modal', function (event) {

				var button = $(event.relatedTarget); // Button that triggered the modal
				var modal = $(this);
				
				var id = button.data('id'); // Se obtiene valor en data-id
				modal.find('.id').text(id); //Se asigna en la etiqueta con clase id

				var modelo = button.data('modelo');
				modal.find('.modelo').text(modelo);

				var descripcion = button.data('descripcion');
	//				alert(modal.find('.descripcion').text(descripcion));
				modal.find('.descripcion').text(descripcion);

				var index = button.data('index'); // Se obtiene valor Del index del for {i}
				//alert(index);
				var recursos = {!! $recursos !!};
				var salas = recursos[index]['salas'];
				//alert(recursos);
				var html = '';
				//Cabecera de la tabla
				html += '<h3>Salas del recurso -> '+descripcion+'</h3>'+ 
						'<div class="table-responsive table-condensed">'+
			'<table  class="pull-center table table-striped table-bordered" width="100%"  border="0" cellspacing="0" cellpadding="0" style="font-size:12px">'+
                          ' <thead>'+
                            '<tr>'+
                              '<th class="col-xs-1 col-sm-1 col-md-1 col-lg-1">#Sala</th>'+
                              '<th class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Descripción</th>'+
                              '<th class="col-xs-6 col-sm-6 col-md-6 col-lg-6">Sede</th>'+
							  '</tr>'+							  
							  '</thead>'+
							  '<tbody>';
						if (salas.length<=0){ //Si no hay recursos en la sala
							html= '<div class="col-xs-12">'+
          				'<div class="alert alert-danger" id="note1">'+
                    		'El recurso seleccionado no tienes salas disponibles.'+
                    		'</div>'+
                    		'<div class="alert alert-success" id="note2">'+
                    		'Acción: Debe ingresar al mantenimiento de recursos y asociar  los recursos a la sala.'+
                    		'</div>'+                    	
                    	'</div>';
						}else{// Si hay recursos en la sala {Arma tabla}
								for (var i = 0 ; i < salas.length; i++){
									html +=   '<tr>'+
				                              '<td>'+salas[i].SALA_ID+'</td>'+
				                              '<td>'+salas[i].SALA_DESCRIPCION+'</td>'+
				                              '<td>'+salas[i]['sede'].SEDE_DESCRIPCION+'</td>'+
								  			'</tr>';
								}; //Finaliza el for
							html+= '</tbody>'+
							  '</table>'+
							  '</div>';
							  };//Finaliza el if-else			
							 
				modal.find('.salas').html(html);	//Ingresa html al modal

				var urlForm = button.data('action'); // Se cambia acción del formulario.
				$('.frmModal').attr('action', urlForm);
			});
		});
	</script>
@parent
@endsection

<!-- Mensaje Modal para mostrar recursos-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalSalas" role="dialog" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header alert-info">
				<h4 class="modal-title">Recurso <span class="id"></span></h4>
			</div>

			<div class="modal-body">

				<div class="row">
					<div class="col-xs-2">
						<i class="fa fa-tasks  fa-3x fa-fw"></i>
					</div>
					<div class="col-xs-10">
						<!--<h3><span class="descripcion"></span></h3>-->
						<h4><span class="salas"></span></h4>
					</div>
				</div>
			</div>
          <div class="modal-footer">
            <button type="submit" class="btn-xs btn-danger btn-xs" data-dismiss="modal">
                  <span class="glyphicon glyphicon-remove"></span> Cancelar
                </button>
          </div>
		</div>
	</div>
</div><!-- Fin de  Mensaje Modal para mostrar recursos-->