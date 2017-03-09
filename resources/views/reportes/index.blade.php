@extends('layout')
@section('title', '/ Charts')

@section('head')
    <style type="text/css">
        .canvas-chart {
          height: 400px;
        }
        @media only screen and (max-width: 480px) {
          .canvas-chart {
            height: 600px;
          }
        }

    </style>
@parent
@endsection

@include('reportes/script-angularCharts')
@include('reportes/script-exportarPDF')

@section('content')
    @include('partials/modal')

    <div class="jumbotron">
        <div class="row">
            <div class="col-xs-8">
                <h2 class="page-header">Encuesta {{ $ENCU_id }}</h2>
            </div>
            <div class="col-xs-4 text-right">
                @if($ENCU_paradocente)
                <!-- carga botón de exportar PDFs percepción estudiantil por docentes -->
                {{ Form::button('Generar<br>percepción estudiantil',[
                    'class'=>'btn btn-primary btn-xs',
                    'data-toggle'=>'modal',
                    'data-backdrop'=>'static',
                    'data-formato'=>'ZIP',
                    'data-url'=>URL::to('encuestas/'.$ENCU_id.'/downloadZIP'),
                    'data-target'=>'#msgModalDownloading',
                ])}}
                @endif
                <!-- carga botón de exportar -->
                 @include('reportes/index-modalExport')
            </div>
        </div>
        <hr>

        <div ng-app="appEva360" ng-controller="PreguntasCtrl">
            <div class="row charts" ng-repeat='arrChart in arrCharts'>

                <!-- Carga de gráfico -->
                <div class="col-xs-12 col-md-6">
                    <div class="panel panel-default panel-chart">
                        <div class="panel-heading">
                            Pregunta <span ng-bind="arrChart.PREG_posicion">..</span> Tipo <span ng-bind="arrChart.PREG_tipo">...</span>
                        </div>
                        <div class="panel-body">
                            <canvas class="canvas-chart" id="canvas_{% $index %}" style="height:450px"></canvas>
                        </div>
                    </div>
                </div><!-- Fin de gráfico -->

                <!-- Info general, estadística -->
                <div class="col-xs-12 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">Info</div>
                        <table id="tb-info-{% $index %}" class="table table-bordered table-striped tb-info">
                            <thead>
                                <tr>
                                    <th class="col-xs-1"></th>
                                    <th class="col-xs-8">Pregunta</th>
                                    <th class="col-xs-1" ng-repeat="n in [].constructor(arrChart.datosTabla[0].resps.length) track by $index" ng-bind="$index+1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="fila in arrChart.datosTabla">
                                    <td>
                                        <img ng-src="../../assets/img/colors/{%getColor(fila.color)%}.jpeg">
                                    </td>
                                    <td ng-bind="fila.preg"></td>
                                    <td ng-repeat="resp in fila.resps track by $index" ng-bind="resp"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- Fin info -->

            </div> <!-- Fin ng-repeat arrCharts -->
        </div> <!-- Fin de PreguntasCtrl -->
    </div> <!-- Fin jumbotron -->

<img id="logo" src="{{ asset('assets/img/logo.png') }}" class="hide">
@parent
@endsection