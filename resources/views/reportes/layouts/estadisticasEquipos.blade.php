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
      table.equipos{
        width:800px;
        border-collapse: collapse;
        border:none !important;
      }
      table.equipo{width:150px;/*table-layout: fixed;*/}
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


<table class="equipos">
@foreach($equipos as $key => $equipo)
  @if($key==0 or $key%3==0)
  <tr style="border-collapse: collapse; border:none !important;">
  @endif
  <td style="padding: 10px; border:none !important;">
      <table class="equipo">
        <thead>
          <tr>
            <th>({{$key}}) EQUIPO {{$equipo->EQUI_ID}}</th>
          </tr>
        </thead>
        <tbody>
          <tr class="" style="text-align: center">
            <td>{{$equipo->EQUI_DESCRIPCION}}</td>
          </tr>
          <tr class="" style="text-align: center">
            <td>

            @foreach($equiposConPrest as $eqConPres)
                          @if($eqConPres->EQUI_ID == $equipo->EQUI_ID)
                          {{$eqConPres->EQUI_ID }}
                          @break
                          @else
                          .
                          @endif
            @endforeach
            </td>
          </tr>
          <tr class="" style="text-align: center">
            <td>XXXXXXXXXXXX</td>
          </tr>
        </tbody>
      </table>
  </td>

  @if(($key+1)%3==0)
  </tr>
  @endif
@endforeach
</table>


    </div><!-- end content -->

    <!-- <div class="page-break"></div> -->


    <div class="footer">
      <div>
        <small>Powered by <i>diheke</i></small>
      </div>
    </div>

  </body>

</html>