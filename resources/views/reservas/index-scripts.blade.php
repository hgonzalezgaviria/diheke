<script type="text/javascript">
$(function () {

	//Token para envío de peticiones por ajax a los controladores de Laravel
	var crsfToken = $('meta[name="csrf-token"]').attr('content');
	var sala = getUrlParameter('sala');
	//var equipo = getUrlParameter('equipo');
	var equipo = null;


	//Se obtienen los días de la semana seleccionados y se almacena en la variable global 'diasSemSelected'
	//Dropdown con lista de dias de la semana [lunes-sabado]
	var diasSemSelected = ["lunes", "martes", "miércoles", "jueves", "viernes", "sábado"];
	$('#chkdias').multiselect({
		//maxHeight: 400,
		//dropUp: true,
		numberDisplayed: 8,
		//buttonWidth: '300px',
		nonSelectedText: 'Ninguno',
		onChange: function(option, checked, select) {
			diasem = $(option).val();
			if(checked)
				diasSemSelected.push(diasem);
			else
				diasSemSelected = $(diasSemSelected).not([diasem]).get();

			console.log(diasSemSelected);
		}
	});
	$('#chkdias').multiselect('selectAll', false);
	$('#chkdias').multiselect('updateButtonText');
	/*$("#chkdias").on('change', function(){
		diasSemSelected = $(this).find('option:selected').map(function(){
							return $(this).val();
						}).get();
		console.log(diasSemSelected);
	});*/

	//Inicialización de inputs tipo DataPicker
	var optionsDtPicker = {
		locale: 'es',
		stepping: 30,
		useCurrent: false,  //Important! See issue #1075. Requerido para minDate
		minDate: moment(), //-1 Permite seleccionar el dia actual
		defaultDate: moment().add(30,'minutes'), //-1 Permite seleccionar el dia actual
		daysOfWeekDisabled: [0],//Deshabilita el día domingo
		//disabledDates: getFestivos(), //No funciona porque el arreglo debe ser objMoment o mm/dd/yyyy
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up: "fa fa-arrow-up",
			down: "fa fa-arrow-down",
			previous: 'fa fa-chevron-left',
			next: 'fa fa-chevron-right',
			today: 'glyphicon glyphicon-screenshot',
			clear: 'fa fa-trash',
			close: 'fa fa-times'
		},
		tooltips: {
			//today: 'Go to today',
			//clear: 'Clear selection',
			//close: 'Close the picker',
			selectMonth: 'Seleccione Mes',
			prevMonth: 'Mes Anterior',
			nextMonth: 'Mes Siguiente',
			selectYear: 'Seleccione Año',
			prevYear: 'Año Anterior',
			nextYear: 'Año Siguiente',
			selectDecade: 'Seleccione Década',
			prevDecade: 'Década Anterior',
			nextDecade: 'Década Siguiente',
			prevCentury: 'Siglo Anterior',
			nextCentury: 'Siglo Siguiente'
		}
	};

	$('#fechaInicio').datetimepicker(optionsDtPicker);
	$('#fechaInicio').data("DateTimePicker").options({
		format: 'YYYY-MM-DD HH:mm'
	});

	$('#fechaHasta').datetimepicker(optionsDtPicker);
	$('#fechaHasta').data("DateTimePicker").options({
		format: 'YYYY-MM-DD'
	});
	$('#fechaHasta').data("DateTimePicker").clear();

    $("#fechaInicio").on("dp.change", function (e) {
        $('#fechaHasta').data("DateTimePicker")
        	.minDate(e.date)
        	.clear();
    });

/***** Funciones y eventos para llenar dropdown/combobox *****/

	//llenar cboxFacultades
	function llenarCboxFacultades(facultad){
	//$("#cboxFacultades").on('click', function(){
		var cboxFacultades = $('#cboxFacultades');

		if( cboxFacultades.val() == null){
			cboxFacultades.empty();
			cboxFacultades.append('<option selected disabled>Cargando...</option>');
			//cboxFacultades.find('option:first').text("Cargando...");
			$.ajax({
				url: '../consultaFacultades',
				//data: 'sede='+ null,
				dataType: "json",
				type: "POST",
				headers: {
					"X-CSRF-TOKEN": crsfToken
				},
				success: function(facultades) {
				 
					cboxFacultades.empty();
					var registros = facultades.length;
					if(registros > 0){
						cboxFacultades.append('<option selected disabled>Seleccione...</option>');
						for(var i = 0; i < facultades.length; i++){
							cboxFacultades.append(
								'<option value="' + facultades[i].UNID_ID + '">' +
									facultades[i].UNID_NOMBRE +
								'</option>'
							);
						}
					} else {
						$.msgBox({
							title:"Información",
							content:"¡No hay datos disponibles!",
							type:"info"
						}); 
					}
				},
				error: function(json){
					console.log("Error al traer los datos");
					$('#errorAjax').append(json.responseText);
				}
			});
		}
	} // llenarCboxFacultades click
	llenarCboxFacultades();

	//Al cambiar seleccion de cboxFacultades, se llena cBoxDocentes
	$("#cboxFacultades").on('change', function(){
		llenarCboxDocentes($(this).val());
	}); // cboxFacultades change

	//llenar cboxDocentes
	function llenarCboxDocentes(facultad){
		//var facultad = $("#cboxFacultades").val();
		var cBoxDocentes = $("#cBoxDocentes");

		//if( cBoxDocentes.val() == null){

			cBoxDocentes.empty();
			cBoxDocentes.append('<option selected disabled>Cargando...</option>');

			$.ajax({
				url: '../consultaDocentes',
				data: 'unidad='+ facultad,
				dataType: "json",
				type: "POST",
				headers: {
					"X-CSRF-TOKEN": crsfToken
				},
				success: function(docentes, error) {
					cBoxDocentes.empty();
					var registros = docentes.length;

					if(registros > 0){
						cBoxDocentes.append('<option selected disabled>Seleccione...</option>');
						for(var i = 0; i < docentes.length; i++){
							cBoxDocentes.append('<option value=' + docentes[i].PEGE_ID + '>' + docentes[i].PENG_PRIMERNOMBRE + " " + docentes[i].PENG_SEGUNDONOMBRE + " " + docentes[i].PENG_PRIMERAPELLIDO + " " + docentes[i].PENG_SEGUNDOAPELLIDO + '</option>' );
						} 
					} else {
						$.msgBox({
							title:"Información",
							content:"¡No hay datos disponibles!",
							type:"info"
						});
					}
				},
				error: function(json){
					console.log("Error al traer los datos");
					$('#errorAjax').append('<h1>llenarDocentes</h1>'+json.responseText);
				}
			});
		//}
	}// llenarCboxDocentes func

	//Al cambiar seleccion de cBoxDocentes, se llena cBoxGrupos
	$("#cBoxDocentes").on('change', function(){
		//llenarCboxGrupos($(this).val());
		$("#cBoxGrupos").trigger('click');
	}); // cBoxDocentes change

	//llenar cBoxGrupos
	$("#cBoxGrupos").on('click', function(){

		var cBoxGrupos = $(this);

		if( cBoxGrupos.val() == null){
			cBoxGrupos.find('option:first').text("Cargando...");
			$.ajax({
				url: '../consultaGrupos',
				data: 'sede='+ null,
				dataType: "json",
				type: "POST",
				headers: {
					"X-CSRF-TOKEN": crsfToken
				},
				success: function(grupos) {
					cBoxGrupos.empty();
					var registros = grupos.length;
					if(registros > 0){
						for(var i = 0; i < grupos.length; i++){
							$("#cBoxGrupos").append(
								'<option value=' + grupos[i].GRUP_ID + '>' +
									grupos[i].GRUP_NOMBRE +
								'</option>'
							);
						}
					} else {
						$.msgBox({
							title:"Información",
							content:"¡No hay datos disponibles!",
							type:"info"
						});
					}
				},
				error: function(json){
					console.log("Error al traer los datos");
					$('#errorAjax').append(json.responseText);
				}
				});
		}
	}); // cBoxGrupos click

	//llenar cboxAsignaturas
	$("#cboxAsignaturas").on('click', function(){
		var selectAsignaturas = $(this);
		
		if(selectAsignaturas.val() == null){
			selectAsignaturas.find('option:first').text("Cargando...");
			$.ajax({
				url: '../consultaMaterias',
				data: 'sede='+ null,
				dataType: "json",
				type: "POST",
				headers: {
				"X-CSRF-TOKEN": crsfToken
				},
				success: function(materia) {
					selectAsignaturas.empty();
					var registros = materia.length;
					if(registros > 0){
						for(var i = 0; i < materia.length; i++){
							selectAsignaturas.append(
								'<option value=' + materia[i].MATE_CODIGOMATERIA + '>' +
									materia[i].MATE_NOMBRE +
								'</option>'
							);
						}
						selectAsignaturas.trigger("chosen:updated");
					} else {
						$.msgBox({
							title:"Información",
							content:"¡No hay datos disponibles!",
							type:"info"
						}); 
					}
				},
				error: function(json){
					console.log("Error al traer los datos");
					$('#errorAjax').append(json.responseText);
				}
			});
		}
	}); // cboxAsignaturas click

	//
	//Al cambiar valor de radios 'tipoRepeticion', se habilitan los form requeridos según el tipo de repetición. 
	var tipoRepetChecked;
	$("input[name=tipoRepeticion]").click(function(){

		tipoRepetChecked = $(this).filter(':checked').val();

		switch(tipoRepetChecked){
			//case 'semana': //si el R.B es el de reservar semanalmente, se muestran todos los checkbox
			//	$('.checkbox').show();
			//	break;
			case 'hasta': //Reserva diaria hasta la fecha seleccionada.
				$('.reservaPorDias').addClass('hide');
				$('.reservaHastaFecha').removeClass('hide');
				break;
			case 'pordias': //Reserva para los días de la semana seleccionados hasta la fecha seleccionada.
				$('.reservaHastaFecha').addClass('hide');
				$('.reservaPorDias').removeClass('hide');
				break;
			default: //Reseva sin repetición
				$('#fechaHasta').val('');
				$('.reservaHastaFecha').addClass('hide');
				$('.reservaPorDias').addClass('hide');
		}
	});

/***** FIN Funciones y eventos para llenar dropdown/combobox *****/


/***** Funciones para reservar *****/
	//$('#btn-reservar').on('click', function() {
	$('#msgModalProcessing').on('shown.bs.modal', function() {

		tipoRepetChecked = $("input[name=tipoRepeticion]").filter(':checked').val();

		switch(tipoRepetChecked){
			case 'hasta': //Reserva diaria hasta la fecha seleccionada.
				reservaHastaFecha();
				break;
			/*case 'pordias': //Reserva para los días de la semana seleccionados hasta la fecha seleccionada.
				reservaPorDias();
				break;*/
			case 'ninguna':
				reservaHastaFecha();
				break;
		}
		//$('#msgModalProcessing').modal('handleUpdate')
		//window.setTimeout(function(){ location.reload(); }, 1000);
	});



	function reservaHastaFecha() {

		/***** COPIADO DESDE  reservaSinRepeticion ******/

		var titulo = 'RS.R';
		var todoeldia = false;

		//Obteniendo valores del formulario
		var fechaini = $('#fechaInicio').data("DateTimePicker").date();
		var fechainicio = moment(fechaini, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
		var nhoras = $('#nHoras').val();

		//se le adiciona el numero de horas
		var fechafin = moment(fechaini).add(nhoras, 'hours');
		var fechafinal = moment(fechafin,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');


		var facultad = $("#cboxFacultades").val();
		var docente = $("#cBoxDocentes").val();
		var materia = $("#cboxAsignaturas").val();
		var grupo = $("#cBoxGrupos").val();



		/***** FIN  COPIADO DESDE  reservaSinRepeticion ******/


		//variable para almacenar el valor de la fecha de inicio formateada a YYYY-MM-DD de la
		//reserva que se pretende realizar
		var fini = $('#fechaInicio').data("DateTimePicker").date();
		fini = moment(fini, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

		var fechahasta = $('#fechaHasta').data("DateTimePicker").date();
		if(fechahasta == null || fechahasta.format('YYYY-MM-DD') == fini){
			fechahasta = moment(fini).add(nhoras, 'hours').format('YYYY-MM-DD HH:ss');;
		} else {
			fechahasta = moment(fechahasta, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');
		}

		if(fini > fechahasta){
			$.msgBox({
				title:"Error",
				content:"¡Fecha inicial no puede ser mayor a la fecha final! ",
				type:"error"
			});
			$('#msgModalProcessing').modal('hide');
			return;
		}

		var arrReservas = [];
		var cont = 0;

		//trae todas las reservas del fullcalendar 
		var reservasTodas = $('#calendar').fullCalendar('clientEvents');
		//console.log(JSON.stringify(reservasTodas));
		var puedeHacerReservas = true;

		console.log('fini = '+fini);
		console.log('fechahasta = '+fechahasta);
		console.log(fini < fechahasta);

		var arrFestivos = getFestivos();

		//Si la reserva es sin repetición, no se debe repetir el while
		var repetir = true;
		while( (fini < fechahasta) && puedeHacerReservas && repetir){
			if(tipoRepetChecked == 'ninguna')
				repetir = false;

			if(cont!=0){
				fechainicio = moment(fechainicio).add(1, 'days');
				fechainicio = moment(fechainicio,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
				fechafinal = moment(fechafinal).add(1, 'days');
				fechafinal = moment(fechafinal,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
				fini = moment(fini).add(1, 'days');
			}
			cont++;
			fini = moment(fini,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

			var diasemana =  moment(fechainicio, 'YYYY-MM-DD HH:mm').format('dddd');
			var msgError;
			//console.log(fini+' es festivo? ' + ($.inArray( fini , arrFestivos)>=0))
			//Si la fecha no está en arrFestivos y si el dia está seleccionado...
			if( 
				( $.inArray( fini , arrFestivos) < 0 ) && ( $.inArray(diasemana, diasSemSelected) >= 0 )
				){
				//Se adiciona la fecha al arreglo de reservas
				arrReservas.push({
					'RESE_TITULO': titulo,
					'RESE_FECHAINI': fechainicio,
					'RESE_FECHAFIN': fechafinal, 
					'RESE_TODOELDIA': todoeldia,
					'SALA_ID': sala,
				});

				//Validaciones de cruce de fechas en reservas existentes
				//Si existen reservas previas, se debe validar que no tenga cruces
				if(reservasTodas.length > 0){
					for(k in reservasTodas){

						//objeto tipo date para almacenar el valor de la fecha inicial de la reserva del arreglo
						var fechairan = new Date();
						fechairan = moment(reservasTodas[k].start, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

						//objeto tipo date para almacenar el valor de la fecha final de la reserva que esta en bd
						var ffinalran = new Date();
						ffinalran = moment(reservasTodas[k].end, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

						//variable para almacenar el valor de la fecha de inicio formateada a YYYY-MM-DD de la
						//reserva que se pretende realizar
						var fecInicioValidaran = moment(fechainicio, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');
 
						//objeto tipo date para almacenar el valor de la fecha inicial de la reserva que se pretende realizar
						var finicioreservaran = new Date();
						finicioreservaran = moment(reservasTodas[k].start, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

						//si la fecha de inicio de base de datos (formato YYYY-MM-DD) es igual a la fecha de inicio
						//de reserva que se pretende realizar, se validan las demas condiciones. Es decir que no va
						//revisar todas las reservas sino unicamente las reservas del día en que se pretende realizar
						//la nueva reserva
						if(fecInicioValidaran == finicioreservaran){
							puedeHacerReservas = validarReservaLibre(fechairan,ffinalran, fechainicio,fechafinal);
						}

						if(!puedeHacerReservas){
							msgError = 'Algunas se traslapan en el horario!';
							repetir = false;
							break;
						}
					}//For validar reservas existentes
				}
			} else {//If Festivos
				msgError = 'Es un festivo.';
			}
		}//aqui cierra el while

			console.log('puedeHacerReservas='+puedeHacerReservas);
		if(puedeHacerReservas && arrReservas.length>0){
			$.ajax({
				url: 'guardarReservas',
				data: {
					reservas : arrReservas,
					'UNID_ID': facultad,
					'PEGE_ID': docente,
					'GRUP_ID': grupo,
					'MATE_CODIGOMATERIA': materia
				},
				//dataType: 'json',
				type: "POST",
				headers: {
					"X-CSRF-TOKEN": crsfToken
				},
				success: function(events) {
					$('#calendar').fullCalendar('refetchEvents');
					$.msgBox({
						title:"Éxito",
						content:"¡Su reserva se ha realizado satisfactoriamente!",
						type:"success"
					});

					console.log("Events guardarReservas"+JSON.stringify(events));
				},
				error: function(json){
					console.log("Error al crear la reserva");
					$('#errorAjax').append(json.responseText);
					$.msgBox({
						title:"Error",
						content:"¡No se puede realizar la reserva!. Verifique los datos estén completos.",
						type:"error"
					});
					$('#msgModalProcessing').modal('hide');
				},
			});
		} else {
			$.msgBox({
				title:"Error",
				content:"¡No se puede realizar reservas. "+msgError,
				type:"error"
			});
			$('#msgModalProcessing').modal('hide');
		}
	};

/***** HELPERS - Funciones de apoyo *****/
	
	//Valida que una fecha de reserva nueva no se "traslape" con una reserva existente
	// Para mas información, visite el archivo reservas/testvalidacion.blade.php
	function validarReservaLibre(fIniExis, fFinExis, fIniNew, fFinNew){
		var esvalida = false;

		if(( (fIniNew >= fIniExis) &&
			  (fIniNew >= fFinExis) &&
			  (fFinNew >= fFinExis) 
			) || (
			  (fIniNew < fIniExis) &&
			  (fIniNew < fFinExis) &&
			  (fFinNew <= fIniExis)
				))
			esvalida = true;
		
		return esvalida;
	}
			
	//Obtener el valor de un parametro enviado por GET
	function getUrlParameter(sParam) {
		var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');
			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : sParameterName[1];
			}
		}
	};

	//Obtener array de festivos por Ajax
	function getFestivos() {
		var arrFestivos = [];
		$.ajax({
			url: 'getFestivos',
			async: false,
			dataType: 'json',
			type: 'POST',
			headers: {
				"X-CSRF-TOKEN": crsfToken
			},
			success: function(festivos) {
				for(var i = 0; i < festivos.length; i++){
					var ffest = moment(festivos[i].FEST_FECHA, 'YYYY-MM-DD').format('YYYY-MM-DD');
					arrFestivos[i] = ffest;
				}
			},
			error: function(json){
				console.log("Error al consultar festivos");
				$('#errorAjax').append(json.responseText);
			}        
		});
		//console.log("Festivos:" + arrFestivos);
		return arrFestivos;
	}

	/* initialize the external events
	-----------------------------------------------------------------*/
	function ini_events(ele) {
		ele.each(function () {
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};

			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 1070,
				revert: true, // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
		});
	}

	ini_events($('#external-events div.external-event'));
	/* initialize the calendar
	-----------------------------------------------------------------*/
	//Date for the calendar events (dummy data)
	//while(reload==false){
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		buttonText: {
			today: 'hoy',
			month: 'mes',
			week: 'semana',
			day: 'dia'
		},
		events: {
			url:"../cargaEventos" + sala
		},
		eventRender: function(event, element) { 
			var endd = moment(event.end).format('HH:mm');
			element.find('.fc-title').append(" " + endd);
		},
		eventAfterAllRender: function( view ) {
			$('#msgModalProcessing').modal('hide');
		},
		eventClick: function(calEvent, jsEvent, view) {
			//Visualizar Popup con los detalles de la reserva
			var start = moment(calEvent.start).format('YYYY-MM-DD HH:mm:ss');
			var end = moment(calEvent.end).format('YYYY-MM-DD HH:mm:ss');

			$('#divmodal').empty();
			$('#divmodal').append("<p><b>Descripción: </b> " +  calEvent.title + "</p>");
			$('#divmodal').append("<p><b>Sede: </b> "+calEvent.SEDE_DESCRIPCION+"</p>");
			$('#divmodal').append("<p><b>Espacio/Sala: </b> "+calEvent.SALA_DESCRIPCION+ "</p>");
			$('#divmodal').append("<p><b>Fecha de Inicio: </b> " +  start + "</p>");
			$('#divmodal').append("<p><b>Fecha Fin: </b> " +  end + "</p>");
			//$('#divmodal').append("<p><b>Duración:</b> " +'2'+ "</p>");
			$('#divmodal').append("<p><b>Estado:</b> " +calEvent.ESTA_DESCRIPCION+ "</p>");
			$('#divmodal').append("<p><b>Total reservas:</b> " +calEvent.count_reservas+ "</p>");
			$('#divmodal').append("<p><b>Creado por:</b> <span class='RESE_CREADOPOR'>" +calEvent.RESE_CREADOPOR+ "</span></p>");
			$('#divmodal').append("<p><b>Autorización:</b> <span class='AUTO_ID'>" +calEvent.AUTO_ID+ "</span></p>");
			$('#modalReserva').modal('show');
			// change the border color just for fun
			$(this).css('border-color', 'red');
			//console.log(calEvent);
		},
		editable: false,
		droppable: false, // this allows things to be dropped onto the calendar !!!
		drop: function (date, allDay) { // this function is called when something is dropped
			// retrieve the dropped element's stored Event Object
			var originalEventObject = $(this).data('eventObject');
			// we need to copy it, so that multiple events don't have a reference to the same object
			var copiedEventObject = $.extend({}, originalEventObject);
			allDay=false;
			// assign it the date that was reported
			copiedEventObject.start = date;
			copiedEventObject.end = date;
			copiedEventObject.allDay = allDay;
			copiedEventObject.backgroundColor = $(this).css("background-color");
			copiedEventObject.borderColor = $(this).css("border-color");

			// render the event on the calendar
			//$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
			// is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}

			//Guardamos el evento creado en base de datos
			var title=copiedEventObject.title;
			var start=copiedEventObject.start.format("YYYY-MM-DD HH:mm");
			var end=copiedEventObject.end.format("YYYY-MM-DD HH:mm");
			var back=copiedEventObject.backgroundColor;

			var fechaInicioStr = $('#fechaInicio').data("DateTimePicker").date();
			var fechaIni = moment(fechaInicioStr).format("YYYY-MM-DD HH:mm:ss");

			var fechaFinStr = $('#fechaFin').data("DateTimePicker").date();
			var fechaFin = moment(fechaFinStr).format("YYYY-MM-DD HH:mm:ss");
		
			$.ajax({
				url: 'guardaEventos',
				data: 'title='+ title+'&start='+ fechaIni+'&allday='+allDay+'&background='+back+
				'&end='+fechaFin,
				type: "POST",
				headers: {
				"X-CSRF-TOKEN": crsfToken
				},
				success: function(events) {
					console.log('Evento creado');
					$('#calendar').fullCalendar('refetchEvents');
				},
				error: function(json){
					console.log("Error al crear evento");
					$('#errorAjax').append(json.responseText);
				}
			});
		}
	});

});
</script>