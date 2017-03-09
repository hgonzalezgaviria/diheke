<!DOCTYPE html>
<html lang="es">
  <head>
    <title>PERCEPCIÓN ESTUDIANTIL DOCENTE</title>
    {!! Html::meta(null, 'text/html; charset=utf-8', ['http-equiv'=>'Content-Type'] ) !!}
    <style type="text/css">
      @page {
        margin-top: 120px;
        margin-bottom: 50px;
        margin-left: 20px;
        margin-right: 20px;
      }
      .page-break { page-break-after: always; }
      .header{
        position: fixed;
        top: -80px;
        width: 100%;
        margin-left: 20px;
        margin-right: 20px;
      }
      .title{
        position: absolute;
        top: -90px;
        width: 100%;
        text-align: center;
      }
      .title>h2{margin-bottom: 0;}
      .title>h3{margin-top: 0;}
      .footer{
        position: fixed;
        bottom: -50px;
        width: 100%;
        color: #606060;
      }

      body{
        padding-left:20px;
        padding-right:20px;
      }
      .content{
        font-size: 11px;
      }
      .gruposPreg{
        font-size: 10px;
      }
      .observaciones{
        font-size: 14px;
      }

      thead{
        background-color: LightGray;
      }
      table {
        border-collapse: collapse;
      }
      table#info-docente{width:940px;/*table-layout: fixed;*/}
      table#result-encuesta{width:940px;}
      table, td, th {
        border: 1px solid black;
      }
      .td-text{
        text-align: justify;
      }
      .td-number{
        text-align: center;
        width:50px;
      }
    </style>
  </head>

  <body>

    <div class="header">
      <img class="headerLogo" src="{{ asset('assets/img/logo.png') }}" height="60">
    </div>

    <div class="title">
      <h2>PERCEPCIÓN ESTUDIANTIL DOCENTE</h2>
      <h3>Peridodo Academico: XXXX-X</h3>
    </div>

    <div class="content">

      <table id="info-docente">
        <thead>
          <tr>
            <th style="width:100px">Cedula Docente</th>
            <th style="width:125px">Nombre Docente</th>
            <th style="width:10px">Codigo Asignatura</th>
            <th style="width:125px">Nombre Asignatura</th>
            <th style="width:10px">Grupo</th>
            <th style="width:125px">Facultad</th>
            <th style="width:10px">Nº Evaluacion</th>
            <th style="width:10px">Dominio Curricular (Media)</th>
            <th style="width:10px">Evaluación Aprendizaje (Media)</th>
            <th style="width:10px">Pedagogía (Media)</th>
            <th style="width:10px">Aspecto Humano (Media)</th>
            <th style="width:10px">Calificación General (Media)</th>
            <th style="width:10px">Calificación General (Desv. Est)</th>
          </tr>
        </thead>
        <tbody>
          <tr class="" style="text-align: center">
            <td>XXXXXXXXXXXX</td>
            <td>{{ mb_strtoupper($docente->name) }}</td>
            <td>FIXXXXXX</td>
            <td>XXXXXX ASIGNATURA XXX XXXXXX</td>
            <td>XXX</td>
            <td>XXXXXX FACULTAD XXXXX XXXXXXXX</td>
            <td>{{ $ttlResps }}</td>
            <td>xx.xx</td>
            <td>xx.xx</td>
            <td>xx.xx</td>
            <td>xx.xx</td>
            <td>xx.xx</td>
            <td>{{round($desv_estandar_general, 2)}}</td>
          </tr>
        </tbody>
      </table>

      <br><br>

      <table id="result-encuesta">
        <thead>
          <tr>
            <th rowspan="2" colspan="1">Preguntas</th>
            <th colspan="3">Estadísticas</th>
            <th colspan="5">Porcentajes %</th>
          </tr>
          <tr>
            <th>Media</th>
            <th>Mediana</th>
            <th>Desviacion Estandar</th>

            <th>Total en Desacuerdo</th>
            <th>En Desacuerdo</th>
            <th>Medianamente de Desacuerdo</th>
            <th>De Acuerdo</th>
            <th>Total de Acuerdo</th>
          </tr>
        </thead>
        <tbody>
          @foreach($resumenResps as $preg => $resps)
            <tr>
              <!--<td class="gruposPreg td-text">{{-- $resp['PREG_titulo'] --}}</td>-->
              <td class="td-text">{{ $preg }}</td>
              <td class="td-number media">
                {{ round($resps['estadist']['media'], 2) }}
              </td>
              <td class="td-number mediana">
                {{ round($resps['estadist']['mediana'], 2) }}
              </td>
              <td class="td-number desv-estandar">
                {{ round($resps['estadist']['desv_estandar'], 2) }}
              </td>
              @foreach($resps['resps'] as $resp)
              <td class="td-number">
                {{ $ttlResps === 0 ? 0 : round($resp / $ttlResps * 100, 2) }}
              </td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </table>
    </div><!-- end content -->

    <div class="page-break"></div>

    <div class="title">
      <h2>OBSERVACIONES</h2>
    </div>

    <div class="observaciones">
      @forelse($observaciones as $obs)
        @if(!empty($obs))
          {{$obs}}<br>
        @endif
      @empty
        Sin observaciones.
      @endforelse
    </div> <!-- end content -->


    <div class="footer">
      <div>
        <small>Powered by <i>Shinseiki86</i></small>
      </div>
    </div>

  </body>

</html>