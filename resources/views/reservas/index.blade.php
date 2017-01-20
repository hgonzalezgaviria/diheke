@extends('layout')
@section('title', '/ Crear Reserva')
@section('scripts')
    <script type="text/javascript">

  $(function () {

    $('#fechainicio').datetimepicker({
          locale: 'es',
          format: 'YYYY-MM-DD HH:mm:ss',
          //format: 'DD/MM/YYYY hh:mm A',
          stepping: 30,
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

    $('#fechafin').datetimepicker({
          locale: 'es',
          format: 'YYYY-MM-DD HH:mm:ss',
          //format: 'DD/MM/YYYY hh:mm A',
          stepping: 30,
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

    $('#probando').click(function() {


        var titulo = 'R.S';
        var todoeldia = false;
        var fondo = 'rgb(51, 122, 183)';
        var fechaini = $('#fechainicio').data("DateTimePicker").date();
        var fechafin = $('#fechafin').data("DateTimePicker").date();


        //var fechainicio = moment(fechaini, 'YYYY-DD-MM HH:mm:ss').format('YYYY-DD-MM HH:mm:ss');
        var fechainicio = moment(fechaini, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
        var fechafinal = moment(fechafin,'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');



        var sala = getUrlParameter('sala');
        var equipo = getUrlParameter('equipo');

        
        if(equipo != 0){
          titulo = 'R.E';
          alert(titulo + " " + sala);
        }

       
        
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
                console.log('Evento creado ');   
                $('#calendar').fullCalendar('refetchEvents');
              },
              error:   function(json){
                console.log("Error al crear evento");
              }        
        });
        
 
        
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

        alert('Event: ' + calEvent.title);
        alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
        alert('View: ' + view.name);

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

                <div class='input-group date' id='fechafin'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>

                <br>

                <button id="probando" type="button" class="btn btn-primary btn-flat">Crear Reserva</button>

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

@endsection

