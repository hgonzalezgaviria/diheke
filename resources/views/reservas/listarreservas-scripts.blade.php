<script type="text/javascript">
$(function () {

	//Token para envío de peticiones por ajax a los controladores de Laravel
	var crsfToken = $('meta[name="csrf-token"]').attr('content');
	var sala = getUrlParameter('sala');
	//var equipo = getUrlParameter('equipo');
	var equipo = null;

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

	//Inicialización de inputs tipo DataPicker
	var optionsDtPicker = {
		locale: 'es',
		stepping: 30,
		useCurrent: false,  //Important! See issue #1075. Requerido para minDate
		//minDate: moment(), //-1 Permite seleccionar el dia actual
		//defaultDate: moment().add(30,'minutes'), //-1 Permite seleccionar el dia actual
		daysOfWeekDisabled: [0],//Deshabilita el día domingo
		//enabledHours: (Array)[7,8,9,10,11,12,13,14,15,16,17,18,19,20,21],
		//disabledHours: (Array)[0,1,2,3,4,5,6,22,23], //Deshabilita las horas en las cuales no hay servicio de reserva
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
						cboxFacultades.append('<option selected disabled>Todos...</option>');
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

	//llenar llenarCboxEstados
	function llenarCboxEstados(){
	//$("#cboxFacultades").on('click', function(){
		var cboxEstados = $('#cboxEstados');

		if( cboxEstados.val() == null){
			cboxEstados.empty();
			cboxEstados.append('<option selected disabled>Cargando...</option>');
			//cboxFacultades.find('option:first').text("Cargando...");
			$.ajax({
				url: '../consultaEstados',
				//data: 'sede='+ null,
				dataType: "json",
				type: "POST",
				headers: {
					"X-CSRF-TOKEN": crsfToken
				},
				success: function(estados) {
				 
					cboxEstados.empty();
					var registros = estados.length;
					if(registros > 0){
						cboxEstados.append('<option selected disabled>Todos...</option>');
						for(var i = 0; i < estados.length; i++){
							cboxEstados.append(
								'<option value="' + estados[i].ESTA_ID + '">' +
									estados[i].ESTA_DESCRIPCION +
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
	} // llenarCboxEstados click
	llenarCboxEstados();

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
						cBoxDocentes.append('<option selected disabled>Todos...</option>');
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


	//cambiar el mes cuando lo seleccione del combo
	$("#cboxMeses").on('change', function(){

		var selectMeses = $(this).val();
		var currentYear = (new Date).getFullYear();

		var ano = $("#ano").val(); //año especificado por el usuario para la consulta

		var anosel = null; //variable que contendra el año en curso o el año dado por el usuario
						   //si es que el año dado por el usuario es nulo


		if(ano != null && ano.length == 4){
			anosel = ano;
		}else{
			anosel = currentYear;
		}

		if(selectMeses != null && selectMeses != ""){
			$('#calendar').fullCalendar('gotoDate', new Date(anosel, selectMeses));
		}
		
		
		
	}); // cboxMeses click

    

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

	//consultar las reservas con filtros

	ini_events($('#external-events div.external-event'));
	/* initialize the calendar
	-----------------------------------------------------------------*/
	//Date for the calendar events (dummy data)
	//while(reload==false){
	$('#calendar').fullCalendar({
		//isRTL: true,
		displayEventTime: false,
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
			url:"../listarReservas" + sala
		},
		eventRender: function(event, element) { 
			var startt = moment(event.start).format('HH:mm');
			var endd = moment(event.end).format('HH:mm');
			element.find('.fc-title').append(" " + startt + "-" + endd);
		},
		eventAfterAllRender: function( view ) {
			$('#msgModalProcessing').modal('hide');
		},
		eventMouseover: function(calEvent, jsEvent) { 
			var tooltip = '<div class="tooltipevent" style="width:340px;height:110px;background:#f9ec54;position:absolute;z-index:10001;">'+
				"<b>Sede:</b>"+calEvent.SEDE_DESCRIPCION +" <br>"+
				"<b>Facultad:</b>"+calEvent.UNID_NOMBRE +" <br>"+
				"<b>Grupo:</b>"+calEvent.GRUP_NOMBRE +" <br>"+
				"<b>Materia:</b>"+calEvent.MATE_NOMBRE +" <br>"+
				"<b>Docente:</b>"+ calEvent.PENG_NOMBRE +" <br>" +
				"<b>Estado:</b>"+ calEvent.ESTA_DESCRIPCION +" <br>" +
				'</div>'; var $tool = $(tooltip).appendTo('body');
		$(this).mouseover(function(e) {
		    $(this).css('z-index', 10000);
		            $tool.fadeIn('500');
		            $tool.fadeTo('10', 1.9);
		}).mousemove(function(e) {
		    $tool.css('top', e.pageY + 10);
		    $tool.css('left', e.pageX + 20);
		});
		},
		eventMouseout: function(calEvent, jsEvent) {
		$(this).css('z-index', 8);
		$('.tooltipevent').remove();
		},
		eventClick: function(calEvent, jsEvent, view) {
			//Visualizar Popup con los detalles de la reserva
			var start = moment(calEvent.start).format('YYYY-MM-DD HH:mm:ss');
			var end = moment(calEvent.end).format('YYYY-MM-DD HH:mm:ss');

			$('#divmodal').empty();
			$('#divmodal').append("<p><b>Sede: </b> "+calEvent.SEDE_DESCRIPCION+ "<b> Facultad: </b> "+calEvent.UNID_NOMBRE+  "</p>");
			$('#divmodal').append("<p><b>Grupo: </b> "+calEvent.GRUP_NOMBRE+ "<b> Materia: </b> "+calEvent.MATE_NOMBRE + "</p>");
			$('#divmodal').append("<p><b>Docente: </b> "+calEvent.PENG_NOMBRE+ "</p>");
			$('#divmodal').append("<p><b>Espacio/Sala: </b> "+calEvent.SALA_DESCRIPCION+ "</p>");
			$('#divmodal').append("<p><b>Fecha de Inicio: </b> " + start + "<b> Fecha Fin: </b> " + end +"</p>");
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

	function listarFiltro(facultad, sala, docente, grupo, asignatura, estado){
		
		//Token para envío de peticiones por ajax a los controladores de Laravel
		var crsfToken = $('meta[name="csrf-token"]').attr('content');

		var p = 'sala='+ sala +'&cboxFacultades='+ facultad +'&cBoxDocentes='+ docente +'&cBoxGrupos='+grupo + '&cboxAsignaturas='+ asignatura +'&cboxEstados='+estado;

		//alert(p);

        var events = $.ajax({
						url: '../listReservasFiltro',
						data: 'sala='+ sala +'&cboxFacultades='+ facultad +'&cBoxDocentes='+ docente +'&cBoxGrupos='+grupo + '&cboxAsignaturas='+ asignatura +'&cboxEstados='+estado,
						type: "POST",
						headers: {
							"X-CSRF-TOKEN": crsfToken
						}
					});

		//$('#calendar').fullCalendar( 'removeEventSource', events);
		$('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar( 'addEventSource', events);         
        $('#calendar').fullCalendar( 'refetchEvents' );

	}

	function aplicarFiltros(facultad, sala, docente, grupo, asignatura, estado){

		var facultad = 1;
		var sala = 1;
		var docente = 1111;
		var grupo = 12;
		var asignatura = "FIXXXXX1";
		var estado = 6;

		var reservasTodas = $('#calendar').fullCalendar('clientEvents');

		var reservasfiltro = new Array();

		if(reservasTodas.length > 0){

			for(i in reservasTodas){

				console.log(reservasTodas[i].AUTO_ID);

				if(facultad != null){
					if(reservasTodas[i].UNID_ID == facultad){
						reservasfiltro.push( reservasTodas[i] );
						//delete reservasTodas[i];
					}
				}
					

			}

		$('#calendar').fullCalendar( 'removeEventSource', reservasTodas);
		$('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar( 'addEventSource', reservasTodas);         
        $('#calendar').fullCalendar( 'refetchEvents' );



		}

		console.log(reservasTodas);

	}

	//click en el boton de filtrar
	$("#btn-filtrar").on('click', function(){


		var sala = $("#sala").val();
		var facultad = $("#cboxFacultades").val();
		var docente = $("#cBoxDocentes").val();
		var grupo = $("#cBoxGrupos").val();
		var asignatura = $("#cboxAsignaturas").val();
		var estado = $("#cboxEstados").val();

		//listarFiltro(facultad, sala, docente, grupo, asignatura, estado);
	
		aplicarFiltros(facultad, sala, docente, grupo, asignatura, estado);
		
	}); // click en el boton de filtrar function listarFiltro(facultad, sala, docente, grupo, asignatura, estado){



});
</script>