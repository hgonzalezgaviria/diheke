@extends('layout')
@section('title', '/ Crear Reserva')
@section('scripts')
<script type="text/javascript">

  $(function () {

    var adiassel = [];

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

    $('#fechahastad').datetimepicker({
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

    $('#fechainiciod').datetimepicker({
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




    $("#reservadias").click(function(){

      var arrreservasd = [];
      var arrfestivosd = [];

      var fondod = null;
      var titulod = 'RS.D';
      var todoeldiad = false;
      var fondod = 'rgb(255, 255, 0)';
      var colord = $('#color').val();

      if(colord != null){
        fondod = colord;
        //console.log('no es nulo '+color)
      }

      var facultadd = $("#facultadesd").val();
      var docented = $("#docentesd").val();
      var materiad = $("#asignaturasd").val();
      var grupod = $("#gruposd").val();

      var sala = getUrlParameter('sala');
      var equipod = getUrlParameter('equipo');
      equipod = null;

      //variable para validar cuantos días se seleccionaron
      var nrodias = adiassel.length;

      //variables de fechas de inicio de reserva y fecha final para validar el rango
      var finid = $('#fechainiciod').data("DateTimePicker").date();
      var ffind = $('#fechahastad').data("DateTimePicker").date();

      //numero de horas de la reserva
      var nhorasd = $('#nhorasd').val();

      //variable inicial y final de la reserva
      var finires = $('#fechainiciod').data("DateTimePicker").date();
      var ffinres = moment(finid).add(nhorasd, 'hours');

      //esto hace que la fecha inicial tenga la hora cero, de lo contrario la condicion del while
      //no se cumpliria en uno de los casos porque una fecha excede a la otra en horas, minutos o segundos
      finid = moment().startOf('day');

      if(nrodias > 0){

            crsfToken = document.getElementsByName("_token")[0].value;

            var festrequestd;

                festrequestd = $.ajax({
                       url: 'getFestivos',
                       async: false,
                       data: 'vacio=' + 'sinretorno',
                       dataType: 'json',
                       type: "POST",
                       headers: {
                        "X-CSRF-TOKEN": crsfToken
                      },
                      success: function(festivos) {
                        
                        for(var i = 0; i < festivos.length; i++){
                          var ffestd = moment(festivos[i].FEST_FECHA, 'YYYY-MM-DD').format('YYYY-MM-DD');
                          arrfestivosd[i] = ffestd;
                        }

                      },
                      error:   function(json){
                        console.log("Error al consultar festivos");
                        $('#errorAjax').append(json.responseText);
                      }        
                });

            
            var contr = 0;
            while(finid < ffind){

              var fini = moment(finires, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
              var ffin = moment(ffinres, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm'); 
              var ffinre = moment(finid, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

              //variable para controlar la excepcion de salida del bucle
              finid = moment(finid).add(1, 'days');

              //variable para obtener el día de la semana (lunes, martes, miercoles..)
              var diares =  moment(fini, 'YYYY-MM-DD HH:mm').format('dddd');

              //variable para volver la fecha de la reserva en formato YYYY-MM-DD
              var finir = moment(fini, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

              //fechas que incrementan en la reserva
              finires = moment(finires).add(1, 'days');
              ffinres = moment(ffinres).add(1, 'days');

              if(diares != "domingo"){
                  for(var i=0; i<adiassel.length; i++) {
                    //console.log(diares + " - " + adiassel[i]);
                        if(diares == adiassel[i]){
                            arrreservasd[contr] = [titulod, fini, 
                                            todoeldiad, fondod, 
                                            ffin, salad, 
                                            equipod, facultadd,
                                            docented, grupod, materiad];
                        }else{
                            arrreservasd[contr] = [null, null,
                                            null, null, 
                                            null, null, 
                                            null, null,
                                            null, null, null];
                        }
                  }

                  for(var i=0; i<adiassel.length; i++) {

                    
                    if(adiassel[i] == diares){

                      console.log("días iguales: " + adiassel[i] + " = " + diares);

                    }

                  }

                  //console.log(diares + "\n");
                        //console.log("valor del arreglo: " + arrreservasd[i] + " día: "+ diares);
                        //console.log(diares + " ");
              }

              contr++;

                /*
                for (var i = 0; i < arrfestivosd.length; i++) {
                  
                    var festd = moment(arrfestivosd[i], 'YYYY-MM-DD').format('YYYY-MM-DD');

                    //if((festd != finir) || (diares != "domingo")){

                      


                }
                */

              
            }

            //console.log("este es el arreglo final: "+ arrreservasd);

            //alert(arrreservasd.length);

            
            console.log(arrreservasd);

            crsfToken = document.getElementsByName("_token")[0].value;
            var request;
            request = $.ajax({
                url: 'guardarReservas',
                data: {reservas : arrreservasd},
                //dataType: 'json',
                type: "POST",
                headers: {
                  "X-CSRF-TOKEN": crsfToken
                },
                success: function(events) {
                  console.log('Response guardarReservas: '+JSON.stringify(events));
                  $.msgBox({
                    title:"Éxito",
                    content:"¡Su reserva se ha realizado satisfactoriamente!",
                    type:"success"
                  });
                  $('#calendar').fullCalendar('refetchEvents');
                },
                error:   function(json){
                  console.log("Error al crear evento de reservas por días: ");
                      $('#errorAjax').append(json.responseText);
                }
            });
            
            
     
      }else{

              $.msgBox({
                  title:"Error",
                  content:"¡Faltan datos para la reserva!",
                  type:"error"
              }); 

      }

    });




    var cmaterias = 0;
    $("#asignaturas").click(function(){

      


      if(cmaterias == 0){

            crsfToken = document.getElementsByName("_token")[0].value;

            $.ajax({
                     url: '../consultaMaterias',
                     data: 'sede='+ null,
                     dataType: "json",
                     type: "POST",
                     headers: {
                            "X-CSRF-TOKEN": crsfToken
                        },
                  success: function(materia) {
                 
                          $('#asignaturas').empty();

                          var registros = materia.length;
                          if(registros > 0){
                              for(var i = 0; i < materia.length; i++){
                                $("#asignaturas").append('<option value=' + materia[i].MATE_CODIGOMATERIA + '>' + materia[i].MATE_NOMBRE + '</option>');
                              }
                          }else{

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


            cmaterias++;
      }

    });

    var cfacultades = 0;
    $("#facultades").click(function(){

      var facu = $("#facultades").val();

      if(facu != null){

        llenarDocentes(facu);

      }

      if(cfacultades == 0){

            crsfToken = document.getElementsByName("_token")[0].value;

            $.ajax({
                     url: '../consultaFacultades',
                     data: 'sede='+ null,
                     dataType: "json",
                     type: "POST",
                     headers: {
                            "X-CSRF-TOKEN": crsfToken
                        },
                  success: function(facultades) {
                 
                          $('#facultades').empty();

                          var registros = facultades.length;
                          if(registros > 0){
                              for(var i = 0; i < facultades.length; i++){
                                $("#facultades").append('<option value=' + facultades[i].UNID_ID + '>' + facultades[i].UNID_NOMBRE + '</option>');
                              }
                          }else{

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


            cfacultades++;
      }

    });

    var cgrupos = 0;
    $("#grupos").click(function(){

      if(cgrupos == 0){

            crsfToken = document.getElementsByName("_token")[0].value;

            $.ajax({
                     url: '../consultaGrupos',
                     data: 'sede='+ null,
                     dataType: "json",
                     type: "POST",
                     headers: {
                            "X-CSRF-TOKEN": crsfToken
                        },
                  success: function(grupos) {

                          $('#grupos').empty();

                          var registros = grupos.length;

                          if(registros > 0){
              
                              for(var i = 0; i < grupos.length; i++){
                                $("#grupos").append('<option value=' + grupos[i].GRUP_ID + '>' + grupos[i].GRUP_NOMBRE + '</option>');
                              } 
                          }else{

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


            cgrupos++;
      }

    });



    function llenarDocentes(facultad){

              var opcion = $("#facultades").val();

              crsfToken = document.getElementsByName("_token")[0].value;

              $.ajax({
                       url: '../consultaDocentes',
                       data: 'unidad='+ opcion,
                       dataType: "json",
                       type: "POST",
                       headers: {
                              "X-CSRF-TOKEN": crsfToken
                          },
                    success: function(docentes, error) {

                            $('#docentes').empty();

                            var registros = grupos.length;

                            if(registros > 0){
                
                                for(var i = 0; i < docentes.length; i++){
                                  $("#docentes").append('<option value=' + docentes[i].PEGE_ID + '>' + docentes[i].PENG_PRIMERNOMBRE + " " + docentes[i].PENG_SEGUNDONOMBRE + " " + docentes[i].PENG_PRIMERAPELLIDO + " " + docentes[i].PENG_SEGUNDOAPELLIDO + '</option>' );
                                } 

                            }else{

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

    }

    function llenarDocentesd(facultad){

              //var opcion = $("#facultadesd").val();

              crsfToken = document.getElementsByName("_token")[0].value;

              $.ajax({
                       url: '../consultaDocentesd',
                       data: 'unidad='+ facultad,
                       dataType: "json",
                       type: "POST",
                       headers: {
                              "X-CSRF-TOKEN": crsfToken
                          },
                    success: function(docentes, error) {

                            $('#docentesd').empty();

                            var registros = docentes.length;

                            if(registros > 0){
                
                                for(var i = 0; i < docentes.length; i++){
                                  $("#docentesd").append('<option value=' + docentes[i].PEGE_ID + '>' + docentes[i].PENG_PRIMERNOMBRE + " " + docentes[i].PENG_SEGUNDONOMBRE + " " + docentes[i].PENG_PRIMERAPELLIDO + " " + docentes[i].PENG_SEGUNDOAPELLIDO + '</option>' );
                                } 

                            }

                    },
                    error: function(json){
                            console.log("Error al traer los datos");
                        $('#errorAjax').append('<h1>llenarDocentesd</h1>'+json.responseText);
                    }        
                });

    }

    //===========================================================
    var cfacultadesd = 0;
    $("#facultadesd").click(function(){

      var facud = $("#facultadesd").val();

      if(facud != null ){
        llenarDocentesd(facud);
      }

      if(cfacultadesd == 0){

            crsfToken = document.getElementsByName("_token")[0].value;

            $.ajax({
                     url: '../consultaFacultades',
                     data: 'sede='+ null,
                     dataType: "json",
                     type: "POST",
                     headers: {
                            "X-CSRF-TOKEN": crsfToken
                        },
                  success: function(facultades) {
                 
                          $('#facultadesd').empty();

                          var registros = facultades.length;

                          if(registros > 0){
                              for(var i = 0; i < facultades.length; i++){
                                $("#facultadesd").append('<option value=' + facultades[i].UNID_ID + '>' + facultades[i].UNID_NOMBRE + '</option>');
                              }
                          }else{

                              $.msgBox({
                                            title:"Información",
                                            content:"¡No hay datos disponibles!",
                                            type:"info"
                              }); 

                          }
                  },
                  error: function(json){
                          console.log("Error al traer los datos");
                        $('#errorAjax').append('<strong>$("#facultadesd").click</strong>'+json.responseText);
                  }        
              });


            cfacultadesd++;
      }


    });

    var cgruposd = 0;
    $("#gruposd").click(function(){

      if(cgruposd == 0){

            crsfToken = document.getElementsByName("_token")[0].value;

            $.ajax({
                     url: '../consultaGrupos',
                     data: 'sede='+ null,
                     dataType: "json",
                     type: "POST",
                     headers: {
                            "X-CSRF-TOKEN": crsfToken
                        },
                  success: function(grupos) {

                          $('#gruposd').empty();

                          var registros = grupos.length;

                          if(registros > 0){
              
                              for(var i = 0; i < grupos.length; i++){
                                $("#gruposd").append('<option value=' + grupos[i].GRUP_ID + '>' + grupos[i].GRUP_NOMBRE + '</option>');
                              } 
                          }else{

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


            cgruposd++;
      }

    });

    var cmateriasd = 0;
    $("#asignaturasd").click(function(){

      


      if(cmateriasd == 0){

            crsfToken = document.getElementsByName("_token")[0].value;

            $.ajax({
                     url: '../consultaMaterias',
                     data: 'sede='+ null,
                     dataType: "json",
                     type: "POST",
                     headers: {
                            "X-CSRF-TOKEN": crsfToken
                        },
                  success: function(materia) {
                 
                          $('#asignaturasd').empty();

                          var registros = materia.length;
                          if(registros > 0){
                              for(var i = 0; i < materia.length; i++){
                                $("#asignaturasd").append('<option value=' + materia[i].MATE_CODIGOMATERIA + '>' + materia[i].MATE_NOMBRE + '</option>');
                              }
                          }else{

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


            cmateriasd++;
      }

    });

    
    //=================================================

    //agregamos un callback para determinar cual es el check box que se encuentra en estado seleccionado
    
    $("input[name=chkdias]").click(function(){
      //asignamos a la variable "sel" el valor del R.B seleccionado
      adiassel = $("input[name=chkdias]:checked").map(function(){
                    return $(this).val();
                }).get();

      console.log(adiassel);

    });



    //ocultamos el campo de fecha hasta cuando se cargue el DOM
    $('#fechahasta').hide();

    //ocultamos todos los checkbox cuando se cargue el dom
    $('.checkbox').hide();


    //variable "sel" para asignar cual es el Radio Button seleccionado
    var sel = null;

    //agregamos un callback para determinar cual es el Radio Button que se encuentra en estado seleccionado
    //radios

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

      //si el R.B es el de reservar por días, se muestran modal con esas caracteristicas
      if(sel == "pordias"){
        
        $('#modalresdias').modal('show');
      }else{
       
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
                        $('#errorAjax').append(json.responseText);
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


                  var facultad = $("#facultades").val();
                  var docente = $("#docentes").val();
                  var materia = $("#asignaturas").val();
                  var grupo = $("#grupos").val();

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

                          if(sel!="hasta" && sel!="semestre" && sel!="mensual" && sel!="semana" && sel!="pordias"){

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
                              
                              /*

                              alert(puedereservar + "\n" + titulo + "\n" + fechainicio + "\n" + todoeldia + "\n"
                                 + fondo + "\n" + fechafinal + "\n" + sala + "\n" + equipo + "\n" + 
                                 facultad + "\n" + materia + "\n" + grupo + "\n" + docente + "\n");

                              */

                              if(puedereservar){

                                      crsfToken = document.getElementsByName("_token")[0].value;

                                      $.ajax({
                                           url: 'guardaEventos',
                                           data: 'title='+ titulo+'&start='+ fechainicio+'&allday='+todoeldia+'&background='+fondo+
                                           '&end='+fechafinal+'&sala='+sala+'&equipo='+equipo
                                           +'&facultad='+facultad+'&materia='+materia+'&grupo='+grupo
                                           +'&docente='+docente,
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
                                          console.log("Error al crear evento en reserva unitaria");
                        $('#errorAjax').append(json.responseText);
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
                                var finiciovalidaran = new Date();

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
                                          //alert("dia de la semana: "+diasemana);

                                var cnt = 0;
                                for(var j = 0; j < arrfestivos.length; j++){
                                  
                                  var fest = moment(arrfestivos[j], 'YYYY-MM-DD').format('YYYY-MM-DD');
                                  //arrfestivos[i] = ffest;

                                  if((fest == fini) || (diasemana == "domingo")){
                                    arrreservas[i] = [null, null, null, null, null, 
                                                      null, null, null, null, null, null];
                                    cnt +=1;
                                  }
                                  else if( (fest != fini && cnt == 0)){
                                    arrreservas[i] = [titulo, fechainicio, 
                                                      todoeldia, fondo, 
                                                      fechafinal, sala, 
                                                      equipo, facultad,
                                                      docente, grupo, materia];
                                    cnt = 0;
                                  }

                                }

                                        for(k in reservastodas){

                                                //objeto tipo date para almacenar el valor de la fecha inicial de la reserva del arreglo
                                                var fechairan = new Date();
                                                fechairan = moment(reservastodas[k].start, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

                                                //objeto tipo date para almacenar el valor de la fecha final de la reserva que esta en bd
                                                var ffinalran = new Date();
                                                ffinalran = moment(reservastodas[k].end, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

                                                finiciovalidaran = moment(fechainicio, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

                                                finicioran = moment(fechainicio, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

                                                //objeto tipo date para almacenar el valor de la fecha inicial de la reserva que se pretende realizar
                                                var finicioreservaran = new Date();
                                                finicioreservaran = moment(reservastodas[k].start, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD');

                                                

                                                //objeto tipo date para almacenar el valor de la fecha final de la reserva que se pretende
                                                //realizar
                                                var ffinalreservaran = new Date();
                                                ffinalreservaran = moment(fechafinal, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

                                                          //si la fecha de inicio de base de datos (formato YYYY-MM-DD) es igual a la fecha de inicio
                                                  //de reserva que se pretende realizar, se validan las demas condiciones. Es decir que no va
                                                  //revisar todas las reservas sino unicamente las reservas del día en que se pretende realizar
                                                  //la nueva reserva
                                                  if(finiciovalidaran == finicioreservaran){
                                                        //alert(fechafin);
                                                        

                                                          //si esta condicion es verdadera no puede reservar
                                                          if(finicioran>=fechairan && finicioran<=ffinalran){
                                                            
                                                            /*
                                                            $.msgBox({
                                                              title:"Error con fecha inicial",
                                                              content:"¡No se puede realizar reserva, existen algunas que se traslapan! "+finicioran,
                                                              type:"error"
                                                            });
                                                            */
                                                          //reservastras += fechairan + " - " + ffinalran + "\n";
                                                           

                                                            puedehacerreservas = false;
                                                            break;
                                                            
                                                          }else if(ffinalreservaran>=fechairan && ffinalreservaran<=ffinalran){
                                                            
                                                            /*
                                                            $.msgBox({
                                                              title:"Error con fecha final",
                                                              content:"¡No se puede realizar reserva, existen algunas que se traslapan! "+ffinalreservaran,
                                                              type:"error"
                                                            });
                                                            */

                                                          //reservastras += fechairan + " - " + ffinalran + "\n";

                                                            puedehacerreservas = false;
                                                            break;

                                                          }else{
                                                            puedehacerreservas = true;
                                                          }

                                                  }else{
                                                      puedehacerreservas = true;
                                                  }
                                        }//aqui cierra el for

                                                  i++;
                    }//aqui cierra el while

                    //alert(puedehacerreservas);

                                                if(puedehacerreservas){

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
                        $('#errorAjax').append(json.responseText);
                                                    }        
                                                    });
                                                }else if(puedehacerreservas == false){

                                                  $.msgBox({
                                                    title:"Error",
                                                    content:"¡No se puede realizar reservas, algunas se traslapan en el horario! ",
                                                    type:"error"
                                                  });

                                                }
      }//aqui cierra el if de si es reserva de rango

                                              

                                              

  }//aqui cierra el if de si puede reservar

                                            
                                             
                                            
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

    var salad = getUrlParameter('sala');

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

      events: { url:"../cargaEventos" + salad},


      eventRender: function(event, element) { 
            var endd = moment(event.end).format('HH:mm');
            element.find('.fc-title').append(" " + endd); 
      },

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
                        $('#errorAjax').append(json.responseText);
          }        
        });

      }

      

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
            </div>
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
              <label><input type="radio" name="radio" name="ninguna" value="ninguna">Ninguna</label>
            </div>
            <div class="radio disabled">
              <label><input type="radio" name="radio" name="hasta" value="hasta">Hasta una Fecha</label>
            </div>
            <div class="radio disabled">
              <label><input type="radio" name="radio" name="pordias" value="pordias">Por días</label>
            </div>

            <div class='input-group date' id='fechahasta'>
              <input type='text' class="form-control" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>

             <div class="form-group">
                <label>Facultad:</label>
                <div class="selectContainer">
                    <select class="form-control" name="size" id="facultades">
                      <option value="">Seleccione..</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Docente:</label>
                <div class="selectContainer">
                    <select class="form-control" name="size" id="docentes">
                      <option value="">Seleccione..</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Grupo:</label>
                <div class="selectContainer">
                    <select class="form-control" name="size" id="grupos">
                      <option value="">Seleccione..</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Asignatura:</label>
                <div class="selectContainer">
                    <select class="form-control" name="size" id="asignaturas">
                      <option value="">Seleccione..</option>
                    </select>
                </div>
            </div>



             <br>
            <button id="reservar" type="button" class="btn btn-primary btn-flat">Crear Reserva</button>

           

            

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

<div class="modal fade" id="modalresdias" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Reservas por días
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                  <div class="form-horizontal" role="form">

                  <!--
                    <div class="form-group">
                      <label  class="col-sm-2 control-label"
                                for="inputEmail3">Email</label>
                      <div class="col-sm-10">
                          <input type="email" class="form-control" 
                          id="inputEmail3" placeholder="Email"/>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label"
                            for="inputPassword3" >Password</label>
                      <div class="col-sm-10">
                          <input type="password" class="form-control"
                              id="inputPassword3" placeholder="Password"/>
                      </div>
                    </div>
                  -->

                  <div class="form-group">
                  <label class="col-sm-2 control-label">Facultad:</label>
                  <div class="col-sm-10">
                      <select class="form-control" name="size" id="facultadesd">
                        <option value="0">Seleccione..</option>
                      </select>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-2 control-label">Docente:</label>
                  <div class="col-sm-10">
                      <select class="form-control" name="size" id="docentesd">
                        <option value="">Seleccione..</option>
                      </select>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-2 control-label">Grupo:</label>
                  <div class="col-sm-10">
                      <select class="form-control" name="size" id="gruposd">
                        <option value="">Seleccione..</option>
                      </select>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-2 control-label">Asignatura:</label>
                  <div class="col-sm-10" id="pruebalo">
                      <select class="form-control" name="size" id="asignaturasd">
                        <option value="">Seleccione..</option>
                      </select>
                  </div>
              </div>

                 <div class="otros">
                   <label class="otros"> <input type="checkbox" value="lunes" name="chkdias" id="lu"> Lunes</label>
                 </div>
                 <div class="otros">
                   <label><input type="checkbox" value="martes" name="chkdias" id="ma"> Martes</label>
                 </div>
                 <div class="otros">
                   <label><input type="checkbox" value="miercoles" name="chkdias" id="mi"> Miercoles</label>
                 </div>
                 <div class="otros">
                   <label><input type="checkbox" value="jueves" name="chkdias" id="ju"> Jueves</label>
                 </div>
                 <div class="otros">
                   <label><input type="checkbox" value="viernes" name="chkdias" id="vi"> Viernes</label>
                 </div>
                 <div class="otros">
                   <label><input type="checkbox" value="sábado" name="chkdias" id="sa"> Sabado</label>
                 </div>

            
                  </div>

                  <label class="col-sm-2 control-label">Fecha Inicial:</label>
                  <div class='input-group date' id='fechainiciod'>
              <input type='text' class="form-control" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>

            <br>

            <label class="col-sm-2 control-label">Horas:</label>
            <div class='input-group date' >
              <input type='number' class="form-control" id="nhorasd" placeholder="No. de horas" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>

            <br>

                  <label class="col-sm-2 control-label">Hasta:</label>
                  <div class='input-group date' id='fechahastad'>
              <input type='text' class="form-control" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>



            <!--
            <div class='input-group date' id='fechainiciod'>
              <input type='text' class="form-control" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>

            <br>

            <div class='input-group date' >
              <input type='number' class="form-control" id="nhorasd" placeholder="No. de horas" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
            -->
   
          </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal" id="cerrarmodal">
                            Cerrar
                </button>
                <button type="button" class="btn btn-primary" id="reservadias">
                    Reservar
                </button>
            </div>
        </div>
    </div>
</div>


</div>

<div id="errorAjax"></div>

@endsection