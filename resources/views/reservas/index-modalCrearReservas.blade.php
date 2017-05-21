
@section('scripts')
<script type="text/javascript">
$(document).ready(function () {

	$('#btn-reservar').click(function() {
				if($('#tipoRepeticionHF').is(':checked')) { 
					var varfechaHasta = $('#fechaHasta').data("DateTimePicker").date();
					//var varfechaHasta1 = moment(varfechaHasta, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
					  if (varfechaHasta === null) {
					  //	alert('esta blanco');
				//	  	alert(varfechaHasta);

					  	$.msgBox({
							title:"Información",
							content:"El campo Fecha Hasta esta vacio",
							type:"warning"
						}); 

        				//alert('El campo Fecha Hasta esta vacio');
        			$("#fechaHasta").focus();
        			return false;
    				}

				//	alert(varfechaHasta); 

				}

    //Se obtiene el valor del campo
    var name = $('#nHoras').val();

    //Se verifica que el valor del campo este vacio
    if (name === '') {
        //alert('El campo Horas esta vacio');
          	$.msgBox({
							title:"Información",
							content:"El campo Horas esta vacio",
							type:"warning"
						}); 
        $("#nHoras").focus();
        return false;
    }
    //Se verifica longitud del campo
    else if (name.length != 1) {
       // alert('El longitud del campo hora es incorrecto');
           	$.msgBox({
							title:"Información",
							content:"El longitud del campo hora es incorrecto",
							type:"warning"
						}); 
        return false;
    } else {
       //return true;
    }

     var selectFaculta = $('#cboxFacultades').val();

       if (selectFaculta === null) {
      	//alert("Debes seleccionar una Falculta");
      	 	$.msgBox({
							title:"Información",
							content:"Debes seleccionar una Falculta",
							type:"warning"
						}); 

      	$("#cboxFacultades").focus();
        return false;
    }else {
        //alert('Campo correcto');
    }

         var selectDocente = $('#cBoxDocentes').val();

       if (selectDocente === null) {
      	//alert("Debes seleccionar un Docente");
      	$.msgBox({
							title:"Información",
							content:"Debes seleccionar un Docente",
							type:"warning"
						}); 

      	$("#cBoxDocentes").focus();
        return false;
    }else {
        //alert('Campo correcto');
    }

    var selectGrupo = $('#cBoxGrupos').val();

       if (selectGrupo === null) {
      	//alert("Debes seleccionar un Grupo");
      	 	$.msgBox({
							title:"Información",
							content:"Debes seleccionar un Grupo",
							type:"warning"
						}); 
      	$("#cBoxGrupos").focus();
        return false;
    }else {
        //alert('Campo correcto');
    }

       var selectAsignatura = $('#cboxAsignaturas').val();

       if (selectAsignatura === null) {
      	//alert("Debes seleccionar una Asignatura");
      	 	$.msgBox({
							title:"Información",
							content:"Debes seleccionar una Asignatura",
							type:"warning"
						}); 
      	$("#cboxAsignaturas").focus();
        return false;
    }else {
        //alert('Campo correcto');
    }



	});

});

$(function () {

	

	
	//Se determina cuales son los días de la semana que se encuentran seleccionados
	$("input[name=chkdias]").click(function(){
	  adiassel = $("input[name=chkdias]:checked").map(function(){
					return $(this).val();
				}).get();
	  console.log(adiassel);
	});




});
</script>
@parent
@endsection

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalcrearres" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content panel-info">

			<div class="modal-header panel-heading" style="border-top-left-radius: inherit; border-top-right-radius: inherit;">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Cerrar</span>
				</button>
				<h4 class="modal-title">Crear Reservas</h4>
			</div>

			<div class="modal-body">

				<div class="form-vertical" role="form">

				<div class="row">
						<div class="col-xs-7 form-group">
							<label>Desde:</label>
							<div class='input-group date' id='fechaInicio'>
								<input type='text' class="form-control" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>

						<div class="col-xs-5 form-group">
							<label>Horas:</label>
							<input type='number' class="form-control" min="1" max="12" id="nHoras" placeholder="No. de horas" />
						</div>

					</div>


					<div id="cp3" class="input-group colorpicker-component hide">
						<input type="text" class="form-control" id="color" readonly="true" />
						<span class="input-group-addon"><i></i></span>
					</div>

					<div class="form-group">
						<label>Tipo de Repetición:</label>
						<div class="input-group">
							<label class="radio-inline form-check-label">
								<input class="form-check-input" type="radio" name="tipoRepeticion" value="ninguna" checked>
								Ninguna
							</label>

            				@if (in_array(Auth::user()->rol->ROLE_ROL , ['audit','admin']))
							<label class="radio-inline">
								<input class="form-check-input" id="tipoRepeticionHF" type="radio" name="tipoRepeticion" value="hasta">
								Hasta una Fecha
							</label>
							@endif
						</div>
					</div>

					<div class="form-group reservaPorDias reservaHastaFecha hide">
						<label>Hasta:</label>
						<div class='input-group date' id='fechaHasta'>
							<input type='text' class="form-control" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>

					<div class="form-group reservaPorDias reservaHastaFecha hide">
						<label for="chkdias">Dias:</label>
						<div class="input-group">
							<select id="chkdias" name="chkdias[]" class="form-control" multiple="multiple" required>
								<option value="lunes" id="lu">Lunes</option>
								<option value="martes" id="ma">Martes</option>
								<option value="miércoles" id="mi">Miércoles</option>
								<option value="jueves" id="ju">Jueves</option>
								<option value="viernes" id="vi">Viernes</option>
								<option value="sábado" id="sa">Sábado</option>
								<option value="domingo" id="do" disabled>Domingo</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label>Facultad:</label>
						<div class="selectContainer">
							<select class="form-control" name="size" id="cboxFacultades">
							  <option selected disabled>Seleccione...</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label>Docente:</label>
						<div class="selectContainer">
							<select class="form-control" name="size" id="cBoxDocentes">
							  <option selected disabled>Seleccione...</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-4 form-group">
							<label>Grupo:</label>
							<div class="selectContainer">
								<select class="form-control" name="size" id="cBoxGrupos">
								  <option selected disabled>Seleccione...</option>
								</select>
							</div>
						</div>

						<div class="col-xs-8 form-group">
							<label>Asignatura:</label>
							<div class="selectContainer">
								<select class="form-control" name="size" id="cboxAsignaturas">
								  <option selected disabled>Seleccione...</option>
								</select>
							</div>
						</div>
					</div>

					

				</div> <!-- end Form -->
			</div>
						
			<div class="modal-footer">
				
				
						<button id="btn-reservar" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#msgModalProcessing">
							Crear Reserva
						</button>
				
				<button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarmodal">
					Cerrar
				</button>
			</div>
		</div> <!-- end modal-content -->
	</div><!-- end modal-dialog -->
</div>


