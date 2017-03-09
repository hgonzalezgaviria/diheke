@section('scripts')
  {!! Html::script('assets/js/angular/angular.min.js') !!}
  {!! Html::script('assets/js/chart.js/Chart.bundle.min.js') !!}

  <script type="text/javascript">
    var msgModalLoading = $('#msgModal');
    msgModalLoading.find('#modal-text').text('Cargando datos...');
    msgModalLoading
      .modal({backdrop: 'static', keyboard: false})
      .modal('show');

    var appEva360 = angular.module('appEva360', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('{%');
        $interpolateProvider.endSymbol('%}');
    });

    appEva360.controller('PreguntasCtrl', ['$scope', function($scope){

      //Se carga el arreglo $arrCharts que llega desde el controlador (PHP) a la variable 
      //$scope.arrCharts en Angular
      $scope.arrCharts = {!! json_encode($arrCharts ,JSON_NUMERIC_CHECK) !!};

      //Se cargan los charts al cargar la página
      window.onload = function() {
          //Por cada pregunta se genera un chart
          angular.forEach($scope.arrCharts, function(opcsChart, index){
              $scope.createChart(opcsChart, index);
          });
          //Ocultar modal al finalizar carga de datos y generación de gráficos (charts)
          msgModalLoading.modal('hide');
      };


      /***** FUNCIONES *****/
      //Genera colores aleatorios.
      var randomColorFactor = function() {
          return Math.round(Math.random() * 255);
      };
      var randomColor = function() {
          return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.8)';
      };

      //Función para validar si un número es entero (Compatibilidad para IE11 e inferiores)
      isNumber = function(x) {
        return ! isNaN (x-0) && x !== null && x !== "" && x !== false;
      }

      //Retorna un color predeterminado en un array como RGB.
      $scope.getColor = function (name) {
          /*var colorsHEX = {
              'red':     '#ff0000',
              'yellow':  '#ffff00',
              'green':   '#008000',
              'blue':    '#0000ff',
              'magenta': '#ff00ff',
              'cyan':    '#00ffff',
              'orange':  '#ffa500',
              'grey':    '#808080',
              'deepskyblue': '#00bfff',
              'pink': '#ffc0cb',
              'saddlebrown': '#8b4513',
          };*/

          var colorsRGB = {
              'red':         'rgba(255,0,0,0.8)',
              'yellow':      'rgba(255,255,0,0.8)',
              'green':       'rgba(0,128,0,0.8)',
              'blue':        'rgba(0,0,255,0.8)',
              'magenta':     'rgba(255,0,255,0.8)',
              'cyan':        'rgba(0,255,255,0.8)',
              'orange':      'rgba(255,165,0,0.8)',
              'grey':        'rgba(128,128,128,0.8)',
              'deepskyblue': 'rgba(0,191,255,0.8)',
              'pink':        'rgba(255,192,203,0.8)',
              'saddlebrown': 'rgba(139,69,19,0.8)',
          };

          //Si name es un número, entonces se debe buscar el indice en el arreglo
          if(isNumber(name)){
              index = name;
              var keys = Object.keys(colorsRGB);
              if(index >= 0 && index < keys.length )
                  return colorsRGB[keys[index]];
              else
                  return randomColor();

          }//Sino, entonces se buscará por llave asociativa.
          else if (typeof colorsRGB[name.toLowerCase()] != 'undefined'){
              return colorsRGB[name.toLowerCase()];
          }

          //No se encontró...
          return false;
      }; // Fin function $scope.getColor


      //Adiciona porcentaje como texto en el gráfico de barras (bar)
      var drawLabelBar = function (ctx, dataset) {
          for (var i = 0; i < dataset.data.length; i++) {
              var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model;
              if(ctx.canvas.clientWidth > 600){
                  //ctx.font = '14px Arial';
                  ctx.fillText(dataset.data[i], model.x, model.y -12);
              } else {
                  ctx.save();
                  // Translate 0,0 to the point you want the text
                  ctx.translate(model.x, model.y);
                  // Rotate context by -90 degrees
                  ctx.rotate(-90 * Math.PI / 180);
                  // Draw text
                  ctx.shadowColor = "white";
                  ctx.shadowOffsetX = 1; 
                  ctx.shadowOffsetY = 1;
                  ctx.shadowBlur = 1;
                  ctx.fillText(dataset.data[i], 10, -5);
                  ctx.restore();
              }
          }
      } // Fin function drawLabelBar

      //Adiciona porcentaje como texto en el gráfico de torta (pie)
      var drawLabelPie = function (obj) {
          var self = obj,
          chartInstance = obj.chart,
          ctx = chartInstance.ctx;

          ctx.font = '18px Arial';
          ctx.textAlign = "center";
          ctx.fillStyle = "#ffffff";

          Chart.helpers.each(self.data.datasets.forEach(function (dataset, datasetIndex) {
              var meta = self.getDatasetMeta(datasetIndex),
                  total = 0, //total values to compute fraction
                  labelxy = [],
                  offset = Math.PI / 2, //start sector from top
                  radius,
                  centerx,
                  centery, 
                  lastend = 0; //prev arc's end line: starting with 0

              for (var val in dataset.data) {
                  total += dataset.data[val];
              }

              Chart.helpers.each(meta.data.forEach( function (element, index) {
                  radius = 0.9 * element._model.outerRadius - element._model.innerRadius;
                  centerx = element._model.x;
                  centery = element._model.y;
                  var thispart = dataset.data[index],
                      arcsector = Math.PI * (2 * thispart / total);
                  if (element.hasValue() && dataset.data[index] > 0) {
                    labelxy.push(lastend + arcsector / 2 + Math.PI + offset);
                  }
                  else {
                    labelxy.push(-1);
                  }
                  lastend += arcsector;
              }), self) //Chart.helpers.each

              var lradius = radius * 3 / 4;
              for (var idx in labelxy) {
                  if (labelxy[idx] === -1) continue;
                  var langle = labelxy[idx],
                  dx = centerx + lradius * Math.cos(langle),
                  dy = centery + lradius * Math.sin(langle),
                  val = dataset.data[idx] / total * 100;

                  ctx.save();
                  ctx.shadowColor = "black";
                  ctx.shadowOffsetX = 1; 
                  ctx.shadowOffsetY = 1; 
                  ctx.shadowBlur = 1;
                  ctx.fillText(val.toFixed(2) + ' %', dx, dy);
                  ctx.restore();
              }
          }), self); //Chart.helpers.each
      }// Fin function drawLabelPie


      //Crea un objeto Chart con las obciones definidas en el arreglo .
      $scope.createChart = function(opciones, index) {
          var titulo = opciones.titulo;

          var labelsData = opciones.labelsData;
          var resps_value = opciones.resps_value;
          var chartData = '';
          var opcs = '';

          switch(opciones.tipo_chart){
              //**************
              case 'pie': // Pregunta SI/NO
                  //opciones.tipo_chart = 'pie';
                  chartData = {
                      labels: labelsData,
                      datasets: [{
                          backgroundColor:  [
                              $scope.getColor('red'),
                              $scope.getColor('blue')
                          ],
                          //hoverBorderColor: 'rgb(102, 255, 102)',
                          data: resps_value
                      }]
                  };
                  opcs = {
                      maintainAspectRatio: false,
                      responsive: true,
                      title: {
                          display: true,
                          fontSize: 20,
                          text: ''+opciones.PREG_titulo
                      },
                      legend: {
                          display: false,
                          position: 'top',
                          onClick: null,
                          labels: {
                              fontSize: 16
                          }
                      },
                      animation: {
                          duration: 0,
                          onComplete: function () {
                              drawLabelPie(this);
                          }
                      }
                  };
  
                  break;

              //**************
              case 'bar': // Pregunta Selec única y múltiple
                  chartData = {
                      labels: labelsData,
                      datasets: [{
                          label: 'Preg '+opciones.PREG_posicion,
                          backgroundColor: $scope.getColor('deepskyblue'),
                          //backgroundColor: "#36A2EB",
                          //hoverBorderColor: 'rgb(102, 255, 102)',
                          data: resps_value
                      }]
                  };
                  opcs = {
                      animation: {
                          duration: 0,
                          onComplete: function () {
                              // render the value of the chart above the bar
                              var ctx = this.chart.ctx;
                              Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, 'normal', Chart.defaults.global.defaultFontFamily);
                              ctx.fillStyle = this.chart.config.options.defaultFontColor;
                              ctx.textAlign = 'center';
                              ctx.textBaseline = 'bottom';
                              this.data.datasets.forEach(function (dataset) {
                                  drawLabelBar(ctx, dataset);
                              });

                          }
                      },
                      elements: {
                          rectangle: {
                              borderWidth: 2,
                              //borderColor: 'rgb(0, 204, 0)',
                              borderSkipped: 'bottom'
                          }
                      },
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero: true,
                                  min: 0,
                                  fontSize: 16
                                  //stepSize: 1
                              }
                          }],
                          xAxes: [{
                              ticks: {
                                  fontSize: 16
                              }
                          }]
                      },
                      maintainAspectRatio: false,
                      responsive: true,
                      title: {
                          display: true,
                          fontSize: 20,
                          padding: 25,
                          text: opciones.PREG_titulo
                      },
                      legend: {
                          display: false
                      }
                  };
                  break;

              //**************
              case 'bar2': // Pregunta Escala (Likert)
                  opciones.tipo_chart = 'bar';
                  chartData = {
                      //labels: itemPreg,
                      labels: ["1", "2", "3", "4", "5"],
                      datasets: []
                  };

                  angular.forEach(resps_value, function(resp_value, index){
                          chartData.datasets.push( {
                                  label: opciones.labelsDataSet[index],
                                  backgroundColor: $scope.getColor(index),
                                  //backgroundColor: "rgba(0, 255, 102, 0.8)",
                                  //hoverBorderColor: 'rgb(102, 255, 102)',
                                  data: resp_value
                              }
                          );

                  })

                 opcs = {
                      animation: {
                          duration: 0,
                          onComplete: function () {
                              // render the value of the chart above the bar
                              var ctx = this.chart.ctx;
                              ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, 'normal', Chart.defaults.global.defaultFontFamily);
                              ctx.fillStyle = this.chart.config.options.defaultFontColor;
                              ctx.textAlign = 'center';
                              ctx.textBaseline = 'top';

                              this.data.datasets.forEach(function (dataset) {
                                  drawLabelBar(ctx, dataset);
                              });
                          }
                      },
                      elements: {
                          rectangle: {
                              borderWidth: 2,
                              //borderColor: randomColor(),
                              borderSkipped: 'bottom'
                          }
                      },
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero: true,
                                  min: 0,
                                  fontSize: 16
                              }
                          }],
                          xAxes: [{
                              ticks: {
                                  fontSize: 16
                              }
                          }]
                      },
                      maintainAspectRatio: false,
                      responsive: true,
                      title: {
                          display: true,
                          fontSize: 20,
                          padding: 25,
                          text: opciones.PREG_titulo
                      },
                      legend: {
                          display: false,
                          position: 'bottom',
                          onClick: null,
                          labels: {
                              fontSize: 16
                          }
                      }
                  };
                  break;
              //**************
              default:
                  //null
          } //End switch

          var canvas = document.getElementById('canvas_'+index).getContext("2d");
          window.myBar = new Chart(canvas, {
              type: opciones.tipo_chart,
              data: chartData,
              options: opcs
          }); // Fin window.myBar

          window.myBar.update();
      }; // Fin function createChart
    }]);

  </script>
  
@parent
@endsection