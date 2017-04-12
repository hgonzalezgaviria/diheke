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
		stepping: 1,
		useCurrent: false,  //Important! See issue #1075. Requerido para minDate
		minDate: new Date()-1, //-1 Permite seleccionar el dia actual
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
				$('.reservaHastaFecha').addClass('hide');
				$('.reservaPorDias').addClass('hide');
		}
	});

/***** FIN Funciones y eventos para llenar dropdown/combobox *****/


/***** Funciones para reservar *****/
	$('#btn-reservar').on('click', function() {
		tipoRepetChecked = $("input[name=tipoRepeticion]").filter(':checked').val();

		switch(tipoRepetChecked){
			case 'hasta': //Reserva diaria hasta la fecha seleccionada.
				reservaHastaFecha();
				break;
			/*case 'pordias': //Reserva para los días de la semana seleccionados hasta la fecha seleccionada.
				reservaPorDias();
				break;*/
			case 'ninguna':
				reservaSinRepeticion();
				break;
		}
	});

	function reservaSinRepeticion() {

		var arrFestivos = getFestivos();

		var titulo = 'RS';
		var todoeldia = false;
		var fondo = 'rgb(51, 122, 183)';

		/*var color = $('#color').val();
		if(color != null){
			fondo = color;
			//console.log('no es nulo '+color)
		}*/

		//Obteniendo valores del formulario
		var fechaini = $('#fechaInicio').data("DateTimePicker").date();
		//var fechafin = $('#fechaFin').data("DateTimePicker").date();

		var nhoras = $('#nHoras').val();

		//se le adiciona el numero de horas

		var fechafin = moment(fechaini).add(nhoras, 'hours');

		//var fechainicio = moment(fechaini, 'YYYY-DD-MM HH:mm:ss').format('YYYY-DD-MM HH:mm:ss');
		var fechainicio = moment(fechaini, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
		var fechafinal = moment(fechafin,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');


		var facultad = $("#cboxFacultades").val();
		var docente = $("#cBoxDocentes").val();
		var materia = $("#cboxAsignaturas").val();
		var grupo = $("#cBoxGrupos").val();



		var reserva = new Object();
		var finicio = $('#fechaInicio').data("DateTimePicker").date();
		finicio = moment(finicio, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

		//variable para almacenar el valor de la fecha de inicio formateada a YYYY-MM-DD de la
		//reserva que se pretende realizar
		var finiciovalida = $('#fechaInicio').data("DateTimePicker").date();
		finiciovalida = moment(finiciovalida, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

		var fechahasta = $('#fechaHasta').data("DateTimePicker").date();
		fechahasta = moment(fechahasta, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

		//trae todos los eventos del fullcalendar 
		var array = $('#calendar').fullCalendar('clientEvents');

		var puedereservar = (array[0] == null) ? false : true;

		for(i in array){

			//objeto tipo date para almacenar el valor de la fecha inicial de la reserva que esta en bd
			var fechai = new Date();
			fechai = moment(array[i].start, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

			//objeto tipo date para almacenar el valor de la fecha final de la reserva que esta en bd
			var ffinal = new Date();
			ffinal = moment(array[i].end, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

			//objeto tipo date para almacenar el valor de la fecha inicial de la reserva que se pretende
			//realizar
			var finicioreserva = new Date();
			finicioreserva = moment(array[i].start, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

			//objeto tipo date para almacenar el valor de la fecha final de la reserva que se pretende
			//realizar
			var ffinalreserva = new Date();
			ffinalreserva = moment(fechafin, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

			//si la fecha de inicio de base de datos (formato YYYY-MM-DD) es igual a la fecha de inicio
			//de reserva que se pretende realizar, se validan las demas condiciones. Es decir que no va
			//revisar todas las reservas sino unicamente las reservas del día en que se pretende realizar
			//la nueva reserva
			if(finiciovalida == finicioreserva){
				//si esta condicion es verdadera no puede reservar
				if(finicio>=fechai && finicio<=ffinal){

					$.msgBox({
						title:"Error",
						content:"¡Fecha inicial no disponible para la reserva! "+finicio,
						type:"error"
					});

					puedereservar = false;
					break;
				
				} else if(ffinalreserva>=fechai && ffinalreserva<=ffinal){
					
					$.msgBox({
						title:"Error",
						content:"¡Fecha final no disponible para la reserva! "+ffinalreserva,
						type:"error"
					});

					puedereservar = false;
					break;

				} else {
					puedereservar = true;
				}
			} else {
				puedereservar = true;
			}
		}

		if(puedereservar){
			//====================================================================================
			//este bloque sirve para validar que el día en que se pretende hacer la reserva no sea un festivo
			var finiciores = moment(fechainicio, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');
			for(var j = 0; j < arrFestivos.length; j++){
			
				var fest = moment(arrFestivos[j], 'YYYY-MM-DD').format('YYYY-MM-DD');
				var diasem =  moment(finiciores, 'YYYY-MM-DD HH:mm').format('dddd');

				if(fest == finiciores || diasem == "domingo"){
					puedereservar = false;
				}
			}


			if(puedereservar){
				$.ajax({
					url: 'guardaEventos',
					data: 'title='+ titulo+
						'&start='+ fechainicio+
						'&allday='+todoeldia+
						'&background='+fondo+
						'&end='+fechafinal+
						'&sala='+sala+
						'&equipo='+equipo+
						'&facultad='+facultad+
						'&materia='+materia+
						'&grupo='+grupo+
						'&docente='+docente,
					type: "POST",
					headers: {
						"X-CSRF-TOKEN": crsfToken
					},
					success: function(events) {
						$.msgBox({
							title:"Éxito",
							content:"¡Su reserva se ha realizado satisfactoriamente!",
							type:"success"
						});
						$('#calendar').fullCalendar('refetchEvents');
					},
					error: function(json){
						console.log("Error al crear evento en reserva unitaria");
						$('#errorAjax').append(json.responseText);
					}        
				});
			} else {
				$.msgBox({
					title: "Error",
					content: "¡No se puede realizar la reserva, este día es domingo o festivo!",
					type: "error"
				});
			}
		}//aqui cierra el if de si puede reservar					
	};

	function reservaHastaFecha() {

		/***** COPIADO DESDE  reservaSinRepeticion ******/
		var arrFestivos = getFestivos();

		var titulo = 'RS.R';
		var todoeldia = false;

		//Obteniendo valores del formulario
		var fechaini = $('#fechaInicio').data("DateTimePicker").date();
		//var fechafin = $('#fechaFin').data("DateTimePicker").date();

		var nhoras = $('#nHoras').val();

		//se le adiciona el numero de horas

		var fechafin = moment(fechaini).add(nhoras, 'hours');

		//var fechainicio = moment(fechaini, 'YYYY-DD-MM HH:mm:ss').format('YYYY-DD-MM HH:mm:ss');
		var fechainicio = moment(fechaini, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
		var fechafinal = moment(fechafin,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');


		var facultad = $("#cboxFacultades").val();
		var docente = $("#cBoxDocentes").val();
		var materia = $("#cboxAsignaturas").val();
		var grupo = $("#cBoxGrupos").val();

		var reserva = new Object();
		var finicio = $('#fechaInicio').data("DateTimePicker").date();
		finicio = moment(finicio, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

		//variable para almacenar el valor de la fecha de inicio formateada a YYYY-MM-DD de la
		//reserva que se pretende realizar
		var finiciovalida = $('#fechaInicio').data("DateTimePicker").date();
		finiciovalida = moment(finiciovalida, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

		var fechahasta = $('#fechaHasta').data("DateTimePicker").date();
		fechahasta = moment(fechahasta, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

		//trae todos los eventos del fullcalendar 
		var array = $('#calendar').fullCalendar('clientEvents');

		var puedereservar = (array[0] == null) ? false : true;

		/***** FIN  COPIADO DESDE  reservaSinRepeticion ******/

		if( (fechahasta!=null && fechahasta!="") && (tipoRepetChecked!=null && tipoRepetChecked=="hasta") ){

			var fini = $('#fechaInicio').data("DateTimePicker").date();
			fini = moment(fini, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');


			var fecha = null;
			var fecReservaIni = moment(fechainicio).add(0, 'days');
			fecReservaIni = moment(fecReservaIni,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

			//alert(fini + " - " + fechahasta);
			var i = 0;
			var arrReservas = [];
			var cont = 0;

			//trae todas las reservas del fullcalendar 
			var reservasTodas = $('#calendar').fullCalendar('clientEvents');
			console.log(JSON.stringify(reservasTodas));
			var puedeHacerReservas = true;
			//(reservasTodas[0] == null) ? false : true;

			//variable para almacenar el valor de la fecha de inicio formateada a YYYY-MM-DD de la
			//reserva que se pretende realizar
			var fecInicioValidaran = new Date();

			var finicioran = new Date();

			var reservastras = null;

			while(fini < fechahasta){
					if(cont != 0){
						fechainicio = moment(fechainicio).add(1, 'days');
						fechainicio = moment(fechainicio,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
						fechafinal = moment(fechafinal).add(1, 'days');
						fechafinal = moment(fechafinal,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
						fini = moment(fini).add(1, 'days');
					}else if(cont == 1){
						fechainicio = moment(fechainicio).add(1, 'days');
						fechainicio = moment(fechainicio,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
						fechafinal = moment(fechafinal).add(1, 'days');
						fechafinal = moment(fechafinal,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
						fini = moment(fini).add(1, 'days');
					}

					cont = 1;

					fini = moment(fini,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');
					var diasemana =  moment(fechainicio, 'YYYY-MM-DD HH:mm').format('dddd');

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
					}

					//Validaciones de cruce de fechas en reservas existentes
					for(k in reservasTodas){

						//objeto tipo date para almacenar el valor de la fecha inicial de la reserva del arreglo
						var fechairan = new Date();
						fechairan = moment(reservasTodas[k].start, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

						//objeto tipo date para almacenar el valor de la fecha final de la reserva que esta en bd
						var ffinalran = new Date();
						ffinalran = moment(reservasTodas[k].end, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

						fecInicioValidaran = moment(fechainicio, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

						finicioran = moment(fechainicio, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

						//objeto tipo date para almacenar el valor de la fecha inicial de la reserva que se pretende realizar
						var finicioreservaran = new Date();
						finicioreservaran = moment(reservasTodas[k].start, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

						//objeto tipo date para almacenar el valor de la fecha final de la reserva que se pretende realizar
						var ffinalreservaran = new Date();
						ffinalreservaran = moment(fechafinal, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

						//si la fecha de inicio de base de datos (formato YYYY-MM-DD) es igual a la fecha de inicio
						//de reserva que se pretende realizar, se validan las demas condiciones. Es decir que no va
						//revisar todas las reservas sino unicamente las reservas del día en que se pretende realizar
						//la nueva reserva
						if(fecInicioValidaran == finicioreservaran){
							//si esta condicion es verdadera no puede reservar
							if(finicioran>=fechairan && finicioran<=ffinalran){
								puedeHacerReservas = false;
								break;
							} else if(ffinalreservaran>=fechairan && ffinalreservaran<=ffinalran){
								puedeHacerReservas = false;
								break;
							} else {
								puedeHacerReservas = true;
							}
						} else {
							puedeHacerReservas = true;
						}
					}//aqui cierra el for
				i++;
			}//aqui cierra el while


			if(puedeHacerReservas){
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
						console.log("Error al crear evento");
						$('#errorAjax').append(json.responseText);
					}
				});
			} else {
				$.msgBox({
					title:"Error",
					content:"¡No se puede realizar reservas, algunas se traslapan en el horario! ",
					type:"error"
				});
			}
		}//aqui cierra el if de si es reserva de rango
	};

/***** HELPERS - Funciones de apoyo *****/

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
		eventClick: function(calEvent, jsEvent, view) {
			//Visualizar Popup con los detalles de la reserva
			var start = moment(calEvent.start).format('YYYY-MM-DD HH:mm:ss');
			var end = moment(calEvent.end).format('YYYY-MM-DD HH:mm:ss');
			$('#divmodal').empty();
			$('#divmodal').append("<p>Titulo: " +  calEvent.title + "</p>");
			$('#divmodal').append("<p>Fecha de Inicio: " +  start + "</p>");
			$('#divmodal').append("<p>Fecha Fin: " +  end + "</p>");
			$('#myModal').modal('show');
			// change the border color just for fun
			$(this).css('border-color', 'red');
		},
		editable: true,
		droppable: true, // this allows things to be dropped onto the calendar !!!
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