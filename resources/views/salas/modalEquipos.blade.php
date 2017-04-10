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
			$('#modalEquipos').on('show.bs.modal', function (event) {

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
				var salas = {!! $salas !!};
				//console.log(salas);
				// alert(salas);
				var equipos = salas[index]['equipos'];
				//console.log(equipos);
				//alert(equipos);
				var html = '';
				//Cabecera de la tabla
				html += '<h3>Equipos de la sala -> '+descripcion+'</h3>'+ 
						'<div class="table-responsive table-condensed">'+
			'<table  class="table table-striped" width="100%"  border="0" cellspacing="0" cellpadding="0" style="font-size:12px">'+
                          ' <thead>'+
                            '<tr>'+
                              '<th class="col-xs-1 col-sm-1 col-md-1 col-lg-1">#Recurso</th>'+
                              '<th class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Descripción</th>'+
							  '</tr>'+							  
							  '</thead>'+
							  '<tbody>';
						if (equipos.length<=0){ //Si no hay equipos en la sala
							html= '<div class="col-xs-12">'+
          				'<div class="alert alert-danger" id="note1">'+
                    		'La sala seleccionada no tienes equipos disponibles.'+
                    		'</div>'+
                    		'<div class="alert alert-success" id="note2">'+
                    		'Acción: Debe ingresar al mantenimiento de equipos y asociar  los equipos a la sala.'+
                    		'</div>'+                    	
                    	'</div>';
						}else{// Si hay equipos en la sala {Arma tabla}
								for (var i = 0 ; i < equipos.length; i++){
									html +=   '<tr>'+
				                              '<td>'+equipos[i].EQUI_ID+'</td>'+
				                              '<td>'+equipos[i].EQUI_DESCRIPCION+'</td>'+
								  			'</tr>';
								}; //Finaliza el for
							html+= '</tbody>'+
							  '</table>'+
							  '</div>';
							  };//Finaliza el if-else			
							 
				modal.find('.equipos').html(html);	//Ingresa html al modal

				var urlForm = button.data('action'); // Se cambia acción del formulario.
				$('.frmModal').attr('action', urlForm);
			});
		});
	</script>
@parent
@endsection

<!-- Mensaje Modal para mostrar equipos-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalEquipos" role="dialog" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header alert-info">
				<h4 class="modal-title">Sala <span class="id"></span></h4>
			</div>

			<div class="modal-body">

				<div class="row">
					<div class="col-xs-2">
						<i class="fa fa-tasks  fa-3x fa-fw"></i>
					</div>
					<div class="col-xs-10">
						<!--<h3><span class="descripcion"></span></h3>-->
						<h4><span class="equipos"></span></h4>
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
</div><!-- Fin de  Mensaje Modal para mostrar equipos-->