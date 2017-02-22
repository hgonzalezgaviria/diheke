@section('head')
  <style type="text/css">
    .modal {
      text-align: center;
    }

    @media screen and (min-width: 768px) { 
      .modal:before {
      display: inline-block;
      vertical-align: middle;
      content: " ";
      height: 100%;
      }
    }

    .modal-dialog {
      display: inline-block;
      text-align: left;
      vertical-align: middle;
    }

    .fa-3x{
      vertical-align: middle;
    }

  </style>
@parent
@endsection
  <div class="modal fade" data-backdrop="static" data-keyboard="false"  id="modalPrestamoEquipos" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

          <div class="modal-header" style="padding:40px 50px;">
            <h4><span class="glyphicon glyphicon-floppy-saved"></span> Prestamo de equipo</h4>
          </div>

          <div class="modal-body" style="padding:40px 50px;">

            <form id="frmPrestamo" method="POST" action="{{URL('prestamoEquipo')}}" accept-charset="UTF-8">
             {{ Form::token() }}
              <div class="form-group">
                <label for="equipo"> Equipo</label>
                <input type="text" class="form-control" name = "equipo" id="equipo" placeholder="ID del equipo a prestar" readonly>
              </div>

              <div class="form-group">
                <label for="doc_usuario"> Cod/ID</label>
                <input type="number" class="form-control" name = "doc_usuario"
                pattern="/^([0-9])*$/" data-toggle="tooltip" title="Numero de ID alumno solo Numeros"
                 id="doc_usuario" placeholder="Ingrese el codigo del documento" required>
              </div>
              <div class="form-group">
                <label for="nombre"> Nombre Completo</label>
                <input type="text" class="form-control" name = "nombre"
                data-toggle="tooltip" title="Nombre de alumno solo letras" id="nombre" placeholder=" Ingrese el nombre" required>
              </div>

           
                <button type="submit" class="btn btn-success btn-block">
                  <span class="glyphicon glyphicon-off"></span> Prestamo
                </button>
            
            </form>

          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
                  <span class="glyphicon glyphicon-remove"></span> Cancelar
                </button>
          </div>
      </div>
      
    </div>
  </div> 