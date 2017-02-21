@extends('layout')
@section('title', '/ Crear Reserva')
@section('scripts')
<script type="text/javascript">

  $(function () {

    $('#fechainicio').datetimepicker({
      locale: 'es',
      format: 'YYYY-MM-DD HH:mm',
          //format: 'DD/MM/YYYY hh:mm A',
          stepping: 1,
          useCurrent: false,  //Important! See issue #1075. Requerido para minDate
          minDate: new Date(),
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
        });

    $('#fechahasta').datetimepicker({
      locale: 'es',
      format: 'YYYY-MM-DD',
          //format: 'DD/MM/YYYY hh:mm A',
          stepping: 1,
          useCurrent: false,  //Important! See issue #1075. Requerido para minDate
          minDate: new Date(),
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
        });

    //ocultamos el campo de fecha hasta cuando se cargue el DOM
    $('#fechahasta').hide();

    //ocultamos todos los checkbox cuando se cargue el dom
    $('.checkbox').hide();


    //variable "sel" para asignar cual es el Radio Button seleccionado
    var sel = null;

    //agregamos un callback para determinar cual es el Radio Button que se encuentra en estado seleccionado
    $("input[name=radio]").click(function(){
      
      //asignamos a la variable "sel" el valor del R.B seleccionado
      sel = $("input[name=radio]:checked").val();

      //si el R.B es el de reservar hasta una fecha, se muestra el campo de fecha hasta
      if(sel == "hasta"){
        //con esta linea mostramos el campo de fecha hasta
        $('#fechahasta').show();
      }else{
        //con esta linea ocultamos el campo de fecha hasta
        $('#fechahasta').hide();
      }

      //si el R.B es el de reservar semanalmente, se muestran todos los checkbox 
      if(sel == "semana"){
        //con esta linea mostramos todos los checkbox
        $('.checkbox').show();
      }else{
        //con esta linea ocultamos todos los checkbox
        $('.checkbox').hide();
      }

    });


    //variable que se le asigna el valor de una funcion para obtener el valor de un parametro enviado por GET
    var getUrlParameter = function getUrlParameter(sParam) {
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


    //configuracion del colorpicker para que tenga el formato RGB
    $('#color').colorpicker({
            //color: '#AA3399',
            format: 'rgb',
            input: 'color'
          });

    $('#probar').click(function() {

    });
    
    
    
    $('#reservar').click(function() {

                  var arrfestivos = [];
                  var arrfest = [];
      
                  crsfToken = document.getElementsByName("_token")[0].value;

                  var festrequest;

                      festrequest = $.ajax({
                       url: 'getFestivos',
                       async: false,
                       data: 'reservas=' + 'probando',
                       dataType: 'json',
                       type: "POST",
                       headers: {
                        "X-CSRF-TOKEN": crsfToken
                      },
                      success: function(festivos) {
                        
                        for(var i = 0; i < festivos.length; i++){
                          var ffest = moment(festivos[i].FEST_FECHA, 'YYYY-MM-DD').format('YYYY-MM-DD');
                          arrfestivos[i] = ffest;
                        }

                      },
                      error:   function(json){
                        console.log("Error al consultar festivos");
                      }        
                    });

                  var titulo = 'R.S';
                  var todoeldia = false;
                  var fondo = 'rgb(51, 122, 183)';

                  //alert( $('#color').val());
                  var color = $('#color').val();

                  if(color != null){
                    fondo = color;
                    //console.log('no es nulo '+color)
                  }

                  var fechaini = $('#fechainicio').data("DateTimePicker").date();
                  //var fechafin = $('#fechafin').data("DateTimePicker").date();

                  var nhoras = $('#nhoras').val();

                  //se le adiciona el numero de horas

                  var fechafin = moment(fechaini).add(nhoras, 'hours');

                  //var fechainicio = moment(fechaini, 'YYYY-DD-MM HH:mm:ss').format('YYYY-DD-MM HH:mm:ss');
                  var fechainicio = moment(fechaini, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
                  var fechafinal = moment(fechafin,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');



                  var sala = getUrlParameter('sala');
                  var equipo = getUrlParameter('equipo');
                  equipo = null;


                  var reserva = new Object();
                  var finicio = $('#fechainicio').data("DateTimePicker").date();
                  finicio = moment(finicio, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
        
                  //variable para almacenar el valor de la fecha de inicio formateada a YYYY-MM-DD de la
                  //reserva que se pretende realizar
                  var finiciovalida = $('#fechainicio').data("DateTimePicker").date();
                  finiciovalida = moment(finiciovalida, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

                  var fechahasta = $('#fechahasta').data("DateTimePicker").date();
                  fechahasta = moment(fechahasta, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

                  //trae todos los eventos del fullcalendar 
                  var array = $('#calendar').fullCalendar('clientEvents');

                  var puedereservar = false;

                  if(array[0] == null){
                    puedereservar = true;
                  }

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
                              //alert(fechafin);
                              

                              //si esta condicion es verdadera no puede reservar
                              if(finicio>=fechai && finicio<=ffinal){
                                
                                $.msgBox({
                                  title:"Error",
                                  content:"¡Fecha inicial no disponible para la reserva! "+finicio,
                                  type:"error"
                                });

                                puedereservar = false;
                                break;
                                
                              }else if(ffinalreserva>=fechai && ffinalreserva<=ffinal){
                                
                                $.msgBox({
                                  title:"Error",
                                  content:"¡Fecha final no disponible para la reserva! "+ffinalreserva,
                                  type:"error"
                                });

                                puedereservar = false;
                                break;

                              }else{
                                puedereservar = true;
                              }


                            }else{
                              puedereservar = true;
                            }
                        }


        //alert("el valor de sel es: "+sel+ " Puede reservar es "+puedereservar);
        if(puedereservar){

                          if(sel!="hasta" && sel!="semestre" && sel!="mensual" && sel!="semana"){

                              //====================================================================================
                              //este bloque sirve para validar que el día en que se pretende hacer la reserva no sea un festivo
                              var finiciores = moment(fechainicio, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');
                              for(var j = 0; j < arrfestivos.length; j++){
                                
                                var fest = moment(arrfestivos[j], 'YYYY-MM-DD').format('YYYY-MM-DD');
                                var diasem =  moment(finiciores, 'YYYY-MM-DD HH:mm').format('dddd');
                                      //arrfestivos[i] = ffest;

                                      if(fest == finiciores || diasem == "domingo"){
                                        puedereservar = false;
                                      }
                              }
                              //====================================================================================
                              

                              
                              if(puedereservar){

                                      crsfToken = document.getElementsByName("_token")[0].value;

                                      $.ajax({
                                           url: 'guardaEventos',
                                           data: 'title='+ titulo+'&start='+ fechainicio+'&allday='+todoeldia+'&background='+fondo+
                                           '&end='+fechafinal+'&sala='+sala+'&equipo='+equipo,
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
                                         error:   function(json){
                                          console.log("Error al crear evento");
                                        }        
                                      });

                              }else{

                                    $.msgBox({
                                      title:"Error",
                                      content:"¡No se puede realizar la reserva, este día es domingo o festivo!",
                                      type:"error"
                                    });

                              }
                          }

                          if((fechahasta!=null && fechahasta!="") && (sel!=null && sel=="hasta")){

                            
                                var fini = $('#fechainicio').data("DateTimePicker").date();
                                fini = moment(fini, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');


                                var fecha = null;
                                var fecreservaini = moment(fechainicio).add(0, 'days');
                                fecreservaini = moment(fecreservaini,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

                                //alert(fini + " - " + fechahasta);
                                var i = 0;
                                var arrreservas = [];
                                var cont = 0;

                                //trae todas las reservas del fullcalendar 
                                var reservastodas = $('#calendar').fullCalendar('clientEvents');

                                var puedehacerreservas = false;

                                if(reservastodas[0] == null){
                                  puedehacerreservas = true;
                                }


                                //variable para almacenar el valor de la fecha de inicio formateada a YYYY-MM-DD de la
                                //reserva que se pretende realizar
                                var finiciovalida = new Date();

                                var finicio = new Date();
                            
                            

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
                                          //alert("dia de la semana: "+diasemana);

                                var cnt = 0;
                                for(var j = 0; j < arrfestivos.length; j++){
                                  
                                  var fest = moment(arrfestivos[j], 'YYYY-MM-DD').format('YYYY-MM-DD');
                                  //arrfestivos[i] = ffest;

                                  if((fest == fini) || (diasemana == "domingo")){
                                    arrreservas[i] = [null, null, null, null, null, null, null];
                                    cnt +=1;
                                  }
                                  else if( (fest != fini && cnt == 0)){
                                    arrreservas[i] = [titulo, fechainicio, todoeldia, fondo, fechafinal, sala, equipo];
                                    cnt = 0;
                                  }

                                }

                                        for(k in reservastodas){

                                                //objeto tipo date para almacenar el valor de la fecha inicial de la reserva del arreglo
                                                var fechai = new Date();
                                                fechai = moment(reservastodas[k].start, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

                                                //objeto tipo date para almacenar el valor de la fecha final de la reserva que esta en bd
                                                var ffinal = new Date();
                                                ffinal = moment(reservastodas[k].end, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

                                                finiciovalida = moment(fechainicio, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

                                                finicio = moment(fechainicio, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

                                                //objeto tipo date para almacenar el valor de la fecha inicial de la reserva que se pretende realizar
                                                var finicioreserva = new Date();
                                                finicioreserva = moment(reservastodas[k].start, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

                                                finicio = moment(fechai, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

                                                //objeto tipo date para almacenar el valor de la fecha final de la reserva que se pretende
                                                //realizar
                                                var ffinalreserva = new Date();
                                                ffinalreserva = moment(fechafinal, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

                                                          //si la fecha de inicio de base de datos (formato YYYY-MM-DD) es igual a la fecha de inicio
                                                  //de reserva que se pretende realizar, se validan las demas condiciones. Es decir que no va
                                                  //revisar todas las reservas sino unicamente las reservas del día en que se pretende realizar
                                                  //la nueva reserva
                                                  if(finiciovalida == finicioreserva){
                                                        //alert(fechafin);
                                                        

                                                          //si esta condicion es verdadera no puede reservar
                                                          if(finicio>=fechai && finicio<=ffinal){
                                                            
                                                            $.msgBox({
                                                              title:"Error",
                                                              content:"¡Fecha inicial no disponible para la reserva! "+finicio,
                                                              type:"error"
                                                            });

                                                            puedereservar = false;
                                                            break;
                                                            
                                                          }else if(ffinalreserva>=fechai && ffinalreserva<=ffinal){
                                                            
                                                            $.msgBox({
                                                              title:"Error",
                                                              content:"¡Fecha final no disponible para la reserva! "+ffinalreserva,
                                                              type:"error"
                                                            });

                                                            puedereservar = false;
                                                            break;

                                                          }else{
                                                            puedereservar = true;
                                                          }

                                                  }else{
                                                      puedereservar = true;
                                                  }
                                        }

                                                  i++;
                    }

                                                if(puedereservar){

                                                    crsfToken = document.getElementsByName("_token")[0].value;

                                                    var request;

                                                    request = $.ajax({
                                                     url: 'guardarReservas',
                                                     data: {reservas : arrreservas},
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



                                                    },
                                                    error:   function(json){
                                                      console.log("Error al crear evento");
                                                    }        
                                                    });
                                                }
                                              }

                                              

                                              

                                            }

                                            if(!puedereservar){

                                              $.msgBox({
                                                title:"Error",
                                                content:"¡No se puede realizar reservas, algunas se traslapan! ",
                                                type:"error"
                                              });

                                            }


                                            
                                            
                                            
                                            
                                            
    });

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

      events: { url:"../cargaEventos"},

      //con esta funcion llamaremos el popup para mostrar los detalles de la reserva
      eventClick: function(calEvent, jsEvent, view) {

        
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

        var fechaInicioStr = $('#fechainicio').data("DateTimePicker").date();
        var fechaFinStr = $('#fechafin').data("DateTimePicker").date();

        var fechaIni = moment(fechaInicioStr).format("YYYY-MM-DD HH:mm:ss");
        var fechaFin = moment(fechaFinStr).format("YYYY-MM-DD HH:mm:ss");
        
        crsfToken = document.getElementsByName("_token")[0].value;
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
          }        
        });

      }

      

    });

    /* AGREGANDO EVENTOS AL PANEL */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button

      //$('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });


    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }

      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //Remove event from text input
      $("#new-event").val("");
    });


  });
</script>
@endsection

@section('content')

<h1 class="page-header">Nueva Reserva</h1>

@include('partials/errors')

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all() )}}

<div class="panel panel-default">
  <!-- Content Header (Page header) -->
  <div class="panel-heading"><h2> Calendario de Reservas   </h2>  </div>
  <div class="panel-body">
    <!-- Main content -->

    <div class="row">
      <div class="col-md-3">
       
        <!-- /. box -->
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Crear Reserva</h3>
          </div>
          <div class="box-body">
            
            <!-- /btn-group -->
            <div class="input-group">
              

              <div class="input-group-btn">
                
              </div>

              <!-- /btn-group -->
            </div><br/><br/>
            <!-- /input-group -->


            <div class='input-group date' id='fechainicio'>
              <input type='text' class="form-control" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>

            <br>

            <div class='input-group date' >
              <input type='number' class="form-control" id="nhoras" placeholder="No. de horas" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>

            <br>

                <!--
                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                 <ul class="list-inline" id="color-chooser">
                   <li><a class="text-success" href="#"><i class="fa fa-circle fa-3x"></i></a></li>
                   <li><a class="text-primary" href="#"><i class="fa fa-circle fa-3x"></i></a></li>
                   <li><a class="text-danger" href="#"><i class="fa fa-circle fa-3x"></i></a></li>
                 </ul>
               </div>
             -->
             <div id="cp3" class="input-group colorpicker-component">
              <input type="text" class="form-control" id="color" readonly="true" />
              <span class="input-group-addon"><i></i></span>
            </div>

            <br>

            Tipo de Repetición:
            <div class="radio">
              <label><input type="radio" name="radio" name="semestre" value="semestre">Semestral</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="radio" name="mensual" value="mensual">Mensual</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="radio" name="semana" value="semana">En la Semana</label>
            </div>
            <div class="radio disabled">
              <label><input type="radio" name="radio" name="hasta" value="hasta">Hasta una Fecha</label>
            </div>

            <div class='input-group date' id='fechahasta'>
              <input type='text' class="form-control" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>

            <br>

            <div class="checkbox">
              <label><input type="checkbox" value="lu">Lunes</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="ma">Martes</label>
            </div>
            <div class="checkbox disabled">
              <label><input type="checkbox" value="mi">Miercoles</label>
            </div>
            <div class="checkbox disabled">
              <label><input type="checkbox" value="mi">Jueves</label>
            </div>
            <div class="checkbox disabled">
              <label><input type="checkbox" value="mi">Viernes</label>
            </div>
            <div class="checkbox disabled">
              <label><input type="checkbox" value="mi">Sabado</label>
            </div>

            <button id="reservar" type="button" class="btn btn-primary btn-flat">Crear Reserva</button>

            <button id="probar" type="button" class="btn btn-primary btn-flat">Probar</button>

            

            {!! Form::open(['route' => ['guardaEventos'], 'method' => 'POST', 'id' =>'form-calendario']) !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-body no-padding">
            <!-- THE CALENDAR -->
            <div id="calendar"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /. box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- /.content -->
  </div><!-- /.panel-body -->
</div><!-- /.panel -->
</div>
</div>

<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detalle de Reserva</h4>
      </div>
      <div class="modal-body" id="divmodal">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</div>

@endsection