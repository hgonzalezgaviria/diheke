
@section('scripts')
    <script>
     $(function () {

      	/*
      	para realizar la paginacion de una tabla lo unico que hay que hacer es asignarle un id a la tabla,
      	en este caso el id es "tabla" e invocar la función Datatable, lo demas que ven sobre esta función
      	son configuraciones de presentación
      	HFG--Se Realiza ajuste de texto, otros atributos
      	*/
	 	$('.table').DataTable({  
	 		"lengthMenu": [[5, 10, 15, 25,50,100], [5, 10, 15, 25,50,100]],
	 		"sScrollY": "350px",
	        //"pagingType": "full_numbers",
	        "pagingType": "simple_numbers",
	        "bScrollCollapse": true,
	              rowReorder: {
            selector: 'td:nth-child(2)'
        		},
        		rowReorder: false,
	        "responsive": true,
	    "language": { 
		    "sProcessing":     "Procesando...", 
		    "sLengthMenu":     "Mostrar _MENU_ registros", 
		    "sZeroRecords":    "No se encontraron resultados", 
		    "sEmptyTable":     "Ningún dato disponible en esta tabla", 
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", 
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros", 
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)", 
		    "sInfoPostFix":    "", 
		    "sSearch":         "Buscar:", 
		    "sUrl":            "", 
		    "sInfoThousands":  ",", 
		    "sLoadingRecords": "Cargando...", 
		    "oPaginate": { 
		        "sFirst":    "Primero", 
		        "sLast":     "Último", 
		        "sNext":     "Siguiente", 
		        "sPrevious": "Anterior"} 
   					 },	        
	 	});
		
		$('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
			$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust().draw();
		});

	  });
    </script>
@parent
@endsection
